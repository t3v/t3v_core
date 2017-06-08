<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\Resource\Exception\InvalidFileNameException;
use \TYPO3\CMS\Core\Utility\File\BasicFileUtility;
use \TYPO3\CMS\Core\Utility\GeneralUtility;

use \T3v\T3vCore\Service\AbstractService;

/**
 * File Service Class
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
   * The constructor function.
   *
   * @return void
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

      if (GeneralUtility::verifyFilenameAgainstDenyPattern($fileName) {
        $temporaryFileName = $file['tmp_name'];
        $uploadsFolderPath = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
        $newFileName       = $this->basicFileUtility->getUniqueName($this->normalizeFileName($fileName), $uploadsFolderPath);
        $fileCouldBeMoved  = GeneralUtility::upload_copy_move($temporaryFileName, $newFileName);

        if ($fileCouldBeMoved) {
          return $newFileName;
        }
      } else {
        throw new InvalidFileNameException('File name could not be verified against deny pattern.', 1496958715);
      }
    }

    return null;
  }

  /**
   * Normalizes a file name.
   *
   * @param string $fileName The file name
   * @return string The normalized file name
   */
  public static function normalizeFileName($fileName) {
    $fileName = (string) $fileName;
    $fileName = mb_strtolower($fileName);

    $search   = ['ä', 'ö', 'ü', 'ß', ',', ' '];
    $replace  = ['ae', 'oe', 'ue', 'ss', '-', '_'];
    $fileName = str_replace($search, $replace, $fileName);

    return $fileName;
  }

  /**
   * Deletes a file.
   *
   * @param object $file The file object
   * @return void
   */
  protected function deleteFile($file) {
    unlink($file);
  }
}