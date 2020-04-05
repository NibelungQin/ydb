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
 * OrderPeerPay
 * @Table(name="ims_ewei_shop_order_peerpay",
 *      indexes={
 *          @Index(name="uniacid", columns={"uniacid"}),
 *          @Index(name="orderid", columns={"orderid"})})
 * @Entity
 */
class OrderPeerpay
{
    public const TABLE_NAME = 'ims_ewei_shop_order_peerpay';

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
     * @var int
     *
     * @Column(name="orderid", type="integer", nullable=false)
     */
    private $orderid = '0';

    /**
     * @var int
     *
     * @Column(name="peerpay_type", type="smallint", nullable=false)
     */
    private $peerpayType = '0';

    /**
     * @var string
     *
     * @Column(name="peerpay_price", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $peerpayPrice = '0.00';

    /**
     * @var string
     *
     * @Column(name="peerpay_maxprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $peerpayMaxprice = '0.00';

    /**
     * @var string
     *
     * @Column(name="peerpay_realprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $peerpayRealprice = '0.00';

    /**
     * @var string
     *
     * @Column(name="peerpay_selfpay", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $peerpaySelfpay = '0.00';

    /**
     * @var string
     *
     * @Column(name="peerpay_message", type="string", length=500, nullable=false)
     */
    private $peerpayMessage = '';

    /**
     * @var int
     *
     * @Column(name="status", type="smallint", nullable=false)
     */
    private $status = '0';

    /**
     * @var int
     *
     * @Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime = '0';

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
    public function getOrderid(): int
    {
        return $this->orderid;
    }

    /**
     * @param int $orderid
     */
    public function setOrderid(int $orderid): void
    {
        $this->orderid = $orderid;
    }

    /**
     * @return int
     */
    public function getPeerpayType(): int
    {
        return $this->peerpayType;
    }

    /**
     * @param int $peerpayType
     */
    public function setPeerpayType(int $peerpayType): void
    {
        $this->peerpayType = $peerpayType;
    }

    /**
     * @return string
     */
    public function getPeerpayPrice(): string
    {
        return $this->peerpayPrice;
    }

    /**
     * @param string $peerpayPrice
     */
    public function setPeerpayPrice(string $peerpayPrice): void
    {
        $this->peerpayPrice = $peerpayPrice;
    }

    /**
     * @return string
     */
    public function getPeerpayMaxprice(): string
    {
        return $this->peerpayMaxprice;
    }

    /**
     * @param string $peerpayMaxprice
     */
    public function setPeerpayMaxprice(string $peerpayMaxprice): void
    {
        $this->peerpayMaxprice = $peerpayMaxprice;
    }

    /**
     * @return string
     */
    public function getPeerpayRealprice(): string
    {
        return $this->peerpayRealprice;
    }

    /**
     * @param string $peerpayRealprice
     */
    public function setPeerpayRealprice(string $peerpayRealprice): void
    {
        $this->peerpayRealprice = $peerpayRealprice;
    }

    /**
     * @return string
     */
    public function getPeerpaySelfpay(): string
    {
        return $this->peerpaySelfpay;
    }

    /**
     * @param string $peerpaySelfpay
     */
    public function setPeerpaySelfpay(string $peerpaySelfpay): void
    {
        $this->peerpaySelfpay = $peerpaySelfpay;
    }

    /**
     * @return string
     */
    public function getPeerpayMessage(): string
    {
        return $this->peerpayMessage;
    }

    /**
     * @param string $peerpayMessage
     */
    public function setPeerpayMessage(string $peerpayMessage): void
    {
        $this->peerpayMessage = $peerpayMessage;
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

}
