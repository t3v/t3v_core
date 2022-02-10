<?php
declare(strict_types=1);

namespace T3v\T3vCore\ViewHelpers\Traits;

use T3v\T3vCore\Service\SettingsService;

/**
 * The settings trait.
 *
 * @package T3v\T3vCore\ViewHelpers\Traits
 */
trait SettingsTrait
{
    /**
     * The settings service.
     *
     * @var SettingsService
     */
    protected $settingsService;

    /**
     * Injects the settings service.
     *
     * @param SettingsService $settingsService The settings service
     */
    public function injectSettingsService(SettingsService $settingsService): void
    {
        $this->settingsService = $settingsService;
    }
}
