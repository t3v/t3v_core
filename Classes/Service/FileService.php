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
   * @param array $file The file object
   * @param string $uploadsFolderPath The uploads folder path
   * @return mixed The filename of the saved file or null if the file could not be saved
   */
  public function saveFile($file, $uploadsFolderPath) {
    if (is_array($file) && !empty($uploadsFolderPath)) {
      $filename = $file['name'];

      if (!empty($filename)) {
        $temporaryFilename = $file['tmp_name'];
        $path              = GeneralUtility::getFileAbsFileName($uploadsFolderPath);
        $newFilename       = $this->basicFileUtility->getUniqueName($filename, $path);
        $fileCouldBeMoved  = GeneralUtility::upload_copy_move($temporaryFilename, $newFilename);

        if ($fileCouldBeMoved) {
          return $newFilename;
        }
      }
    }
  }

  /**
   * Deletes a file.
   *
   * @param string $file The file
   * @return void
   */
  protected function deleteFile($file) {
    unlink($file);
  }
}