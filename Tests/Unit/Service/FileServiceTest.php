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
    $this->assertEquals(FileService::cleanFileName('foo.pdf'),         'foo.pdf');
    $this->assertEquals(FileService::cleanFileName('FOO.PDF'),         'foo.pdf');
    $this->assertEquals(FileService::cleanFileName('foo x.pdf'),       'foo-x.pdf');
    $this->assertEquals(FileService::cleanFileName('foo_x.pdf'),       'foo-x.pdf');
    $this->assertEquals(FileService::cleanFileName('foo-x.pdf'),       'foo-x.pdf');
    $this->assertEquals(FileService::cleanFileName('foo,x.pdf'),       'foo-x.pdf');
    $this->assertEquals(FileService::cleanFileName('foo.pdf.pdf'),     'foo-pdf.pdf');
    $this->assertEquals(FileService::cleanFileName('foo ä ö ü ß.pdf'), 'foo-ae-oe-ue-ss.pdf');
    $this->assertEquals(FileService::cleanFileName('foo_ä_ö_ü_ß.pdf'), 'foo-ae-oe-ue-ss.pdf');
    $this->assertEquals(FileService::cleanFileName('foo-ä-ö-ü-ß.pdf'), 'foo-ae-oe-ue-ss.pdf');
    $this->assertEquals(FileService::cleanFileName('Español.pdf'),     'espanol.pdf');
    $this->assertEquals(FileService::cleanFileName('Français.pdf'),    'francais.pdf');
    $this->assertEquals(FileService::cleanFileName('Čeština.pdf'),     'cestina.pdf');
    $this->assertEquals(FileService::cleanFileName('活动日起.pdf'),     'huodongriqi.pdf');
  }
}