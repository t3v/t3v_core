<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Utility\GeneralUtility;

use T3v\T3vCore\Service\AbstractService;
use T3v\T3vCore\Service\LanguageService;

/**
 * Query Result Service Class
 *
 * @package T3v\T3vCore\Service
 */
class QueryResultService extends AbstractService {
  /**
   * The language service
   *
   * @var \T3v\T3vCore\Service\LanguageService;
   */
  protected $languageService;


  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->languageService = $this->objectManager->get(LanguageService::class);
  }

  /**
   * Filters a query result by language presets.
   *
   * @param array $queryResult The query result
   * @param array $presets The language presets
   * @return array The filtered query result
   */
  public function filterByLanguagePresets($queryResult, $presets) {
    $result = $queryResult;

    if (is_array($presets) && !empty($presets)) {
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
   * @param array $queryResult The query result
   * @param array|string $exceptions The optional UIDs which are ignored, as array or as string, seperated by `,`
   * @return array The filtered query result
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