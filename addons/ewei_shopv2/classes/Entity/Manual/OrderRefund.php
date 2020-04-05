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
 * ImsEweiShopOrderRefund
 *
 * @Table(name="ims_ewei_shop_order_refund",
 *      indexes={@Index(name="idx_createtime", columns={"createtime"}),
 *      @Index(name="idx_uniacid", columns={"uniacid"})})
 * @Entity
 */
class OrderRefund
{
    public const TABLE_NAME = 'ims_ewei_shop_order_refund';
    public const REFUND_TYPE = ['退款', '退货退款', '换货'];

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
     * @Column(name="orderid", type="integer", nullable=true)
     */
    private $orderid = '0';

    /**
     * @var string|null
     *
     * @Column(name="refundno", type="string", length=255, nullable=true)
     */
    private $refundno = '';

    /**
     * @var string|null
     *
     * @Column(name="price", type="string", length=255, nullable=true)
     */
    private $price = '';

    /**
     * @var string|null
     *
     * @Column(name="reason", type="string", length=255, nullable=true)
     */
    private $reason = '';

    /**
     * @var string|null
     *
     * @Column(name="images", type="text", length=65535, nullable=true)
     */
    private $images;

    /**
     * @var string|null
     *
     * @Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status = '0';

    /**
     * @var string|null
     *
     * @Column(name="reply", type="text", length=65535, nullable=true)
     */
    private $reply;

    /**
     * @var int|null
     *
     * @Column(name="refundtype", type="smallint", nullable=true)
     */
    private $refundtype = '0';

    /**
     * @var string|null
     *
     * @Column(name="orderprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $orderprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="applyprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $applyprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="imgs", type="text", length=65535, nullable=true)
     */
    private $imgs;

    /**
     * @var int|null
     *
     * @Column(name="rtype", type="smallint", nullable=true)
     */
    private $rtype = '0';

    /**
     * @var string|null
     *
     * @Column(name="refundaddress", type="text", length=65535, nullable=true)
     */
    private $refundaddress;

    /**
     * @var string|null
     *
     * @Column(name="message", type="text", length=65535, nullable=true)
     */
    private $message;

    /**
     * @var string|null
     *
     * @Column(name="express", type="string", length=100, nullable=true)
     */
    private $express = '';

    /**
     * @var string|null
     *
     * @Column(name="expresscom", type="string", length=100, nullable=true)
     */
    private $expresscom = '';

    /**
     * @var string|null
     *
     * @Column(name="expresssn", type="string", length=100, nullable=true)
     */
    private $expresssn = '';

    /**
     * @var int|null
     *
     * @Column(name="operatetime", type="integer", nullable=true)
     */
    private $operatetime = '0';

    /**
     * @var int|null
     *
     * @Column(name="sendtime", type="integer", nullable=true)
     */
    private $sendtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="returntime", type="integer", nullable=true)
     */
    private $returntime = '0';

    /**
     * @var int|null
     *
     * @Column(name="refundtime", type="integer", nullable=true)
     */
    private $refundtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="rexpress", type="string", length=100, nullable=true)
     */
    private $rexpress = '';

    /**
     * @var string|null
     *
     * @Column(name="rexpresscom", type="string", length=100, nullable=true)
     */
    private $rexpresscom = '';

    /**
     * @var string|null
     *
     * @Column(name="rexpresssn", type="string", length=100, nullable=true)
     */
    private $rexpresssn = '';

    /**
     * @var int|null
     *
     * @Column(name="refundaddressid", type="integer", nullable=true)
     */
    private $refundaddressid = '0';

    /**
     * @var int|null
     *
     * @Column(name="endtime", type="integer", nullable=true)
     */
    private $endtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="realprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $realprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="merchid", type="integer", nullable=true)
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
    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    /**
     * @param int|null $orderid
     */
    public function setOrderid(?int $orderid): void
    {
        $this->orderid = $orderid;
    }

    /**
     * @return string|null
     */
    public function getRefundno(): ?string
    {
        return $this->refundno;
    }

    /**
     * @param string|null $refundno
     */
    public function setRefundno(?string $refundno): void
    {
        $this->refundno = $refundno;
    }

    /**
     * @return string|null
     */
    public function getPrice(): ?string
    {
        return $this->price;
    }

    /**
     * @param string|null $price
     */
    public function setPrice(?string $price): void
    {
        $this->price = $price;
    }

    /**
     * @return string|null
     */
    public function getReason(): ?string
    {
        return $this->reason;
    }

    /**
     * @param string|null $reason
     */
    public function setReason(?string $reason): void
    {
        $this->reason = $reason;
    }

    /**
     * @return string|null
     */
    public function getImages(): ?string
    {
        return $this->images;
    }

    /**
     * @param string|null $images
     */
    public function setImages(?string $images): void
    {
        $this->images = $images;
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
    public function getCreatetime(): ?int
    {
        return $this->createtime;
    }

    /**
     * @param int|null $createtime
     */
    public function setCreatetime(?int $createtime): void
    {
        $this->createtime = $createtime;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return string|null
     */
    public function getReply(): ?string
    {
        return $this->reply;
    }

    /**
     * @param string|null $reply
     */
    public function setReply(?string $reply): void
    {
        $this->reply = $reply;
    }

    /**
     * @return int|null
     */
    public function getRefundtype(): ?int
    {
        return $this->refundtype;
    }

    /**
     * @param int|null $refundtype
     */
    public function setRefundtype(?int $refundtype): void
    {
        $this->refundtype = $refundtype;
    }

    /**
     * @return string|null
     */
    public function getOrderprice(): ?string
    {
        return $this->orderprice;
    }

    /**
     * @param string|null $orderprice
     */
    public function setOrderprice(?string $orderprice): void
    {
        $this->orderprice = $orderprice;
    }

    /**
     * @return string|null
     */
    public function getApplyprice(): ?string
    {
        return $this->applyprice;
    }

    /**
     * @param string|null $applyprice
     */
    public function setApplyprice(?string $applyprice): void
    {
        $this->applyprice = $applyprice;
    }

    /**
     * @return string|null
     */
    public function getImgs(): ?string
    {
        return $this->imgs;
    }

    /**
     * @param string|null $imgs
     */
    public function setImgs(?string $imgs): void
    {
        $this->imgs = $imgs;
    }

    /**
     * @return int|null
     */
    public function getRtype(): ?int
    {
        return $this->rtype;
    }

    /**
     * @param int|null $rtype
     */
    public function setRtype(?int $rtype): void
    {
        $this->rtype = $rtype;
    }

    /**
     * @return string|null
     */
    public function getRefundaddress(): ?string
    {
        return $this->refundaddress;
    }

    /**
     * @param string|null $refundaddress
     */
    public function setRefundaddress(?string $refundaddress): void
    {
        $this->refundaddress = $refundaddress;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     */
    public function setMessage(?string $message): void
    {
        $this->message = $message;
    }

    /**
     * @return string|null
     */
    public function getExpress(): ?string
    {
        return $this->express;
    }

    /**
     * @param string|null $express
     */
    public function setExpress(?string $express): void
    {
        $this->express = $express;
    }

    /**
     * @return string|null
     */
    public function getExpresscom(): ?string
    {
        return $this->expresscom;
    }

    /**
     * @param string|null $expresscom
     */
    public function setExpresscom(?string $expresscom): void
    {
        $this->expresscom = $expresscom;
    }

    /**
     * @return string|null
     */
    public function getExpresssn(): ?string
    {
        return $this->expresssn;
    }

    /**
     * @param string|null $expresssn
     */
    public function setExpresssn(?string $expresssn): void
    {
        $this->expresssn = $expresssn;
    }

    /**
     * @return int|null
     */
    public function getOperatetime(): ?int
    {
        return $this->operatetime;
    }

    /**
     * @param int|null $operatetime
     */
    public function setOperatetime(?int $operatetime): void
    {
        $this->operatetime = $operatetime;
    }

    /**
     * @return int|null
     */
    public function getSendtime(): ?int
    {
        return $this->sendtime;
    }

    /**
     * @param int|null $sendtime
     */
    public function setSendtime(?int $sendtime): void
    {
        $this->sendtime = $sendtime;
    }

    /**
     * @return int|null
     */
    public function getReturntime(): ?int
    {
        return $this->returntime;
    }

    /**
     * @param int|null $returntime
     */
    public function setReturntime(?int $returntime): void
    {
        $this->returntime = $returntime;
    }

    /**
     * @return int|null
     */
    public function getRefundtime(): ?int
    {
        return $this->refundtime;
    }

    /**
     * @param int|null $refundtime
     */
    public function setRefundtime(?int $refundtime): void
    {
        $this->refundtime = $refundtime;
    }

    /**
     * @return string|null
     */
    public function getRexpress(): ?string
    {
        return $this->rexpress;
    }

    /**
     * @param string|null $rexpress
     */
    public function setRexpress(?string $rexpress): void
    {
        $this->rexpress = $rexpress;
    }

    /**
     * @return string|null
     */
    public function getRexpresscom(): ?string
    {
        return $this->rexpresscom;
    }

    /**
     * @param string|null $rexpresscom
     */
    public function setRexpresscom(?string $rexpresscom): void
    {
        $this->rexpresscom = $rexpresscom;
    }

    /**
     * @return string|null
     */
    public function getRexpresssn(): ?string
    {
        return $this->rexpresssn;
    }

    /**
     * @param string|null $rexpresssn
     */
    public function setRexpresssn(?string $rexpresssn): void
    {
        $this->rexpresssn = $rexpresssn;
    }

    /**
     * @return int|null
     */
    public function getRefundaddressid(): ?int
    {
        return $this->refundaddressid;
    }

    /**
     * @param int|null $refundaddressid
     */
    public function setRefundaddressid(?int $refundaddressid): void
    {
        $this->refundaddressid = $refundaddressid;
    }

    /**
     * @return int|null
     */
    public function getEndtime(): ?int
    {
        return $this->endtime;
    }

    /**
     * @param int|null $endtime
     */
    public function setEndtime(?int $endtime): void
    {
        $this->endtime = $endtime;
    }

    /**
     * @return string|null
     */
    public function getRealprice(): ?string
    {
        return $this->realprice;
    }

    /**
     * @param string|null $realprice
     */
    public function setRealprice(?string $realprice): void
    {
        $this->realprice = $realprice;
    }

    /**
     * @return int|null
     */
    public function getMerchid(): ?int
    {
        return $this->merchid;
    }

    /**
     * @param int|null $merchid
     */
    public function setMerchid(?int $merchid): void
    {
        $this->merchid = $merchid;
    }

}
