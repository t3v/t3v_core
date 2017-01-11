<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \T3v\T3vCore\Service\AbstractService;
use \T3v\T3vCore\Service\LanguageService;

/**
 * Query Result Service Class
 *
 * @package T3v\T3vCore\Service
 */
class QueryResultService extends AbstractService {
  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->languageService = $this->objectManager->get('T3v\T3vCore\Service\LanguageService');
  }

  /**
   * Filters a query result by system language.
   *
   * @param array $queryResult The query result
   * @param mixed $exceptions The optional UIDs which are ignored, as array or as string, seperated by `,`
   * @return array The filtered query result
   */
  public function filterBySysLanguage($queryResult, $exceptions = []) {
    if (is_string($exceptions)) {
      $exceptions = GeneralUtility::intExplode(',', $exceptions, true);
    }

    $result         = $queryResult;
    $sysLanguageUid = $this->languageService->getSysLanguageUid();

    if (!in_array($sysLanguageUid, $exceptions, true)) {
      $result = [];

      foreach ($queryResult as $object) {
        $uid = $object->getSysLanguageUid();

        if ($uid && $uid == $sysLanguageUid) {
          $result[] = $object;
        }
      }
    }

    return $result;
  }
}