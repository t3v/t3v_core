<?php
namespace T3v\T3vCore\Tests\Unit\Utility;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Utility\UrlUtility;

/**
 * The URL utility test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Utility
 */
class UrlUtilityTest extends UnitTestCase {
  /**
   * Test if the URL gets encoded.
   *
   * @test
   */
  public function urlGetsEncoded() {
    $this->assertEquals(UrlUtility::encodeUrl('http://www.t3v.com'), 'http%3A%2F%2Fwww.t3v.com');
  }

  /**
   * Test if the URL gets decoded.
   *
   * @test
   */
  public function urlGetsDecoded() {
    $this->assertEquals(UrlUtility::decodeUrl('http%3A%2F%2Fwww.t3v.com'), 'http://www.t3v.com');
  }
}