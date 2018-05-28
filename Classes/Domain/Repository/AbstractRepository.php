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
   * Finds objects by UID, overrides the default one.
   *
   * @param int $uid The UID
   * @param array $querySettings The optional query settings to apply
   * @return object|null The found object or null if no object was found
   */
  public function findByUid(int $uid, array $querySettings = ['respectSysLanguage' => false]) {
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
   * Finds objects by multiple UIDs.
   *
   * @param array|string $uids The UIDs as array or as string, seperated by `,`
   * @param array $querySettings The optional query settings to apply
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByUids($uids, array $querySettings = ['respectSysLanguage' => false]) {
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
  public function getRawObjectByUid(int $uid, int $languageUid = 0, array $querySettings = ['respectSysLanguage' => false]) {
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
  public function getRawModelByUid(int $uid, int $languageUid = 0, array $querySettings = ['respectSysLanguage' => false]) {
    return $this->getRawObjectByUid($uid, $languageUid, $querySettings);
  }

  /**
   * Finds objects by PID.
   *
   * @param int $pid The PID
   * @param int $limit The optional limit, defaults to `0`
   * @param array $querySettings The optional query settings to apply
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByPid(int $pid, int $limit = 0, array $querySettings = ['respectSysLanguage' => true]) {
    if ($pid && $pid > 0) {
      // Create query
      $query = $this->createquery();

      // Apply query settings
      $query = $this->applyQuerySettings($query, $querySettings);

      // Set constraints
      $query->matching($query->equals('pid', $pid));

      // Set limit if available
      if ($limit > 0) {
        $query->setLimit($limit);
      }

      // Execute query
      $result = $query->execute();

      return $result;
    }

    return null;
  }

  /**
   * Finds objects by multiple PIDs.
   *
   * @param array|string $pids The PIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit, defaults to `0`
   * @param array $querySettings The optional query settings
   * @return \TYPO3\CMS\Extbase\Persistence\Generic\QueryResult|null The found objects or null if no objects were found
   */
  public function findByPids($pids, int $limit = 0, array $querySettings = ['respectSysLanguage' => true]) {
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
      if ($limit > 0) {
        $query->setLimit($limit);
      }

      // Execute query
      $result = $query->execute();

      return $result;
    }

    return null;
  }

  /**
   * Applies settings on a query.
   *
   * @param object $query The query
   * @param array $settings The settings to apply
   * @return object The query with the applied settings
   */
  protected function applyQuerySettings($query, array $settings) {
    if (!empty($settings)) {
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
   * Gets the orderings by a field.
   *
   * @param string $field The field
   * @param array $values The values
   * @param string $order The optional order, defaults to `QueryInterface::ORDER_DESCENDING`
   * @return array The orderings
   */
  protected function getOrderingsByField(string $field, array $values, string $order = QueryInterface::ORDER_DESCENDING) {
    $orderings = [];

    if (!empty($values)) {
      foreach ($values as $value) {
        $orderings["$field={$value}"] = $order;
      }
    }

    return $orderings;
  }
}