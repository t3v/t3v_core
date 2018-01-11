<?php
namespace T3v\T3vCore\Tests\Functional\Service;

use Nimut\TestingFramework\TestCase\FunctionalTestCase;

use T3v\T3vCore\Service\FileService;

/**
 * File Service Test Class
 *
 * @package T3v\T3vCore\Tests\Functional\Service
 */
class FileServiceTest extends FunctionalTestCase {
  /**
   * The subject.
   *
   * @var \T3v\T3vCore\Service\FileService
   */
  protected $subject;

  /**
   * Setup before running tests.
   *
   * @return void
   */
  protected function setUp() {
    parent::setUp();

    $this->subject = new FileService();
  }

  /**
   * Tear down after running tests.
   *
   * @return void
   */
  protected function tearDown() {
    $this->subject = null;
  }

  /**
   * Test if the file name gets cleaned.
   *
   * @test
   */
  public function fileNameGetsCleaned() {
    $this->assertEquals($this->subject->cleanFileName('file.pdf'),         'file.pdf');
    $this->assertEquals($this->subject->cleanFileName('FILE.PDF'),         'file.pdf');
    $this->assertEquals($this->subject->cleanFileName('file x.pdf'),       'file_x.pdf');
    $this->assertEquals($this->subject->cleanFileName('file_x.pdf'),       'file_x.pdf');
    $this->assertEquals($this->subject->cleanFileName('file-x.pdf'),       'file-x.pdf');
    $this->assertEquals($this->subject->cleanFileName('file,x.pdf'),       'file_x.pdf');
    $this->assertEquals($this->subject->cleanFileName('file ä ö ü ß.pdf'), 'file_ae_oe_ue_ss.pdf');
    $this->assertEquals($this->subject->cleanFileName('file_ä_ö_ü_ß.pdf'), 'file_ae_oe_ue_ss.pdf');
    $this->assertEquals($this->subject->cleanFileName('file-ä-ö-ü-ß.pdf'), 'file-ae-oe-ue-ss.pdf');
  }
}