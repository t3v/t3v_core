<?php
namespace T3v\T3vCore\Tests\Unit\Service;

use \TYPO3\CMS\Core\Tests\UnitTestCase;

use \T3v\T3vCore\Service\FileService;

class FileServiceTest extends UnitTestCase {
  /**
   * Test if the file name gets normalized.
   *
   * @test
   */
  public function fileNameGetsNormalized() {
    $this->assertEquals(FileService::normalizeFileName('preview.pdf'),   'preview.pdf');
    $this->assertEquals(FileService::normalizeFileName('preview x.pdf'), 'preview_x.pdf');
    $this->assertEquals(FileService::normalizeFileName('ä-ö-ü-ß.pdf'),   'ae-oe-ue-ss.pdf');
  }
}