<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * OrderPeerpayPayinfo
 * @Table(name="ims_ewei_shop_order_peerpay_payinfo")
 * @Entity
 */
class OrderPeerpayPayinfo
{
    public const TABLE_NAME = 'ims_ewei_shop_order_peerpay_payinfo';

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
     * @Column(name="pid", type="integer", nullable=false)
     */
    private $pid = '0';

    /**
     * @var int
     *
     * @Column(name="uid", type="integer", nullable=false)
     */
    private $uid = '0';

    /**
     * @var string
     *
     * @Column(name="uname", type="string", length=255, nullable=false)
     */
    private $uname = '';

    /**
     * @var string
     *
     * @Column(name="usay", type="string", length=500, nullable=false)
     */
    private $usay = '';

    /**
     * @var string
     *
     * @Column(name="price", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var int
     *
     * @Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="headimg", type="string", length=255, nullable=true)
     */
    private $headimg;

    /**
     * @var int
     *
     * @Column(name="refundstatus", type="smallint", nullable=false)
     */
    private $refundstatus = '0';

    /**
     * @var string
     *
     * @Column(name="refundprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $refundprice = '0.00';

    /**
     * @var string
     *
     * @Column(name="tid", type="string", length=255, nullable=false)
     */
    private $tid = '';

    /**
     * @var string
     *
     * @Column(name="openid", type="string", length=255, nullable=false)
     */
    private $openid = '';

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
    public function getPid(): int
    {
        return $this->pid;
    }

    /**
     * @param int $pid
     */
    public function setPid(int $pid): void
    {
        $this->pid = $pid;
    }

    /**
     * @return int
     */
    public function getUid(): int
    {
        return $this->uid;
    }

    /**
     * @param int $uid
     */
    public function setUid(int $uid): void
    {
        $this->uid = $uid;
    }

    /**
     * @return string
     */
    public function getUname(): string
    {
        return $this->uname;
    }

    /**
     * @param string $uname
     */
    public function setUname(string $uname): void
    {
        $this->uname = $uname;
    }

    /**
     * @return string
     */
    public function getUsay(): string
    {
        return $this->usay;
    }

    /**
     * @param string $usay
     */
    public function setUsay(string $usay): void
    {
        $this->usay = $usay;
    }

    /**
     * @return string
     */
    public function getPrice(): string
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice(string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getCreatetime(): int
    {
        return $this->createtime;
    }

    /**
     * @param int $createtime
     */
    public function setCreatetime(int $createtime): void
    {
        $this->createtime = $createtime;
    }

    /**
     * @return string|null
     */
    public function getHeadimg(): ?string
    {
        return $this->headimg;
    }

    /**
     * @param string|null $headimg
     */
    public function setHeadimg(?string $headimg): void
    {
        $this->headimg = $headimg;
    }

    /**
     * @return int
     */
    public function getRefundstatus(): int
    {
        return $this->refundstatus;
    }

    /**
     * @param int $refundstatus
     */
    public function setRefundstatus(int $refundstatus): void
    {
        $this->refundstatus = $refundstatus;
    }

    /**
     * @return string
     */
    public function getRefundprice(): string
    {
        return $this->refundprice;
    }

    /**
     * @param string $refundprice
     */
    public function setRefundprice(string $refundprice): void
    {
        $this->refundprice = $refundprice;
    }

    /**
     * @return string
     */
    public function getTid(): string
    {
        return $this->tid;
    }

    /**
     * @param string $tid
     */
    public function setTid(string $tid): void
    {
        $this->tid = $tid;
    }

    /**
     * @return string
     */
    public function getOpenid(): string
    {
        return $this->openid;
    }

    /**
     * @param string $openid
     */
    public function setOpenid(string $openid): void
    {
        $this->openid = $openid;
    }

}
