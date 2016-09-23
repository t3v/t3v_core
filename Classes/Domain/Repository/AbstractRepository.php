<?php
namespace T3v\T3vCore\Domain\Repository;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use \TYPO3\CMS\Extbase\Persistence\QueryInterface;
use \TYPO3\CMS\Extbase\Persistence\Repository;

/**
 * Abstract Repository Class
 *
 * @package T3v\T3vCore\Domain\Repository
 */
abstract class AbstractRepository extends Repository {
  protected $defaultOrderings = [
    'crdate' => QueryInterface::ORDER_DESCENDING,
    'uid'    => QueryInterface::ORDER_DESCENDING
  ];

  /**
   * Life cycle method.
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
   * Finder to query by multiple UIDs.
   *
   * @param mixed $uids The UIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByUids($uids, $limit = null, $querySettings = []) {
    if (is_string($uids)) {
      $uids = GeneralUtility::intExplode(',', $uids, true);
    }

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = array(
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    );

    if (!empty($uids)) {
      $constraints[] = $query->in('uid', $uids);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Set limit if available
    if (!empty($limit)) {
      $query->setLimit($limit);
    }

    $query->setOrderings($this->orderByField('uid', $uids));

    return $query->execute();
  }

  /**
   * Finder to query by PID.
   *
   * @param int $pid The PID
   * @param array $querySettings The optional query settings
   * @return mixed The first found object or null if no object was found
   */
  public function findByPid($pid, $querySettings = []) {
    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    $query->matching($query->equals('pid', $pid));

    return $query->execute()->getFirst();
  }

  /**
   * Finder to query by multiple PIDs.
   *
   * @param mixed $pids The PIDs as array or as string, seperated by `,`
   * @param int $limit The optional limit
   * @param array $querySettings The optional query settings
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByPids($pids, $limit = null, $querySettings = []) {
    if (is_string($pids)) {
      $pids = GeneralUtility::intExplode(',', $pids, true);
    }

    // Create query
    $query = $this->createquery();

    // Apply query settings
    $query = $this->applyQuerySettings($query, $querySettings);

    // Built up constraints
    $constraints = array(
      $query->equals('deleted', 0),
      $query->equals('hidden', 0)
    );

    if (!empty($pids)) {
      $constraints[] = $query->in('pid', $pids);
    }

    // Set constraints
    $query->matching($query->logicalAnd($constraints));

    // Set limit if available
    if (!empty($limit)) {
      $query->setLimit($limit);
    }

    $query->setOrderings($this->orderByField('pid', $pids));

    return $query->execute();
  }

  /**
   * Helper to apply settings on a query.
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
   * Helper to get the orderings by a field.
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