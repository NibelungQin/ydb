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
 * GoodsGroup
 *
 * @Table(name="ims_ewei_shop_goods_group",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_enabled", columns={"enabled"})})
 * @Entity
 */
class GoodsGroup
{
    /**
     * @var int
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid = '0';

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=255, nullable=false)
     */
    private $name = '';

    /**
     * @var string
     *
     * @Column(name="goodsids", type="string", length=255, nullable=false)
     */
    private $goodsids = '';

    /**
     * @var int
     *
     * @Column(name="enabled", type="smallint", nullable=false)
     */
    private $enabled = '0';

    /**
     * @var int
     *
     * @Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';

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
     * @return int
     */
    public function getUniacid(): int
    {
        return $this->uniacid;
    }

    /**
     * @param int $uniacid
     */
    public function setUniacid(int $uniacid): void
    {
        $this->uniacid = $uniacid;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getGoodsids(): string
    {
        return $this->goodsids;
    }

    /**
     * @param string $goodsids
     */
    public function setGoodsids(string $goodsids): void
    {
        $this->goodsids = $goodsids;
    }

    /**
     * @return int
     */
    public function isEnabled(): int
    {
        return $this->enabled;
    }

    /**
     * @param bool $enabled
     */
    public function setEnabled(bool $enabled): void
    {
        $this->enabled = $enabled;
    }

    /**
     * @return int
     */
    public function getMerchid(): int
    {
        return $this->merchid;
    }

    /**
     * @param int $merchid
     */
    public function setMerchid(int $merchid): void
    {
        $this->merchid = $merchid;
    }

}
