<?php
namespace T3v\T3vCore\Domain\Model\Traits;

/**
 * The Language UID trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait LanguageUidTrait {
  /**
   * The entitie's language UID.
   *
   * @var int
   */
  protected $languageUid;

  /**
   * The entitie's intern language UID.
   *
   * @var int
   */
  protected $_languageUid;

  /**
   * Returns the entitie's language UID.
   *
   * @return int The entitie's language UID
   */
  public function getLanguageUid() {
    return $this->_languageUid;
  }

  /**
   * Sets the entitie's language UID.
   *
   * @param int $languageUid The entitie's language UID
   */
  public function setLanguageUid($languageUid) {
    $this->_languageUid = $languageUid;
  }
}