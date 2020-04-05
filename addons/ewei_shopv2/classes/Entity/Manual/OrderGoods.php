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
 * OrderGoods
 * @Table(name="ims_ewei_shop_order_goods",
 *      indexes={
 *          @Index(name="idx_applytime3", columns={"applytime3"}),
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_checktime3", columns={"checktime3"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"}),
 *          @Index(name="idx_invalidtime3", columns={"invalidtime3"}),
 *          @Index(name="idx_applytime1", columns={"applytime1"}),
 *          @Index(name="idx_paytime1", columns={"paytime1"}),
 *          @Index(name="idx_status1", columns={"status1"}),
 *          @Index(name="idx_paytime3", columns={"paytime3"}),
 *          @Index(name="idx_checktime2", columns={"checktime2"}),
 *          @Index(name="idx_invalidtime1", columns={"invalidtime1"}),
 *          @Index(name="idx_orderid", columns={"orderid"}),
 *          @Index(name="idx_invalidtime2", columns={"invalidtime2"}),
 *          @Index(name="idx_createtime", columns={"createtime"}),
 *          @Index(name="idx_status3", columns={"status3"}),
 *          @Index(name="idx_checktime1", columns={"checktime1"}),
 *          @Index(name="idx_paytime2", columns={"paytime2"}),
 *          @Index(name="idx_applytime2", columns={"applytime2"}),
 *          @Index(name="idx_status2", columns={"status2"})})
 * @Entity
 */
class OrderGoods
{
    public const TABLE_NAME = 'ims_ewei_shop_order_goods';

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
     * @var int|null
     *
     * @Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

    /**
     * @var string|null
     *
     * @Column(name="price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="total", type="integer", nullable=true, options={"default"="1"})
     */
    private $total = '1';

    /**
     * @var int|null
     *
     * @Column(name="optionid", type="integer", nullable=true)
     */
    private $optionid = '0';

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="optionname", type="text", length=65535, nullable=true)
     */
    private $optionname;

    /**
     * @var string|null
     *
     * @Column(name="commission1", type="text", length=65535, nullable=true)
     */
    private $commission1;

    /**
     * @var int|null
     *
     * @Column(name="applytime1", type="integer", nullable=true)
     */
    private $applytime1 = '0';

    /**
     * @var int|null
     *
     * @Column(name="checktime1", type="integer", nullable=true)
     */
    private $checktime1 = '0';

    /**
     * @var int|null
     *
     * @Column(name="paytime1", type="integer", nullable=true)
     */
    private $paytime1 = '0';

    /**
     * @var int|null
     *
     * @Column(name="invalidtime1", type="integer", nullable=true)
     */
    private $invalidtime1 = '0';

    /**
     * @var int|null
     *
     * @Column(name="deletetime1", type="integer", nullable=true)
     */
    private $deletetime1 = '0';

    /**
     * @var int|null
     *
     * @Column(name="status1", type="smallint", nullable=true)
     */
    private $status1 = '0';

    /**
     * @var string|null
     *
     * @Column(name="content1", type="text", length=65535, nullable=true)
     */
    private $content1;

    /**
     * @var string|null
     *
     * @Column(name="commission2", type="text", length=65535, nullable=true)
     */
    private $commission2;

    /**
     * @var int|null
     *
     * @Column(name="applytime2", type="integer", nullable=true)
     */
    private $applytime2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="checktime2", type="integer", nullable=true)
     */
    private $checktime2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="paytime2", type="integer", nullable=true)
     */
    private $paytime2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="invalidtime2", type="integer", nullable=true)
     */
    private $invalidtime2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="deletetime2", type="integer", nullable=true)
     */
    private $deletetime2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="status2", type="smallint", nullable=true)
     */
    private $status2 = '0';

    /**
     * @var string|null
     *
     * @Column(name="content2", type="text", length=65535, nullable=true)
     */
    private $content2;

    /**
     * @var string|null
     *
     * @Column(name="commission3", type="text", length=65535, nullable=true)
     */
    private $commission3;

    /**
     * @var int|null
     *
     * @Column(name="applytime3", type="integer", nullable=true)
     */
    private $applytime3 = '0';

    /**
     * @var int|null
     *
     * @Column(name="checktime3", type="integer", nullable=true)
     */
    private $checktime3 = '0';

    /**
     * @var int|null
     *
     * @Column(name="paytime3", type="integer", nullable=true)
     */
    private $paytime3 = '0';

    /**
     * @var int|null
     *
     * @Column(name="invalidtime3", type="integer", nullable=true)
     */
    private $invalidtime3 = '0';

    /**
     * @var int|null
     *
     * @Column(name="deletetime3", type="integer", nullable=true)
     */
    private $deletetime3 = '0';

    /**
     * @var int|null
     *
     * @Column(name="status3", type="smallint", nullable=true)
     */
    private $status3 = '0';

    /**
     * @var string|null
     *
     * @Column(name="content3", type="text", length=65535, nullable=true)
     */
    private $content3;

    /**
     * @var string|null
     *
     * @Column(name="realprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $realprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="goodssn", type="string", length=255, nullable=true)
     */
    private $goodssn = '';

    /**
     * @var string|null
     *
     * @Column(name="productsn", type="string", length=255, nullable=true)
     */
    private $productsn = '';

    /**
     * @var int|null
     *
     * @Column(name="nocommission", type="smallint", nullable=true)
     */
    private $nocommission = '0';

    /**
     * @var string|null
     *
     * @Column(name="changeprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $changeprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="oldprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $oldprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commissions", type="text", length=65535, nullable=true)
     */
    private $commissions;

    /**
     * @var int|null
     *
     * @Column(name="diyformid", type="integer", nullable=true)
     */
    private $diyformid = '0';

    /**
     * @var int|null
     *
     * @Column(name="diyformdataid", type="integer", nullable=true)
     */
    private $diyformdataid = '0';

    /**
     * @var string|null
     *
     * @Column(name="diyformdata", type="text", length=65535, nullable=true)
     */
    private $diyformdata;

    /**
     * @var string|null
     *
     * @Column(name="diyformfields", type="text", length=65535, nullable=true)
     */
    private $diyformfields;

    /**
     * @var string|null
     *
     * @Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

    /**
     * @var int
     *
     * @Column(name="printstate", type="integer", nullable=false)
     */
    private $printstate = '0';

    /**
     * @var int
     *
     * @Column(name="printstate2", type="integer", nullable=false)
     */
    private $printstate2 = '0';

    /**
     * @var int|null
     *
     * @Column(name="rstate", type="smallint", nullable=true)
     */
    private $rstate = '0';

    /**
     * @var int|null
     *
     * @Column(name="refundtime", type="integer", nullable=true)
     */
    private $refundtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';

    /**
     * @var int|null
     *
     * @Column(name="parentorderid", type="integer", nullable=true)
     */
    private $parentorderid = '0';

    /**
     * @var int
     *
     * @Column(name="merchsale", type="smallint", nullable=false)
     */
    private $merchsale = '0';

    /**
     * @var string
     *
     * @Column(name="isdiscountprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $isdiscountprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="canbuyagain", type="smallint", nullable=true)
     */
    private $canbuyagain = '0';

    /**
     * @var int|null
     *
     * @Column(name="seckill", type="smallint", nullable=true)
     */
    private $seckill = '0';

    /**
     * @var int|null
     *
     * @Column(name="seckill_taskid", type="integer", nullable=true)
     */
    private $seckillTaskid = '0';

    /**
     * @var int|null
     *
     * @Column(name="seckill_roomid", type="integer", nullable=true)
     */
    private $seckillRoomid = '0';

    /**
     * @var int|null
     *
     * @Column(name="seckill_timeid", type="integer", nullable=true)
     */
    private $seckillTimeid = '0';

    /**
     * @var int|null
     *
     * @Column(name="is_make", type="smallint", nullable=true)
     */
    private $isMake = '0';

    /**
     * @var int
     *
     * @Column(name="sendtype", type="smallint", nullable=false)
     */
    private $sendtype = '0';

    /**
     * @var string
     *
     * @Column(name="expresscom", type="string", length=30, nullable=false)
     */
    private $expresscom;

    /**
     * @var string
     *
     * @Column(name="expresssn", type="string", length=50, nullable=false)
     */
    private $expresssn;

    /**
     * @var string
     *
     * @Column(name="express", type="string", length=255, nullable=false)
     */
    private $express;

    /**
     * @var int
     *
     * @Column(name="sendtime", type="integer", nullable=false)
     */
    private $sendtime;

    /**
     * @var int
     *
     * @Column(name="finishtime", type="integer", nullable=false)
     */
    private $finishtime;

    /**
     * @var string
     *
     * @Column(name="remarksend", type="text", length=65535, nullable=false)
     */
    private $remarksend;

    /**
     * @var int
     *
     * @Column(name="prohibitrefund", type="smallint", nullable=false)
     */
    private $prohibitrefund = '0';

    /**
     * @var string
     *
     * @Column(name="storeid", type="string", length=255, nullable=false)
     */
    private $storeid;

    /**
     * @var int
     *
     * @Column(name="trade_time", type="integer", nullable=false)
     */
    private $tradeTime = '0';

    /**
     * @var string
     *
     * @Column(name="optime", type="string", length=30, nullable=false)
     */
    private $optime;

    /**
     * @var int
     *
     * @Column(name="tdate_time", type="integer", nullable=false)
     */
    private $tdateTime = '0';

    /**
     * @var string
     *
     * @Column(name="dowpayment", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $dowpayment = '0.00';

    /**
     * @var int
     *
     * @Column(name="peopleid", type="integer", nullable=false)
     */
    private $peopleid = '0';

    /**
     * @var int
     *
     * @Column(name="esheetprintnum", type="integer", nullable=false)
     */
    private $esheetprintnum = '0';

    /**
     * @var string
     *
     * @Column(name="ordercode", type="string", length=30, nullable=false)
     */
    private $ordercode;

    /**
     * @var string|null
     *
     * @Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @Column(name="consume", type="text", length=65535, nullable=true)
     */
    private $consume;

    /**
     * @var int
     *
     * @Column(name="single_refundid", type="integer", nullable=false)
     */
    private $singleRefundid = '0';

    /**
     * @var int
     *
     * @Column(name="single_refundstate", type="smallint", nullable=false)
     */
    private $singleRefundstate = '0';

    /**
     * @var int
     *
     * @Column(name="single_refundtime", type="integer", nullable=false)
     */
    private $singleRefundtime = '0';

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
     * @return int|null
     */
    public function getTotal(): ?int
    {
        return $this->total;
    }

    /**
     * @param int|null $total
     */
    public function setTotal(?int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return int|null
     */
    public function getOptionid(): ?int
    {
        return $this->optionid;
    }

    /**
     * @param int|null $optionid
     */
    public function setOptionid(?int $optionid): void
    {
        $this->optionid = $optionid;
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
     * @return string|null
     */
    public function getOptionname(): ?string
    {
        return $this->optionname;
    }

    /**
     * @param string|null $optionname
     */
    public function setOptionname(?string $optionname): void
    {
        $this->optionname = $optionname;
    }

    /**
     * @return string|null
     */
    public function getCommission1(): ?string
    {
        return $this->commission1;
    }

    /**
     * @param string|null $commission1
     */
    public function setCommission1(?string $commission1): void
    {
        $this->commission1 = $commission1;
    }

    /**
     * @return int|null
     */
    public function getApplytime1(): ?int
    {
        return $this->applytime1;
    }

    /**
     * @param int|null $applytime1
     */
    public function setApplytime1(?int $applytime1): void
    {
        $this->applytime1 = $applytime1;
    }

    /**
     * @return int|null
     */
    public function getChecktime1(): ?int
    {
        return $this->checktime1;
    }

    /**
     * @param int|null $checktime1
     */
    public function setChecktime1(?int $checktime1): void
    {
        $this->checktime1 = $checktime1;
    }

    /**
     * @return int|null
     */
    public function getPaytime1(): ?int
    {
        return $this->paytime1;
    }

    /**
     * @param int|null $paytime1
     */
    public function setPaytime1(?int $paytime1): void
    {
        $this->paytime1 = $paytime1;
    }

    /**
     * @return int|null
     */
    public function getInvalidtime1(): ?int
    {
        return $this->invalidtime1;
    }

    /**
     * @param int|null $invalidtime1
     */
    public function setInvalidtime1(?int $invalidtime1): void
    {
        $this->invalidtime1 = $invalidtime1;
    }

    /**
     * @return int|null
     */
    public function getDeletetime1(): ?int
    {
        return $this->deletetime1;
    }

    /**
     * @param int|null $deletetime1
     */
    public function setDeletetime1(?int $deletetime1): void
    {
        $this->deletetime1 = $deletetime1;
    }

    /**
     * @return int|null
     */
    public function getStatus1(): ?int
    {
        return $this->status1;
    }

    /**
     * @param int|null $status1
     */
    public function setStatus1(?int $status1): void
    {
        $this->status1 = $status1;
    }

    /**
     * @return string|null
     */
    public function getContent1(): ?string
    {
        return $this->content1;
    }

    /**
     * @param string|null $content1
     */
    public function setContent1(?string $content1): void
    {
        $this->content1 = $content1;
    }

    /**
     * @return string|null
     */
    public function getCommission2(): ?string
    {
        return $this->commission2;
    }

    /**
     * @param string|null $commission2
     */
    public function setCommission2(?string $commission2): void
    {
        $this->commission2 = $commission2;
    }

    /**
     * @return int|null
     */
    public function getApplytime2(): ?int
    {
        return $this->applytime2;
    }

    /**
     * @param int|null $applytime2
     */
    public function setApplytime2(?int $applytime2): void
    {
        $this->applytime2 = $applytime2;
    }

    /**
     * @return int|null
     */
    public function getChecktime2(): ?int
    {
        return $this->checktime2;
    }

    /**
     * @param int|null $checktime2
     */
    public function setChecktime2(?int $checktime2): void
    {
        $this->checktime2 = $checktime2;
    }

    /**
     * @return int|null
     */
    public function getPaytime2(): ?int
    {
        return $this->paytime2;
    }

    /**
     * @param int|null $paytime2
     */
    public function setPaytime2(?int $paytime2): void
    {
        $this->paytime2 = $paytime2;
    }

    /**
     * @return int|null
     */
    public function getInvalidtime2(): ?int
    {
        return $this->invalidtime2;
    }

    /**
     * @param int|null $invalidtime2
     */
    public function setInvalidtime2(?int $invalidtime2): void
    {
        $this->invalidtime2 = $invalidtime2;
    }

    /**
     * @return int|null
     */
    public function getDeletetime2(): ?int
    {
        return $this->deletetime2;
    }

    /**
     * @param int|null $deletetime2
     */
    public function setDeletetime2(?int $deletetime2): void
    {
        $this->deletetime2 = $deletetime2;
    }

    /**
     * @return int|null
     */
    public function getStatus2(): ?int
    {
        return $this->status2;
    }

    /**
     * @param int|null $status2
     */
    public function setStatus2(?int $status2): void
    {
        $this->status2 = $status2;
    }

    /**
     * @return string|null
     */
    public function getContent2(): ?string
    {
        return $this->content2;
    }

    /**
     * @param string|null $content2
     */
    public function setContent2(?string $content2): void
    {
        $this->content2 = $content2;
    }

    /**
     * @return string|null
     */
    public function getCommission3(): ?string
    {
        return $this->commission3;
    }

    /**
     * @param string|null $commission3
     */
    public function setCommission3(?string $commission3): void
    {
        $this->commission3 = $commission3;
    }

    /**
     * @return int|null
     */
    public function getApplytime3(): ?int
    {
        return $this->applytime3;
    }

    /**
     * @param int|null $applytime3
     */
    public function setApplytime3(?int $applytime3): void
    {
        $this->applytime3 = $applytime3;
    }

    /**
     * @return int|null
     */
    public function getChecktime3(): ?int
    {
        return $this->checktime3;
    }

    /**
     * @param int|null $checktime3
     */
    public function setChecktime3(?int $checktime3): void
    {
        $this->checktime3 = $checktime3;
    }

    /**
     * @return int|null
     */
    public function getPaytime3(): ?int
    {
        return $this->paytime3;
    }

    /**
     * @param int|null $paytime3
     */
    public function setPaytime3(?int $paytime3): void
    {
        $this->paytime3 = $paytime3;
    }

    /**
     * @return int|null
     */
    public function getInvalidtime3(): ?int
    {
        return $this->invalidtime3;
    }

    /**
     * @param int|null $invalidtime3
     */
    public function setInvalidtime3(?int $invalidtime3): void
    {
        $this->invalidtime3 = $invalidtime3;
    }

    /**
     * @return int|null
     */
    public function getDeletetime3(): ?int
    {
        return $this->deletetime3;
    }

    /**
     * @param int|null $deletetime3
     */
    public function setDeletetime3(?int $deletetime3): void
    {
        $this->deletetime3 = $deletetime3;
    }

    /**
     * @return int|null
     */
    public function getStatus3(): ?int
    {
        return $this->status3;
    }

    /**
     * @param int|null $status3
     */
    public function setStatus3(?int $status3): void
    {
        $this->status3 = $status3;
    }

    /**
     * @return string|null
     */
    public function getContent3(): ?string
    {
        return $this->content3;
    }

    /**
     * @param string|null $content3
     */
    public function setContent3(?string $content3): void
    {
        $this->content3 = $content3;
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
     * @return string|null
     */
    public function getGoodssn(): ?string
    {
        return $this->goodssn;
    }

    /**
     * @param string|null $goodssn
     */
    public function setGoodssn(?string $goodssn): void
    {
        $this->goodssn = $goodssn;
    }

    /**
     * @return string|null
     */
    public function getProductsn(): ?string
    {
        return $this->productsn;
    }

    /**
     * @param string|null $productsn
     */
    public function setProductsn(?string $productsn): void
    {
        $this->productsn = $productsn;
    }

    /**
     * @return int|null
     */
    public function getNocommission(): ?int
    {
        return $this->nocommission;
    }

    /**
     * @param int|null $nocommission
     */
    public function setNocommission(?int $nocommission): void
    {
        $this->nocommission = $nocommission;
    }

    /**
     * @return string|null
     */
    public function getChangeprice(): ?string
    {
        return $this->changeprice;
    }

    /**
     * @param string|null $changeprice
     */
    public function setChangeprice(?string $changeprice): void
    {
        $this->changeprice = $changeprice;
    }

    /**
     * @return string|null
     */
    public function getOldprice(): ?string
    {
        return $this->oldprice;
    }

    /**
     * @param string|null $oldprice
     */
    public function setOldprice(?string $oldprice): void
    {
        $this->oldprice = $oldprice;
    }

    /**
     * @return string|null
     */
    public function getCommissions(): ?string
    {
        return $this->commissions;
    }

    /**
     * @param string|null $commissions
     */
    public function setCommissions(?string $commissions): void
    {
        $this->commissions = $commissions;
    }

    /**
     * @return int|null
     */
    public function getDiyformid(): ?int
    {
        return $this->diyformid;
    }

    /**
     * @param int|null $diyformid
     */
    public function setDiyformid(?int $diyformid): void
    {
        $this->diyformid = $diyformid;
    }

    /**
     * @return int|null
     */
    public function getDiyformdataid(): ?int
    {
        return $this->diyformdataid;
    }

    /**
     * @param int|null $diyformdataid
     */
    public function setDiyformdataid(?int $diyformdataid): void
    {
        $this->diyformdataid = $diyformdataid;
    }

    /**
     * @return string|null
     */
    public function getDiyformdata(): ?string
    {
        return $this->diyformdata;
    }

    /**
     * @param string|null $diyformdata
     */
    public function setDiyformdata(?string $diyformdata): void
    {
        $this->diyformdata = $diyformdata;
    }

    /**
     * @return string|null
     */
    public function getDiyformfields(): ?string
    {
        return $this->diyformfields;
    }

    /**
     * @param string|null $diyformfields
     */
    public function setDiyformfields(?string $diyformfields): void
    {
        $this->diyformfields = $diyformfields;
    }

    /**
     * @return string|null
     */
    public function getOpenid(): ?string
    {
        return $this->openid;
    }

    /**
     * @param string|null $openid
     */
    public function setOpenid(?string $openid): void
    {
        $this->openid = $openid;
    }

    /**
     * @return int
     */
    public function getPrintstate(): int
    {
        return $this->printstate;
    }

    /**
     * @param int $printstate
     */
    public function setPrintstate(int $printstate): void
    {
        $this->printstate = $printstate;
    }

    /**
     * @return int
     */
    public function getPrintstate2(): int
    {
        return $this->printstate2;
    }

    /**
     * @param int $printstate2
     */
    public function setPrintstate2(int $printstate2): void
    {
        $this->printstate2 = $printstate2;
    }

    /**
     * @return int|null
     */
    public function getRstate(): ?int
    {
        return $this->rstate;
    }

    /**
     * @param int|null $rstate
     */
    public function setRstate(?int $rstate): void
    {
        $this->rstate = $rstate;
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

    /**
     * @return int|null
     */
    public function getParentorderid(): ?int
    {
        return $this->parentorderid;
    }

    /**
     * @param int|null $parentorderid
     */
    public function setParentorderid(?int $parentorderid): void
    {
        $this->parentorderid = $parentorderid;
    }

    /**
     * @return int
     */
    public function getMerchsale(): int
    {
        return $this->merchsale;
    }

    /**
     * @param int $merchsale
     */
    public function setMerchsale(int $merchsale): void
    {
        $this->merchsale = $merchsale;
    }

    /**
     * @return string
     */
    public function getIsdiscountprice(): string
    {
        return $this->isdiscountprice;
    }

    /**
     * @param string $isdiscountprice
     */
    public function setIsdiscountprice(string $isdiscountprice): void
    {
        $this->isdiscountprice = $isdiscountprice;
    }

    /**
     * @return int|null
     */
    public function getCanbuyagain(): ?int
    {
        return $this->canbuyagain;
    }

    /**
     * @param int|null $canbuyagain
     */
    public function setCanbuyagain(?int $canbuyagain): void
    {
        $this->canbuyagain = $canbuyagain;
    }

    /**
     * @return int|null
     */
    public function getSeckill(): ?int
    {
        return $this->seckill;
    }

    /**
     * @param int|null $seckill
     */
    public function setSeckill(?int $seckill): void
    {
        $this->seckill = $seckill;
    }

    /**
     * @return int|null
     */
    public function getSeckillTaskid(): ?int
    {
        return $this->seckillTaskid;
    }

    /**
     * @param int|null $seckillTaskid
     */
    public function setSeckillTaskid(?int $seckillTaskid): void
    {
        $this->seckillTaskid = $seckillTaskid;
    }

    /**
     * @return int|null
     */
    public function getSeckillRoomid(): ?int
    {
        return $this->seckillRoomid;
    }

    /**
     * @param int|null $seckillRoomid
     */
    public function setSeckillRoomid(?int $seckillRoomid): void
    {
        $this->seckillRoomid = $seckillRoomid;
    }

    /**
     * @return int|null
     */
    public function getSeckillTimeid(): ?int
    {
        return $this->seckillTimeid;
    }

    /**
     * @param int|null $seckillTimeid
     */
    public function setSeckillTimeid(?int $seckillTimeid): void
    {
        $this->seckillTimeid = $seckillTimeid;
    }

    /**
     * @return int|null
     */
    public function getIsMake(): ?int
    {
        return $this->isMake;
    }

    /**
     * @param int|null $isMake
     */
    public function setIsMake(?int $isMake): void
    {
        $this->isMake = $isMake;
    }

    /**
     * @return int
     */
    public function getSendtype(): int
    {
        return $this->sendtype;
    }

    /**
     * @param int $sendtype
     */
    public function setSendtype(int $sendtype): void
    {
        $this->sendtype = $sendtype;
    }

    /**
     * @return string
     */
    public function getExpresscom(): string
    {
        return $this->expresscom;
    }

    /**
     * @param string $expresscom
     */
    public function setExpresscom(string $expresscom): void
    {
        $this->expresscom = $expresscom;
    }

    /**
     * @return string
     */
    public function getExpresssn(): string
    {
        return $this->expresssn;
    }

    /**
     * @param string $expresssn
     */
    public function setExpresssn(string $expresssn): void
    {
        $this->expresssn = $expresssn;
    }

    /**
     * @return string
     */
    public function getExpress(): string
    {
        return $this->express;
    }

    /**
     * @param string $express
     */
    public function setExpress(string $express): void
    {
        $this->express = $express;
    }

    /**
     * @return int
     */
    public function getSendtime(): int
    {
        return $this->sendtime;
    }

    /**
     * @param int $sendtime
     */
    public function setSendtime(int $sendtime): void
    {
        $this->sendtime = $sendtime;
    }

    /**
     * @return int
     */
    public function getFinishtime(): int
    {
        return $this->finishtime;
    }

    /**
     * @param int $finishtime
     */
    public function setFinishtime(int $finishtime): void
    {
        $this->finishtime = $finishtime;
    }

    /**
     * @return string
     */
    public function getRemarksend(): string
    {
        return $this->remarksend;
    }

    /**
     * @param string $remarksend
     */
    public function setRemarksend(string $remarksend): void
    {
        $this->remarksend = $remarksend;
    }

    /**
     * @return int
     */
    public function getProhibitrefund(): int
    {
        return $this->prohibitrefund;
    }

    /**
     * @param int $prohibitrefund
     */
    public function setProhibitrefund(int $prohibitrefund): void
    {
        $this->prohibitrefund = $prohibitrefund;
    }

    /**
     * @return string
     */
    public function getStoreid(): string
    {
        return $this->storeid;
    }

    /**
     * @param string $storeid
     */
    public function setStoreid(string $storeid): void
    {
        $this->storeid = $storeid;
    }

    /**
     * @return int
     */
    public function getTradeTime(): int
    {
        return $this->tradeTime;
    }

    /**
     * @param int $tradeTime
     */
    public function setTradeTime(int $tradeTime): void
    {
        $this->tradeTime = $tradeTime;
    }

    /**
     * @return string
     */
    public function getOptime(): string
    {
        return $this->optime;
    }

    /**
     * @param string $optime
     */
    public function setOptime(string $optime): void
    {
        $this->optime = $optime;
    }

    /**
     * @return int
     */
    public function getTdateTime(): int
    {
        return $this->tdateTime;
    }

    /**
     * @param int $tdateTime
     */
    public function setTdateTime(int $tdateTime): void
    {
        $this->tdateTime = $tdateTime;
    }

    /**
     * @return string
     */
    public function getDowpayment(): string
    {
        return $this->dowpayment;
    }

    /**
     * @param string $dowpayment
     */
    public function setDowpayment(string $dowpayment): void
    {
        $this->dowpayment = $dowpayment;
    }

    /**
     * @return int
     */
    public function getPeopleid(): int
    {
        return $this->peopleid;
    }

    /**
     * @param int $peopleid
     */
    public function setPeopleid(int $peopleid): void
    {
        $this->peopleid = $peopleid;
    }

    /**
     * @return int
     */
    public function getEsheetprintnum(): int
    {
        return $this->esheetprintnum;
    }

    /**
     * @param int $esheetprintnum
     */
    public function setEsheetprintnum(int $esheetprintnum): void
    {
        $this->esheetprintnum = $esheetprintnum;
    }

    /**
     * @return string
     */
    public function getOrdercode(): string
    {
        return $this->ordercode;
    }

    /**
     * @param string $ordercode
     */
    public function setOrdercode(string $ordercode): void
    {
        $this->ordercode = $ordercode;
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
    public function getConsume(): ?string
    {
        return $this->consume;
    }

    /**
     * @param string|null $consume
     */
    public function setConsume(?string $consume): void
    {
        $this->consume = $consume;
    }

    /**
     * @return int
     */
    public function getSingleRefundid(): int
    {
        return $this->singleRefundid;
    }

    /**
     * @param int $singleRefundid
     */
    public function setSingleRefundid(int $singleRefundid): void
    {
        $this->singleRefundid = $singleRefundid;
    }

    /**
     * @return int
     */
    public function getSingleRefundstate(): int
    {
        return $this->singleRefundstate;
    }

    /**
     * @param int $singleRefundstate
     */
    public function setSingleRefundstate(int $singleRefundstate): void
    {
        $this->singleRefundstate = $singleRefundstate;
    }

    /**
     * @return int
     */
    public function getSingleRefundtime(): int
    {
        return $this->singleRefundtime;
    }

    /**
     * @param int $singleRefundtime
     */
    public function setSingleRefundtime(int $singleRefundtime): void
    {
        $this->singleRefundtime = $singleRefundtime;
    }

}
