<?php
namespace T3v\T3vCore\Tests\Unit\Service;

use Nimut\TestingFramework\TestCase\UnitTestCase;

use T3v\T3vCore\Service\FileService;

/**
 * File Service Test Class
 *
 * @package T3v\T3vCore\Tests\Unit\Service
 */
class FileServiceTest extends UnitTestCase {
  /**
   * Test if the file name gets normalized.
   *
   * @test
   */
  public function fileNameGetsNormalized() {
    $this->assertEquals(FileService::normalizeFileName('file.pdf'),         'file.pdf');
    $this->assertEquals(FileService::normalizeFileName('file x.pdf'),       'file_x.pdf');
    $this->assertEquals(FileService::normalizeFileName('file,x.pdf'),       'file-x.pdf');
    $this->assertEquals(FileService::normalizeFileName('file-ä-ö-ü-ß.pdf'), 'file-ae-oe-ue-ss.pdf');
  }
}