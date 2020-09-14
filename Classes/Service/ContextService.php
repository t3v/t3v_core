<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class ContextService extends AbstractService
{
    public const SECTION_DATE = 'date';
    public const SECTION_LANGUAGE = 'language';
    public const SECTION_USER_BACKEND = 'backend.user';
    public const SECTION_USER_FRONTEND = 'frontend.user';
    public const SECTION_VISIBILITY = 'visibility';
    public const SECTION_WORKSPACE = 'workspace';

    public const PROP_DATE_TIMESTAMP = 'timestamp';
    public const PROP_DATE_TIMEZONE = 'timezone';
    public const PROP_DATE_ISO = 'iso';
    public const PROP_DATE_FULL = 'full';

    public const PROP_LANGUAGE_ID = 'id';
    public const PROP_LANGUAGE_CONTENT_ID = 'contentId';
    public const PROP_LANGUAGE_FALLBACK_CHAIN = 'fallbackChain';
    public const PROP_LANGUAGE_OVERLAY_TYPE = 'overlayType';
    public const PROP_LANGUAGE_LEGACY_LANGUAGE_MODE = 'legacyLanguageMode';
    public const PROP_LANGUAGE_LEGACY_OVERLAY_TYPE = 'legacyOverlayType';

    public const PROP_USER_BACKEND_ID = 'id';
    public const PROP_USER_BACKEND_USERNAME = 'username';
    public const PROP_USER_BACKEND_IS_ADMIN = 'isAdmin';
    public const PROP_USER_BACKEND_GROUP_IDS = 'groupIds';

    public const PROP_USER_FRONTEND_IS_LOGGED_IN = 'isLoggedIn';
    public const PROP_USER_FRONTEND_GROUP_NAMES = 'groupNames';
    public const PROP_USER_FRONTEND_IS_ADMIN = self::PROP_USER_BACKEND_IS_ADMIN;
    public const PROP_USER_FRONTEND_GROUP_IDS = self::PROP_USER_BACKEND_GROUP_IDS;

    public const PROP_VISIBILITY_INCLUDE_HIDDEN_PAGES = 'includeHiddenPages';
    public const PROP_VISIBILITY_INCLUDE_HIDDEN_CONTEXT = 'includeHiddenContent';
    public const PROP_VISIBILITY_INCLUDE_DELETEDRECORDS = 'includeDeletedRecords';

    public const PROP_WORKSPACE_ID = 'id';
    public const PROP_WORKSPACE_IS_LIVE = 'isLive';
    public const PROP_WORKSPACE_IS_OFFLINE = 'isOffline';

    /**
     * The context.
     *
     * @var \TYPO3\CMS\Core\Context\Context
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    protected $context;

    /**
     * Constructs a context service.
     */
    public function __construct()
    {
        $this->context = GeneralUtility::makeInstance(Context::class);
    }

    /**
     * Gets the context.
     *
     * @return \TYPO3\CMS\Core\Context\Context The context
     * @noinspection PhpUnnecessaryFullyQualifiedNameInspection
     */
    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * Returns a property from an aspect but only if the property is found.
     *
     * @param string $name The name
     * @param string $property The property
     * @param mixed $default The default
     * @return mixed|null The property
     */
    public function getPropertyFromAspect(string $name, string $property, $default = null)
    {
        $result = null;

        try {
            $result = $this->context->getPropertyFromAspect($name, $property, $default);
        } catch (AspectNotFoundException $exception) {
            return null;
        }

        return $result;
    }

    /**
     * @return int
     */
    public function getDateTimestamp(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_TIMESTAMP
        );
    }

    /**
     * @return string
     */
    public function getDateTimezone(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_TIMEZONE
        );
    }

    /**
     * @return string
     */
    public function getDateIso(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_ISO
        );
    }

    /**
     * @return \DateTimeImmutable
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getDateFull(): \DateTimeImmutable
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_FULL
        );
    }

    /**
     * @return int
     */
    public function getLanguageId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_ID
        );
    }

    /**
     * @return int
     */
    public function getLanguageContentId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_CONTENT_ID
        );
    }

    /**
     * @return string
     */
    public function getLanguageFallbackChain(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_FALLBACK_CHAIN
        );
    }

    /**
     * @return string
     */
    public function getLanguageOverlayType(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_OVERLAY_TYPE
        );
    }

    /**
     * @return string
     */
    public function getLanguageLegacyLanguageMode(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_LEGACY_LANGUAGE_MODE
        );
    }

    /**
     * @return string
     */
    public function getLanguageLegacyOverlayType(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_LEGACY_OVERLAY_TYPE
        );
    }

    /**
     * @return int
     */
    public function getUserBackendId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_ID
        );
    }

    /**
     * @return string
     */
    public function getUserBackendUsername(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_USERNAME
        );
    }

    /**
     * @return bool
     */
    public function isUserBackendIsAdmin(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_IS_ADMIN
        );
    }

    /**
     * @return array
     */
    public function getUserBackendGroupIds(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_GROUP_IDS
        );
    }

    /**
     * @return bool
     */
    public function isUserFrontendIsLoggedIn(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_IS_LOGGED_IN
        );
    }

    /**
     * @return array
     */
    public function getUserFrontendGroupNames(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_GROUP_NAMES
        );
    }

    /**
     * @return array
     */
    public function getUserFrontendGroupIds(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_GROUP_IDS
        );
    }

    /**
     * @return bool
     */
    public function isVisibilityIncludeHiddenPages(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_HIDDEN_PAGES
        );
    }

    /**
     * @return bool
     */
    public function isVisibilityIncludeHiddenContext(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_HIDDEN_CONTEXT
        );
    }

    /**
     * @return bool
     */
    public function isVisibilityIncludeDeletedrecords(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_DELETEDRECORDS
        );
    }

    /**
     * @return int
     */
    public function getWorkspaceId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_ID
        );
    }

    /**
     * @return bool
     */
    public function isWorkspaceIsLive(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_IS_LIVE
        );
    }

    /**
     * @return bool
     */
    public function isWorkspaceIsOffline(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_IS_OFFLINE
        );
    }
}
