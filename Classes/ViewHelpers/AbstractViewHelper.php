<?php
namespace T3v\T3vCore\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper as AbstractViewHelperFluid;

use T3v\T3vCore\Service\LanguageService;

/**
 * The abstract view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
abstract class AbstractViewHelper extends AbstractViewHelperFluid {
  /**
   * The language service.
   *
   * @var \T3v\T3vCore\Service\LanguageService
   * @inject
   */
  protected $languageService;

  /**
   * Gets the current language.
   *
   * @param string $default The default value, defaults to `en`
   * @return string The current language if available, otherwise the default
   */
  protected function getLanguage($default = 'en') {
    $default = (string) $default;

    return $this->languageService->getLanguage($default);
  }

  /**
   * Gets the current language UID.
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