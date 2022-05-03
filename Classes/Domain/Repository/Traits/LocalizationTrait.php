<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Repository\Traits;

use T3v\T3vCore\Service\LocalizationService;
use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * The localization trait.
 *
 * @package T3v\T3vCore\Domain\Repository\Traits
 */
trait LocalizationTrait
{
    /**
     * The localization service.
     *
     * @var LocalizationService
     */
    protected $localizationService;

    /**
     * Initializes the object.
     */
    public function initializeObject(): void
    {
        $querySettings = $this->objectManager->get(Typo3QuerySettings::class);
        $querySettings->setRespectStoragePage(false);

        // Switch by system language UID (Language Fallback Mapping)
        //
        // $sysLanguageUid = $this->localizationService->getSysLanguageUid();
        //
        // switch ($sysLanguageUid) {
        //   case 0:
        //     $querySettings->setLanguageUid(0);
        //
        //     break;
        //
        //   case 1:
        //     $querySettings->setLanguageUid(1);
        //
        //     break;
        //
        //   default:
        //     $querySettings->setLanguageUid(0);
        // }

        $this->setDefaultQuerySettings($querySettings);
    }

    /**
     * Injects the localization service.
     *
     * @param LocalizationService $localizationService The localization service
     */
    public function injectLocalizationService(LocalizationService $localizationService): void
    {
        $this->localizationService = $localizationService;
    }
}
