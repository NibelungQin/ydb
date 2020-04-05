<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * GoodscodeGood
 *
 * @Table(name="ims_ewei_shop_goodscode_good")
 * @Entity
 */
class GoodscodeGood
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
    private $uniacid;

    /**
     * @var int
     *
     * @Column(name="goodsid", type="integer", nullable=false)
     */
    private $goodsid;

    /**
     * @var string
     *
     * @Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @Column(name="thumb", type="string", length=255, nullable=false)
     */
    private $thumb;

    /**
     * @var string
     *
     * @Column(name="qrcode", type="string", length=255, nullable=false)
     */
    private $qrcode;

    /**
     * @var int
     *
     * @Column(name="status", type="smallint", nullable=false)
     */
    private $status;

    /**
     * @var int
     *
     * @Column(name="displayorder", type="integer", nullable=false)
     */
    private $displayorder;

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
    public function getGoodsid(): int
    {
        return $this->goodsid;
    }

    /**
     * @param int $goodsid
     */
    public function setGoodsid(int $goodsid): void
    {
        $this->goodsid = $goodsid;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getThumb(): string
    {
        return $this->thumb;
    }

    /**
     * @param string $thumb
     */
    public function setThumb(string $thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string
     */
    public function getQrcode(): string
    {
        return $this->qrcode;
    }

    /**
     * @param string $qrcode
     */
    public function setQrcode(string $qrcode): void
    {
        $this->qrcode = $qrcode;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getDisplayorder(): int
    {
        return $this->displayorder;
    }

    /**
     * @param int $displayorder
     */
    public function setDisplayorder(int $displayorder): void
    {
        $this->displayorder = $displayorder;
    }
}
