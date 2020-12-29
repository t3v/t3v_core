<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Utility;

use T3v\T3vCore\Utility\ContentElementUtility;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The content element utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ContentElementUtilityTest extends UnitTestCase
{
    /**
     * Tests the `getIdentifier` function.
     *
     * @test
     */
    public function getIdentifier(): void
    {
        self::assertEquals(
            'Announcements',
            ContentElementUtility::getIdentifier('Announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('Announcements Latest Announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('announcements latest announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('announcements Latest Announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('announcements_latest_announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('announcements-latest-announcements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('AnnouncementsLatestAnnouncements')
        );

        self::assertEquals(
            'AnnouncementsLatestAnnouncements',
            ContentElementUtility::getIdentifier('announcementsLatestAnnouncements')
        );

        // === Deprecated ===

        self::assertEquals(
            'Announcements',
            ContentElementUtility::identifier('Announcements')
        );

        self::assertEquals(
            'Announcements',
            ContentElementUtility::contentElementIdentifier('Announcements')
        );
    }

    /**
     * Tests the `getSignature` function.
     *
     * @test
     */
    public function getSignature(): void
    {
        self::assertEquals(
            't3vannouncements_announcements',
            ContentElementUtility::getSignature('t3vannouncements', 'Announcements')
        );

        self::assertEquals(
            't3vannouncements_announcementslatestannouncements',
            ContentElementUtility::getSignature('t3vannouncements', 'AnnouncementsLatestAnnouncements')
        );

        // === Deprecated ===

        self::assertEquals(
            't3vannouncements_announcements',
            ContentElementUtility::signature('t3vannouncements', 'Announcements')
        );

        self::assertEquals(
            't3vannouncements_announcements',
            ContentElementUtility::contentElementSignature('t3vannouncements', 'Announcements')
        );
    }
}
