<?php
namespace T3v\T3vCore\Service;

use \TYPO3\CMS\Core\SingletonInterface;
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
   * @var \TYPO3\CMS\Core\Utility\File\BasicFileUtility
   */
  protected $basicFileUtility;

  /**
   * The constructor function.
   */
  public function __construct() {
    parent::__construct();

    $this->basicFileUtility = $this->objectManager->get('TYPO3\CMS\Core\Utility\File\BasicFileUtility');
  }

  /**
   * Saves a file.
   *
   * @param object $file The file object
   * @param string $uploadsFolderPath The uploads folder path
   * @return mixed The file name of the saved file or null if the file could not be saved
   */
  public function saveFile($file, $uploadsFolderPath) {
    if (is_array($file) && !empty($file) && !empty($uploadsFolderPath)) {
      $fileName          = $file['name'];
      $temporaryFileName = $file['tmp_name'];
      $uploadsFolderPath = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
      $newFileName       = $this->basicFileUtility->getUniqueName(strtolower($fileName), $uploadsFolderPath);
      $fileCouldBeMoved  = GeneralUtility::upload_copy_move($temporaryFileName, $newFileName);

      if ($fileCouldBeMoved) {
        return $newFileName;
      }
    }

    return null;
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