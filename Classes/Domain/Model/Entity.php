<?php
namespace T3v\T3vCore\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * The entity class.
 *
 * @package T3v\T3vCore\Domain\Model
 */
class Entity extends AbstractEntity {
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
   * Returns the entitie's system language UID.
   *
   * @return int The entitie's system language UID
   */
  public function getSysLanguageUid(): int {
    return $this->sysLanguageUid;
  }

  /**
   * Returns the entitie's L10n parent.
   *
   * @return int The entitie's L10n parent
   */
  public function getL10nParent(): int {
    return $this->l10nParent;
  }

  /**
   * Returns the entitie's localized UID.
   *
   * @return int The entitie's localized UID
   */
  public function getLocalizedUid(): int {
    return $this->_localizedUid;
  }

  /**
   * Returns the entitie's creation date.
   *
   * @return \DateTime The entitie's creation date
   */
  public function getCrdate(): \DateTime {
    return $this->crdate;
  }

  /**
   * Returns when the entity was created, alias for the `getCrdate` function.
   *
   * @return \DateTime The entitie's creation date
   */
  public function getCreatedAt(): \DateTime {
    return $this->getCrdate();
  }

  /**
   * Returns the entitie's timestamp.
   *
   * @return \DateTime The entitie's timestamp
   */
  public function getTstamp(): \DateTime {
    return $this->tstamp;
  }

  /**
   * Returns when the entity was upated, alias for the `getTstamp` function.
   *
   * @return \DateTime The entitie's creation date
   */
  public function getUpdatedAt(): \DateTime {
    return $this->getTstamp();
  }
}
