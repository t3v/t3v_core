<?php
namespace T3v\T3vCore\Domain\Repository;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \TYPO3\CMS\Extbase\Persistence\Repository;

use \T3v\T3vCore\Service\LanguageService;

/**
 * Abstract Repository Class
 *
 * @package T3v\T3vCore\Domain\Repository
 */
abstract class AbstractRepository extends Repository {
  /**
   * Language Service
   *
   * @var \T3v\T3vCore\Service\LanguageService
   * @inject
   */
  protected $languageService;

  /**
   * The default orderings.
   *
   * @var array
   */
  protected $defaultOrderings = [
    'crdate' => QueryInterface::ORDER_DESCENDING,
    'uid'    => QueryInterface::ORDER_DESCENDING
  ];

  /**
   * The life cycle method.
   *
   * @return void
   */
  public function initializeObject() {
    $querySettings = $this->objectManager->get('TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings');
    $querySettings->setIgnoreEnableFields(false);
    $querySettings->setRespectStoragePage(false);

    $this->setDefaultQuerySettings($querySettings);
  }

  /**
   * Finder to query by UID, overrides the default one.
   *
   * @param int $uid The UID
   * @param array $querySettings The optional query settings
   * @return object|null The found object or null if no object was found
   */
  public function findByUid($uid, $querySettings = ['respectSysLanguage' => false]) {
    $uid = intval($uid);

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = [
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    ];

    if ($uid) {
      $constraints[] = $query->equals('uid', $uid);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Execute query
    $result = $query->execute()->getFirst();

    return $result;
  }

  /**
   * Finder to query by multiple UIDs.
   *
   * @param array|string $uids The UIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByUids($uids, $limit = null, $querySettings = ['respectSysLanguage' => false]) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = [
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    ];

    if (!empty($uids)) {
      $constraints[] = $query->in('uid', $uids);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Set limit if available
    if (!empty($limit)) {
      $limit = intval($limit);

      $query->setLimit($limit);
    }

    // Set orderings
    $query->setOrderings($this->orderByField('uid', $uids));

    // Execute query
    $result = $query->execute();

    return $result;
  }

  /**
   * Finder to query by PID.
   *
   * @param int $pid The PID
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByPid($pid, $limit = null, $querySettings = ['respectSysLanguage' => false]) {
    $pid = intval($pid);

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = [
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    ];

    if ($pid) {
      $constraints[] = $query->equals('pid', $pid);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Set limit if available
    if (!empty($limit)) {
      $limit = intval($limit);

      $query->setLimit($limit);
    }

    // Execute query
    $result = $query->execute();

    return $result;
  }

  /**
   * Finder to query by multiple PIDs.
   *
   * @param array|string $pids The PIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByPids($pids, $limit = null, $querySettings = ['respectSysLanguage' => false]) {
    if (is_string($pids)) {
      $pids = GeneralUtility::intExplode(',', $pids, true);
    }

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = [
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    ];

    if (!empty($pids)) {
      $constraints[] = $query->in('pid', $pids);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Set limit if available
    if (!empty($limit)) {
      $limit = intval($limit);

      $query->setLimit($limit);
    }

    // Set orderings
    $query->setOrderings($this->orderByField('pid', $pids));

    // Execute query
    $result = $query->execute();

    return $result;
  }

  /**
   * Get a raw model by the UID.
   *
   * @param int $uid The UID
   * @param int $languageUid The language UID, defaults to `0`
   * @param array $querySettings The optional query settings
   * @return object|null The raw model or null if no object was found
   */
  public function getRawModelByUid($uid, $languageUid = 0, $querySettings = ['respectSysLanguage' => false]) {
    $uid         = intval($uid);
    $languageUid = intval($languageUid);

    if ($uid) {
      // Create query
      $query = $this->createquery();

      // Set language UID
      $settings = $query->getQuerySettings();
      $settings->setLanguageUid($languageUid);

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Built up constraints
      $constraints = [
        $query->equals('deleted', 0),
        $query->equals('hidden', 0)
      ];

      if ($uid) {
        $constraints[] = $query->equals('uid', $uid);
      }

      // Set constraints
      $query->matching($query->logicalAnd($constraints));

      // Execute query and return raw result
      $result = $query->execute(true);

      $model = $result[0];
    }

    return $model;
  }

  /**
   * Helper function to apply settings on a query.
   *
   * @param object $query The query
   * @param array $settings The settings to apply
   * @return object The query with the applied settings
   */
  protected function applyQuerySettings($query, $settings) {
    if (is_array($settings) && !empty($settings)) {
      $respectStoragePage = $settings['respectStoragePage'];

      if (is_bool($respectStoragePage)) {
        $query->getQuerySettings()->setRespectStoragePage($respectStoragePage);
      }

      $respectSysLanguage = $settings['respectSysLanguage'];

      if (is_bool($respectSysLanguage)) {
        $query->getQuerySettings()->setRespectSysLanguage($respectSysLanguage);
      }

      $returnRawQueryResult = $settings['returnRawQueryResult'];

      if (is_bool($returnRawQueryResult)) {
        $query->getQuerySettings()->setReturnRawQueryResult($returnRawQueryResult);
      }
    }

    return $query;
  }

  /**
   * Helper function to get the orderings by a field.
   *
   * @param string $field The field
   * @param array $values The values
   * @return array The orderings
   */
  protected function orderByField($field, $values) {
    $orderings = [];

    foreach ($values as $value) {
      $orderings["$field={$value}"] = QueryInterface::ORDER_DESCENDING;
    }

    return $orderings;
  }
}