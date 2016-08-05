<?php
namespace T3v\T3vCore\ViewHelpers;

/**
 * Abstract Tag Based View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
abstract class AbstractTagBasedViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
  /**
   * Helper to get the current sys language UID, defaults to `0`.
   *
   * @return int The current sys language UID
   */
  protected function getSysLanguageUid() {
    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->sys_language_uid)) {
        return $GLOBALS['TSFE']->sys_language_uid;
      }
    }

    return 0;
  }

  /**
   * Helper to get the current language, defaults to `en`.
   *
   * @return string The current language
   */
  protected function getLanguage() {
    if (TYPO3_MODE === 'FE') {
      if (isset($GLOBALS['TSFE']->config['config']['language'])) {
        return $GLOBALS['TSFE']->config['config']['language'];
      }
    } elseif (strlen($GLOBALS['BE_USER']->uc['lang']) > 0) {
      return $GLOBALS['BE_USER']->uc['lang'];
    }

    return 'en';
  }
}