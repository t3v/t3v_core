<?php
namespace T3v\T3vCore\Service;

use T3v\T3vCore\Service\AbstractService;

/**
 * The localization service class.
 *
 * @package T3v\T3vCore\Service
 */
class LocalizationService extends AbstractService {
  /**
   * Gets the current language.
   *
   * @param string $fallback The optional fallback language, defaults to `en`
   * @return string The current language if available, otherwise the fallback language
   */
  public function getLanguage(string $fallback = null): string {
    $language = $fallback ?: 'en';

    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->lang)) {
        $language = $GLOBALS['TSFE']->lang;
      }
    } elseif (is_object($GLOBALS['LANG'])) {
      if (isset($GLOBALS['LANG']->lang)) {
        $language = $GLOBALS['LANG']->lang;
      }
    }

    return $language;
  }

  /**
   * Gets the current language UID.
   *
   * @param int $fallback The optional fallback language UID, defaults to `0`
   * @return int The current language UID if available, otherwise the fallback language UID
   */
  public function getLanguageUid(int $fallback = null): int {
    $languageUid = $fallback ?: 0;

    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->sys_language_uid)) {
        $languageUid = $GLOBALS['TSFE']->sys_language_uid;
      }
    } elseif (is_object($GLOBALS['LANG'])) {
      if (isset($GLOBALS['LANG']->sys_language_uid)) {
        $languageUid = $GLOBALS['LANG']->sys_language_uid;
      }
    }

    return $languageUid;
  }

  /**
   * Gets the current system language UID, alias for `getLanguageUid`.
   *
   * @param int $fallback The optional fallback system language UID, defaults to `0`
   * @return int The current system language UID if available, otherwise the fallback system language UID
   */
  public function getSysLanguageUid(int $fallback = null): int {
    return $this->getLanguageUid($fallback);
  }
}
