<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * GoodsSpecItem
 *
 * @Table(name="ims_ewei_shop_goods_spec_item",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_show", columns={"show"}),
 *          @Index(name="idx_specid", columns={"specid"}),
 *          @Index(name="idx_displayorder", columns={"displayorder"})})
 * @Entity
 */
class GoodsSpecItem
{
    public const TABLE_NAME = 'ims_ewei_shop_goods_spec_item';

    /**
     * @var int
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @Column(name="uniacid", type="integer", nullable=true)
     */
    private $uniacid = '0';

    /**
     * @var int|null
     *
     * @Column(name="specid", type="integer", nullable=true)
     */
    private $specid = '0';

    /**
     * @var string|null
     *
     * @Column(name="title", type="string", length=255, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var int|null
     *
     * @Column(name="`show`", type="integer", nullable=true)
     */
    private $show = '0';

    /**
     * @var int|null
     *
     * @Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @Column(name="valueId", type="string", length=255, nullable=true)
     */
    private $valueid = '';

    /**
     * @var int|null
     *
     * @Column(name="`virtual`", type="integer", nullable=true)
     */
    private $virtual = '0';

    /**
     * @var string|null
     *
     * @Column(name="cycelbuy_periodic", type="string", length=20, nullable=true)
     */
    private $cycelbuyPeriodic = '';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUniacid(): ?int
    {
        return $this->uniacid;
    }

    /**
     * @param int|null $uniacid
     */
    public function setUniacid(?int $uniacid): void
    {
        $this->uniacid = $uniacid;
    }

    /**
     * @return int|null
     */
    public function getSpecid(): ?int
    {
        return $this->specid;
    }

    /**
     * @param int|null $specid
     */
    public function setSpecid(?int $specid): void
    {
        $this->specid = $specid;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    /**
     * @param string|null $thumb
     */
    public function setThumb(?string $thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * @return int|null
     */
    public function getShow(): ?int
    {
        return $this->show;
    }

    /**
     * @param int|null $show
     */
    public function setShow(?int $show): void
    {
        $this->show = $show;
    }

    /**
     * @return int|null
     */
    public function getDisplayorder(): ?int
    {
        return $this->displayorder;
    }

    /**
     * @param int|null $displayorder
     */
    public function setDisplayorder(?int $displayorder): void
    {
        $this->displayorder = $displayorder;
    }

    /**
     * @return string|null
     */
    public function getValueid(): ?string
    {
        return $this->valueid;
    }

    /**
     * @param string|null $valueid
     */
    public function setValueid(?string $valueid): void
    {
        $this->valueid = $valueid;
    }

    /**
     * @return int|null
     */
    public function getVirtual(): ?int
    {
        return $this->virtual;
    }

    /**
     * @param int|null $virtual
     */
    public function setVirtual(?int $virtual): void
    {
        $this->virtual = $virtual;
    }

    /**
     * @return string|null
     */
    public function getCycelbuyPeriodic(): ?string
    {
        return $this->cycelbuyPeriodic;
    }

    /**
     * @param string|null $cycelbuyPeriodic
     */
    public function setCycelbuyPeriodic(?string $cycelbuyPeriodic): void
    {
        $this->cycelbuyPeriodic = $cycelbuyPeriodic;
    }

}
