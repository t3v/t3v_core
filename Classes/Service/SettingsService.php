<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;

/**
 * The settings service class.
 *
 * @package T3v\T3vCore\Service
 */
class SettingsService extends AbstractService
{
    /**
     * The modes which T3v Core supports.
     */
    public const STRICT_MODE = 'strict';
    public const FALLBACK_MODE = 'fallback';

    /**
     * Checks if T3v Core is running in `strict` mode.
     *
     * @return bool If T3v Core is running in `strict` mode
     */
    public function runningInStrictMode(): bool
    {
        $strictMode = true;
        $settings = $this->getSettings();

        if (is_array($settings) && !empty($settings)) {
            $mode = $settings['mode'];

            if ($mode !== self::STRICT_MODE) {
                $strictMode = false;
            }
        }

        return $strictMode;
    }

    /**
     * Checks if T3v Core is running in `fallback` mode.
     *
     * @return bool If T3v Core is running in `fallback` mode
     */
    public function runningInFallbackMode(): bool
    {
        $fallbackMode = false;
        $settings = $this->getSettings();

        if (is_array($settings) && !empty($settings)) {
            $mode = $settings['mode'];

            if ($mode === self::FALLBACK_MODE) {
                $fallbackMode = true;
            }
        }

        return $fallbackMode;
    }

    /**
     * Gets the settings from `plugin.tx_t3vcore.settings`.
     *
     * @return array The settings
     */
    protected function getSettings(): array
    {
        $configurationManager = self::getConfigurationManager();
        $configuration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        return $configuration['plugin.']['tx_t3vcore.']['settings.'];
    }
}
