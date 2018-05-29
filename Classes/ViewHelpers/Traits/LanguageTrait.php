<?php
namespace T3v\T3vCore\ViewHelpers\Traits;

/**
 * The language trait.
 *
 * @package T3v\T3vCore\ViewHelpers\Traits
 */
trait LanguageTrait {
  /**
   * Gets the language.
   *
   * @param string $default The default language, defaults to `en`
   * @return string The language if available, otherwise the default one
   */
  protected function getLanguage(string $default = 'en') {
    return $this->languageService->getLanguage($default);
  }

  /**
   * Gets the language UID.
   *
   * @param int $default The default language UID, defaults to `0`
   * @return int The language UID if available, otherwise the default one
   */
  protected function getLanguageUid(int $default = 0) {
    return $this->languageService->getLanguageUid($default);
  }

  /**
   * Alias for `getLanguageUid`.
   *
   * @param int $default The default system language UID, defaults to `0`
   * @return int The system language UID if available, otherwise the default one
   */
  protected function getSysLanguageUid(int $default = 0) {
    return $this->getLanguageUid($default);
  }
}