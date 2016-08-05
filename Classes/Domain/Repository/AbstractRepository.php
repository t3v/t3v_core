<?php
namespace T3v\T3vCore\Domain\Repository;

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
   * @param array $uids The UIDs
   * @param int $limit The optional limit
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByUids($uids, $limit = null) {
    $query = $this->createquery();

    // Adjust query settings
    // $query->getQuerySettings()->setRespectStoragePage(false);
    // $query->getQuerySettings()->setReturnRawQueryResult(true);

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
   * Finder to query by page ID.
   *
   * @param int $pid The page ID
   * @return mixed The found object or null if no object was found
   */
  public function findByPid($pid) {
    $query = $this->createQuery();

    $query->matching($query->equals('pid', $pid));

    return $query->execute()->getFirst();
  }

  /**
   * Finder to query by multiple page IDs.
   *
   * @param array $pids The page IDs
   * @param int $limit The optional limit
   * @return \Extbase\Persistence\QueryResult The found objects
   */
  public function findByPids($pids, $limit = null) {
    $query = $this->createquery();

    // Adjust query settings
    // $query->getQuerySettings()->setRespectStoragePage(false);
    // $query->getQuerySettings()->setReturnRawQueryResult(true);

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
   * Helper to get the orderings by field.
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