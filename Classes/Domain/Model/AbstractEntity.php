<?php
declare(strict_types=1);

namespace T3v\T3vCore\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity as ExtbaseAbstractEntity;

/**
 * The abstract entity class.
 *
 * @package T3v\T3vCore\Domain\Model
 */
abstract class AbstractEntity extends ExtbaseAbstractEntity
{
    /**
     * The entity's type.
     *
     * @var string
     */
    protected $type;

    /**
     * The entity's handle.
     *
     * @var string
     */
    protected $handle;

    /**
     * The entity's system language UID.
     *
     * @var int
     */
    protected $sysLanguageUid;

    /**
     * The entity's L10n parent.
     *
     * @var int
     */
    protected $l10nParent;

    /**
     * The entity's localized UID.
     *
     * @var int
     */
    protected $_localizedUid;

    /**
     * The entity's creation date.
     *
     * @var \DateTime
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    protected $crdate;

    /**
     * The entity's timestamp.
     *
     * @var \DateTime
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    protected $tstamp;

    /**
     * Returns the entity's type.
     *
     * @return string|null The entity's type
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * Sets the entity's type.
     *
     * @param string $type The entity's type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * Returns the entity's handle.
     *
     * @return string|null The entity's handle
     */
    public function getHandle(): ?string
    {
        return $this->handle;
    }

    /**
     * Sets the entity's handle.
     *
     * @param string $handle The entity's handle
     */
    public function setHandle(string $handle): void
    {
        $this->handle = $handle;
    }

    /**
     * Returns the entity's system language UID.
     *
     * @return int|null The entity's system language UID
     */
    public function getSysLanguageUid(): ?int
    {
        return $this->sysLanguageUid;
    }

    /**
     * Returns the entity's L10n parent.
     *
     * @return int|null The entity's L10n parent
     */
    public function getL10nParent(): ?int
    {
        return $this->l10nParent;
    }

    /**
     * Returns the entity's localized UID.
     *
     * @return int|null The entity's localized UID
     */
    public function getLocalizedUid(): ?int
    {
        return $this->_localizedUid;
    }

    /**
     * Returns the entity's creation date.
     *
     * @return \DateTime|null The entity's creation date
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getCrdate(): ?\DateTime
    {
        return $this->crdate;
    }

    /**
     * Returns when the entity was created, alias for the `getCrdate` function.
     *
     * @return \DateTime|null The entity's creation date
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->getCrdate();
    }

    /**
     * Returns the entity's timestamp.
     *
     * @return \DateTime|null The entity's timestamp
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getTstamp(): ?\DateTime
    {
        return $this->tstamp;
    }

    /**
     * Returns when the entity was updated, alias for the `getTstamp` function.
     *
     * @return \DateTime|null The entity's creation date
     * @noinspection PhpFullyQualifiedNameUsageInspection
     */
    public function getUpdatedAt(): ?\DateTime
    {
        return $this->getTstamp();
    }
}
