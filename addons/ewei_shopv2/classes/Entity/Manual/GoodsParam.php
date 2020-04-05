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
 * GoodsParam
 *
 * @Table(name="ims_ewei_shop_goods_param",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_displayorder", columns={"displayorder"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"})})
 * @Entity
 */
class GoodsParam
{
    public const TABLE_NAME = 'ims_ewei_shop_goods_param';

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
     * @Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

    /**
     * @var string|null
     *
     * @Column(name="title", type="string", length=50, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @Column(name="value", type="text", length=65535, nullable=true)
     */
    private $value;

    /**
     * @var int|null
     *
     * @Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

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
    public function getGoodsid(): ?int
    {
        return $this->goodsid;
    }

    /**
     * @param int|null $goodsid
     */
    public function setGoodsid(?int $goodsid): void
    {
        $this->goodsid = $goodsid;
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
    public function getValue(): ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     */
    public function setValue(?string $value): void
    {
        $this->value = $value;
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

}
