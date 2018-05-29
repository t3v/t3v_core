<?php
namespace T3v\T3vCore\Service;

use T3v\T3vCore\Service\AbstractService;

/**
 * The language service class.
 *
 * @package T3v\T3vCore\Service
 */
class LanguageService extends AbstractService {
  /**
   * Gets current language.
   *
   * @param string $default The default language, defaults to `default`
   * @return string The current language if available, otherwise the default one
   */
  public function getLanguage(string $default = 'default'): string {
    $language = $default;

    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->lang)) {
        $language = $GLOBALS['TSFE']->lang;
      }
    } elseif (is_object($GLOBALS['LANG'])) {
      if (isset($GLOBALS['LANG']->lang)) {
        $language = $GLOBALS['LANG']->lang;
      }
    }

    // if (TYPO3_MODE === 'FE') {
    //   if (isset($GLOBALS['TSFE']->config['config']['language'])) {
    //     $language = $GLOBALS['TSFE']->config['config']['language'];
    //   }
    // } elseif (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
    //   $language = $GLOBALS['BE_USER']->uc['lang'];
    // }

    return $language;
  }

  /**
   * Gets current language UID.
   *
   * @param int $default The default language UID, defaults to `0`
   * @return int The current language UID if available, otherwise the default one
   */
  public function getLanguageUid(int $default = 0): int {
    $languageUid = $default;

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
   * Alias for `getLanguageUid`.
   *
   * @param int $default The default system language UID, defaults to `0`
   * @return int The current system language UID if available, otherwise the default
   */
  public function getSysLanguageUid(int $default = 0): int {
    return $this->getLanguageUid($default);
  }
}