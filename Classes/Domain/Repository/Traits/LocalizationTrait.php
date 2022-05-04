<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Repository\Traits;

use TYPO3\CMS\Extbase\Persistence\Generic\Typo3QuerySettings;

/**
 * The localization trait.
 *
 * @package T3v\T3vCore\Domain\Repository\Traits
 */
trait LocalizationTrait
{
    /**
     * The TYPO3 query settings.
     *
     * @var Typo3QuerySettings
     */
    protected $querySettings;

    /**
     * Initializes the object.
     */
    public function initializeObject(): void
    {
        $this->querySettings->setRespectStoragePage(false);
        $this->setDefaultQuerySettings($this->querySettings);
    }

    /**
     * Injects the query settings.
     *
     * @param Typo3QuerySettings $querySettings The query settings
     */
    public function injectQuerySettings(Typo3QuerySettings $querySettings): void
    {
        $this->querySettings = $querySettings;
    }
}
