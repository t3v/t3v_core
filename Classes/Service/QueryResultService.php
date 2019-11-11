<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

use T3v\T3vCore\Service\AbstractService;
use T3v\T3vCore\Service\LanguageService;

/**
 * The query result service class.
 *
 * @package T3v\T3vCore\Service
 */
class QueryResultService extends AbstractService {
  /**
   * The language service.
   *
   * @var \T3v\T3vCore\Service\LanguageService;
   */
  protected $languageService;

  /**
   * Injects the language service.
   *
   * @param \T3v\T3vCore\Service\LanguageService $languageService
   */
  public function injectLanguageService(LanguageService $languageService): void {
    $this->languageService = $languageService;
  }

  /**
   * Filters a query result by language presets.
   *
   * @param object $queryResult The query result
   * @param array $presets The language presets
   * @return object The filtered query result
   */
  public function filterByLanguagePresets($queryResult, array $presets) {
    $result = $queryResult;

    if (!empty($presets)) {
      $sysLanguageUid = $this->languageService->getSysLanguageUid();
      $preset         = intval($presets[$sysLanguageUid]);

      if (isset($preset)) {
        $result = [];

        foreach ($queryResult as $object) {
          $uid = $object->getSysLanguageUid();

          if (isset($uid) && $uid == $preset) {
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
  public function filterBySysLanguage($queryResult, $exceptions = []) {
    $result = $queryResult;

    if (is_string($exceptions)) {
      $exceptions = GeneralUtility::intExplode(',', $exceptions, true);
    }

    $sysLanguageUid = $this->languageService->getSysLanguageUid();

    if (!in_array($sysLanguageUid, $exceptions, true)) {
      $result = [];

      foreach ($queryResult as $object) {
        $uid = $object->getSysLanguageUid();

        if (isset($uid) && $uid == $sysLanguageUid) {
          $result[] = $object;
        }
      }
    }

    return $result;
  }
}
