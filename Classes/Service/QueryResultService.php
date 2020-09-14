<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The query result service class.
 *
 * @package T3v\T3vCore\Service
 */
class QueryResultService extends AbstractService
{
    /**
     * Filters a query result by language presets.
     *
     * @param object $queryResult The query result
     * @param array $presets The language presets
     * @return object The filtered query result
     */
    public function filterByLanguagePresets($queryResult, array $presets)
    {
        $result = $queryResult;

        if (!empty($presets)) {
            $localizationService = self::getObjectManager()->get(LocalizationService::class);
            $sysLanguageUid = $localizationService->getSysLanguageUid();
            $preset = (int)$presets[$sysLanguageUid];

            if (isset($preset)) {
                $result = [];

                foreach ($queryResult as $object) {
                    $uid = $object->getSysLanguageUid();

                    if (isset($uid) && $uid === $preset) {
                        $result[] = $object;
                    }
                }
            }
        }

        return $result;
    }

    /**
     * Filters a query result by system language.
     *
     * @param object $queryResult The query result
     * @param array|string $exceptions The optional UIDs which are ignored as array or as string, seperated by `,`
     * @return object The filtered query result
     */
    public function filterBySysLanguage($queryResult, $exceptions = [])
    {
        $result = $queryResult;

        if (is_string($exceptions)) {
            $exceptions = GeneralUtility::intExplode(',', $exceptions, true);
        }

        $localizationService = self::getObjectManager()->get(LocalizationService::class);
        $sysLanguageUid = $localizationService->getSysLanguageUid();

        if (!in_array($sysLanguageUid, $exceptions, true)) {
            $result = [];

            foreach ($queryResult as $object) {
                $uid = $object->getSysLanguageUid();

                if (isset($uid) && $uid === $sysLanguageUid) {
                    $result[] = $object;
                }
            }
        }

        return $result;
    }
}
