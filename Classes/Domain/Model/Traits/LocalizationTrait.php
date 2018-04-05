<?php
namespace T3v\T3vCore\Domain\Model\Traits;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * The localization trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait LocalizationTrait {
  /**
   * Gets the localizations.
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
   * Gets the labels by a language key or the default ones.
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
   * Gets the labels from a target.
   *
   * It simplifies the labels by just taking the value from the target.
   *
   * @param array $labels The labels
   * @return array The labels
   */
  protected function getLabelsFromTarget($labels) {
    if (is_array($labels)) {
      foreach ($labels as $key => $label) {
        $labels[$key] = $label[0]['target'];
      }
    }

    return $labels;
  }
}