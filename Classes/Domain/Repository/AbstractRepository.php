<?php
namespace T3v\T3vCore\Domain\Repository;

use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Core\Utility\VersionNumberUtility;
use TYPO3\CMS\Extbase\Persistence\Generic\QueryResult;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository;

use T3v\T3vCore\Service\LanguageService;

/**
 * The abstract repository class.
 *
 * @package T3v\T3vCore\Domain\Repository
 */
abstract class AbstractRepository extends Repository {
  /**
   * The language service.
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
   */
  public function initializeObject() {
    $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
    $querySettings->setIgnoreEnableFields(false);
    $querySettings->setRespectStoragePage(false);

    $this->setDefaultQuerySettings($querySettings);
  }

  /**
   * Finder to query by UID, overrides the default one.
   *
   * @param int $uid The UID
   * @param array $querySettings The optional query settings to apply
   * @return object|null The found object or null if no object was found
   */
  public function findByUid($uid, $querySettings = ['respectSysLanguage' => false]) {
    $uid = intval($uid);

    if ($uid && $uid > 0) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set constraints
      $query->matching($query->equals('uid', $uid));

      // Execute query and get first object
      $result = $query->execute()->getFirst();

      return $result;
    }

    return null;
  }

  /**
   * Finder to query by multiple UIDs.
   *
   * @param array|string $uids The UIDs as array or as string, seperated by `,`
   * @param array $querySettings The optional query settings to apply
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByUids($uids, $querySettings = ['respectSysLanguage' => false]) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    if (!empty($uids)) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set constraints
      $query->matching($query->in('uid', $uids));

      // Execute query
      $result = $query->execute();

      return $result;
    }

    return null;
  }

  /**
   * Get a raw object by the UID.
   *
   * @param int $uid The UID
   * @param int $languageUid The language UID, defaults to `0`
   * @param array $querySettings The optional query settings to apply
   * @return object|null The raw object or null if no object was found
   */
  public function getRawObjectByUid($uid, $languageUid = 0, $querySettings = ['respectSysLanguage' => false]) {
    $uid         = intval($uid);
    $languageUid = intval($languageUid);

    if ($uid && $uid > 0) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set language UID
      $settings = $query->getQuerySettings();
      $settings->setLanguageUid($languageUid);

      // Set constraints
      $query->matching($query->equals('uid', $uid));

      // Execute query and get raw object
      $result = $query->execute(true);

      return $result[0];
    }

    return null;
  }

  /**
   * Get a raw model by UID.
   *
   * Alias for `getRawObjectByUid`.
   *
   * @param int $uid The UID
   * @param int $languageUid The language UID, defaults to `0`
   * @param array $querySettings The optional query settings to apply
   * @return object|null The raw model or null if no model was found
   */
  public function getRawModelByUid($uid, $languageUid = 0, $querySettings = ['respectSysLanguage' => false]) {
    $uid         = intval($uid);
    $languageUid = intval($languageUid);

    return $this->getRawObjectByUid($uid, $languageUid, $querySettings);
  }

  /**
   * Finder to query by PID.
   *
   * @param int $pid The PID
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings to apply
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByPid($pid, $limit = null, $querySettings = ['respectSysLanguage' => true]) {
    $pid = intval($pid);

    if ($pid && $pid > 0) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set constraints
      $query->matching($query->equals('pid', $pid));

      // Set limit if available
      if (!empty($limit)) {
        $limit = intval($limit);

        $query->setLimit($limit);
      }

      // Execute query
      $result = $query->execute();

      return $result;
    }

    return null;
  }

  /**
   * Finder to query by multiple PIDs.
   *
   * @param array|string $pids The PIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByPids($pids, $limit = null, $querySettings = ['respectSysLanguage' => true]) {
    if (is_string($pids)) {
      $pids = GeneralUtility::intExplode(',', $pids, true);
    }

    if (!empty($pids)) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set constraints
      $query->matching($query->in('pid', $pids));

      // Set limit if available
      if (!empty($limit)) {
        $limit = intval($limit);

        $query->setLimit($limit);
      }

      // Execute query
      $result = $query->execute();

      return $result;
    }

    return null;
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
   * @param string $order The optional order, defaults to `QueryInterface::ORDER_DESCENDING`
   * @return array The orderings
   */
  protected function getOrderingsByField($field, $values, $order = QueryInterface::ORDER_DESCENDING) {
    $orderings = [];

    foreach ($values as $value) {
      $orderings["$field={$value}"] = $order;
    }

    return $orderings;
  }
}