<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Model\Traits;

use TYPO3\CMS\Core\Localization\LocalizationFactory;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

/**
 * The localization trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait LocalizationTrait
{
    /**
     * The entity's language UID.
     *
     * @var int
     */
    protected $languageUid;

    /**
     * The localization factory.
     *
     * @var \TYPO3\CMS\Core\Localization\LocalizationFactory
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $localizationFactory;

    /**
     * Returns the entity's language UID.
     *
     * @return int The entity's language UID
     */
    public function getLanguageUid(): int
    {
        return $this->_languageUid;
    }

    /**
     * Sets the entity's language UID.
     *
     * @param int $languageUid The entity's language UID
     */
    public function setLanguageUid(int $languageUid): void
    {
        $this->_languageUid = $languageUid;
    }

    /**
     * Injects the localization factory.
     *
     * @param LocalizationFactory $localizationFactory The localization factory
     */
    public function injectLocalizationFactory(LocalizationFactory $localizationFactory): void
    {
        $this->localizationFactory = $localizationFactory;
    }

    /**
     * Gets localizations from the standard translation file (`~Resources/Private/Language/locallang.xlf`).
     *
     * @param string $languageKey The optional language key, defaults to `default`
     * @return array The localizations
     */
    protected function getLocalizations(string $languageKey = 'default'): array
    {
        $localLang = ExtensionManagementUtility::extPath(static::EXTENSION_KEY, 'Resources/Private/Language/locallang.xlf');
        $localizations = $this->localizationFactory->getParsedData($localLang, $languageKey);
        $localizations = $this->getLabelsByLanguageKey($localizations, $languageKey);

        return $this->getLabelsFromTarget($localizations);
    }

    /**
     * Gets labels by a language key or the default ones.
     *
     * @param array $localizations The localizations
     * @param string $languageKey The language key
     * @return array The labels
     */
    protected function getLabelsByLanguageKey(array $localizations, string $languageKey): array
    {
        $labels = [];

        if (!empty($localizations[$languageKey])) {
            $labels = $localizations[$languageKey];
        } elseif (!empty($localizations['default'])) {
            $labels = $localizations['default'];
        }

        return $labels;
    }

    /**
     * Gets labels from a target.
     *
     * It simplifies the labels by just taking the value from the target.
     *
     * @param array $labels The labels
     * @return array The labels
     */
    protected function getLabelsFromTarget(array $labels): array
    {
        if (!empty($labels)) {
            foreach ($labels as $key => $label) {
                $labels[$key] = $label[0]['target'];
            }
        }

        return $labels;
    }
}
