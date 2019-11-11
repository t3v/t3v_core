<?php
namespace T3v\T3vCore\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity as AbstractEntity;

/**
 * The abstract model class.
 *
 * @package T3v\T3vCore\Domain\Model
 */
abstract class AbstractModel extends AbstractEntity {
  /**
   * The model's system language UID.
   *
   * @var int
   */
  protected $sysLanguageUid;

  /**
   * The model's L10n parent.
   *
   * @var int
   */
  protected $l10nParent;

  /**
   * The model's localized UID.
   *
   * @var int
   */
  protected $_localizedUid;

  /**
   * The model's creation date.
   *
   * @var \DateTime
   */
  protected $crdate;

  /**
   * The model's timestamp.
   *
   * @var \DateTime
   */
  protected $tstamp;

  /**
   * Returns the model's system language UID.
   *
   * @return int The model's system language UID
   */
  public function getSysLanguageUid(): int {
    return $this->sysLanguageUid;
  }

  /**
   * Returns the model's L10n parent.
   *
   * @return int The model's L10n parent
   */
  public function getL10nParent(): int {
    return $this->l10nParent;
  }

  /**
   * Returns the model's localized UID.
   *
   * @return int The model's localized UID
   */
  public function getLocalizedUid(): int {
    return $this->_localizedUid;
  }

  /**
   * Returns the model's creation date.
   *
   * @return \DateTime The model's creation date
   */
  public function getCrdate(): \DateTime {
    return $this->crdate;
  }

  /**
   * Returns when the entity was created, alias for `getCrdate`.
   *
   * @return \DateTime The model's creation date
   */
  public function getCreatedAt(): \DateTime {
    return $this->getCrdate();
  }

  /**
   * Returns the model's timestamp.
   *
   * @return \DateTime The model's timestamp
   */
  public function getTstamp(): \DateTime {
    return $this->tstamp;
  }

  /**
   * Returns when the entity was upated, alias for `getTstamp`.
   *
   * @return \DateTime The model's creation date
   */
  public function getUpdatedAt(): \DateTime {
    return $this->getTstamp();
  }
}
