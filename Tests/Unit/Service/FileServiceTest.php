<?php
declare(strict_types=1);

namespace T3v\T3vCore\Tests\Unit\Service;

use T3v\T3vCore\Service\FileService;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

/**
 * The file service test class.
 *
 * @package T3v\T3vCore\Tests\Unit\Service
 */
class FileServiceTest extends UnitTestCase
{
    /**
     * Tests the `cleanFileName` function.
     *
     * @test
     */
    public function cleanFileName(): void
    {
        self::assertEquals('foo.pdf', FileService::cleanFileName('foo.pdf'));
        self::assertEquals('foo.pdf', FileService::cleanFileName('FOO.PDF'));
        self::assertEquals('foo-x.pdf', FileService::cleanFileName('foo x.pdf'));
        self::assertEquals('foo-x.pdf', FileService::cleanFileName('foo_x.pdf'));
        self::assertEquals('foo-x.pdf', FileService::cleanFileName('foo-x.pdf'));
        self::assertEquals('foo-x.pdf', FileService::cleanFileName('foo,x.pdf'));
        self::assertEquals('foo-pdf.pdf', FileService::cleanFileName('foo.pdf.pdf'));
        self::assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo ä ö ü ß.pdf'));
        self::assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo_ä_ö_ü_ß.pdf'));
        self::assertEquals('foo-ae-oe-ue-ss.pdf', FileService::cleanFileName('foo-ä-ö-ü-ß.pdf'));
        self::assertEquals('espanol.pdf', FileService::cleanFileName('Español.pdf'));
        self::assertEquals('francais.pdf', FileService::cleanFileName('Français.pdf'));
        self::assertEquals('cestina.pdf', FileService::cleanFileName('Čeština.pdf'));
        self::assertEquals('huodongriqi.pdf', FileService::cleanFileName('活动日起.pdf'));
        self::assertMatchesRegularExpression('/upload-/i', FileService::cleanFileName('대한민국.pdf'));
    }
}
