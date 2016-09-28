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
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();
  }

  /**
   * Helper function to get the current language.
   *
   * @param string $default The default value, defaults to `en`
   * @return string The current language if available, otherwise the default
   */
  public function getLanguage($default = 'en') {
    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->config['config']['language'])) {
        return $GLOBALS['TSFE']->config['config']['language'];
      }
    } elseif (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
      return $GLOBALS['BE_USER']->uc['lang'];
    }

    return $default;
  }

  /**
   * Helper function to get the current system language UID.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current system language UID if available, otherwise the default
   */
  public function getSysLanguageUid($default = 0) {
    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->sys_language_uid)) {
        return $GLOBALS['TSFE']->sys_language_uid;
      }
    }

    return $default;
  }
}