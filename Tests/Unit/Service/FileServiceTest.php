<?php
namespace T3v\T3vCore\Tests\Unit\Service;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Service\FileService;

/**
 * The file service test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Service
 */
class FileServiceTest extends UnitTestCase {
  /**
   * Test if the file name gets cleaned.
   *
   * @test
   */
  public function cleanFileName() {
    $this->assertEquals('foo.pdf',             FileService::cleanFileName('foo.pdf'));
    $this->assertEquals('foo.pdf',             FileService::cleanFileName('FOO.PDF'));
    $this->assertEquals('foo-x.pdf',           FileService::cleanFileName('foo x.pdf'));
    $this->assertEquals('foo-x.pdf',           FileService::cleanFileName('foo_x.pdf'));
    $this->assertEquals('foo-x.pdf',           FileService::cleanFileName('foo-x.pdf'));
    $this->assertEquals('foo-x.pdf',           FileService::cleanFileName('foo,x.pdf'));
    $this->assertEquals('foo-pdf.pdf',         FileService::cleanFileName('foo.pdf.pdf'));
    $this->assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo ä ö ü ß.pdf'));
    $this->assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo_ä_ö_ü_ß.pdf'));
    $this->assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo-ä-ö-ü-ß.pdf'));
    $this->assertEquals('espanol.pdf',         FileService::cleanFileName('Español.pdf'));
    $this->assertEquals('francais.pdf',        FileService::cleanFileName('Français.pdf'));
    $this->assertEquals('cestina.pdf',         FileService::cleanFileName('Čeština.pdf'));
    $this->assertEquals('huodongriqi.pdf',     FileService::cleanFileName('活动日起.pdf'));
    $this->assertRegExp('/upload-/i',          FileService::cleanFileName('대한민국.pdf'));
  }
}