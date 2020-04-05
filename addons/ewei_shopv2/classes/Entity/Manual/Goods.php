<?php
/**
 * Created by PhpStorm.
 * User: yang
 * Date: 2019/5/13
 * Time: 0:02
 */
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * Goods
 * @Table(name="ims_ewei_shop_goods",
 *     indexes={
 *          @Index(name="idx_iscomment", columns={"iscomment"}),
 *          @Index(name="idx_istime", columns={"istime"}),
 *          @Index(name="idx_tcate", columns={"tcate"}),
 *          @Index(name="idx_pcate", columns={"pcate"}),
 *          @Index(name="idx_merchid", columns={"merchid"}),
 *          @Index(name="idx_isnew", columns={"isnew"}),
 *          @Index(name="idx_isdiscount", columns={"isdiscount"}),
 *          @Index(name="idx_isrecommand", columns={"isrecommand"}),
 *          @Index(name="idx_issendfree", columns={"issendfree"}),
 *          @Index(name="idx_deleted", columns={"deleted"}),
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_scate", columns={"tcate"}),
 *          @Index(name="idx_ccate", columns={"ccate"}),
 *          @Index(name="idx_checked", columns={"checked"}),
 *          @Index(name="idx_ishot", columns={"ishot"})},
 *     options={"collate":"utf8mb4_unicode_ci", "charset":"utf8mb4", "engine":"InnoDB"}))
 * @Entity
 */
class Goods
{
    public const TABLE_NAME = 'ims_ewei_shop_goods';
    public const TYPE = [
        'new' => '新品',
        'hot' => '热卖',
        'recommand' => '推荐',
        'discount' => '促销',
        'time' => '限时卖',
        'sendfree' => '包邮',
        'nodiscount' => '不参与折扣状态'
    ];


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
     * @Column(name="pcate", type="integer", nullable=true)
     */
    private $pcate = '0';

    /**
     * @var int|null
     *
     * @Column(name="ccate", type="integer", nullable=true)
     */
    private $ccate = '0';

    /**
     * @var int|null
     *
     * @Column(name="`type`", type="smallint", nullable=true, options={"default"="1"})
     */
    private $type = '1';

    /**
     * @var int|null
     *
     * @Column(name="`status`", type="smallint", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var int|null
     *
     * @Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @Column(name="title", type="string", length=100, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var string|null
     *
     * @Column(name="unit", type="string", length=5, nullable=true)
     */
    private $unit = '';

    /**
     * @var string|null
     *
     * @Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description;

    /**
     * @var string|null
     *
     * @Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @Column(name="goodssn", type="string", length=50, nullable=true)
     */
    private $goodssn = '';

    /**
     * @var string|null
     *
     * @Column(name="productsn", type="string", length=50, nullable=true)
     */
    private $productsn = '';

    /**
     * @var string|null
     *
     * @Column(name="productprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $productprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="marketprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $marketprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="costprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $costprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="originalprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $originalprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="total", type="integer", nullable=true)
     */
    private $total = '0';

    /**
     * @var int|null
     *
     * @Column(name="totalcnf", type="integer", nullable=true)
     */
    private $totalcnf = '0';

    /**
     * @var int|null
     *
     * @Column(name="sales", type="integer", nullable=true)
     */
    private $sales = '0';

    /**
     * @var int|null
     *
     * @Column(name="salesreal", type="integer", nullable=true)
     */
    private $salesreal = '0';

    /**
     * @var string|null
     *
     * @Column(name="spec", type="string", length=5000, nullable=true)
     */
    private $spec = '';

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="weight", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $weight = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="credit", type="string", length=255, nullable=true)
     */
    private $credit;

    /**
     * @var int|null
     *
     * @Column(name="maxbuy", type="integer", nullable=true)
     */
    private $maxbuy = '0';

    /**
     * @var int|null
     *
     * @Column(name="usermaxbuy", type="integer", nullable=true)
     */
    private $usermaxbuy = '0';

    /**
     * @var int|null
     *
     * @Column(name="hasoption", type="integer", nullable=true)
     */
    private $hasoption = '0';

    /**
     * @var int|null
     *
     * @Column(name="dispatch", type="integer", nullable=true)
     */
    private $dispatch = '0';

    /**
     * @var string|null
     *
     * @Column(name="thumb_url", type="text", length=65535, nullable=true)
     */
    private $thumbUrl;

    /**
     * @var int|null
     *
     * @Column(name="isnew", type="smallint", nullable=true)
     */
    private $isnew = '0';

    /**
     * @var int|null
     *
     * @Column(name="ishot", type="smallint", nullable=true)
     */
    private $ishot = '0';

    /**
     * @var int|null
     *
     * @Column(name="isdiscount", type="smallint", nullable=true)
     */
    private $isdiscount = '0';

    /**
     * @var int|null
     *
     * @Column(name="isrecommand", type="smallint", nullable=true)
     */
    private $isrecommand = '0';

    /**
     * @var int|null
     *
     * @Column(name="issendfree", type="smallint", nullable=true)
     */
    private $issendfree = '0';

    /**
     * @var int|null
     *
     * @Column(name="istime", type="smallint", nullable=true)
     */
    private $istime = '0';

    /**
     * @var int|null
     *
     * @Column(name="iscomment", type="smallint", nullable=true)
     */
    private $iscomment = '0';

    /**
     * @var int|null
     *
     * @Column(name="timestart", type="integer", nullable=true)
     */
    private $timestart = '0';

    /**
     * @var int|null
     *
     * @Column(name="timeend", type="integer", nullable=true)
     */
    private $timeend = '0';

    /**
     * @var int|null
     *
     * @Column(name="viewcount", type="integer", nullable=true)
     */
    private $viewcount = '0';

    /**
     * @var int|null
     *
     * @Column(name="deleted", type="smallint", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var int|null
     *
     * @Column(name="hascommission", type="smallint", nullable=true)
     */
    private $hascommission = '0';

    /**
     * @var string|null
     *
     * @Column(name="commission1_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission1Rate = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commission1_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission1Pay = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commission2_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission2Rate = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commission2_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission2Pay = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commission3_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission3Rate = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="commission3_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission3Pay = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="score", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $score = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="taobaoid", type="string", length=255, nullable=true)
     */
    private $taobaoid = '';

    /**
     * @var string|null
     *
     * @Column(name="taotaoid", type="string", length=255, nullable=true)
     */
    private $taotaoid = '';

    /**
     * @var string|null
     *
     * @Column(name="taobaourl", type="string", length=255, nullable=true)
     */
    private $taobaourl = '';

    /**
     * @var int|null
     *
     * @Column(name="updatetime", type="integer", nullable=true)
     */
    private $updatetime = '0';

    /**
     * @var string|null
     *
     * @Column(name="share_title", type="string", length=255, nullable=true)
     */
    private $shareTitle = '';

    /**
     * @var string|null
     *
     * @Column(name="share_icon", type="string", length=255, nullable=true)
     */
    private $shareIcon = '';

    /**
     * @var int|null
     *
     * @Column(name="cash", type="smallint", nullable=true)
     */
    private $cash = '0';

    /**
     * @var string|null
     *
     * @Column(name="commission_thumb", type="string", length=255, nullable=true)
     */
    private $commissionThumb = '';

    /**
     * @var int|null
     *
     * @Column(name="isnodiscount", type="smallint", nullable=true)
     */
    private $isnodiscount = '0';

    /**
     * @var string|null
     *
     * @Column(name="showlevels", type="text", length=65535, nullable=true)
     */
    private $showlevels;

    /**
     * @var string|null
     *
     * @Column(name="buylevels", type="text", length=65535, nullable=true)
     */
    private $buylevels;

    /**
     * @var string|null
     *
     * @Column(name="showgroups", type="text", length=65535, nullable=true)
     */
    private $showgroups;

    /**
     * @var string|null
     *
     * @Column(name="buygroups", type="text", length=65535, nullable=true)
     */
    private $buygroups;

    /**
     * @var int|null
     *
     * @Column(name="isverify", type="smallint", nullable=true)
     */
    private $isverify = '0';

    /**
     * @var string|null
     *
     * @Column(name="storeids", type="text", length=65535, nullable=true)
     */
    private $storeids;

    /**
     * @var string|null
     *
     * @Column(name="noticeopenid", type="string", length=255, nullable=true)
     */
    private $noticeopenid = '';

    /**
     * @var int|null
     *
     * @Column(name="tcate", type="integer", nullable=true)
     */
    private $tcate = '0';

    /**
     * @var string|null
     *
     * @Column(name="noticetype", type="text", length=65535, nullable=true)
     */
    private $noticetype;

    /**
     * @var int|null
     *
     * @Column(name="needfollow", type="smallint", nullable=true)
     */
    private $needfollow = '0';

    /**
     * @var string|null
     *
     * @Column(name="followtip", type="string", length=255, nullable=true)
     */
    private $followtip = '';

    /**
     * @var string|null
     *
     * @Column(name="followurl", type="string", length=255, nullable=true)
     */
    private $followurl = '';

    /**
     * @var string|null
     *
     * @Column(name="deduct", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deduct = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="`virtual`", type="integer", nullable=true)
     */
    private $virtual = '0';

    /**
     * @var string|null
     *
     * @Column(name="ccates", type="text", length=65535, nullable=true)
     */
    private $ccates;

    /**
     * @var string|null
     *
     * @Column(name="discounts", type="text", length=65535, nullable=true)
     */
    private $discounts;

    /**
     * @var int|null
     *
     * @Column(name="nocommission", type="smallint", nullable=true)
     */
    private $nocommission = '0';

    /**
     * @var int|null
     *
     * @Column(name="hidecommission", type="smallint", nullable=true)
     */
    private $hidecommission = '0';

    /**
     * @var string|null
     *
     * @Column(name="pcates", type="text", length=65535, nullable=true)
     */
    private $pcates;

    /**
     * @var string|null
     *
     * @Column(name="tcates", type="text", length=65535, nullable=true)
     */
    private $tcates;

    /**
     * @var string|null
     *
     * @Column(name="cates", type="text", length=65535, nullable=true)
     */
    private $cates;

    /**
     * @var int|null
     *
     * @Column(name="artid", type="integer", nullable=true)
     */
    private $artid = '0';

    /**
     * @var string|null
     *
     * @Column(name="detail_logo", type="string", length=255, nullable=true)
     */
    private $detailLogo = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_shopname", type="string", length=255, nullable=true)
     */
    private $detailShopname = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_btntext1", type="string", length=255, nullable=true)
     */
    private $detailBtntext1 = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_btnurl1", type="string", length=255, nullable=true)
     */
    private $detailBtnurl1 = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_btntext2", type="string", length=255, nullable=true)
     */
    private $detailBtntext2 = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_btnurl2", type="string", length=255, nullable=true)
     */
    private $detailBtnurl2 = '';

    /**
     * @var string|null
     *
     * @Column(name="detail_totaltitle", type="string", length=255, nullable=true)
     */
    private $detailTotaltitle = '';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate42392", type="smallint", nullable=true)
     */
    private $saleupdate42392 = '0';

    /**
     * @var string|null
     *
     * @Column(name="deduct2", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deduct2 = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="ednum", type="integer", nullable=true)
     */
    private $ednum = '0';

    /**
     * @var string|null
     *
     * @Column(name="edmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $edmoney = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="edareas", type="text", length=65535, nullable=true)
     */
    private $edareas;

    /**
     * @var int|null
     *
     * @Column(name="diyformtype", type="smallint", nullable=true)
     */
    private $diyformtype = '0';

    /**
     * @var int|null
     *
     * @Column(name="diyformid", type="integer", nullable=true)
     */
    private $diyformid = '0';

    /**
     * @var int|null
     *
     * @Column(name="diymode", type="smallint", nullable=true)
     */
    private $diymode = '0';

    /**
     * @var int|null
     *
     * @Column(name="dispatchtype", type="smallint", nullable=true)
     */
    private $dispatchtype = '0';

    /**
     * @var int|null
     *
     * @Column(name="dispatchid", type="integer", nullable=true)
     */
    private $dispatchid = '0';

    /**
     * @var string|null
     *
     * @Column(name="dispatchprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $dispatchprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="manydeduct", type="smallint", nullable=true)
     */
    private $manydeduct = '0';

    /**
     * @var string|null
     *
     * @Column(name="shorttitle", type="string", length=255, nullable=true)
     */
    private $shorttitle = '';

    /**
     * @var string|null
     *
     * @Column(name="isdiscount_title", type="string", length=255, nullable=true)
     */
    private $isdiscountTitle = '';

    /**
     * @var int|null
     *
     * @Column(name="isdiscount_time", type="integer", nullable=true)
     */
    private $isdiscountTime = '0';

    /**
     * @var string|null
     *
     * @Column(name="isdiscount_discounts", type="text", length=65535, nullable=true)
     */
    private $isdiscountDiscounts;

    /**
     * @var string|null
     *
     * @Column(name="commission", type="text", length=65535, nullable=true)
     */
    private $commission;

    /**
     * @var int|null
     *
     * @Column(name="saleupdate37975", type="smallint", nullable=true)
     */
    private $saleupdate37975 = '0';

    /**
     * @var int|null
     *
     * @Column(name="shopid", type="integer", nullable=true)
     */
    private $shopid = '0';

    /**
     * @var string|null
     *
     * @Column(name="allcates", type="text", length=65535, nullable=true)
     */
    private $allcates;

    /**
     * @var int|null
     *
     * @Column(name="minbuy", type="integer", nullable=true)
     */
    private $minbuy = '0';

    /**
     * @var int|null
     *
     * @Column(name="invoice", type="smallint", nullable=true)
     */
    private $invoice = '0';

    /**
     * @var int|null
     *
     * @Column(name="`repair`", type="smallint", nullable=true)
     */
    private $repair = '0';

    /**
     * @var int|null
     *
     * @Column(name="seven", type="smallint", nullable=true)
     */
    private $seven = '0';

    /**
     * @var string|null
     *
     * @Column(name="money", type="string", length=255, nullable=true)
     */
    private $money = '';

    /**
     * @var string|null
     *
     * @Column(name="minprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $minprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="maxprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $maxprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="province", type="string", length=255, nullable=true)
     */
    private $province = '';

    /**
     * @var string|null
     *
     * @Column(name="city", type="string", length=255, nullable=true)
     */
    private $city = '';

    /**
     * @var int|null
     *
     * @Column(name="buyshow", type="smallint", nullable=true)
     */
    private $buyshow = '0';

    /**
     * @var string|null
     *
     * @Column(name="buycontent", type="text", length=65535, nullable=true)
     */
    private $buycontent;

    /**
     * @var int|null
     *
     * @Column(name="saleupdate51117", type="smallint", nullable=true)
     */
    private $saleupdate51117 = '0';

    /**
     * @var int|null
     *
     * @Column(name="virtualsend", type="smallint", nullable=true)
     */
    private $virtualsend = '0';

    /**
     * @var string|null
     *
     * @Column(name="virtualsendcontent", type="text", length=65535, nullable=true)
     */
    private $virtualsendcontent;

    /**
     * @var int|null
     *
     * @Column(name="verifytype", type="smallint", nullable=true)
     */
    private $verifytype = '0';

    /**
     * @var string|null
     *
     * @Column(name="diyfields", type="text", length=65535, nullable=true)
     */
    private $diyfields;

    /**
     * @var int|null
     *
     * @Column(name="diysaveid", type="integer", nullable=true)
     */
    private $diysaveid = '0';

    /**
     * @var int|null
     *
     * @Column(name="diysave", type="smallint", nullable=true)
     */
    private $diysave = '0';

    /**
     * @var int|null
     *
     * @Column(name="quality", type="smallint", nullable=true)
     */
    private $quality = '0';

    /**
     * @var int
     *
     * @Column(name="groupstype", type="smallint", nullable=false)
     */
    private $groupstype = '0';

    /**
     * @var int
     *
     * @Column(name="showtotal", type="smallint", nullable=false)
     */
    private $showtotal = '0';

    /**
     * @var string|null
     *
     * @Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle = '';

    /**
     * @var int|null
     *
     * @Column(name="minpriceupdated", type="smallint", nullable=true)
     */
    private $minpriceupdated = '0';

    /**
     * @var int
     *
     * @Column(name="sharebtn", type="smallint", nullable=false)
     */
    private $sharebtn = '0';

    /**
     * @var string|null
     *
     * @Column(name="catesinit3", type="text", length=65535, nullable=true)
     */
    private $catesinit3;

    /**
     * @var int|null
     *
     * @Column(name="showtotaladd", type="smallint", nullable=true)
     */
    private $showtotaladd = '0';

    /**
     * @var int|null
     *
     * @Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';

    /**
     * @var int|null
     *
     * @Column(name="checked", type="smallint", nullable=true)
     */
    private $checked = '0';

    /**
     * @var int|null
     *
     * @Column(name="thumb_first", type="smallint", nullable=true)
     */
    private $thumbFirst = '0';

    /**
     * @var int|null
     *
     * @Column(name="merchsale", type="smallint", nullable=true)
     */
    private $merchsale = '0';

    /**
     * @var string|null
     *
     * @Column(name="keywords", type="string", length=255, nullable=true)
     */
    private $keywords = '';

    /**
     * @var string|null
     *
     * @Column(name="catch_id", type="string", length=255, nullable=true)
     */
    private $catchId = '';

    /**
     * @var string|null
     *
     * @Column(name="catch_url", type="string", length=255, nullable=true)
     */
    private $catchUrl = '';

    /**
     * @var string|null
     *
     * @Column(name="catch_source", type="string", length=255, nullable=true)
     */
    private $catchSource = '';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate40170", type="smallint", nullable=true)
     */
    private $saleupdate40170 = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate35843", type="smallint", nullable=true)
     */
    private $saleupdate35843 = '0';

    /**
     * @var string|null
     *
     * @Column(name="labelname", type="text", length=65535, nullable=true)
     */
    private $labelname;

    /**
     * @var int|null
     *
     * @Column(name="autoreceive", type="integer", nullable=true)
     */
    private $autoreceive = '0';

    /**
     * @var int|null
     *
     * @Column(name="cannotrefund", type="smallint", nullable=true)
     */
    private $cannotrefund = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate33219", type="smallint", nullable=true)
     */
    private $saleupdate33219 = '0';

    /**
     * @var int|null
     *
     * @Column(name="bargain", type="integer", nullable=true)
     */
    private $bargain = '0';

    /**
     * @var string|null
     *
     * @Column(name="buyagain", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $buyagain = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="buyagain_islong", type="smallint", nullable=true)
     */
    private $buyagainIslong = '0';

    /**
     * @var int|null
     *
     * @Column(name="buyagain_condition", type="smallint", nullable=true)
     */
    private $buyagainCondition = '0';

    /**
     * @var int|null
     *
     * @Column(name="buyagain_sale", type="smallint", nullable=true)
     */
    private $buyagainSale = '0';

    /**
     * @var string|null
     *
     * @Column(name="buyagain_commission", type="text", length=65535, nullable=true)
     */
    private $buyagainCommission;

    /**
     * @var int|null
     *
     * @Column(name="saleupdate32484", type="smallint", nullable=true)
     */
    private $saleupdate32484 = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate36586", type="smallint", nullable=true)
     */
    private $saleupdate36586 = '0';

    /**
     * @var int|null
     *
     * @Column(name="diypage", type="integer", nullable=true)
     */
    private $diypage;

    /**
     * @var int|null
     *
     * @Column(name="cashier", type="smallint", nullable=true)
     */
    private $cashier = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate53481", type="smallint", nullable=true)
     */
    private $saleupdate53481 = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate30424", type="smallint", nullable=true)
     */
    private $saleupdate30424 = '0';

    /**
     * @var int
     *
     * @Column(name="isendtime", type="smallint", nullable=false)
     */
    private $isendtime = '0';

    /**
     * @var int
     *
     * @Column(name="usetime", type="integer", nullable=false)
     */
    private $usetime = '0';

    /**
     * @var int
     *
     * @Column(name="endtime", type="integer", nullable=false)
     */
    private $endtime = '0';

    /**
     * @var int
     *
     * @Column(name="merchdisplayorder", type="integer", nullable=false)
     */
    private $merchdisplayorder = '0';

    /**
     * @var int|null
     *
     * @Column(name="exchange_stock", type="integer", nullable=true)
     */
    private $exchangeStock = '0';

    /**
     * @var string
     *
     * @Column(name="exchange_postage", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $exchangePostage = '0.00';

    /**
     * @var int
     *
     * @Column(name="ispresell", type="smallint", nullable=false)
     */
    private $ispresell = '0';

    /**
     * @var string
     *
     * @Column(name="presellprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $presellprice = '0.00';

    /**
     * @var int
     *
     * @Column(name="presellover", type="smallint", nullable=false)
     */
    private $presellover = '0';

    /**
     * @var int
     *
     * @Column(name="presellovertime", type="integer", nullable=false)
     */
    private $presellovertime;

    /**
     * @var int
     *
     * @Column(name="presellstart", type="smallint", nullable=false)
     */
    private $presellstart = '0';

    /**
     * @var int
     *
     * @Column(name="preselltimestart", type="integer", nullable=false)
     */
    private $preselltimestart = '0';

    /**
     * @var int
     *
     * @Column(name="presellend", type="smallint", nullable=false)
     */
    private $presellend = '0';

    /**
     * @var int
     *
     * @Column(name="preselltimeend", type="integer", nullable=false)
     */
    private $preselltimeend = '0';

    /**
     * @var int
     *
     * @Column(name="presellsendtype", type="smallint", nullable=false)
     */
    private $presellsendtype = '0';

    /**
     * @var int
     *
     * @Column(name="presellsendstatrttime", type="integer", nullable=false)
     */
    private $presellsendstatrttime = '0';

    /**
     * @var int
     *
     * @Column(name="presellsendtime", type="integer", nullable=false)
     */
    private $presellsendtime = '0';

    /**
     * @var string
     *
     * @Column(name="edareas_code", type="text", length=65535, nullable=false)
     */
    private $edareasCode;

    /**
     * @var int
     *
     * @Column(name="unite_total", type="smallint", nullable=false)
     */
    private $uniteTotal = '0';

    /**
     * @var string|null
     *
     * @Column(name="buyagain_price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $buyagainPrice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="threen", type="string", length=255, nullable=true)
     */
    private $threen = '';

    /**
     * @var int|null
     *
     * @Column(name="intervalfloor", type="smallint", nullable=true)
     */
    private $intervalfloor = '0';

    /**
     * @var string|null
     *
     * @Column(name="intervalprice", type="string", length=512, nullable=true)
     */
    private $intervalprice = '';

    /**
     * @var int
     *
     * @Column(name="isfullback", type="smallint", nullable=false)
     */
    private $isfullback = '0';

    /**
     * @var int
     *
     * @Column(name="isstatustime", type="smallint", nullable=false)
     */
    private $isstatustime = '0';

    /**
     * @var int
     *
     * @Column(name="statustimestart", type="integer", nullable=false)
     */
    private $statustimestart = '0';

    /**
     * @var int
     *
     * @Column(name="statustimeend", type="integer", nullable=false)
     */
    private $statustimeend = '0';

    /**
     * @var int
     *
     * @Column(name="nosearch", type="smallint", nullable=false)
     */
    private $nosearch = '0';

    /**
     * @var int
     *
     * @Column(name="showsales", type="smallint", nullable=false, options={"default"="1"})
     */
    private $showsales = '1';

    /**
     * @var int
     *
     * @Column(name="islive", type="integer", nullable=false)
     */
    private $islive = '0';

    /**
     * @var string
     *
     * @Column(name="liveprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $liveprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="opencard", type="smallint", nullable=true)
     */
    private $opencard = '0';

    /**
     * @var string|null
     *
     * @Column(name="cardid", type="string", length=255, nullable=true)
     */
    private $cardid = '';

    /**
     * @var int|null
     *
     * @Column(name="verifygoodsnum", type="integer", nullable=true, options={"default"="1"})
     */
    private $verifygoodsnum = '1';

    /**
     * @var int|null
     *
     * @Column(name="verifygoodsdays", type="integer", nullable=true, options={"default"="1"})
     */
    private $verifygoodsdays = '1';

    /**
     * @var int|null
     *
     * @Column(name="verifygoodslimittype", type="smallint", nullable=true)
     */
    private $verifygoodslimittype = '0';

    /**
     * @var int|null
     *
     * @Column(name="verifygoodslimitdate", type="integer", nullable=true)
     */
    private $verifygoodslimitdate = '0';

    /**
     * @var string
     *
     * @Column(name="minliveprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $minliveprice = '0.00';

    /**
     * @var string
     *
     * @Column(name="maxliveprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $maxliveprice = '0.00';

    /**
     * @var string
     *
     * @Column(name="dowpayment", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $dowpayment = '0.00';

    /**
     * @var int
     *
     * @Column(name="tempid", type="integer", nullable=false)
     */
    private $tempid = '0';

    /**
     * @var int
     *
     * @Column(name="isstoreprice", type="smallint", nullable=false)
     */
    private $isstoreprice = '0';

    /**
     * @var int
     *
     * @Column(name="beforehours", type="integer", nullable=false)
     */
    private $beforehours = '0';

    /**
     * @var int|null
     *
     * @Column(name="saleupdate", type="smallint", nullable=true)
     */
    private $saleupdate = '0';

    /**
     * @var int
     *
     * @Column(name="newgoods", type="smallint", nullable=false)
     */
    private $newgoods = '0';

    /**
     * @var string
     *
     * @Column(name="video", type="string", length=521, nullable=false)
     */
    private $video = '';

    /**
     * @var string|null
     *
     * @Column(name="officthumb", type="string", length=512, nullable=true)
     */
    private $officthumb;

    /**
     * @var int
     *
     * @Column(name="verifygoodstype", type="smallint", nullable=false)
     */
    private $verifygoodstype = '0';

    /**
     * @var int
     *
     * @Column(name="isforceverifystore", type="smallint", nullable=false)
     */
    private $isforceverifystore = '0';

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
    public function getPcate(): ?int
    {
        return $this->pcate;
    }

    /**
     * @param int|null $pcate
     */
    public function setPcate(?int $pcate): void
    {
        $this->pcate = $pcate;
    }

    /**
     * @return int|null
     */
    public function getCcate(): ?int
    {
        return $this->ccate;
    }

    /**
     * @param int|null $ccate
     */
    public function setCcate(?int $ccate): void
    {
        $this->ccate = $ccate;
    }

    /**
     * @return int|null
     */
    public function getType(): ?int
    {
        return $this->type;
    }

    /**
     * @param int|null $type
     */
    public function setType(?int $type): void
    {
        $this->type = $type;
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
    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    /**
     * @param string|null $thumb
     */
    public function setThumb(?string $thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     */
    public function setUnit(?string $unit): void
    {
        $this->unit = $unit;
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
     * @return string|null
     */
    public function getProductprice(): ?string
    {
        return $this->productprice;
    }

    /**
     * @param string|null $productprice
     */
    public function setProductprice(?string $productprice): void
    {
        $this->productprice = $productprice;
    }

    /**
     * @return string|null
     */
    public function getMarketprice(): ?string
    {
        return $this->marketprice;
    }

    /**
     * @param string|null $marketprice
     */
    public function setMarketprice(?string $marketprice): void
    {
        $this->marketprice = $marketprice;
    }

    /**
     * @return string|null
     */
    public function getCostprice(): ?string
    {
        return $this->costprice;
    }

    /**
     * @param string|null $costprice
     */
    public function setCostprice(?string $costprice): void
    {
        $this->costprice = $costprice;
    }

    /**
     * @return string|null
     */
    public function getOriginalprice(): ?string
    {
        return $this->originalprice;
    }

    /**
     * @param string|null $originalprice
     */
    public function setOriginalprice(?string $originalprice): void
    {
        $this->originalprice = $originalprice;
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
    public function getTotalcnf(): ?int
    {
        return $this->totalcnf;
    }

    /**
     * @param int|null $totalcnf
     */
    public function setTotalcnf(?int $totalcnf): void
    {
        $this->totalcnf = $totalcnf;
    }

    /**
     * @return int|null
     */
    public function getSales(): ?int
    {
        return $this->sales;
    }

    /**
     * @param int|null $sales
     */
    public function setSales(?int $sales): void
    {
        $this->sales = $sales;
    }

    /**
     * @return int|null
     */
    public function getSalesreal(): ?int
    {
        return $this->salesreal;
    }

    /**
     * @param int|null $salesreal
     */
    public function setSalesreal(?int $salesreal): void
    {
        $this->salesreal = $salesreal;
    }

    /**
     * @return string|null
     */
    public function getSpec(): ?string
    {
        return $this->spec;
    }

    /**
     * @param string|null $spec
     */
    public function setSpec(?string $spec): void
    {
        $this->spec = $spec;
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
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string|null $weight
     */
    public function setWeight(?string $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string|null
     */
    public function getCredit(): ?string
    {
        return $this->credit;
    }

    /**
     * @param string|null $credit
     */
    public function setCredit(?string $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @return int|null
     */
    public function getMaxbuy(): ?int
    {
        return $this->maxbuy;
    }

    /**
     * @param int|null $maxbuy
     */
    public function setMaxbuy(?int $maxbuy): void
    {
        $this->maxbuy = $maxbuy;
    }

    /**
     * @return int|null
     */
    public function getUsermaxbuy(): ?int
    {
        return $this->usermaxbuy;
    }

    /**
     * @param int|null $usermaxbuy
     */
    public function setUsermaxbuy(?int $usermaxbuy): void
    {
        $this->usermaxbuy = $usermaxbuy;
    }

    /**
     * @return int|null
     */
    public function getHasoption(): ?int
    {
        return $this->hasoption;
    }

    /**
     * @param int|null $hasoption
     */
    public function setHasoption(?int $hasoption): void
    {
        $this->hasoption = $hasoption;
    }

    /**
     * @return int|null
     */
    public function getDispatch(): ?int
    {
        return $this->dispatch;
    }

    /**
     * @param int|null $dispatch
     */
    public function setDispatch(?int $dispatch): void
    {
        $this->dispatch = $dispatch;
    }

    /**
     * @return string|null
     */
    public function getThumbUrl(): ?string
    {
        return $this->thumbUrl;
    }

    /**
     * @param string|null $thumbUrl
     */
    public function setThumbUrl(?string $thumbUrl): void
    {
        $this->thumbUrl = $thumbUrl;
    }

    /**
     * @return int|null
     */
    public function getIsnew(): ?int
    {
        return $this->isnew;
    }

    /**
     * @param int|null $isnew
     */
    public function setIsnew(?int $isnew): void
    {
        $this->isnew = $isnew;
    }

    /**
     * @return int|null
     */
    public function getIshot(): ?int
    {
        return $this->ishot;
    }

    /**
     * @param int|null $ishot
     */
    public function setIshot(?int $ishot): void
    {
        $this->ishot = $ishot;
    }

    /**
     * @return int|null
     */
    public function getIsdiscount(): ?int
    {
        return $this->isdiscount;
    }

    /**
     * @param int|null $isdiscount
     */
    public function setIsdiscount(?int $isdiscount): void
    {
        $this->isdiscount = $isdiscount;
    }

    /**
     * @return int|null
     */
    public function getIsrecommand(): ?int
    {
        return $this->isrecommand;
    }

    /**
     * @param int|null $isrecommand
     */
    public function setIsrecommand(?int $isrecommand): void
    {
        $this->isrecommand = $isrecommand;
    }

    /**
     * @return int|null
     */
    public function getIssendfree(): ?int
    {
        return $this->issendfree;
    }

    /**
     * @param int|null $issendfree
     */
    public function setIssendfree(?int $issendfree): void
    {
        $this->issendfree = $issendfree;
    }

    /**
     * @return int|null
     */
    public function getIstime(): ?int
    {
        return $this->istime;
    }

    /**
     * @param int|null $istime
     */
    public function setIstime(?int $istime): void
    {
        $this->istime = $istime;
    }

    /**
     * @return int|null
     */
    public function getIscomment(): ?int
    {
        return $this->iscomment;
    }

    /**
     * @param int|null $iscomment
     */
    public function setIscomment(?int $iscomment): void
    {
        $this->iscomment = $iscomment;
    }

    /**
     * @return int|null
     */
    public function getTimestart(): ?int
    {
        return $this->timestart;
    }

    /**
     * @param int|null $timestart
     */
    public function setTimestart(?int $timestart): void
    {
        $this->timestart = $timestart;
    }

    /**
     * @return int|null
     */
    public function getTimeend(): ?int
    {
        return $this->timeend;
    }

    /**
     * @param int|null $timeend
     */
    public function setTimeend(?int $timeend): void
    {
        $this->timeend = $timeend;
    }

    /**
     * @return int|null
     */
    public function getViewcount(): ?int
    {
        return $this->viewcount;
    }

    /**
     * @param int|null $viewcount
     */
    public function setViewcount(?int $viewcount): void
    {
        $this->viewcount = $viewcount;
    }

    /**
     * @return int|null
     */
    public function getDeleted(): ?int
    {
        return $this->deleted;
    }

    /**
     * @param int|null $deleted
     */
    public function setDeleted(?int $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return int|null
     */
    public function getHascommission(): ?int
    {
        return $this->hascommission;
    }

    /**
     * @param int|null $hascommission
     */
    public function setHascommission(?int $hascommission): void
    {
        $this->hascommission = $hascommission;
    }

    /**
     * @return string|null
     */
    public function getCommission1Rate(): ?string
    {
        return $this->commission1Rate;
    }

    /**
     * @param string|null $commission1Rate
     */
    public function setCommission1Rate(?string $commission1Rate): void
    {
        $this->commission1Rate = $commission1Rate;
    }

    /**
     * @return string|null
     */
    public function getCommission1Pay(): ?string
    {
        return $this->commission1Pay;
    }

    /**
     * @param string|null $commission1Pay
     */
    public function setCommission1Pay(?string $commission1Pay): void
    {
        $this->commission1Pay = $commission1Pay;
    }

    /**
     * @return string|null
     */
    public function getCommission2Rate(): ?string
    {
        return $this->commission2Rate;
    }

    /**
     * @param string|null $commission2Rate
     */
    public function setCommission2Rate(?string $commission2Rate): void
    {
        $this->commission2Rate = $commission2Rate;
    }

    /**
     * @return string|null
     */
    public function getCommission2Pay(): ?string
    {
        return $this->commission2Pay;
    }

    /**
     * @param string|null $commission2Pay
     */
    public function setCommission2Pay(?string $commission2Pay): void
    {
        $this->commission2Pay = $commission2Pay;
    }

    /**
     * @return string|null
     */
    public function getCommission3Rate(): ?string
    {
        return $this->commission3Rate;
    }

    /**
     * @param string|null $commission3Rate
     */
    public function setCommission3Rate(?string $commission3Rate): void
    {
        $this->commission3Rate = $commission3Rate;
    }

    /**
     * @return string|null
     */
    public function getCommission3Pay(): ?string
    {
        return $this->commission3Pay;
    }

    /**
     * @param string|null $commission3Pay
     */
    public function setCommission3Pay(?string $commission3Pay): void
    {
        $this->commission3Pay = $commission3Pay;
    }

    /**
     * @return string|null
     */
    public function getScore(): ?string
    {
        return $this->score;
    }

    /**
     * @param string|null $score
     */
    public function setScore(?string $score): void
    {
        $this->score = $score;
    }

    /**
     * @return string|null
     */
    public function getTaobaoid(): ?string
    {
        return $this->taobaoid;
    }

    /**
     * @param string|null $taobaoid
     */
    public function setTaobaoid(?string $taobaoid): void
    {
        $this->taobaoid = $taobaoid;
    }

    /**
     * @return string|null
     */
    public function getTaotaoid(): ?string
    {
        return $this->taotaoid;
    }

    /**
     * @param string|null $taotaoid
     */
    public function setTaotaoid(?string $taotaoid): void
    {
        $this->taotaoid = $taotaoid;
    }

    /**
     * @return string|null
     */
    public function getTaobaourl(): ?string
    {
        return $this->taobaourl;
    }

    /**
     * @param string|null $taobaourl
     */
    public function setTaobaourl(?string $taobaourl): void
    {
        $this->taobaourl = $taobaourl;
    }

    /**
     * @return int|null
     */
    public function getUpdatetime(): ?int
    {
        return $this->updatetime;
    }

    /**
     * @param int|null $updatetime
     */
    public function setUpdatetime(?int $updatetime): void
    {
        $this->updatetime = $updatetime;
    }

    /**
     * @return string|null
     */
    public function getShareTitle(): ?string
    {
        return $this->shareTitle;
    }

    /**
     * @param string|null $shareTitle
     */
    public function setShareTitle(?string $shareTitle): void
    {
        $this->shareTitle = $shareTitle;
    }

    /**
     * @return string|null
     */
    public function getShareIcon(): ?string
    {
        return $this->shareIcon;
    }

    /**
     * @param string|null $shareIcon
     */
    public function setShareIcon(?string $shareIcon): void
    {
        $this->shareIcon = $shareIcon;
    }

    /**
     * @return int|null
     */
    public function getCash(): ?int
    {
        return $this->cash;
    }

    /**
     * @param int|null $cash
     */
    public function setCash(?int $cash): void
    {
        $this->cash = $cash;
    }

    /**
     * @return string|null
     */
    public function getCommissionThumb(): ?string
    {
        return $this->commissionThumb;
    }

    /**
     * @param string|null $commissionThumb
     */
    public function setCommissionThumb(?string $commissionThumb): void
    {
        $this->commissionThumb = $commissionThumb;
    }

    /**
     * @return int|null
     */
    public function getIsnodiscount(): ?int
    {
        return $this->isnodiscount;
    }

    /**
     * @param int|null $isnodiscount
     */
    public function setIsnodiscount(?int $isnodiscount): void
    {
        $this->isnodiscount = $isnodiscount;
    }

    /**
     * @return string|null
     */
    public function getShowlevels(): ?string
    {
        return $this->showlevels;
    }

    /**
     * @param string|null $showlevels
     */
    public function setShowlevels(?string $showlevels): void
    {
        $this->showlevels = $showlevels;
    }

    /**
     * @return string|null
     */
    public function getBuylevels(): ?string
    {
        return $this->buylevels;
    }

    /**
     * @param string|null $buylevels
     */
    public function setBuylevels(?string $buylevels): void
    {
        $this->buylevels = $buylevels;
    }

    /**
     * @return string|null
     */
    public function getShowgroups(): ?string
    {
        return $this->showgroups;
    }

    /**
     * @param string|null $showgroups
     */
    public function setShowgroups(?string $showgroups): void
    {
        $this->showgroups = $showgroups;
    }

    /**
     * @return string|null
     */
    public function getBuygroups(): ?string
    {
        return $this->buygroups;
    }

    /**
     * @param string|null $buygroups
     */
    public function setBuygroups(?string $buygroups): void
    {
        $this->buygroups = $buygroups;
    }

    /**
     * @return int|null
     */
    public function getIsverify(): ?int
    {
        return $this->isverify;
    }

    /**
     * @param int|null $isverify
     */
    public function setIsverify(?int $isverify): void
    {
        $this->isverify = $isverify;
    }

    /**
     * @return string|null
     */
    public function getStoreids(): ?string
    {
        return $this->storeids;
    }

    /**
     * @param string|null $storeids
     */
    public function setStoreids(?string $storeids): void
    {
        $this->storeids = $storeids;
    }

    /**
     * @return string|null
     */
    public function getNoticeopenid(): ?string
    {
        return $this->noticeopenid;
    }

    /**
     * @param string|null $noticeopenid
     */
    public function setNoticeopenid(?string $noticeopenid): void
    {
        $this->noticeopenid = $noticeopenid;
    }

    /**
     * @return int|null
     */
    public function getTcate(): ?int
    {
        return $this->tcate;
    }

    /**
     * @param int|null $tcate
     */
    public function setTcate(?int $tcate): void
    {
        $this->tcate = $tcate;
    }

    /**
     * @return string|null
     */
    public function getNoticetype(): ?string
    {
        return $this->noticetype;
    }

    /**
     * @param string|null $noticetype
     */
    public function setNoticetype(?string $noticetype): void
    {
        $this->noticetype = $noticetype;
    }

    /**
     * @return int|null
     */
    public function getNeedfollow(): ?int
    {
        return $this->needfollow;
    }

    /**
     * @param int|null $needfollow
     */
    public function setNeedfollow(?int $needfollow): void
    {
        $this->needfollow = $needfollow;
    }

    /**
     * @return string|null
     */
    public function getFollowtip(): ?string
    {
        return $this->followtip;
    }

    /**
     * @param string|null $followtip
     */
    public function setFollowtip(?string $followtip): void
    {
        $this->followtip = $followtip;
    }

    /**
     * @return string|null
     */
    public function getFollowurl(): ?string
    {
        return $this->followurl;
    }

    /**
     * @param string|null $followurl
     */
    public function setFollowurl(?string $followurl): void
    {
        $this->followurl = $followurl;
    }

    /**
     * @return string|null
     */
    public function getDeduct(): ?string
    {
        return $this->deduct;
    }

    /**
     * @param string|null $deduct
     */
    public function setDeduct(?string $deduct): void
    {
        $this->deduct = $deduct;
    }

    /**
     * @return int|null
     */
    public function getVirtual(): ?int
    {
        return $this->virtual;
    }

    /**
     * @param int|null $virtual
     */
    public function setVirtual(?int $virtual): void
    {
        $this->virtual = $virtual;
    }

    /**
     * @return string|null
     */
    public function getCcates(): ?string
    {
        return $this->ccates;
    }

    /**
     * @param string|null $ccates
     */
    public function setCcates(?string $ccates): void
    {
        $this->ccates = $ccates;
    }

    /**
     * @return string|null
     */
    public function getDiscounts(): ?string
    {
        return $this->discounts;
    }

    /**
     * @param string|null $discounts
     */
    public function setDiscounts(?string $discounts): void
    {
        $this->discounts = $discounts;
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
     * @return int|null
     */
    public function getHidecommission(): ?int
    {
        return $this->hidecommission;
    }

    /**
     * @param int|null $hidecommission
     */
    public function setHidecommission(?int $hidecommission): void
    {
        $this->hidecommission = $hidecommission;
    }

    /**
     * @return string|null
     */
    public function getPcates(): ?string
    {
        return $this->pcates;
    }

    /**
     * @param string|null $pcates
     */
    public function setPcates(?string $pcates): void
    {
        $this->pcates = $pcates;
    }

    /**
     * @return string|null
     */
    public function getTcates(): ?string
    {
        return $this->tcates;
    }

    /**
     * @param string|null $tcates
     */
    public function setTcates(?string $tcates): void
    {
        $this->tcates = $tcates;
    }

    /**
     * @return string|null
     */
    public function getCates(): ?string
    {
        return $this->cates;
    }

    /**
     * @param string|null $cates
     */
    public function setCates(?string $cates): void
    {
        $this->cates = $cates;
    }

    /**
     * @return int|null
     */
    public function getArtid(): ?int
    {
        return $this->artid;
    }

    /**
     * @param int|null $artid
     */
    public function setArtid(?int $artid): void
    {
        $this->artid = $artid;
    }

    /**
     * @return string|null
     */
    public function getDetailLogo(): ?string
    {
        return $this->detailLogo;
    }

    /**
     * @param string|null $detailLogo
     */
    public function setDetailLogo(?string $detailLogo): void
    {
        $this->detailLogo = $detailLogo;
    }

    /**
     * @return string|null
     */
    public function getDetailShopname(): ?string
    {
        return $this->detailShopname;
    }

    /**
     * @param string|null $detailShopname
     */
    public function setDetailShopname(?string $detailShopname): void
    {
        $this->detailShopname = $detailShopname;
    }

    /**
     * @return string|null
     */
    public function getDetailBtntext1(): ?string
    {
        return $this->detailBtntext1;
    }

    /**
     * @param string|null $detailBtntext1
     */
    public function setDetailBtntext1(?string $detailBtntext1): void
    {
        $this->detailBtntext1 = $detailBtntext1;
    }

    /**
     * @return string|null
     */
    public function getDetailBtnurl1(): ?string
    {
        return $this->detailBtnurl1;
    }

    /**
     * @param string|null $detailBtnurl1
     */
    public function setDetailBtnurl1(?string $detailBtnurl1): void
    {
        $this->detailBtnurl1 = $detailBtnurl1;
    }

    /**
     * @return string|null
     */
    public function getDetailBtntext2(): ?string
    {
        return $this->detailBtntext2;
    }

    /**
     * @param string|null $detailBtntext2
     */
    public function setDetailBtntext2(?string $detailBtntext2): void
    {
        $this->detailBtntext2 = $detailBtntext2;
    }

    /**
     * @return string|null
     */
    public function getDetailBtnurl2(): ?string
    {
        return $this->detailBtnurl2;
    }

    /**
     * @param string|null $detailBtnurl2
     */
    public function setDetailBtnurl2(?string $detailBtnurl2): void
    {
        $this->detailBtnurl2 = $detailBtnurl2;
    }

    /**
     * @return string|null
     */
    public function getDetailTotaltitle(): ?string
    {
        return $this->detailTotaltitle;
    }

    /**
     * @param string|null $detailTotaltitle
     */
    public function setDetailTotaltitle(?string $detailTotaltitle): void
    {
        $this->detailTotaltitle = $detailTotaltitle;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate42392(): ?int
    {
        return $this->saleupdate42392;
    }

    /**
     * @param int|null $saleupdate42392
     */
    public function setSaleupdate42392(?int $saleupdate42392): void
    {
        $this->saleupdate42392 = $saleupdate42392;
    }

    /**
     * @return string|null
     */
    public function getDeduct2(): ?string
    {
        return $this->deduct2;
    }

    /**
     * @param string|null $deduct2
     */
    public function setDeduct2(?string $deduct2): void
    {
        $this->deduct2 = $deduct2;
    }

    /**
     * @return int|null
     */
    public function getEdnum(): ?int
    {
        return $this->ednum;
    }

    /**
     * @param int|null $ednum
     */
    public function setEdnum(?int $ednum): void
    {
        $this->ednum = $ednum;
    }

    /**
     * @return string|null
     */
    public function getEdmoney(): ?string
    {
        return $this->edmoney;
    }

    /**
     * @param string|null $edmoney
     */
    public function setEdmoney(?string $edmoney): void
    {
        $this->edmoney = $edmoney;
    }

    /**
     * @return string|null
     */
    public function getEdareas(): ?string
    {
        return $this->edareas;
    }

    /**
     * @param string|null $edareas
     */
    public function setEdareas(?string $edareas): void
    {
        $this->edareas = $edareas;
    }

    /**
     * @return int|null
     */
    public function getDiyformtype(): ?int
    {
        return $this->diyformtype;
    }

    /**
     * @param int|null $diyformtype
     */
    public function setDiyformtype(?int $diyformtype): void
    {
        $this->diyformtype = $diyformtype;
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
    public function getDiymode(): ?int
    {
        return $this->diymode;
    }

    /**
     * @param int|null $diymode
     */
    public function setDiymode(?int $diymode): void
    {
        $this->diymode = $diymode;
    }

    /**
     * @return int|null
     */
    public function getDispatchtype(): ?int
    {
        return $this->dispatchtype;
    }

    /**
     * @param int|null $dispatchtype
     */
    public function setDispatchtype(?int $dispatchtype): void
    {
        $this->dispatchtype = $dispatchtype;
    }

    /**
     * @return int|null
     */
    public function getDispatchid(): ?int
    {
        return $this->dispatchid;
    }

    /**
     * @param int|null $dispatchid
     */
    public function setDispatchid(?int $dispatchid): void
    {
        $this->dispatchid = $dispatchid;
    }

    /**
     * @return string|null
     */
    public function getDispatchprice(): ?string
    {
        return $this->dispatchprice;
    }

    /**
     * @param string|null $dispatchprice
     */
    public function setDispatchprice(?string $dispatchprice): void
    {
        $this->dispatchprice = $dispatchprice;
    }

    /**
     * @return int|null
     */
    public function getManydeduct(): ?int
    {
        return $this->manydeduct;
    }

    /**
     * @param int|null $manydeduct
     */
    public function setManydeduct(?int $manydeduct): void
    {
        $this->manydeduct = $manydeduct;
    }

    /**
     * @return string|null
     */
    public function getShorttitle(): ?string
    {
        return $this->shorttitle;
    }

    /**
     * @param string|null $shorttitle
     */
    public function setShorttitle(?string $shorttitle): void
    {
        $this->shorttitle = $shorttitle;
    }

    /**
     * @return string|null
     */
    public function getIsdiscountTitle(): ?string
    {
        return $this->isdiscountTitle;
    }

    /**
     * @param string|null $isdiscountTitle
     */
    public function setIsdiscountTitle(?string $isdiscountTitle): void
    {
        $this->isdiscountTitle = $isdiscountTitle;
    }

    /**
     * @return int|null
     */
    public function getIsdiscountTime(): ?int
    {
        return $this->isdiscountTime;
    }

    /**
     * @param int|null $isdiscountTime
     */
    public function setIsdiscountTime(?int $isdiscountTime): void
    {
        $this->isdiscountTime = $isdiscountTime;
    }

    /**
     * @return string|null
     */
    public function getIsdiscountDiscounts(): ?string
    {
        return $this->isdiscountDiscounts;
    }

    /**
     * @param string|null $isdiscountDiscounts
     */
    public function setIsdiscountDiscounts(?string $isdiscountDiscounts): void
    {
        $this->isdiscountDiscounts = $isdiscountDiscounts;
    }

    /**
     * @return string|null
     */
    public function getCommission(): ?string
    {
        return $this->commission;
    }

    /**
     * @param string|null $commission
     */
    public function setCommission(?string $commission): void
    {
        $this->commission = $commission;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate37975(): ?int
    {
        return $this->saleupdate37975;
    }

    /**
     * @param int|null $saleupdate37975
     */
    public function setSaleupdate37975(?int $saleupdate37975): void
    {
        $this->saleupdate37975 = $saleupdate37975;
    }

    /**
     * @return int|null
     */
    public function getShopid(): ?int
    {
        return $this->shopid;
    }

    /**
     * @param int|null $shopid
     */
    public function setShopid(?int $shopid): void
    {
        $this->shopid = $shopid;
    }

    /**
     * @return string|null
     */
    public function getAllcates(): ?string
    {
        return $this->allcates;
    }

    /**
     * @param string|null $allcates
     */
    public function setAllcates(?string $allcates): void
    {
        $this->allcates = $allcates;
    }

    /**
     * @return int|null
     */
    public function getMinbuy(): ?int
    {
        return $this->minbuy;
    }

    /**
     * @param int|null $minbuy
     */
    public function setMinbuy(?int $minbuy): void
    {
        $this->minbuy = $minbuy;
    }

    /**
     * @return int|null
     */
    public function getInvoice(): ?int
    {
        return $this->invoice;
    }

    /**
     * @param int|null $invoice
     */
    public function setInvoice(?int $invoice): void
    {
        $this->invoice = $invoice;
    }

    /**
     * @return int|null
     */
    public function getRepair(): ?int
    {
        return $this->repair;
    }

    /**
     * @param int|null $repair
     */
    public function setRepair(?int $repair): void
    {
        $this->repair = $repair;
    }

    /**
     * @return int|null
     */
    public function getSeven(): ?int
    {
        return $this->seven;
    }

    /**
     * @param int|null $seven
     */
    public function setSeven(?int $seven): void
    {
        $this->seven = $seven;
    }

    /**
     * @return string|null
     */
    public function getMoney(): ?string
    {
        return $this->money;
    }

    /**
     * @param string|null $money
     */
    public function setMoney(?string $money): void
    {
        $this->money = $money;
    }

    /**
     * @return string|null
     */
    public function getMinprice(): ?string
    {
        return $this->minprice;
    }

    /**
     * @param string|null $minprice
     */
    public function setMinprice(?string $minprice): void
    {
        $this->minprice = $minprice;
    }

    /**
     * @return string|null
     */
    public function getMaxprice(): ?string
    {
        return $this->maxprice;
    }

    /**
     * @param string|null $maxprice
     */
    public function setMaxprice(?string $maxprice): void
    {
        $this->maxprice = $maxprice;
    }

    /**
     * @return string|null
     */
    public function getProvince(): ?string
    {
        return $this->province;
    }

    /**
     * @param string|null $province
     */
    public function setProvince(?string $province): void
    {
        $this->province = $province;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     */
    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    /**
     * @return int|null
     */
    public function getBuyshow(): ?int
    {
        return $this->buyshow;
    }

    /**
     * @param int|null $buyshow
     */
    public function setBuyshow(?int $buyshow): void
    {
        $this->buyshow = $buyshow;
    }

    /**
     * @return string|null
     */
    public function getBuycontent(): ?string
    {
        return $this->buycontent;
    }

    /**
     * @param string|null $buycontent
     */
    public function setBuycontent(?string $buycontent): void
    {
        $this->buycontent = $buycontent;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate51117(): ?int
    {
        return $this->saleupdate51117;
    }

    /**
     * @param int|null $saleupdate51117
     */
    public function setSaleupdate51117(?int $saleupdate51117): void
    {
        $this->saleupdate51117 = $saleupdate51117;
    }

    /**
     * @return int|null
     */
    public function getVirtualsend(): ?int
    {
        return $this->virtualsend;
    }

    /**
     * @param int|null $virtualsend
     */
    public function setVirtualsend(?int $virtualsend): void
    {
        $this->virtualsend = $virtualsend;
    }

    /**
     * @return string|null
     */
    public function getVirtualsendcontent(): ?string
    {
        return $this->virtualsendcontent;
    }

    /**
     * @param string|null $virtualsendcontent
     */
    public function setVirtualsendcontent(?string $virtualsendcontent): void
    {
        $this->virtualsendcontent = $virtualsendcontent;
    }

    /**
     * @return int|null
     */
    public function getVerifytype(): ?int
    {
        return $this->verifytype;
    }

    /**
     * @param int|null $verifytype
     */
    public function setVerifytype(?int $verifytype): void
    {
        $this->verifytype = $verifytype;
    }

    /**
     * @return string|null
     */
    public function getDiyfields(): ?string
    {
        return $this->diyfields;
    }

    /**
     * @param string|null $diyfields
     */
    public function setDiyfields(?string $diyfields): void
    {
        $this->diyfields = $diyfields;
    }

    /**
     * @return int|null
     */
    public function getDiysaveid(): ?int
    {
        return $this->diysaveid;
    }

    /**
     * @param int|null $diysaveid
     */
    public function setDiysaveid(?int $diysaveid): void
    {
        $this->diysaveid = $diysaveid;
    }

    /**
     * @return int|null
     */
    public function getDiysave(): ?int
    {
        return $this->diysave;
    }

    /**
     * @param int|null $diysave
     */
    public function setDiysave(?int $diysave): void
    {
        $this->diysave = $diysave;
    }

    /**
     * @return int|null
     */
    public function getQuality(): ?int
    {
        return $this->quality;
    }

    /**
     * @param int|null $quality
     */
    public function setQuality(?int $quality): void
    {
        $this->quality = $quality;
    }

    /**
     * @return int
     */
    public function getGroupstype(): int
    {
        return $this->groupstype;
    }

    /**
     * @param int $groupstype
     */
    public function setGroupstype(int $groupstype): void
    {
        $this->groupstype = $groupstype;
    }

    /**
     * @return int
     */
    public function getShowtotal(): int
    {
        return $this->showtotal;
    }

    /**
     * @param int $showtotal
     */
    public function setShowtotal(int $showtotal): void
    {
        $this->showtotal = $showtotal;
    }

    /**
     * @return string|null
     */
    public function getSubtitle(): ?string
    {
        return $this->subtitle;
    }

    /**
     * @param string|null $subtitle
     */
    public function setSubtitle(?string $subtitle): void
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return int|null
     */
    public function getMinpriceupdated(): ?int
    {
        return $this->minpriceupdated;
    }

    /**
     * @param int|null $minpriceupdated
     */
    public function setMinpriceupdated(?int $minpriceupdated): void
    {
        $this->minpriceupdated = $minpriceupdated;
    }

    /**
     * @return int
     */
    public function getSharebtn(): int
    {
        return $this->sharebtn;
    }

    /**
     * @param int $sharebtn
     */
    public function setSharebtn(int $sharebtn): void
    {
        $this->sharebtn = $sharebtn;
    }

    /**
     * @return string|null
     */
    public function getCatesinit3(): ?string
    {
        return $this->catesinit3;
    }

    /**
     * @param string|null $catesinit3
     */
    public function setCatesinit3(?string $catesinit3): void
    {
        $this->catesinit3 = $catesinit3;
    }

    /**
     * @return int|null
     */
    public function getShowtotaladd(): ?int
    {
        return $this->showtotaladd;
    }

    /**
     * @param int|null $showtotaladd
     */
    public function setShowtotaladd(?int $showtotaladd): void
    {
        $this->showtotaladd = $showtotaladd;
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
    public function getChecked(): ?int
    {
        return $this->checked;
    }

    /**
     * @param int|null $checked
     */
    public function setChecked(?int $checked): void
    {
        $this->checked = $checked;
    }

    /**
     * @return int|null
     */
    public function getThumbFirst(): ?int
    {
        return $this->thumbFirst;
    }

    /**
     * @param int|null $thumbFirst
     */
    public function setThumbFirst(?int $thumbFirst): void
    {
        $this->thumbFirst = $thumbFirst;
    }

    /**
     * @return int|null
     */
    public function getMerchsale(): ?int
    {
        return $this->merchsale;
    }

    /**
     * @param int|null $merchsale
     */
    public function setMerchsale(?int $merchsale): void
    {
        $this->merchsale = $merchsale;
    }

    /**
     * @return string|null
     */
    public function getKeywords(): ?string
    {
        return $this->keywords;
    }

    /**
     * @param string|null $keywords
     */
    public function setKeywords(?string $keywords): void
    {
        $this->keywords = $keywords;
    }

    /**
     * @return string|null
     */
    public function getCatchId(): ?string
    {
        return $this->catchId;
    }

    /**
     * @param string|null $catchId
     */
    public function setCatchId(?string $catchId): void
    {
        $this->catchId = $catchId;
    }

    /**
     * @return string|null
     */
    public function getCatchUrl(): ?string
    {
        return $this->catchUrl;
    }

    /**
     * @param string|null $catchUrl
     */
    public function setCatchUrl(?string $catchUrl): void
    {
        $this->catchUrl = $catchUrl;
    }

    /**
     * @return string|null
     */
    public function getCatchSource(): ?string
    {
        return $this->catchSource;
    }

    /**
     * @param string|null $catchSource
     */
    public function setCatchSource(?string $catchSource): void
    {
        $this->catchSource = $catchSource;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate40170(): ?int
    {
        return $this->saleupdate40170;
    }

    /**
     * @param int|null $saleupdate40170
     */
    public function setSaleupdate40170(?int $saleupdate40170): void
    {
        $this->saleupdate40170 = $saleupdate40170;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate35843(): ?int
    {
        return $this->saleupdate35843;
    }

    /**
     * @param int|null $saleupdate35843
     */
    public function setSaleupdate35843(?int $saleupdate35843): void
    {
        $this->saleupdate35843 = $saleupdate35843;
    }

    /**
     * @return string|null
     */
    public function getLabelname(): ?string
    {
        return $this->labelname;
    }

    /**
     * @param string|null $labelname
     */
    public function setLabelname(?string $labelname): void
    {
        $this->labelname = $labelname;
    }

    /**
     * @return int|null
     */
    public function getAutoreceive(): ?int
    {
        return $this->autoreceive;
    }

    /**
     * @param int|null $autoreceive
     */
    public function setAutoreceive(?int $autoreceive): void
    {
        $this->autoreceive = $autoreceive;
    }

    /**
     * @return int|null
     */
    public function getCannotrefund(): ?int
    {
        return $this->cannotrefund;
    }

    /**
     * @param int|null $cannotrefund
     */
    public function setCannotrefund(?int $cannotrefund): void
    {
        $this->cannotrefund = $cannotrefund;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate33219(): ?int
    {
        return $this->saleupdate33219;
    }

    /**
     * @param int|null $saleupdate33219
     */
    public function setSaleupdate33219(?int $saleupdate33219): void
    {
        $this->saleupdate33219 = $saleupdate33219;
    }

    /**
     * @return int|null
     */
    public function getBargain(): ?int
    {
        return $this->bargain;
    }

    /**
     * @param int|null $bargain
     */
    public function setBargain(?int $bargain): void
    {
        $this->bargain = $bargain;
    }

    /**
     * @return string|null
     */
    public function getBuyagain(): ?string
    {
        return $this->buyagain;
    }

    /**
     * @param string|null $buyagain
     */
    public function setBuyagain(?string $buyagain): void
    {
        $this->buyagain = $buyagain;
    }

    /**
     * @return int|null
     */
    public function getBuyagainIslong(): ?int
    {
        return $this->buyagainIslong;
    }

    /**
     * @param int|null $buyagainIslong
     */
    public function setBuyagainIslong(?int $buyagainIslong): void
    {
        $this->buyagainIslong = $buyagainIslong;
    }

    /**
     * @return int|null
     */
    public function getBuyagainCondition(): ?int
    {
        return $this->buyagainCondition;
    }

    /**
     * @param int|null $buyagainCondition
     */
    public function setBuyagainCondition(?int $buyagainCondition): void
    {
        $this->buyagainCondition = $buyagainCondition;
    }

    /**
     * @return int|null
     */
    public function getBuyagainSale(): ?int
    {
        return $this->buyagainSale;
    }

    /**
     * @param int|null $buyagainSale
     */
    public function setBuyagainSale(?int $buyagainSale): void
    {
        $this->buyagainSale = $buyagainSale;
    }

    /**
     * @return string|null
     */
    public function getBuyagainCommission(): ?string
    {
        return $this->buyagainCommission;
    }

    /**
     * @param string|null $buyagainCommission
     */
    public function setBuyagainCommission(?string $buyagainCommission): void
    {
        $this->buyagainCommission = $buyagainCommission;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate32484(): ?int
    {
        return $this->saleupdate32484;
    }

    /**
     * @param int|null $saleupdate32484
     */
    public function setSaleupdate32484(?int $saleupdate32484): void
    {
        $this->saleupdate32484 = $saleupdate32484;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate36586(): ?int
    {
        return $this->saleupdate36586;
    }

    /**
     * @param int|null $saleupdate36586
     */
    public function setSaleupdate36586(?int $saleupdate36586): void
    {
        $this->saleupdate36586 = $saleupdate36586;
    }

    /**
     * @return int|null
     */
    public function getDiypage(): ?int
    {
        return $this->diypage;
    }

    /**
     * @param int|null $diypage
     */
    public function setDiypage(?int $diypage): void
    {
        $this->diypage = $diypage;
    }

    /**
     * @return int|null
     */
    public function getCashier(): ?int
    {
        return $this->cashier;
    }

    /**
     * @param int|null $cashier
     */
    public function setCashier(?int $cashier): void
    {
        $this->cashier = $cashier;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate53481(): ?int
    {
        return $this->saleupdate53481;
    }

    /**
     * @param int|null $saleupdate53481
     */
    public function setSaleupdate53481(?int $saleupdate53481): void
    {
        $this->saleupdate53481 = $saleupdate53481;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate30424(): ?int
    {
        return $this->saleupdate30424;
    }

    /**
     * @param int|null $saleupdate30424
     */
    public function setSaleupdate30424(?int $saleupdate30424): void
    {
        $this->saleupdate30424 = $saleupdate30424;
    }

    /**
     * @return int
     */
    public function getIsendtime(): int
    {
        return $this->isendtime;
    }

    /**
     * @param int $isendtime
     */
    public function setIsendtime(int $isendtime): void
    {
        $this->isendtime = $isendtime;
    }

    /**
     * @return int
     */
    public function getUsetime(): int
    {
        return $this->usetime;
    }

    /**
     * @param int $usetime
     */
    public function setUsetime(int $usetime): void
    {
        $this->usetime = $usetime;
    }

    /**
     * @return int
     */
    public function getEndtime(): int
    {
        return $this->endtime;
    }

    /**
     * @param int $endtime
     */
    public function setEndtime(int $endtime): void
    {
        $this->endtime = $endtime;
    }

    /**
     * @return int
     */
    public function getMerchdisplayorder(): int
    {
        return $this->merchdisplayorder;
    }

    /**
     * @param int $merchdisplayorder
     */
    public function setMerchdisplayorder(int $merchdisplayorder): void
    {
        $this->merchdisplayorder = $merchdisplayorder;
    }

    /**
     * @return int|null
     */
    public function getExchangeStock(): ?int
    {
        return $this->exchangeStock;
    }

    /**
     * @param int|null $exchangeStock
     */
    public function setExchangeStock(?int $exchangeStock): void
    {
        $this->exchangeStock = $exchangeStock;
    }

    /**
     * @return string
     */
    public function getExchangePostage(): string
    {
        return $this->exchangePostage;
    }

    /**
     * @param string $exchangePostage
     */
    public function setExchangePostage(string $exchangePostage): void
    {
        $this->exchangePostage = $exchangePostage;
    }

    /**
     * @return int
     */
    public function getIspresell(): int
    {
        return $this->ispresell;
    }

    /**
     * @param int $ispresell
     */
    public function setIspresell(int $ispresell): void
    {
        $this->ispresell = $ispresell;
    }

    /**
     * @return string
     */
    public function getPresellprice(): string
    {
        return $this->presellprice;
    }

    /**
     * @param string $presellprice
     */
    public function setPresellprice(string $presellprice): void
    {
        $this->presellprice = $presellprice;
    }

    /**
     * @return int
     */
    public function getPresellover(): int
    {
        return $this->presellover;
    }

    /**
     * @param int $presellover
     */
    public function setPresellover(int $presellover): void
    {
        $this->presellover = $presellover;
    }

    /**
     * @return int
     */
    public function getPresellovertime(): int
    {
        return $this->presellovertime;
    }

    /**
     * @param int $presellovertime
     */
    public function setPresellovertime(int $presellovertime): void
    {
        $this->presellovertime = $presellovertime;
    }

    /**
     * @return int
     */
    public function getPresellstart(): int
    {
        return $this->presellstart;
    }

    /**
     * @param int $presellstart
     */
    public function setPresellstart(int $presellstart): void
    {
        $this->presellstart = $presellstart;
    }

    /**
     * @return int
     */
    public function getPreselltimestart(): int
    {
        return $this->preselltimestart;
    }

    /**
     * @param int $preselltimestart
     */
    public function setPreselltimestart(int $preselltimestart): void
    {
        $this->preselltimestart = $preselltimestart;
    }

    /**
     * @return int
     */
    public function getPresellend(): int
    {
        return $this->presellend;
    }

    /**
     * @param int $presellend
     */
    public function setPresellend(int $presellend): void
    {
        $this->presellend = $presellend;
    }

    /**
     * @return int
     */
    public function getPreselltimeend(): int
    {
        return $this->preselltimeend;
    }

    /**
     * @param int $preselltimeend
     */
    public function setPreselltimeend(int $preselltimeend): void
    {
        $this->preselltimeend = $preselltimeend;
    }

    /**
     * @return int
     */
    public function getPresellsendtype(): int
    {
        return $this->presellsendtype;
    }

    /**
     * @param int $presellsendtype
     */
    public function setPresellsendtype(int $presellsendtype): void
    {
        $this->presellsendtype = $presellsendtype;
    }

    /**
     * @return int
     */
    public function getPresellsendstatrttime(): int
    {
        return $this->presellsendstatrttime;
    }

    /**
     * @param int $presellsendstatrttime
     */
    public function setPresellsendstatrttime(int $presellsendstatrttime): void
    {
        $this->presellsendstatrttime = $presellsendstatrttime;
    }

    /**
     * @return int
     */
    public function getPresellsendtime(): int
    {
        return $this->presellsendtime;
    }

    /**
     * @param int $presellsendtime
     */
    public function setPresellsendtime(int $presellsendtime): void
    {
        $this->presellsendtime = $presellsendtime;
    }

    /**
     * @return string
     */
    public function getEdareasCode(): string
    {
        return $this->edareasCode;
    }

    /**
     * @param string $edareasCode
     */
    public function setEdareasCode(string $edareasCode): void
    {
        $this->edareasCode = $edareasCode;
    }

    /**
     * @return int
     */
    public function getUniteTotal(): int
    {
        return $this->uniteTotal;
    }

    /**
     * @param int $uniteTotal
     */
    public function setUniteTotal(int $uniteTotal): void
    {
        $this->uniteTotal = $uniteTotal;
    }

    /**
     * @return string|null
     */
    public function getBuyagainPrice(): ?string
    {
        return $this->buyagainPrice;
    }

    /**
     * @param string|null $buyagainPrice
     */
    public function setBuyagainPrice(?string $buyagainPrice): void
    {
        $this->buyagainPrice = $buyagainPrice;
    }

    /**
     * @return string|null
     */
    public function getThreen(): ?string
    {
        return $this->threen;
    }

    /**
     * @param string|null $threen
     */
    public function setThreen(?string $threen): void
    {
        $this->threen = $threen;
    }

    /**
     * @return int|null
     */
    public function getIntervalfloor(): ?int
    {
        return $this->intervalfloor;
    }

    /**
     * @param int|null $intervalfloor
     */
    public function setIntervalfloor(?int $intervalfloor): void
    {
        $this->intervalfloor = $intervalfloor;
    }

    /**
     * @return string|null
     */
    public function getIntervalprice(): ?string
    {
        return $this->intervalprice;
    }

    /**
     * @param string|null $intervalprice
     */
    public function setIntervalprice(?string $intervalprice): void
    {
        $this->intervalprice = $intervalprice;
    }

    /**
     * @return int
     */
    public function getIsfullback(): int
    {
        return $this->isfullback;
    }

    /**
     * @param int $isfullback
     */
    public function setIsfullback(int $isfullback): void
    {
        $this->isfullback = $isfullback;
    }

    /**
     * @return int
     */
    public function getIsstatustime(): int
    {
        return $this->isstatustime;
    }

    /**
     * @param int $isstatustime
     */
    public function setIsstatustime(int $isstatustime): void
    {
        $this->isstatustime = $isstatustime;
    }

    /**
     * @return int
     */
    public function getStatustimestart(): int
    {
        return $this->statustimestart;
    }

    /**
     * @param int $statustimestart
     */
    public function setStatustimestart(int $statustimestart): void
    {
        $this->statustimestart = $statustimestart;
    }

    /**
     * @return int
     */
    public function getStatustimeend(): int
    {
        return $this->statustimeend;
    }

    /**
     * @param int $statustimeend
     */
    public function setStatustimeend(int $statustimeend): void
    {
        $this->statustimeend = $statustimeend;
    }

    /**
     * @return int
     */
    public function getNosearch(): int
    {
        return $this->nosearch;
    }

    /**
     * @param int $nosearch
     */
    public function setNosearch(int $nosearch): void
    {
        $this->nosearch = $nosearch;
    }

    /**
     * @return int
     */
    public function getShowsales(): int
    {
        return $this->showsales;
    }

    /**
     * @param int $showsales
     */
    public function setShowsales(int $showsales): void
    {
        $this->showsales = $showsales;
    }

    /**
     * @return int
     */
    public function getIslive(): int
    {
        return $this->islive;
    }

    /**
     * @param int $islive
     */
    public function setIslive(int $islive): void
    {
        $this->islive = $islive;
    }

    /**
     * @return string
     */
    public function getLiveprice(): string
    {
        return $this->liveprice;
    }

    /**
     * @param string $liveprice
     */
    public function setLiveprice(string $liveprice): void
    {
        $this->liveprice = $liveprice;
    }

    /**
     * @return int|null
     */
    public function getOpencard(): ?int
    {
        return $this->opencard;
    }

    /**
     * @param int|null $opencard
     */
    public function setOpencard(?int $opencard): void
    {
        $this->opencard = $opencard;
    }

    /**
     * @return string|null
     */
    public function getCardid(): ?string
    {
        return $this->cardid;
    }

    /**
     * @param string|null $cardid
     */
    public function setCardid(?string $cardid): void
    {
        $this->cardid = $cardid;
    }

    /**
     * @return int|null
     */
    public function getVerifygoodsnum(): ?int
    {
        return $this->verifygoodsnum;
    }

    /**
     * @param int|null $verifygoodsnum
     */
    public function setVerifygoodsnum(?int $verifygoodsnum): void
    {
        $this->verifygoodsnum = $verifygoodsnum;
    }

    /**
     * @return int|null
     */
    public function getVerifygoodsdays(): ?int
    {
        return $this->verifygoodsdays;
    }

    /**
     * @param int|null $verifygoodsdays
     */
    public function setVerifygoodsdays(?int $verifygoodsdays): void
    {
        $this->verifygoodsdays = $verifygoodsdays;
    }

    /**
     * @return int|null
     */
    public function getVerifygoodslimittype(): ?int
    {
        return $this->verifygoodslimittype;
    }

    /**
     * @param int|null $verifygoodslimittype
     */
    public function setVerifygoodslimittype(?int $verifygoodslimittype): void
    {
        $this->verifygoodslimittype = $verifygoodslimittype;
    }

    /**
     * @return int|null
     */
    public function getVerifygoodslimitdate(): ?int
    {
        return $this->verifygoodslimitdate;
    }

    /**
     * @param int|null $verifygoodslimitdate
     */
    public function setVerifygoodslimitdate(?int $verifygoodslimitdate): void
    {
        $this->verifygoodslimitdate = $verifygoodslimitdate;
    }

    /**
     * @return string
     */
    public function getMinliveprice(): string
    {
        return $this->minliveprice;
    }

    /**
     * @param string $minliveprice
     */
    public function setMinliveprice(string $minliveprice): void
    {
        $this->minliveprice = $minliveprice;
    }

    /**
     * @return string
     */
    public function getMaxliveprice(): string
    {
        return $this->maxliveprice;
    }

    /**
     * @param string $maxliveprice
     */
    public function setMaxliveprice(string $maxliveprice): void
    {
        $this->maxliveprice = $maxliveprice;
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
    public function getTempid(): int
    {
        return $this->tempid;
    }

    /**
     * @param int $tempid
     */
    public function setTempid(int $tempid): void
    {
        $this->tempid = $tempid;
    }

    /**
     * @return int
     */
    public function getIsstoreprice(): int
    {
        return $this->isstoreprice;
    }

    /**
     * @param int $isstoreprice
     */
    public function setIsstoreprice(int $isstoreprice): void
    {
        $this->isstoreprice = $isstoreprice;
    }

    /**
     * @return int
     */
    public function getBeforehours(): int
    {
        return $this->beforehours;
    }

    /**
     * @param int $beforehours
     */
    public function setBeforehours(int $beforehours): void
    {
        $this->beforehours = $beforehours;
    }

    /**
     * @return int|null
     */
    public function getSaleupdate(): ?int
    {
        return $this->saleupdate;
    }

    /**
     * @param int|null $saleupdate
     */
    public function setSaleupdate(?int $saleupdate): void
    {
        $this->saleupdate = $saleupdate;
    }

    /**
     * @return int
     */
    public function getNewgoods(): int
    {
        return $this->newgoods;
    }

    /**
     * @param int $newgoods
     */
    public function setNewgoods(int $newgoods): void
    {
        $this->newgoods = $newgoods;
    }

    /**
     * @return string
     */
    public function getVideo(): string
    {
        return $this->video;
    }

    /**
     * @param string $video
     */
    public function setVideo(string $video): void
    {
        $this->video = $video;
    }

    /**
     * @return string|null
     */
    public function getOfficthumb(): ?string
    {
        return $this->officthumb;
    }

    /**
     * @param string|null $officthumb
     */
    public function setOfficthumb(?string $officthumb): void
    {
        $this->officthumb = $officthumb;
    }

    /**
     * @return int
     */
    public function getVerifygoodstype(): int
    {
        return $this->verifygoodstype;
    }

    /**
     * @param int $verifygoodstype
     */
    public function setVerifygoodstype(int $verifygoodstype): void
    {
        $this->verifygoodstype = $verifygoodstype;
    }

    /**
     * @return int
     */
    public function getIsforceverifystore(): int
    {
        return $this->isforceverifystore;
    }

    /**
     * @param int $isforceverifystore
     */
    public function setIsforceverifystore(int $isforceverifystore): void
    {
        $this->isforceverifystore = $isforceverifystore;
    }
}
