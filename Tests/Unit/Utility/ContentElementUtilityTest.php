<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\ContentElementUtility;

/**
 * The content element utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class ContentElementUtilityTest extends UnitTestCase {
  /**
   * Tests the identifier function.
   *
   * @test
   */
  public function identifier() {
    $this->assertEquals(
      'Announcements',
      ContentElementUtility::identifier('Announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('Announcements Latest Announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('announcements latest announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('announcements Latest Announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('announcements_latest_announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('announcements-latest-announcements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('AnnouncementsLatestAnnouncements')
    );

    $this->assertEquals(
      'AnnouncementsLatestAnnouncements',
      ContentElementUtility::identifier('announcementsLatestAnnouncements')
    );
  }

  /**
   * Tests the signature function.
   *
   * @test
   */
  public function signature() {
    $this->assertEquals(
      't3vannouncements_announcements',
      ContentElementUtility::signature('t3vannouncements', 'Announcements')
    );

    $this->assertEquals(
      't3vannouncements_announcementslatestannouncements',
      ContentElementUtility::signature('t3vannouncements', 'AnnouncementsLatestAnnouncements')
    );
  }
}
