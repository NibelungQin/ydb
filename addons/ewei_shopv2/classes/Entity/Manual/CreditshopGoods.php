<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopGoods
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_goods", indexes={@ORM\Index(name="idx_endtime", columns={"endtime"}), @ORM\Index(name="idx_status", columns={"status"}), @ORM\Index(name="idx_deleted", columns={"deleted"}), @ORM\Index(name="idx_isrecommand", columns={"isrecommand"}), @ORM\Index(name="idx_timestart", columns={"timestart"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_goodstype", columns={"goodstype"}), @ORM\Index(name="idx_createtime", columns={"createtime"}), @ORM\Index(name="idx_displayorder", columns={"displayorder"}), @ORM\Index(name="idx_istop", columns={"istop"}), @ORM\Index(name="idx_istime", columns={"istime"}), @ORM\Index(name="idx_timeend", columns={"timeend"}), @ORM\Index(name="idx_type", columns={"type"})})
 * @ORM\Entity
 */
class CreditshopGoods
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_goods';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=true)
     */
    private $uniacid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="cate", type="integer", nullable=true)
     */
    private $cate = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="type", type="boolean", nullable=true)
     */
    private $type = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="credit", type="integer", nullable=true)
     */
    private $credit = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $money = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="totalday", type="integer", nullable=true)
     */
    private $totalday = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="chance", type="integer", nullable=true)
     */
    private $chance = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="chanceday", type="integer", nullable=true)
     */
    private $chanceday = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="detail", type="text", length=65535, nullable=true)
     */
    private $detail;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rate1", type="integer", nullable=true)
     */
    private $rate1 = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="rate2", type="integer", nullable=true)
     */
    private $rate2 = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="endtime", type="integer", nullable=true)
     */
    private $endtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="joins", type="integer", nullable=true)
     */
    private $joins = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="views", type="integer", nullable=true)
     */
    private $views = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="showlevels", type="text", length=65535, nullable=true)
     */
    private $showlevels;

    /**
     * @var string|null
     *
     * @ORM\Column(name="buylevels", type="text", length=65535, nullable=true)
     */
    private $buylevels;

    /**
     * @var string|null
     *
     * @ORM\Column(name="showgroups", type="text", length=65535, nullable=true)
     */
    private $showgroups;

    /**
     * @var string|null
     *
     * @ORM\Column(name="buygroups", type="text", length=65535, nullable=true)
     */
    private $buygroups;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="vip", type="boolean", nullable=true)
     */
    private $vip = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="istop", type="boolean", nullable=true)
     */
    private $istop = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isrecommand", type="boolean", nullable=true)
     */
    private $isrecommand = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="istime", type="boolean", nullable=true)
     */
    private $istime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="timestart", type="integer", nullable=true)
     */
    private $timestart = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="timeend", type="integer", nullable=true)
     */
    private $timeend = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_title", type="string", length=255, nullable=true)
     */
    private $shareTitle = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_icon", type="string", length=255, nullable=true)
     */
    private $shareIcon = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_desc", type="string", length=500, nullable=true)
     */
    private $shareDesc = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="followneed", type="boolean", nullable=true)
     */
    private $followneed = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="followtext", type="string", length=255, nullable=true)
     */
    private $followtext = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="subdetail", type="text", length=65535, nullable=true)
     */
    private $subdetail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="noticedetail", type="text", length=65535, nullable=true)
     */
    private $noticedetail;

    /**
     * @var string|null
     *
     * @ORM\Column(name="usedetail", type="string", length=255, nullable=true)
     */
    private $usedetail = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="goodsdetail", type="text", length=65535, nullable=true)
     */
    private $goodsdetail;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isendtime", type="boolean", nullable=true)
     */
    private $isendtime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="usecredit2", type="boolean", nullable=true)
     */
    private $usecredit2 = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=true)
     */
    private $area = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatch", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $dispatch = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="storeids", type="text", length=65535, nullable=true)
     */
    private $storeids;

    /**
     * @var string|null
     *
     * @ORM\Column(name="noticeopenid", type="string", length=255, nullable=true)
     */
    private $noticeopenid = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="noticetype", type="boolean", nullable=true)
     */
    private $noticetype = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isverify", type="boolean", nullable=true)
     */
    private $isverify = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="goodstype", type="boolean", nullable=true)
     */
    private $goodstype = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="couponid", type="integer", nullable=true)
     */
    private $couponid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="productprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $productprice = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="mincredit", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $mincredit = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="minmoney", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $minmoney = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="maxcredit", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $maxcredit = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="maxmoney", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $maxmoney = '0.00';

    /**
     * @var bool
     *
     * @ORM\Column(name="dispatchtype", type="boolean", nullable=false)
     */
    private $dispatchtype = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="dispatchid", type="integer", nullable=false)
     */
    private $dispatchid = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="verifytype", type="boolean", nullable=false)
     */
    private $verifytype = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="verifynum", type="integer", nullable=false)
     */
    private $verifynum = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="grant1", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $grant1 = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="grant2", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $grant2 = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="goodssn", type="string", length=255, nullable=false)
     */
    private $goodssn;

    /**
     * @var string
     *
     * @ORM\Column(name="productsn", type="string", length=255, nullable=false)
     */
    private $productsn;

    /**
     * @var int
     *
     * @ORM\Column(name="weight", type="integer", nullable=false)
     */
    private $weight;

    /**
     * @var bool
     *
     * @ORM\Column(name="showtotal", type="boolean", nullable=false)
     */
    private $showtotal;

    /**
     * @var bool
     *
     * @ORM\Column(name="totalcnf", type="boolean", nullable=false)
     */
    private $totalcnf = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="usetime", type="integer", nullable=false)
     */
    private $usetime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="hasoption", type="boolean", nullable=false)
     */
    private $hasoption = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="noticedetailshow", type="boolean", nullable=false)
     */
    private $noticedetailshow = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="detailshow", type="boolean", nullable=false)
     */
    private $detailshow = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="packetmoney", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $packetmoney = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="surplusmoney", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $surplusmoney = '0.00';

    /**
     * @var string
     *
     * @ORM\Column(name="packetlimit", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $packetlimit = '0.00';

    /**
     * @var bool
     *
     * @ORM\Column(name="packettype", type="boolean", nullable=false)
     */
    private $packettype = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="minpacketmoney", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $minpacketmoney = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="packettotal", type="integer", nullable=false)
     */
    private $packettotal = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="packetsurplus", type="integer", nullable=false)
     */
    private $packetsurplus = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="maxpacketmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $maxpacketmoney = '0.00';


}
