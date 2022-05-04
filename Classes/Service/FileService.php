<?php
declare(strict_types=1);

namespace T3v\T3vCore\Service;

use Cocur\Slugify\Slugify;
use TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * The file service class.
 *
 * @package T3v\T3vCore\Service
 */
class FileService extends AbstractService
{
    /**
     * The empty file name prefix.
     */
    public const EMPTY_FILE_NAME_PREFIX = 'upload-';

    /**
     * The file name rulesets.
     */
    public const FILE_NAME_RULESETS = [
        'default',
        'azerbaijani',
        'burmese',
        'hindi',
        'georgian',
        'norwegian',
        'vietnamese',
        'ukrainian',
        'latvian',
        'finnish',
        'greek',
        'czech',
        'arabic',
        'turkish',
        'polish',
        'german',
        'russian',
        'romanian',
        'chinese'
    ];

    /**
     * Saves a file to an uploads' folder.
     *
     * @param array $file The file
     * @param string $uploadsFolderPath The uploads' folder path
     * @return string|null The file name of the saved file or null if the file could not be saved
     * @throws InvalidFileNameException
     */
    public function saveFile(array $file, string $uploadsFolderPath): ?string
    {
        if (!empty($file) && !empty($uploadsFolderPath)) {
            $fileName = $file['name'];
            $temporaryFileName = $file['tmp_name'];

            if (GeneralUtility::verifyFilenameAgainstDenyPattern($fileName)) {
                $uploadsFolderPath = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
                $fileName = self::cleanFileName($fileName);
                $newFileName = $this->getUniqueFileName($fileName, $uploadsFolderPath);
                $fileCouldBeUploaded = GeneralUtility::upload_copy_move($temporaryFileName, $newFileName);

                if ($fileCouldBeUploaded) {
                    return $newFileName;
                }
            } else {
                throw new InvalidFileNameException('File name could not be verified against deny pattern.', 1496958715);
            }
        }

        return null;
    }

    /**
     * Deletes a file, similar to the Unix C `unlink` function.
     *
     * @param string $fileName The file name
     * @return true|false True on success or false on failure
     */
    public function deleteFile(string $fileName): bool
    {
        return unlink($fileName);
    }

    /**
     * Gets a unique file name.
     *
     * @param string $fileName The file name
     * @param string $directory The directory for which to return a unique file name for, MUST be a valid directory and should be absolute
     * @return string The unique file name
     */
    public function getUniqueFileName(string $fileName, string $directory): string
    {
        return GeneralUtility::makeInstance(BasicFileUtility::class)->getUniqueName($fileName, $directory);
    }

    /**
     * Cleans a file name.
     *
     * @param string $fileName The file name
     * @param array $rulesets The optional rulesets, defaults to `FileService::FILE_NAME_RULESETS`
     * @param string $separator The optional separator, defaults to `-`
     * @return string The cleaned file name
     */
    public static function cleanFileName(string $fileName, array $rulesets = self::FILE_NAME_RULESETS, string $separator = '-'): string
    {
        $slugify = new Slugify(['rulesets' => $rulesets, 'separator' => $separator]);
        $name = $slugify->slugify(pathinfo($fileName, PATHINFO_FILENAME));
        $extension = pathinfo($fileName, PATHINFO_EXTENSION);

        if (empty($name)) {
            $name = uniqid(self::EMPTY_FILE_NAME_PREFIX, true);
        }

        return mb_strtolower($name . '.' . $extension);
    }

    /**
     * Normalizes a file name, alias for `cleanFileName`.
     *
     * @param string $fileName The file name
     * @param array $rulesets The optional rulesets, defaults to `FileService::FILE_NAME_RULESETS`
     * @param string $separator The optional separator, defaults to `-`
     * @return string The normalized file name
     */
    public static function normalizeFileName(string $fileName, array $rulesets = self::FILE_NAME_RULESETS, string $separator = '-'): string
    {
        return self::cleanFileName($fileName, $rulesets, $separator);
    }
}
