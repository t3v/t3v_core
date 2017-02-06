<?php
namespace T3v\T3vCore\Service;

use \T3v\T3vCore\Service\AbstractService;

/**
 * Language Service Class
 *
 * @package T3v\T3vCore\Service
 */
class LanguageService extends AbstractService {
  /**
   * Helper function to get the current language.
   *
   * @param string $default The default value, defaults to `default`
   * @return string The current language if available, otherwise the default
   */
  public function getLanguage($default = 'default') {
    $default  = (string) $default;
    $language = $default;

    if (TYPO3_MODE === 'FE') {
      $language = $GLOBALS['TSFE']->lang;
    } elseif (true === is_object($GLOBALS['LANG'])) {
      $language = $GLOBALS['LANG']->lang;
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
   * Helper function to get the current language UID.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current language UID if available, otherwise the default
   */
  public function getLanguageUid($default = 0) {
    $default     = intval($default);
    $languageUid = $default;

    if (TYPO3_MODE === 'FE') {
      $languageUid = $GLOBALS['TSFE']->sys_language_uid;
    } elseif (true === is_object($GLOBALS['LANG'])) {
      $languageUid = $GLOBALS['LANG']->sys_language_uid;
    }

    // if (TYPO3_MODE === 'FE') {
    //    if (isset($GLOBALS['TSFE']->sys_language_uid)) {
    //     $languageUid = $GLOBALS['TSFE']->sys_language_uid;
    //   }
    // }

    return $languageUid;
  }

  /**
   * Alias for `getLanguageUid`.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current system language UID if available, otherwise the default
   */
  public function getSysLanguageUid($default = 0) {
    $default = intval($default);

    return $this->getLanguageUid($default);
  }
}