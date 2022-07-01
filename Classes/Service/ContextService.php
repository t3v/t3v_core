<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use DateTimeImmutable;
use TYPO3\CMS\Core\Context\Context;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;

/**
 * The context service class.
 *
 * @package T3v\T3vCore\Service
 */
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
     * @var Context
     */
    protected $context;

    /**
     * Gets the context.
     *
     * @return Context The context
     */
    public function getContext(): Context
    {
        return $this->context;
    }

    /**
     * Gets the property from an aspect but only if the property is found.
     *
     * @param string $name The name
     * @param string $property The property
     * @param mixed $default The default
     * @return mixed|null The property
     */
    public function getPropertyFromAspect(string $name, string $property, $default = null)
    {
        try {
            $result = $this->context->getPropertyFromAspect($name, $property, $default);
        } catch (AspectNotFoundException $exception) {
            return null;
        }

        return $result;
    }

    /**
     * Gets the date time stamp.
     *
     * @return int The date time stamp
     */
    public function getDateTimestamp(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_TIMESTAMP
        );
    }

    /**
     * Gets the date time zone.
     *
     * @return string The date time zone
     */
    public function getDateTimezone(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_TIMEZONE
        );
    }

    /**
     * Gets the date iso.
     *
     * @return string The date iso
     */
    public function getDateIso(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_ISO
        );
    }

    /**
     * Gets the date time immutable.
     *
     * @return DateTimeImmutable The date time immutable
     */
    public function getDateFull(): DateTimeImmutable
    {
        return $this->getPropertyFromAspect(
            self::SECTION_DATE,
            self::PROP_DATE_FULL
        );
    }

    /**
     * Gets the language uid.
     *
     * @return int The language uid
     */
    public function getLanguageId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_ID
        );
    }

    /**
     * Gets the language content uid.
     *
     * @return int The language content uid
     */
    public function getLanguageContentId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_CONTENT_ID
        );
    }

    /**
     * Gets the language fallback chain.
     *
     * @return string The language fallback chain
     */
    public function getLanguageFallbackChain(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_FALLBACK_CHAIN
        );
    }

    /**
     * Gets the language overlay type.
     *
     * @return string The language overlay type
     */
    public function getLanguageOverlayType(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_OVERLAY_TYPE
        );
    }

    /**
     * Gets the language legacy language mode.
     *
     * @return string The language legacy language mode
     */
    public function getLanguageLegacyLanguageMode(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_LEGACY_LANGUAGE_MODE
        );
    }

    /**
     * Gets the language legacy overlay type.
     *
     * @return string The language legacy overlay type
     */
    public function getLanguageLegacyOverlayType(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_LANGUAGE,
            self::PROP_LANGUAGE_LEGACY_OVERLAY_TYPE
        );
    }

    /**
     * Gets the backend user ID.
     *
     * @return int The backend user ID
     */
    public function getUserBackendId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_ID
        );
    }

    /**
     * Gets the backend username.
     *
     * @return string The backend username
     */
    public function getUserBackendUsername(): string
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_USERNAME
        );
    }

    /**
     * Gets if the backend user is an admin.
     *
     * @return bool If the backend user is an admin
     */
    public function isUserBackendIsAdmin(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_IS_ADMIN
        );
    }

    /**
     * Gets the group IDs from the backend user.
     *
     * @return array The group IDs from the backend user
     */
    public function getUserBackendGroupIds(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_BACKEND,
            self::PROP_USER_BACKEND_GROUP_IDS
        );
    }

    /**
     * Gets if frontend user is logged in.
     *
     * @return bool If frontend user is logged in
     */
    public function isUserFrontendIsLoggedIn(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_IS_LOGGED_IN
        );
    }

    /**
     * Gets if the frontend user is an admin.
     *
     * @return bool If the frontend user is an admin
     */
    public function isUserFrontendIsAdmin(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_IS_ADMIN
        );
    }

    /**
     * Gets the group IDs from the frontend user.
     *
     * @return array The group IDs from the frontend user
     */
    public function getUserFrontendGroupIds(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_GROUP_IDS
        );
    }

    /**
     * Gets the group names from the frontend user.
     *
     * @return array The group names from the frontend user
     */
    public function getUserFrontendGroupNames(): array
    {
        return $this->getPropertyFromAspect(
            self::SECTION_USER_FRONTEND,
            self::PROP_USER_FRONTEND_GROUP_NAMES
        );
    }

    /**
     * Gets if the visibility includes hidden pages.
     *
     * @return bool If the visibility includes hidden pages
     */
    public function isVisibilityIncludeHiddenPages(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_HIDDEN_PAGES
        );
    }

    /**
     * Gets if the visibility includes hidden context.
     *
     * @return bool If the visibility includes hidden context
     */
    public function isVisibilityIncludeHiddenContext(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_HIDDEN_CONTEXT
        );
    }

    /**
     * Gets if the visibility includes delete records.
     *
     * @return bool If the visibility includes delete records
     */
    public function isVisibilityIncludeDeletedrecords(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_VISIBILITY,
            self::PROP_VISIBILITY_INCLUDE_DELETEDRECORDS
        );
    }

    /**
     * Gets the workspace ID.
     *
     * @return int The workspace ID
     */
    public function getWorkspaceId(): int
    {
        return (int)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_ID
        );
    }

    /**
     * Gets if the workspace is live.
     *
     * @return bool If the workspace is live
     */
    public function isWorkspaceIsLive(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_IS_LIVE
        );
    }

    /**
     * Gets if the workspace is offline.
     *
     * @return bool If the workspace is offline
     */
    public function isWorkspaceIsOffline(): bool
    {
        return (bool)$this->getPropertyFromAspect(
            self::SECTION_WORKSPACE,
            self::PROP_WORKSPACE_IS_OFFLINE
        );
    }

    /**
     * Injects the context.
     *
     * @var Context The context
     */
    public function injectContext(Context $context): void
    {
        $this->context = $context;
    }
}
