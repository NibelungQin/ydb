<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * GoodsLabelstyle
 *
 * @Table(name="ims_ewei_shop_goods_labelstyle")
 * @Entity
 */
class GoodsLabelStyle
{
    public const TABLE_NAME = 'ims_ewei_shop_goods_labelstyle';

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
    private $uniacid;

    /**
     * @var int
     *
     * @Column(name="style", type="integer", nullable=false)
     */
    private $style;

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
     * @return int
     */
    public function getStyle(): int
    {
        return $this->style;
    }

    /**
     * @param int $style
     */
    public function setStyle(int $style): void
    {
        $this->style = $style;
    }

}
