<?php
namespace T3v\T3vCore\ViewHelpers\Traits;

use T3v\T3vCore\Service\LocalizationService;

/**
 * The localization trait.
 *
 * @package T3v\T3vCore\ViewHelpers\Traits
 */
trait LocalizationTrait
{
    /**
     * The localization service.
     *
     * @var \T3v\T3vCore\Service\LocalizationService
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $localizationService;

    /**
     * Injects the localization service.
     *
     * @param \T3v\T3vCore\Service\LocalizationService $localizationService The localization service
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public function injectLocalizationService(LocalizationService $localizationService): void
    {
        $this->localizationService = $localizationService;
    }

    /**
     * Gets the language.
     *
     * @param string $default The default language, defaults to `en`
     * @return string The language if available, otherwise the default one
     */
    protected function getLanguage(string $default = null): string
    {
        $language = $default ?: 'en';

        return $this->localizationService->getLanguage($language);
    }

    /**
     * Gets the language UID.
     *
     * @param int $default The default language UID, defaults to `0`
     * @return int The language UID if available, otherwise the default one
     */
    protected function getLanguageUid(int $default = null): int
    {
        $languageUid = $default ?: 0;

        return $this->localizationService->getLanguageUid($languageUid);
    }

    /**
     * Gets the system language UID, alias for `getLanguageUid`.
     *
     * @param int $default The default system language UID, defaults to `0`
     * @return int The system language UID if available, otherwise the default one
     */
    protected function getSysLanguageUid(int $default = null): int
    {
        $systemLanguageUid = $default ?: 0;

        return $this->getLanguageUid($systemLanguageUid);
    }
}
