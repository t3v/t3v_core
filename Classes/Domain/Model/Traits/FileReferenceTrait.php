<?php
namespace T3v\T3vCore\Domain\Model\Traits;

use \TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * The file reference trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait FileReferenceTrait {
  /**
   * Gets localized file reference.
   *
   * @param string $table The table
   * @param string $field The field
   * @return array|null The localized file reference or null if no localized file reference was found
   */
  protected function getLocalizedFileReference(string $table, string $field) {
    if ($this->getSysLanguageUid() > 0) {
      $localizedFileReferences = $this->getLocalizedFileReferences($table, $field);

      if (!empty($localizedFileReferences)) {
        $localizedFileObject = $localizedFileReferences[0]->toArray();

        if ($localizedFileObject) {
          $pid = intval($localizedFileObject['pid']);
          $uid = intval($localizedFileObject['uid']);

          $fileReference                = new FileReference();
          $fileReference->pid           = $pid;
          $fileReference->uid           = $uid;
          $fileReference->_languageUid  = 0;
          $fileReference->_localizedUid = $uid;
          $fileReference->_versionedUid = $uid;

          return $fileReference;
        }
      }
    }

    return null;
  }

  /**
   * Gets localized file references.
   *
   * @param string $table The table
   * @param string $field The field
   * @return array|null The localized file references or null if no localized file references were found
   */
  protected function getLocalizedFileReferences(string $table, string $field) {
    if ($this->getSysLanguageUid() > 0) {
      return $this->fileRepository->findByRelation($table, $field, $this->getLocalizedUid());
    }

    return null;
  }
}