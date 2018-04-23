<?php
namespace T3v\T3vCore\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper as AbstractTagBasedViewHelperFluid;

use T3v\T3vCore\Service\LanguageService;
use T3v\T3vCore\ViewHelpers\Traits\LanguageTrait;

/**
 * The abstract tag based view helper class.
 *
 * @package T3v\T3vCore\ViewHelpers
 */
abstract class AbstractTagBasedViewHelper extends AbstractTagBasedViewHelperFluid {
  /**
   * The language service.
   *
   * @var \T3v\T3vCore\Service\LanguageService
   * @inject
   */
  protected $languageService;

  /**
   * Use the language trait, requires a language service.
   */
  use LanguageTrait;
}