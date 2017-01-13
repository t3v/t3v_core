<?php
namespace T3v\T3vCore\ViewHelpers;

use \T3v\T3vCore\Service\LanguageService;

/**
 * Abstract Tag Based View Helper Class
 *
 * @package T3v\T3vCore\ViewHelpers
 */
abstract class AbstractTagBasedViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper {
  /**
   * @var \T3v\T3vCore\Service\LanguageService
   * @inject
   */
  protected $languageService;

  /**
   * Helper function to get the current language.
   *
   * @param string $default The default value, defaults to `en`
   * @return string The current language if available, otherwise the default
   */
  protected function getLanguage($default = 'en') {
    $default = (string) $default;

    return $this->languageService->getLanguage($default);
  }

  /**
   * Helper function to get the current language UID.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current language UID if available, otherwise the default
   */
  protected function getLanguageUid($default = 0) {
    $default = intval($default);

    return $this->languageService->getLanguageUid($default);
  }

  /**
   * Alias for `getLanguageUid`.
   *
   * @param int $default The default value, defaults to `0`
   * @return int The current system language UID if available, otherwise the default
   */
  protected function getSysLanguageUid($default = 0) {
    $default = intval($default);

    return $this->getLanguageUid($default);
  }
}