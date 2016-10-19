<?php
namespace T3v\T3vCore\Utility\Draft;

use \TYPO3\CMS\Core\Localization\Locales;
use \TYPO3\CMS\Core\Localization\LocalizationFactory;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Localization Utility Class
 *
 * The language can be enforced <https://agilepark.de/?p=37>.
 *
 * @package T3v\T3vCore\Utility\Draft
 */
class LocalizationUtility extends \TYPO3\CMS\Extbase\Utility\LocalizationUtility {
  /**
   * Loads local language values by looking for a `locallang.php` (or `locallang.xlf`) file in the plugin resources
   * directory and if found includes it. Also locallang values set in the TypoScript property `_LOCAL_LANG` are merged
   * onto the values found in the "locallang.php" file.
   *
   * @param string $extensionName The extension name
   * @param string $enforcedLanguage The optional language to be used instead of using the language derived from FE or BE configuration
   * @return void
   */
  public static function initializeLocalization($extensionName, $enforcedLanguage = NULL) {
    if (!is_null($enforcedLanguage)) {
      // Clear language contents as we load another language
      self::$LOCAL_LANG = array();
    } else if (isset(self::$LOCAL_LANG[$extensionName])) {
      return;
    }

    $locallangPathAndFilename = 'EXT:' . GeneralUtility::camelCaseToLowerCaseUnderscored($extensionName) . '/' . self::$locallangPath . 'locallang.xlf';

    self::setLanguageKeys($enforcedLanguage);

    $renderCharset = TYPO3_MODE === 'FE' ? self::getTypoScriptFrontendController()->renderCharset : self::getLanguageService()->charSet;

    $languageFactory = GeneralUtility::makeInstance(LocalizationFactory::class);

    self::$LOCAL_LANG[$extensionName] = $languageFactory->getParsedData($locallangPathAndFilename, self::$languageKey, $renderCharset);

    foreach (self::$alternativeLanguageKeys as $language) {
      $tempLL = $languageFactory->getParsedData($locallangPathAndFilename, $language, $renderCharset);

      if (self::$languageKey !== 'default' && isset($tempLL[$language])) {
        self::$LOCAL_LANG[$extensionName][$language] = $tempLL[$language];
      }
    }

    self::loadTypoScriptLabels($extensionName);
  }

  /**
   * Sets the currently active language / language_alt keys.
   * Default values are `default` for language key and `` for language_alt key.
   * @param string $enforcedLanguage The optional language to be used instead of using the language derived from FE or BE configuration
   * @return void
   */
  protected static function setLanguageKeys() {
    self::$alternativeLanguageKeys = array();

    if (is_null($enforcedLanguage)) {
      self::$languageKey = 'default';

      if (TYPO3_MODE === 'FE') {
        if (isset(self::getTypoScriptFrontendController()->config['config']['language'])) {
          self::$languageKey = self::getTypoScriptFrontendController()->config['config']['language'];

          if (isset(self::getTypoScriptFrontendController()->config['config']['language_alt'])) {
            self::$alternativeLanguageKeys[] = self::getTypoScriptFrontendController()->config['config']['language_alt'];
           } else {
            $locales = GeneralUtility::makeInstance(Locales::class);

            if (in_array(self::$languageKey, $locales->getLocales())) {
              foreach ($locales->getLocaleDependencies(self::$languageKey) as $language) {
                self::$alternativeLanguageKeys[] = $language;
              }
            }
          }
        }
      } elseif (!empty($GLOBALS['BE_USER']->uc['lang'])) {
        self::$languageKey = $GLOBALS['BE_USER']->uc['lang'];
      } elseif (!empty(self::getLanguageService()->lang)) {
        self::$languageKey = self::getLanguageService()->lang;
      }
    } else {
      self::$languageKey = $enforcedLanguage;

      $locales = GeneralUtility::makeInstance(Locales::class);

      if (in_array(self::$languageKey, $locales->getLocales())) {
        foreach ($locales->getLocaleDependencies(self::$languageKey) as $language) {
          self::$alternativeLanguageKeys[] = $language;
        }
      }
    }
  }
}