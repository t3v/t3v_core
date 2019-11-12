<?php
namespace T3v\T3vCore\Domain\Repository;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;
use TYPO3\CMS\Extbase\Persistence\QueryInterface;
use TYPO3\CMS\Extbase\Persistence\Repository as RepositoryExtbase;

/**
 * The repository class.
 *
 * @package T3v\T3vCore\Domain\Repository
 */
class Repository extends RepositoryExtbase {
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
   * Initialize the object.
   */
  public function initializeObject(): void {
    /** @var Typo3QuerySettings $querySettings */
    $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
    $querySettings->setRespectStoragePage(false);

    $this->setDefaultQuerySettings($querySettings);
  }
}
