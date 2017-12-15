<?php
namespace T3v\T3vCore\Domain\Model\Traits;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * Localization Trait
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait LocalizationTrait {
  /**
   * Helper function to get the localizations.
   *
   * @param string $languageKey The optional language key, defaults to `default`
   * @return array The localizations
   */
  protected function getLocalizations($languageKey = 'default') {
    $loc‌​allang     = ExtensionManagementUtility::extPath(self::EXTENSION_KEY, 'Resources/Private/Language/locallang.xlf');
    $localizations = $this->localizationFactory->getParsedData($loc‌​allang, $languageKey);
    $localizations = $this->getLabelsByLanguageKey($localizations, $languageKey);
    $localizations = $this->getLabelsFromTarget($localizations);

    return $localizations;
  }

  /**
   * Gets the translated labels by a specific language key or fallback to `default`.
   *
   * @param array $localizations The localizations
   * @param string $languageKey The language key
   * @return array The labels
   */
  protected function getLabelsByLanguageKey($localizations, $languageKey) {
    $labels = [];

    if (!empty($localizations[$languageKey])) {
      $labels = $localizations[$languageKey];
    } elseif (!empty($localizations['default'])) {
      $labels = $localizations['default'];
    }

    return $labels;
  }

  /**
   * Simplify labels by just taking the value from the target.
   *
   * @param array $labels The labels
   * @return array The labels
   */
  protected function getLabelsFromTarget($labels) {
    if (is_array($labels)) {
      foreach ($labels as $labelKey => $label) {
        $labels[$labelKey] = $label[0]['target'];
      }
    }

    return $labels;
  }
}