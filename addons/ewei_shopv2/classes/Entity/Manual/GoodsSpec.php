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
 * GoodsSpec
 *
 * @Table(name="ims_ewei_shop_goods_spec",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_displayorder", columns={"displayorder"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"})})
 * @Entity
 */
class GoodsSpec
{
    public const TABLE_NAME = 'ims_ewei_shop_goods_spec';

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
     * @Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description = '';

    /**
     * @var int|null
     *
     * @Column(name="displaytype", type="smallint", nullable=true)
     */
    private $displaytype = '0';

    /**
     * @var string|null
     *
     * @Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var int|null
     *
     * @Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @Column(name="propId", type="string", length=255, nullable=true)
     */
    private $propid = '';

    /**
     * @var int|null
     *
     * @Column(name="iscycelbuy", type="smallint", nullable=true)
     */
    private $iscycelbuy = '0';

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
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int|null
     */
    public function getDisplaytype(): ?int
    {
        return $this->displaytype;
    }

    /**
     * @param int|null $displaytype
     */
    public function setDisplaytype(?int $displaytype): void
    {
        $this->displaytype = $displaytype;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
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
    public function getPropid(): ?string
    {
        return $this->propid;
    }

    /**
     * @param string|null $propid
     */
    public function setPropid(?string $propid): void
    {
        $this->propid = $propid;
    }

    /**
     * @return int|null
     */
    public function getIscycelbuy(): ?int
    {
        return $this->iscycelbuy;
    }

    /**
     * @param int|null $iscycelbuy
     */
    public function setIscycelbuy(?int $iscycelbuy): void
    {
        $this->iscycelbuy = $iscycelbuy;
    }

}
