<?php
namespace T3v\T3vCore\Domain\Model\Traits;

/**
 * The Language UID trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait LanguageUidTrait {
  /**
   * The model's language UID.
   *
   * @var int
   */
  protected $languageUid;

  /**
   * The model's intern language UID.
   *
   * @var int
   */
  protected $_languageUid;

  /**
   * Returns the model's language UID.
   *
   * @return int The model's language UID
   */
  public function getLanguageUid(): int {
    return $this->_languageUid;
  }

  /**
   * Sets the model's language UID.
   *
   * @param int $languageUid The model's language UID
   */
  public function setLanguageUid(int $languageUid) {
    $this->_languageUid = $languageUid;
  }
}
