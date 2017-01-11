<?php
namespace T3v\T3vCore\Domain\Model;

/**
 * Abstract Entity Class
 *
 * @package T3v\T3vCore\Domain\Model
 */
abstract class AbstractEntity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {
  /**
   * The entitie's system language UID.
   *
   * @var int
   */
  protected $sysLanguageUid;

  /**
   * Returns the entitie's system language UID.
   *
   * @return int The entitie's system language UID
   */
  public function getSysLanguageUid() {
    return $this->sysLanguageUid;
  }
}