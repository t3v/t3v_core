<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

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
     * @throws AspectNotFoundException
     */
    public function getLanguage(string $default = null): string
    {
        $language = $default ?: 'en';

        if (TYPO3_MODE === 'FE') {
            if (class_exists(Context::class)) {
                $context = GeneralUtility::makeInstance(Context::class);
                $site = $GLOBALS['TYPO3_REQUEST']->getAttribute('site');
                $id = $context->getPropertyFromAspect('language', 'id');
                $language = $site->getLanguageById($id);

                return $language->getTwoLetterIsoCode();
            }

            if (is_object($GLOBALS['TSFE']) && isset($GLOBALS['TSFE']->lang)) {
                return $GLOBALS['TSFE']->lang;
            }
        }

        if (is_object($GLOBALS['LANG']) && isset($GLOBALS['LANG']->lang)) {
            return $GLOBALS['LANG']->lang;
        }

        return $language;
    }

    /**
     * Gets the current language UID.
     *
     * @param int|null $default The default language UID, defaults to `0`
     * @return int The current language UID if available, otherwise the default one
     * @throws AspectNotFoundException
     */
    public function getLanguageUid(int $default = null): int
    {
        $languageUid = $default ?: 0;

        if (TYPO3_MODE === 'FE') {
            if (class_exists(Context::class)) {
                return GeneralUtility::makeInstance(Context::class)->getPropertyFromAspect('language', 'id');
            }

            if (is_object($GLOBALS['TSFE']) && isset($GLOBALS['TSFE']->sys_language_uid)) {
                return $GLOBALS['TSFE']->sys_language_uid;
            }
        }

        if (is_object($GLOBALS['LANG']) && isset($GLOBALS['LANG']->sys_language_uid)) {
            return $GLOBALS['LANG']->sys_language_uid;
        }

        return $languageUid;
    }

    /**
     * Gets the current system language UID, alias for `getLanguageUid`.
     *
     * @param int|null $default The default system language UID, defaults to `0`
     * @return int The current system language UID if available, otherwise the default
     * @throws AspectNotFoundException
     */
    public function getSysLanguageUid(int $default = null): int
    {
        $systemLanguageUid = $default ?: 0;

        return $this->getLanguageUid($systemLanguageUid);
    }
}
