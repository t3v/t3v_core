<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

use Cocur\Slugify\Slugify;

use T3v\T3vCore\Service\AbstractService;

/**
 * The file service class.
 *
 * @package T3v\T3vCore\Service
 */
class FileService extends AbstractService {
  /**
   * The file name rulesets constant.
   */
  const FILE_NAME_RULESETS = [
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
   * Saves a file to an uploads folder.
   *
   * @param object $file The file object
   * @param string $uploadsFolderPath The uploads folder path
   * @return string|null The file name of the saved file or null if the file could not be saved
   * @throws \TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException
   */
  public static function saveFile($file, string $uploadsFolderPath) {
    if (!empty($file) && is_array($file) && !empty($uploadsFolderPath)) {
      $fileName = $file['name'];

      if (GeneralUtility::verifyFilenameAgainstDenyPattern($fileName)) {
        $temporaryFileName   = $file['tmp_name'];
        $fileName            = self::cleanFileName($fileName);
        $uploadsFolderPath   = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
        $newFileName         = self::getUniqueFileName($fileName, $uploadsFolderPath);
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
   * Deletes a file.
   *
   * @param string $fileName The file name
   * @return true|false True on success or false on failure
   */
  public static function deleteFile(string $fileName) {
    return unlink($fileName);
  }

  /**
   * Cleans a file name.
   *
   * @param string $fileName The file name
   * @param array $rulesets The optional rulesets, defaults to `FileService::FILE_NAME_RULESETS`
   * @param string $separator The optional separator, defaults to `-`
   * @return string The cleaned file name
   */
  public static function cleanFileName(string $fileName, array $rulesets = self::FILE_NAME_RULESETS, string $separator = '-') {
    $slugify   = new Slugify(['rulesets' => $rulesets, 'separator' => $separator]);
    $fileName  = mb_strtolower($fileName);
    $name      = pathinfo($fileName, PATHINFO_FILENAME);
    $name      = $slugify->slugify($name);
    $extension = pathinfo($fileName, PATHINFO_EXTENSION);

    return $name . '.' . $extension;
  }

  /**
   * Alias for `cleanFileName`.
   *
   * @param string $fileName The file name
   * @param array $rulesets The optional rulesets, defaults to `FileService::FILE_NAME_RULESETS`
   * @param string $separator The optional separator, defaults to `-`
   * @return string The normalized file name
   */
  public static function normalizeFileName(string $fileName, array $rulesets = self::FILE_NAME_RULESETS, string $separator = '-') {
    return self::cleanFileName($fileName, $rulesets, $separator);
  }

  /**
   * Gets an unique file name.
   *
   * @param string $fileName The file name to check
   * @param string $directory The directory for which to return a unique file name for `$fileName`, MUST be a valid directory and should be absolute
   * @return string The unique file name
   */
  public static function getUniqueFileName(string $fileName, string $directory) {
    $basicFileUtility = GeneralUtility::makeInstance(BasicFileUtility::class);

    return $basicFileUtility->getUniqueName($fileName, $directory);
  }
}