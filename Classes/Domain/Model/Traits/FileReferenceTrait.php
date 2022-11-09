<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Model\Traits;

use T3v\T3vCore\Service\LocalizationService;
use TYPO3\CMS\Core\Context\Exception\AspectNotFoundException;
use TYPO3\CMS\Core\Resource\FileRepository;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;

/**
 * The file reference trait.
 *
 * @package T3v\T3vCore\Domain\Model\Traits
 */
trait FileReferenceTrait
{
    /**
     * The file repository.
     *
     * @var FileRepository
     */
    protected $fileRepository;

    /**
     * The localization service.
     *
     * @var LocalizationService
     */
    protected $localizationService;

    /**
     * Injects the file repository.
     *
     * @param FileRepository $fileRepository The file repository
     */
    public function injectFileRepository(FileRepository $fileRepository): void
    {
        $this->fileRepository = $fileRepository;
    }

    /**
     * Injects the localization service.
     *
     * @param LocalizationService $localizationService The localization service
     */
    public function injectLocalizationService(LocalizationService $localizationService): void
    {
        $this->localizationService = $localizationService;
    }

    /**
     * Gets a localized file reference.
     *
     * @param string $table The table
     * @param string $field The field
     * @return FileReference|null
     * @throws AspectNotFoundException
     */
    protected function getLocalizedFileReference(string $table, string $field): ?FileReference
    {
        if ($this->localizationService->getSysLanguageUid() > 0) {
            $localizedFileReferences = $this->getLocalizedFileReferences($table, $field);

            if (!empty($localizedFileReferences)) {
                $localizedFileObject = $localizedFileReferences[0]->toArray();

                if ($localizedFileObject) {
                    $pid = (int)$localizedFileObject['pid'];
                    $uid = (int)$localizedFileObject['uid'];

                    $fileReference = new FileReference();
                    $fileReference->pid = $pid;
                    $fileReference->uid = $uid;
                    $fileReference->_languageUid = 0;
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
     * @throws AspectNotFoundException
     */
    protected function getLocalizedFileReferences(string $table, string $field): ?array
    {
        if ($this->localizationService->getSysLanguageUid() > 0) {
            return $this->fileRepository->findByRelation($table, $field, $this->getLocalizedUid());
        }

        return null;
    }
}
