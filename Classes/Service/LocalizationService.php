<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Extbase\Object\Exception;

/**
 * The localization service class.
 *
 * @package T3v\T3vCore\Service
 */
class LocalizationService extends AbstractService
{
    /**
     * Gets the current language.
     *
     * @param string|null $default The default language, defaults to `en`
     * @return string The current language if available, otherwise the default one
     */
    public function getLanguage(string $default = null): string
    {
        $language = $default ?: 'en';

        if (TYPO3_MODE === 'FE') {
            if (isset($GLOBALS['TSFE']->lang)) {
                $language = $GLOBALS['TSFE']->lang;
            }
        } elseif (is_object($GLOBALS['LANG'])) {
            if (isset($GLOBALS['LANG']->lang)) {
                $language = $GLOBALS['LANG']->lang;
            }
        }

        return $language;
    }

    /**
     * Gets the current language UID.
     *
     * @param int|null $default The default language UID, defaults to `0`
     * @return int The current language UID if available, otherwise the default one
     * @throws Exception
     */
    public function getLanguageUid(int $default = null): int
    {
        $languageUid = $default ?: 0;

        if (TYPO3_MODE === 'FE') {
            return self::getObjectManager()->get(ContextService::class)->getPropertyFromAspect(
                ContextService::SECTION_LANGUAGE,
                ContextService::PROP_LANGUAGE_ID
            );
        }

        if (is_object($GLOBALS['LANG']) && isset($GLOBALS['LANG']->sys_language_uid)) {
            $languageUid = $GLOBALS['LANG']->sys_language_uid;
        }

        return $languageUid;
    }

    /**
     * Gets the current system language UID, alias for `getLanguageUid`.
     *
     * @param int|null $default The default system language UID, defaults to `0`
     * @return int The current system language UID if available, otherwise the default
     * @throws Exception
     */
    public function getSysLanguageUid(int $default = null): int
    {
        $systemLanguageUid = $default ?: 0;

        return $this->getLanguageUid($systemLanguageUid);
    }
}
