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
     * The modes which TYPO3voilà supports.
     */
    public const STRICT_MODE = 'strict';
    public const FALLBACK_MODE = 'fallback';
    public const FREE_MODE = 'free';

    /**
     * Checks if TYPO3voilà is running in `strict` mode.
     *
     * @return bool If TYPO3voilà is running in `strict` mode
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
     * Checks if TYPO3voilà is running in `fallback` mode.
     *
     * @return bool If TYPO3voilà is running in `fallback` mode
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
     * Checks if TYPO3voilà is running in `free` mode.
     *
     * @return bool If TYPO3voilà is running in `free` mode
     */
    public function runningInFreeMode(): bool
    {
        $freeMode = false;
        $settings = $this->getSettings();

        if (is_array($settings) && !empty($settings)) {
            $mode = $settings['mode'];

            if ($mode === self::FREE_MODE) {
                $freeMode = true;
            }
        }

        return $freeMode;
    }

    /**
     * Gets the settings from `plugin.<IDENTIFIER>.settings`.
     *
     * @param string $identifier The optional plugin identifier, defaults to `tx_t3v`
     * @return array|null The settings
     */
    protected function getSettings(string $identifier = 'tx_t3v'): ?array
    {
        $configurationManager = self::getConfigurationManager();
        $configuration = $configurationManager->getConfiguration(ConfigurationManagerInterface::CONFIGURATION_TYPE_FULL_TYPOSCRIPT);

        if (is_array($configuration['plugin.']) && !empty($configuration['plugin.'])) {
            if ($identifier[-1] !== '.') { // Append `.` to identifier if it does not already exist
                $identifier .= '.';
            }

            if (is_array($configuration['plugin.'][$identifier]) && !empty($configuration['plugin.'][$identifier])) {
                return $configuration['plugin.'][$identifier]['settings.'];
            }
        }

        return null;
    }
}
