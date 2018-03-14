<?php
namespace T3v\T3vCore\Service;

use TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException;
use TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

use T3v\T3vCore\Service\AbstractService;

/**
 * The file service class.
 *
 * @package T3v\T3vCore\Service
 */
class FileService extends AbstractService {
  /**
   * The basic file utility.
   *
   * @var \TYPO3\CMS\Core\Utility\File\BasicFileUtility
   */
  protected $basicFileUtility;

  /**
   * The constructor.
   */
  public function __construct() {
    parent::__construct();

    $this->basicFileUtility = $this->objectManager->get(BasicFileUtility::class);
  }

  /**
   * Saves a file.
   *
   * @param object $file The file object
   * @param string $uploadsFolderPath The uploads folder path
   * @return string|null The file name of the saved file or null if the file could not be saved
   * @throws \TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException
   */
  public function saveFile($file, $uploadsFolderPath) {
    if (is_array($file) && !empty($file) && !empty($uploadsFolderPath)) {
      $fileName = $file['name'];

      if (GeneralUtility::verifyFilenameAgainstDenyPattern($fileName)) {
        $temporaryFileName   = $file['tmp_name'];
        $fileName            = $this->cleanFileName($fileName);
        $uploadsFolderPath   = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
        $newFileName         = $this->getUniqueFileName($fileName, $uploadsFolderPath);
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
   * @param object $file The file object
   */
  public function deleteFile($file) {
    unlink($file);
  }

  /**
   * Gets an unique file name.
   *
   * @param string $fileName The file name to check
   * @param string $directory The directory for which to return a unique file name for `$fileName`, MUST be a valid directory, should be absolute.
   * @return string The unique file name
   */
  public function getUniqueFileName($fileName, $directory) {
    $fileName  = (string) $fileName;
    $directory = (string) $directory;

    return $this->basicFileUtility->getUniqueName($fileName, $directory);
  }

  /**
   * Cleans a file name.
   *
   * @param string $fileName The file name
   * @return string The cleaned file name
   */
  public function cleanFileName($fileName) {
    $fileName = (string) $fileName;
    $fileName = mb_strtolower($fileName);

    return $this->basicFileUtility->cleanFileName($fileName);
  }

  /**
   * Alias for `cleanFileName`.
   *
   * @param string $fileName The file name
   * @return string The normalized file name
   */
  public function normalizeFileName($fileName) {
    $fileName = (string) $fileName;

    return $this->cleanFileName($fileName);
  }
}