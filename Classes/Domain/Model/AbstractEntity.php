<?php
namespace T3v\T3vCore\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity as AbstractEntityExtbase;

/**
 * The abstract entity class.
 *
 * @package T3v\T3vCore\Domain\Model
 */
abstract class AbstractEntity extends AbstractEntityExtbase {
  /**
   * The entitie's creation date.
   *
   * @var \DateTime
   */
  protected $crdate;

  /**
   * The entitie's timestamp.
   *
   * @var \DateTime
   */
  protected $tstamp;

  /**
   * The entitie's system language UID.
   *
   * @var int
   */
  protected $sysLanguageUid;

  /**
   * The entitie's L10n parent.
   *
   * @var int
   */
  protected $l10nParent;

  /**
   * The entitie's localized UID.
   *
   * @var int
   */
  protected $_localizedUid;

  /**
   * Returns the entitie's creation date.
   *
   * @return \DateTime The entitie's creation date
   */
  public function getCrdate() {
    return $this->crdate;
  }

  /**
   * Returns the entitie's timestamp.
   *
   * @return \DateTime The entitie's timestamp
   */
  public function getTstamp() {
    return $this->tstamp;
  }

  /**
   * Returns the entitie's system language UID.
   *
   * @return int The entitie's system language UID
   */
  public function getSysLanguageUid() {
    return $this->sysLanguageUid;
  }

  /**
   * Returns the entitie's L10n parent.
   *
   * @return int The entitie's L10n parent
   */
  public function getL10nParent() {
    return $this->l10nParent;
  }

  /**
   * Returns the entitie's localized UID.
   *
   * @return int The entitie's localized UID
   */
  public function getLocalizedUid() {
    return $this->_localizedUid;
  }
}