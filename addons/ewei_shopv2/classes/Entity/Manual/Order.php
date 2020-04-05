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
 * Order
 *
 * @Table(name="ims_ewei_shop_order",
 *      indexes={
 *          @Index(name="idx_paytime", columns={"paytime"}),
 *          @Index(name="idx_merchid", columns={"merchid"}),
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_shareid", columns={"agentid"}),
 *          @Index(name="idx_createtime", columns={"createtime"}),
 *          @Index(name="idx_refundid", columns={"refundid"}),
 *          @Index(name="idx_finishtime", columns={"finishtime"}),
 *          @Index(name="idx_openid", columns={"openid"}),
 *          @Index(name="idx_status", columns={"status"})})
 * @Entity
 */
class Order
{
    public const TABLE_NAME = 'ims_ewei_shop_order';
    public const ORDER_PAY_TYPE = [
        0 => ['css' => 'default', 'name' => '未支付'],
        1 => ['css' => 'danger', 'name' => '余额支付'],
        11 => ['css' => 'default', 'name' => '后台付款'],
        2 => ['css' => 'danger', 'name' => '在线支付'],
        21 => ['css' => 'success', 'name' => '微信支付'],
        22 => ['css' => 'warning', 'name' => '支付宝支付'],
        23 => ['css' => 'warning', 'name' => '银联支付'],
        3 => ['css' => 'primary', 'name' => '货到付款'],
        4 => ['css' => 'primary', 'name' => '收银台现金收款']
    ];
    public const ORDER_TYPE_TYPE_OLD = [
        'none'   => ['css' => 'default', 'name' => '未支付'],
        'credit' => ['css' => 'danger', 'name' => '余额支付'],
        'other'  => ['css' => 'default', 'name' => '后台付款'],
        'wechat' => ['css' => 'success', 'name' => '微信支付']
    ];

    public const STATUS_CLOSED = -1;
    public const STATUS_CREATED = 0;
    public const STATUS_PAYED = 1;
    public const STATUS_IN_TRANSIT = 2;
    public const STATUS_FINISHED = 3;

    public const ORDER_STATUS = [
        self::STATUS_CLOSED => ['css' => 'default', 'name' => '已关闭'],
        self::STATUS_CREATED => ['css' => 'danger', 'name' => '待付款'],
        self::STATUS_PAYED => ['css' => 'info', 'name' => '待发货'],
        self::STATUS_IN_TRANSIT => ['css' => 'warning', 'name' => '待收货'],
        self::STATUS_FINISHED => ['css' => 'success', 'name' => '已完成']
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
     * @var string|null
     *
     * @Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid = '';

    /**
     * @var int|null
     *
     * @Column(name="agentid", type="integer", nullable=true)
     */
    private $agentid = '0';

    /**
     * @var string|null
     *
     * @Column(name="ordersn", type="string", length=30, nullable=true)
     */
    private $ordersn = '';

    /**
     * @var string|null
     *
     * @Column(name="price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="goodsprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $goodsprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="discountprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $discountprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status = '0';

    /**
     * @var int|null
     *
     * @Column(name="paytype", type="smallint", nullable=true)
     */
    private $paytype = '0';

    /**
     * @var string|null
     *
     * @Column(name="transid", type="string", length=30, nullable=true)
     */
    private $transid = '0';

    /**
     * @var string|null
     *
     * @Column(name="remark", type="string", length=1000, nullable=true)
     */
    private $remark = '';

    /**
     * @var int|null
     *
     * @Column(name="addressid", type="integer", nullable=true)
     */
    private $addressid = '0';

    /**
     * @var string|null
     *
     * @Column(name="dispatchprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $dispatchprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="dispatchid", type="integer", nullable=true)
     */
    private $dispatchid = '0';

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime;

    /**
     * @var int|null
     *
     * @Column(name="dispatchtype", type="smallint", nullable=true)
     */
    private $dispatchtype = '0';

    /**
     * @var string|null
     *
     * @Column(name="carrier", type="text", length=65535, nullable=true)
     */
    private $carrier;

    /**
     * @var int|null
     *
     * @Column(name="refundid", type="integer", nullable=true)
     */
    private $refundid = '0';

    /**
     * @var int|null
     *
     * @Column(name="iscomment", type="smallint", nullable=true)
     */
    private $iscomment = '0';

    /**
     * @var int|null
     *
     * @Column(name="creditadd", type="smallint", nullable=true)
     */
    private $creditadd = '0';

    /**
     * @var int|null
     *
     * @Column(name="deleted", type="smallint", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var int|null
     *
     * @Column(name="userdeleted", type="smallint", nullable=true)
     */
    private $userdeleted = '0';

    /**
     * @var int|null
     *
     * @Column(name="finishtime", type="integer", nullable=true)
     */
    private $finishtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="paytime", type="integer", nullable=true)
     */
    private $paytime = '0';

    /**
     * @var string
     *
     * @Column(name="expresscom", type="string", length=30, nullable=false)
     */
    private $expresscom = '';

    /**
     * @var string
     *
     * @Column(name="expresssn", type="string", length=50, nullable=false)
     */
    private $expresssn = '';

    /**
     * @var string|null
     *
     * @Column(name="express", type="string", length=255, nullable=true)
     */
    private $express = '';

    /**
     * @var int|null
     *
     * @Column(name="sendtime", type="integer", nullable=true)
     */
    private $sendtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="fetchtime", type="integer", nullable=true)
     */
    private $fetchtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="cash", type="smallint", nullable=true)
     */
    private $cash = '0';

    /**
     * @var int|null
     *
     * @Column(name="canceltime", type="integer", nullable=true)
     */
    private $canceltime;

    /**
     * @var int|null
     *
     * @Column(name="cancelpaytime", type="integer", nullable=true)
     */
    private $cancelpaytime = '0';

    /**
     * @var int|null
     *
     * @Column(name="refundtime", type="integer", nullable=true)
     */
    private $refundtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="isverify", type="smallint", nullable=true)
     */
    private $isverify = '0';

    /**
     * @var int|null
     *
     * @Column(name="verified", type="smallint", nullable=true)
     */
    private $verified = '0';

    /**
     * @var string|null
     *
     * @Column(name="verifyopenid", type="string", length=255, nullable=true)
     */
    private $verifyopenid = '';

    /**
     * @var string|null
     *
     * @Column(name="verifycode", type="string", length=255, nullable=true)
     */
    private $verifycode = '';

    /**
     * @var int|null
     *
     * @Column(name="verifytime", type="integer", nullable=true)
     */
    private $verifytime = '0';

    /**
     * @var int|null
     *
     * @Column(name="verifystoreid", type="integer", nullable=true)
     */
    private $verifystoreid = '0';

    /**
     * @var string|null
     *
     * @Column(name="deductprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deductprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="deductcredit", type="integer", nullable=true)
     */
    private $deductcredit = '0';

    /**
     * @var string|null
     *
     * @Column(name="deductcredit2", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deductcredit2 = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="deductenough", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deductenough = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="`virtual`", type="integer", nullable=true)
     */
    private $virtual = '0';

    /**
     * @var string|null
     *
     * @Column(name="virtual_info", type="text", length=65535, nullable=true)
     */
    private $virtualInfo;

    /**
     * @var string|null
     *
     * @Column(name="virtual_str", type="text", length=65535, nullable=true)
     */
    private $virtualStr;

    /**
     * @var string|null
     *
     * @Column(name="address", type="text", length=65535, nullable=true)
     */
    private $address;

    /**
     * @var int|null
     *
     * @Column(name="sysdeleted", type="smallint", nullable=true)
     */
    private $sysdeleted = '0';

    /**
     * @var int|null
     *
     * @Column(name="ordersn2", type="integer", nullable=true)
     */
    private $ordersn2 = '0';

    /**
     * @var string|null
     *
     * @Column(name="changeprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $changeprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="changedispatchprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $changedispatchprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="oldprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $oldprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="olddispatchprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $olddispatchprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="isvirtual", type="smallint", nullable=true)
     */
    private $isvirtual = '0';

    /**
     * @var int|null
     *
     * @Column(name="couponid", type="integer", nullable=true)
     */
    private $couponid = '0';

    /**
     * @var string|null
     *
     * @Column(name="couponprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $couponprice = '0.00';

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
     * @var int|null
     *
     * @Column(name="diyformid", type="integer", nullable=true)
     */
    private $diyformid = '0';

    /**
     * @var int|null
     *
     * @Column(name="storeid", type="integer", nullable=true)
     */
    private $storeid = '0';

    /**
     * @var int|null
     *
     * @Column(name="printstate", type="smallint", nullable=true)
     */
    private $printstate = '0';

    /**
     * @var int|null
     *
     * @Column(name="printstate2", type="smallint", nullable=true)
     */
    private $printstate2 = '0';

    /**
     * @var string|null
     *
     * @Column(name="address_send", type="text", length=65535, nullable=true)
     */
    private $addressSend;

    /**
     * @var int|null
     *
     * @Column(name="refundstate", type="smallint", nullable=true)
     */
    private $refundstate = '0';

    /**
     * @var string|null
     *
     * @Column(name="closereason", type="text", length=65535, nullable=true)
     */
    private $closereason;

    /**
     * @var string|null
     *
     * @Column(name="remarksaler", type="text", length=65535, nullable=true)
     */
    private $remarksaler;

    /**
     * @var string|null
     *
     * @Column(name="remarkclose", type="text", length=65535, nullable=true)
     */
    private $remarkclose;

    /**
     * @var string|null
     *
     * @Column(name="remarksend", type="text", length=65535, nullable=true)
     */
    private $remarksend;

    /**
     * @var int
     *
     * @Column(name="ismr", type="integer", nullable=false)
     */
    private $ismr = '0';

    /**
     * @var string|null
     *
     * @Column(name="isdiscountprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $isdiscountprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="isvirtualsend", type="smallint", nullable=true)
     */
    private $isvirtualsend = '0';

    /**
     * @var string|null
     *
     * @Column(name="virtualsend_info", type="text", length=65535, nullable=true)
     */
    private $virtualsendInfo;

    /**
     * @var string|null
     *
     * @Column(name="verifyinfo", type="text", length=65535, nullable=true)
     */
    private $verifyinfo;

    /**
     * @var int|null
     *
     * @Column(name="verifytype", type="smallint", nullable=true)
     */
    private $verifytype = '0';

    /**
     * @var string|null
     *
     * @Column(name="verifycodes", type="text", length=65535, nullable=true)
     */
    private $verifycodes;

    /**
     * @var string|null
     *
     * @Column(name="invoicename", type="string", length=255, nullable=true)
     */
    private $invoicename = '';

    /**
     * @var int|null
     *
     * @Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';

    /**
     * @var int|null
     *
     * @Column(name="ismerch", type="smallint", nullable=true)
     */
    private $ismerch = '0';

    /**
     * @var int|null
     *
     * @Column(name="parentid", type="integer", nullable=true)
     */
    private $parentid = '0';

    /**
     * @var int|null
     *
     * @Column(name="isparent", type="smallint", nullable=true)
     */
    private $isparent = '0';

    /**
     * @var string|null
     *
     * @Column(name="grprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $grprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="merchshow", type="smallint", nullable=true)
     */
    private $merchshow = '0';

    /**
     * @var string|null
     *
     * @Column(name="merchdeductenough", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $merchdeductenough = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="couponmerchid", type="integer", nullable=true)
     */
    private $couponmerchid = '0';

    /**
     * @var int|null
     *
     * @Column(name="isglobonus", type="smallint", nullable=true)
     */
    private $isglobonus = '0';

    /**
     * @var int|null
     *
     * @Column(name="merchapply", type="smallint", nullable=true)
     */
    private $merchapply = '0';

    /**
     * @var int|null
     *
     * @Column(name="isabonus", type="smallint", nullable=true)
     */
    private $isabonus = '0';

    /**
     * @var int|null
     *
     * @Column(name="isborrow", type="smallint", nullable=true)
     */
    private $isborrow = '0';

    /**
     * @var string|null
     *
     * @Column(name="borrowopenid", type="string", length=100, nullable=true)
     */
    private $borrowopenid = '';

    /**
     * @var string|null
     *
     * @Column(name="merchisdiscountprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $merchisdiscountprice = '0.00';

    /**
     * @var int
     *
     * @Column(name="apppay", type="smallint", nullable=false)
     */
    private $apppay = '0';

    /**
     * @var string|null
     *
     * @Column(name="coupongoodprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="1.00"})
     */
    private $coupongoodprice = '1.00';

    /**
     * @var string|null
     *
     * @Column(name="buyagainprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $buyagainprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="authorid", type="integer", nullable=true)
     */
    private $authorid = '0';

    /**
     * @var int|null
     *
     * @Column(name="isauthor", type="smallint", nullable=true)
     */
    private $isauthor = '0';

    /**
     * @var int|null
     *
     * @Column(name="ispackage", type="smallint", nullable=true)
     */
    private $ispackage = '0';

    /**
     * @var int|null
     *
     * @Column(name="packageid", type="integer", nullable=true)
     */
    private $packageid = '0';

    /**
     * @var string
     *
     * @Column(name="taskdiscountprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $taskdiscountprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="seckilldiscountprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $seckilldiscountprice = '0.00';

    /**
     * @var int
     *
     * @Column(name="verifyendtime", type="integer", nullable=false)
     */
    private $verifyendtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="willcancelmessage", type="smallint", nullable=true)
     */
    private $willcancelmessage = '0';

    /**
     * @var int
     *
     * @Column(name="sendtype", type="smallint", nullable=false)
     */
    private $sendtype = '0';

    /**
     * @var string
     *
     * @Column(name="lotterydiscountprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $lotterydiscountprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="contype", type="smallint", nullable=true)
     */
    private $contype = '0';

    /**
     * @var int|null
     *
     * @Column(name="wxid", type="integer", nullable=true)
     */
    private $wxid = '0';

    /**
     * @var string|null
     *
     * @Column(name="wxcardid", type="string", length=50, nullable=true)
     */
    private $wxcardid = '';

    /**
     * @var string|null
     *
     * @Column(name="wxcode", type="string", length=50, nullable=true)
     */
    private $wxcode = '';

    /**
     * @var string
     *
     * @Column(name="dispatchkey", type="string", length=30, nullable=false)
     */
    private $dispatchkey = '';

    /**
     * @var int
     *
     * @Column(name="quickid", type="integer", nullable=false)
     */
    private $quickid = '0';

    /**
     * @var int
     *
     * @Column(name="istrade", type="smallint", nullable=false)
     */
    private $istrade = '0';

    /**
     * @var int
     *
     * @Column(name="isnewstore", type="smallint", nullable=false)
     */
    private $isnewstore = '0';

    /**
     * @var int|null
     *
     * @Column(name="liveid", type="integer", nullable=true)
     */
    private $liveid;

    /**
     * @var string|null
     *
     * @Column(name="ordersn_trade", type="string", length=32, nullable=true)
     */
    private $ordersnTrade;

    /**
     * @var int|null
     *
     * @Column(name="tradestatus", type="smallint", nullable=true)
     */
    private $tradestatus = '0';

    /**
     * @var int|null
     *
     * @Column(name="tradepaytype", type="smallint", nullable=true)
     */
    private $tradepaytype;

    /**
     * @var int|null
     *
     * @Column(name="tradepaytime", type="integer", nullable=true)
     */
    private $tradepaytime = '0';

    /**
     * @var string
     *
     * @Column(name="dowpayment", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $dowpayment = '0.00';

    /**
     * @var string
     *
     * @Column(name="betweenprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $betweenprice = '0.00';

    /**
     * @var int
     *
     * @Column(name="isshare", type="integer", nullable=false)
     */
    private $isshare = '0';

    /**
     * @var string
     *
     * @Column(name="officcode", type="string", length=50, nullable=false)
     */
    private $officcode = '';

    /**
     * @var string|null
     *
     * @Column(name="wxapp_prepay_id", type="string", length=100, nullable=true)
     */
    private $wxappPrepayId;

    /**
     * @var int|null
     *
     * @Column(name="cashtime", type="integer", nullable=true)
     */
    private $cashtime = '0';

    /**
     * @var string|null
     *
     * @Column(name="random_code", type="string", length=4, nullable=true)
     */
    private $randomCode;

    /**
     * @var string|null
     *
     * @Column(name="print_template", type="text", length=65535, nullable=true)
     */
    private $printTemplate;

    /**
     * @var int|null
     *
     * @Column(name="city_express_state", type="smallint", nullable=true)
     */
    private $cityExpressState;

    /**
     * @var int|null
     *
     * @Column(name="ces", type="integer", nullable=true)
     */
    private $ces;

    /**
     * @var int|null
     *
     * @Column(name="is_cashier", type="smallint", nullable=true)
     */
    private $isCashier;

    /**
     * @var string|null
     *
     * @Column(name="commissionmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commissionmoney = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="iscycelbuy", type="smallint", nullable=true)
     */
    private $iscycelbuy = '0';

    /**
     * @var int|null
     *
     * @Column(name="cycelbuy_predict_time", type="integer", nullable=true)
     */
    private $cycelbuyPredictTime;

    /**
     * @var string|null
     *
     * @Column(name="cycelbuy_periodic", type="string", length=255, nullable=true)
     */
    private $cycelbuyPeriodic;

    /**
     * @var string|null
     *
     * @Column(name="invoice_img", type="string", length=255, nullable=true)
     */
    private $invoiceImg = '';

    /**
     * @var int|null
     *
     * @Column(name="iswxappcreate", type="smallint", nullable=true)
     */
    private $iswxappcreate = '0';

    /**
     * @var int
     *
     * @Column(name="headsid", type="integer", nullable=false)
     */
    private $headsid = '0';

    /**
     * @var string|null
     *
     * @Column(name="dividend", type="text", length=65535, nullable=true)
     */
    private $dividend;

    /**
     * @var int
     *
     * @Column(name="dividend_applytime", type="integer", nullable=false)
     */
    private $dividendApplytime = '0';

    /**
     * @var int
     *
     * @Column(name="dividend_checktime", type="integer", nullable=false)
     */
    private $dividendChecktime = '0';

    /**
     * @var int
     *
     * @Column(name="dividend_paytime", type="integer", nullable=false)
     */
    private $dividendPaytime = '0';

    /**
     * @var int
     *
     * @Column(name="dividend_invalidtime", type="integer", nullable=false)
     */
    private $dividendInvalidtime = '0';

    /**
     * @var int
     *
     * @Column(name="dividend_deletetime", type="integer", nullable=false)
     */
    private $dividendDeletetime = '0';

    /**
     * @var int
     *
     * @Column(name="dividend_status", type="smallint", nullable=false)
     */
    private $dividendStatus = '0';

    /**
     * @var string|null
     *
     * @Column(name="dividend_content", type="text", length=65535, nullable=true)
     */
    private $dividendContent;

    /**
     * @var string|null
     *
     * @Column(name="costprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $costprice = '0.00';

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
     * @return int|null
     */
    public function getAgentid(): ?int
    {
        return $this->agentid;
    }

    /**
     * @param int|null $agentid
     */
    public function setAgentid(?int $agentid): void
    {
        $this->agentid = $agentid;
    }

    /**
     * @return string|null
     */
    public function getOrdersn(): ?string
    {
        return $this->ordersn;
    }

    /**
     * @param string|null $ordersn
     */
    public function setOrdersn(?string $ordersn): void
    {
        $this->ordersn = $ordersn;
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
    public function getGoodsprice(): ?string
    {
        return $this->goodsprice;
    }

    /**
     * @param string|null $goodsprice
     */
    public function setGoodsprice(?string $goodsprice): void
    {
        $this->goodsprice = $goodsprice;
    }

    /**
     * @return string|null
     */
    public function getDiscountprice(): ?string
    {
        return $this->discountprice;
    }

    /**
     * @param string|null $discountprice
     */
    public function setDiscountprice(?string $discountprice): void
    {
        $this->discountprice = $discountprice;
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
    public function getPaytype(): ?int
    {
        return $this->paytype;
    }

    /**
     * @param int|null $paytype
     */
    public function setPaytype(?int $paytype): void
    {
        $this->paytype = $paytype;
    }

    /**
     * @return string|null
     */
    public function getTransid(): ?string
    {
        return $this->transid;
    }

    /**
     * @param string|null $transid
     */
    public function setTransid(?string $transid): void
    {
        $this->transid = $transid;
    }

    /**
     * @return string|null
     */
    public function getRemark(): ?string
    {
        return $this->remark;
    }

    /**
     * @param string|null $remark
     */
    public function setRemark(?string $remark): void
    {
        $this->remark = $remark;
    }

    /**
     * @return int|null
     */
    public function getAddressid(): ?int
    {
        return $this->addressid;
    }

    /**
     * @param int|null $addressid
     */
    public function setAddressid(?int $addressid): void
    {
        $this->addressid = $addressid;
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
     * @return string|null
     */
    public function getCarrier(): ?string
    {
        return $this->carrier;
    }

    /**
     * @param string|null $carrier
     */
    public function setCarrier(?string $carrier): void
    {
        $this->carrier = $carrier;
    }

    /**
     * @return int|null
     */
    public function getRefundid(): ?int
    {
        return $this->refundid;
    }

    /**
     * @param int|null $refundid
     */
    public function setRefundid(?int $refundid): void
    {
        $this->refundid = $refundid;
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
    public function getCreditadd(): ?int
    {
        return $this->creditadd;
    }

    /**
     * @param int|null $creditadd
     */
    public function setCreditadd(?int $creditadd): void
    {
        $this->creditadd = $creditadd;
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
    public function getUserdeleted(): ?int
    {
        return $this->userdeleted;
    }

    /**
     * @param int|null $userdeleted
     */
    public function setUserdeleted(?int $userdeleted): void
    {
        $this->userdeleted = $userdeleted;
    }

    /**
     * @return int|null
     */
    public function getFinishtime(): ?int
    {
        return $this->finishtime;
    }

    /**
     * @param int|null $finishtime
     */
    public function setFinishtime(?int $finishtime): void
    {
        $this->finishtime = $finishtime;
    }

    /**
     * @return int|null
     */
    public function getPaytime(): ?int
    {
        return $this->paytime;
    }

    /**
     * @param int|null $paytime
     */
    public function setPaytime(?int $paytime): void
    {
        $this->paytime = $paytime;
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
    public function getFetchtime(): ?int
    {
        return $this->fetchtime;
    }

    /**
     * @param int|null $fetchtime
     */
    public function setFetchtime(?int $fetchtime): void
    {
        $this->fetchtime = $fetchtime;
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
     * @return int|null
     */
    public function getCanceltime(): ?int
    {
        return $this->canceltime;
    }

    /**
     * @param int|null $canceltime
     */
    public function setCanceltime(?int $canceltime): void
    {
        $this->canceltime = $canceltime;
    }

    /**
     * @return int|null
     */
    public function getCancelpaytime(): ?int
    {
        return $this->cancelpaytime;
    }

    /**
     * @param int|null $cancelpaytime
     */
    public function setCancelpaytime(?int $cancelpaytime): void
    {
        $this->cancelpaytime = $cancelpaytime;
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
     * @return int|null
     */
    public function getVerified(): ?int
    {
        return $this->verified;
    }

    /**
     * @param int|null $verified
     */
    public function setVerified(?int $verified): void
    {
        $this->verified = $verified;
    }

    /**
     * @return string|null
     */
    public function getVerifyopenid(): ?string
    {
        return $this->verifyopenid;
    }

    /**
     * @param string|null $verifyopenid
     */
    public function setVerifyopenid(?string $verifyopenid): void
    {
        $this->verifyopenid = $verifyopenid;
    }

    /**
     * @return string|null
     */
    public function getVerifycode(): ?string
    {
        return $this->verifycode;
    }

    /**
     * @param string|null $verifycode
     */
    public function setVerifycode(?string $verifycode): void
    {
        $this->verifycode = $verifycode;
    }

    /**
     * @return int|null
     */
    public function getVerifytime(): ?int
    {
        return $this->verifytime;
    }

    /**
     * @param int|null $verifytime
     */
    public function setVerifytime(?int $verifytime): void
    {
        $this->verifytime = $verifytime;
    }

    /**
     * @return int|null
     */
    public function getVerifystoreid(): ?int
    {
        return $this->verifystoreid;
    }

    /**
     * @param int|null $verifystoreid
     */
    public function setVerifystoreid(?int $verifystoreid): void
    {
        $this->verifystoreid = $verifystoreid;
    }

    /**
     * @return string|null
     */
    public function getDeductprice(): ?string
    {
        return $this->deductprice;
    }

    /**
     * @param string|null $deductprice
     */
    public function setDeductprice(?string $deductprice): void
    {
        $this->deductprice = $deductprice;
    }

    /**
     * @return int|null
     */
    public function getDeductcredit(): ?int
    {
        return $this->deductcredit;
    }

    /**
     * @param int|null $deductcredit
     */
    public function setDeductcredit(?int $deductcredit): void
    {
        $this->deductcredit = $deductcredit;
    }

    /**
     * @return string|null
     */
    public function getDeductcredit2(): ?string
    {
        return $this->deductcredit2;
    }

    /**
     * @param string|null $deductcredit2
     */
    public function setDeductcredit2(?string $deductcredit2): void
    {
        $this->deductcredit2 = $deductcredit2;
    }

    /**
     * @return string|null
     */
    public function getDeductenough(): ?string
    {
        return $this->deductenough;
    }

    /**
     * @param string|null $deductenough
     */
    public function setDeductenough(?string $deductenough): void
    {
        $this->deductenough = $deductenough;
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
    public function getVirtualInfo(): ?string
    {
        return $this->virtualInfo;
    }

    /**
     * @param string|null $virtualInfo
     */
    public function setVirtualInfo(?string $virtualInfo): void
    {
        $this->virtualInfo = $virtualInfo;
    }

    /**
     * @return string|null
     */
    public function getVirtualStr(): ?string
    {
        return $this->virtualStr;
    }

    /**
     * @param string|null $virtualStr
     */
    public function setVirtualStr(?string $virtualStr): void
    {
        $this->virtualStr = $virtualStr;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     */
    public function setAddress(?string $address): void
    {
        $this->address = $address;
    }

    /**
     * @return int|null
     */
    public function getSysdeleted(): ?int
    {
        return $this->sysdeleted;
    }

    /**
     * @param int|null $sysdeleted
     */
    public function setSysdeleted(?int $sysdeleted): void
    {
        $this->sysdeleted = $sysdeleted;
    }

    /**
     * @return int|null
     */
    public function getOrdersn2(): ?int
    {
        return $this->ordersn2;
    }

    /**
     * @param int|null $ordersn2
     */
    public function setOrdersn2(?int $ordersn2): void
    {
        $this->ordersn2 = $ordersn2;
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
    public function getChangedispatchprice(): ?string
    {
        return $this->changedispatchprice;
    }

    /**
     * @param string|null $changedispatchprice
     */
    public function setChangedispatchprice(?string $changedispatchprice): void
    {
        $this->changedispatchprice = $changedispatchprice;
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
    public function getOlddispatchprice(): ?string
    {
        return $this->olddispatchprice;
    }

    /**
     * @param string|null $olddispatchprice
     */
    public function setOlddispatchprice(?string $olddispatchprice): void
    {
        $this->olddispatchprice = $olddispatchprice;
    }

    /**
     * @return int|null
     */
    public function getIsvirtual(): ?int
    {
        return $this->isvirtual;
    }

    /**
     * @param int|null $isvirtual
     */
    public function setIsvirtual(?int $isvirtual): void
    {
        $this->isvirtual = $isvirtual;
    }

    /**
     * @return int|null
     */
    public function getCouponid(): ?int
    {
        return $this->couponid;
    }

    /**
     * @param int|null $couponid
     */
    public function setCouponid(?int $couponid): void
    {
        $this->couponid = $couponid;
    }

    /**
     * @return string|null
     */
    public function getCouponprice(): ?string
    {
        return $this->couponprice;
    }

    /**
     * @param string|null $couponprice
     */
    public function setCouponprice(?string $couponprice): void
    {
        $this->couponprice = $couponprice;
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
    public function getStoreid(): ?int
    {
        return $this->storeid;
    }

    /**
     * @param int|null $storeid
     */
    public function setStoreid(?int $storeid): void
    {
        $this->storeid = $storeid;
    }

    /**
     * @return int|null
     */
    public function getPrintstate(): ?int
    {
        return $this->printstate;
    }

    /**
     * @param int|null $printstate
     */
    public function setPrintstate(?int $printstate): void
    {
        $this->printstate = $printstate;
    }

    /**
     * @return int|null
     */
    public function getPrintstate2(): ?int
    {
        return $this->printstate2;
    }

    /**
     * @param int|null $printstate2
     */
    public function setPrintstate2(?int $printstate2): void
    {
        $this->printstate2 = $printstate2;
    }

    /**
     * @return string|null
     */
    public function getAddressSend(): ?string
    {
        return $this->addressSend;
    }

    /**
     * @param string|null $addressSend
     */
    public function setAddressSend(?string $addressSend): void
    {
        $this->addressSend = $addressSend;
    }

    /**
     * @return int|null
     */
    public function getRefundstate(): ?int
    {
        return $this->refundstate;
    }

    /**
     * @param int|null $refundstate
     */
    public function setRefundstate(?int $refundstate): void
    {
        $this->refundstate = $refundstate;
    }

    /**
     * @return string|null
     */
    public function getClosereason(): ?string
    {
        return $this->closereason;
    }

    /**
     * @param string|null $closereason
     */
    public function setClosereason(?string $closereason): void
    {
        $this->closereason = $closereason;
    }

    /**
     * @return string|null
     */
    public function getRemarksaler(): ?string
    {
        return $this->remarksaler;
    }

    /**
     * @param string|null $remarksaler
     */
    public function setRemarksaler(?string $remarksaler): void
    {
        $this->remarksaler = $remarksaler;
    }

    /**
     * @return string|null
     */
    public function getRemarkclose(): ?string
    {
        return $this->remarkclose;
    }

    /**
     * @param string|null $remarkclose
     */
    public function setRemarkclose(?string $remarkclose): void
    {
        $this->remarkclose = $remarkclose;
    }

    /**
     * @return string|null
     */
    public function getRemarksend(): ?string
    {
        return $this->remarksend;
    }

    /**
     * @param string|null $remarksend
     */
    public function setRemarksend(?string $remarksend): void
    {
        $this->remarksend = $remarksend;
    }

    /**
     * @return int
     */
    public function getIsmr(): int
    {
        return $this->ismr;
    }

    /**
     * @param int $ismr
     */
    public function setIsmr(int $ismr): void
    {
        $this->ismr = $ismr;
    }

    /**
     * @return string|null
     */
    public function getIsdiscountprice(): ?string
    {
        return $this->isdiscountprice;
    }

    /**
     * @param string|null $isdiscountprice
     */
    public function setIsdiscountprice(?string $isdiscountprice): void
    {
        $this->isdiscountprice = $isdiscountprice;
    }

    /**
     * @return int|null
     */
    public function getIsvirtualsend(): ?int
    {
        return $this->isvirtualsend;
    }

    /**
     * @param int|null $isvirtualsend
     */
    public function setIsvirtualsend(?int $isvirtualsend): void
    {
        $this->isvirtualsend = $isvirtualsend;
    }

    /**
     * @return string|null
     */
    public function getVirtualsendInfo(): ?string
    {
        return $this->virtualsendInfo;
    }

    /**
     * @param string|null $virtualsendInfo
     */
    public function setVirtualsendInfo(?string $virtualsendInfo): void
    {
        $this->virtualsendInfo = $virtualsendInfo;
    }

    /**
     * @return string|null
     */
    public function getVerifyinfo(): ?string
    {
        return $this->verifyinfo;
    }

    /**
     * @param string|null $verifyinfo
     */
    public function setVerifyinfo(?string $verifyinfo): void
    {
        $this->verifyinfo = $verifyinfo;
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
    public function getVerifycodes(): ?string
    {
        return $this->verifycodes;
    }

    /**
     * @param string|null $verifycodes
     */
    public function setVerifycodes(?string $verifycodes): void
    {
        $this->verifycodes = $verifycodes;
    }

    /**
     * @return string|null
     */
    public function getInvoicename(): ?string
    {
        return $this->invoicename;
    }

    /**
     * @param string|null $invoicename
     */
    public function setInvoicename(?string $invoicename): void
    {
        $this->invoicename = $invoicename;
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
    public function getIsmerch(): ?int
    {
        return $this->ismerch;
    }

    /**
     * @param int|null $ismerch
     */
    public function setIsmerch(?int $ismerch): void
    {
        $this->ismerch = $ismerch;
    }

    /**
     * @return int|null
     */
    public function getParentid(): ?int
    {
        return $this->parentid;
    }

    /**
     * @param int|null $parentid
     */
    public function setParentid(?int $parentid): void
    {
        $this->parentid = $parentid;
    }

    /**
     * @return int|null
     */
    public function getIsparent(): ?int
    {
        return $this->isparent;
    }

    /**
     * @param int|null $isparent
     */
    public function setIsparent(?int $isparent): void
    {
        $this->isparent = $isparent;
    }

    /**
     * @return string|null
     */
    public function getGrprice(): ?string
    {
        return $this->grprice;
    }

    /**
     * @param string|null $grprice
     */
    public function setGrprice(?string $grprice): void
    {
        $this->grprice = $grprice;
    }

    /**
     * @return int|null
     */
    public function getMerchshow(): ?int
    {
        return $this->merchshow;
    }

    /**
     * @param int|null $merchshow
     */
    public function setMerchshow(?int $merchshow): void
    {
        $this->merchshow = $merchshow;
    }

    /**
     * @return string|null
     */
    public function getMerchdeductenough(): ?string
    {
        return $this->merchdeductenough;
    }

    /**
     * @param string|null $merchdeductenough
     */
    public function setMerchdeductenough(?string $merchdeductenough): void
    {
        $this->merchdeductenough = $merchdeductenough;
    }

    /**
     * @return int|null
     */
    public function getCouponmerchid(): ?int
    {
        return $this->couponmerchid;
    }

    /**
     * @param int|null $couponmerchid
     */
    public function setCouponmerchid(?int $couponmerchid): void
    {
        $this->couponmerchid = $couponmerchid;
    }

    /**
     * @return int|null
     */
    public function getIsglobonus(): ?int
    {
        return $this->isglobonus;
    }

    /**
     * @param int|null $isglobonus
     */
    public function setIsglobonus(?int $isglobonus): void
    {
        $this->isglobonus = $isglobonus;
    }

    /**
     * @return int|null
     */
    public function getMerchapply(): ?int
    {
        return $this->merchapply;
    }

    /**
     * @param int|null $merchapply
     */
    public function setMerchapply(?int $merchapply): void
    {
        $this->merchapply = $merchapply;
    }

    /**
     * @return int|null
     */
    public function getIsabonus(): ?int
    {
        return $this->isabonus;
    }

    /**
     * @param int|null $isabonus
     */
    public function setIsabonus(?int $isabonus): void
    {
        $this->isabonus = $isabonus;
    }

    /**
     * @return int|null
     */
    public function getIsborrow(): ?int
    {
        return $this->isborrow;
    }

    /**
     * @param int|null $isborrow
     */
    public function setIsborrow(?int $isborrow): void
    {
        $this->isborrow = $isborrow;
    }

    /**
     * @return string|null
     */
    public function getBorrowopenid(): ?string
    {
        return $this->borrowopenid;
    }

    /**
     * @param string|null $borrowopenid
     */
    public function setBorrowopenid(?string $borrowopenid): void
    {
        $this->borrowopenid = $borrowopenid;
    }

    /**
     * @return string|null
     */
    public function getMerchisdiscountprice(): ?string
    {
        return $this->merchisdiscountprice;
    }

    /**
     * @param string|null $merchisdiscountprice
     */
    public function setMerchisdiscountprice(?string $merchisdiscountprice): void
    {
        $this->merchisdiscountprice = $merchisdiscountprice;
    }

    /**
     * @return int
     */
    public function getApppay(): int
    {
        return $this->apppay;
    }

    /**
     * @param int $apppay
     */
    public function setApppay(int $apppay): void
    {
        $this->apppay = $apppay;
    }

    /**
     * @return string|null
     */
    public function getCoupongoodprice(): ?string
    {
        return $this->coupongoodprice;
    }

    /**
     * @param string|null $coupongoodprice
     */
    public function setCoupongoodprice(?string $coupongoodprice): void
    {
        $this->coupongoodprice = $coupongoodprice;
    }

    /**
     * @return string|null
     */
    public function getBuyagainprice(): ?string
    {
        return $this->buyagainprice;
    }

    /**
     * @param string|null $buyagainprice
     */
    public function setBuyagainprice(?string $buyagainprice): void
    {
        $this->buyagainprice = $buyagainprice;
    }

    /**
     * @return int|null
     */
    public function getAuthorid(): ?int
    {
        return $this->authorid;
    }

    /**
     * @param int|null $authorid
     */
    public function setAuthorid(?int $authorid): void
    {
        $this->authorid = $authorid;
    }

    /**
     * @return int|null
     */
    public function getIsauthor(): ?int
    {
        return $this->isauthor;
    }

    /**
     * @param int|null $isauthor
     */
    public function setIsauthor(?int $isauthor): void
    {
        $this->isauthor = $isauthor;
    }

    /**
     * @return int|null
     */
    public function getIspackage(): ?int
    {
        return $this->ispackage;
    }

    /**
     * @param int|null $ispackage
     */
    public function setIspackage(?int $ispackage): void
    {
        $this->ispackage = $ispackage;
    }

    /**
     * @return int|null
     */
    public function getPackageid(): ?int
    {
        return $this->packageid;
    }

    /**
     * @param int|null $packageid
     */
    public function setPackageid(?int $packageid): void
    {
        $this->packageid = $packageid;
    }

    /**
     * @return string
     */
    public function getTaskdiscountprice(): string
    {
        return $this->taskdiscountprice;
    }

    /**
     * @param string $taskdiscountprice
     */
    public function setTaskdiscountprice(string $taskdiscountprice): void
    {
        $this->taskdiscountprice = $taskdiscountprice;
    }

    /**
     * @return string|null
     */
    public function getSeckilldiscountprice(): ?string
    {
        return $this->seckilldiscountprice;
    }

    /**
     * @param string|null $seckilldiscountprice
     */
    public function setSeckilldiscountprice(?string $seckilldiscountprice): void
    {
        $this->seckilldiscountprice = $seckilldiscountprice;
    }

    /**
     * @return int
     */
    public function getVerifyendtime(): int
    {
        return $this->verifyendtime;
    }

    /**
     * @param int $verifyendtime
     */
    public function setVerifyendtime(int $verifyendtime): void
    {
        $this->verifyendtime = $verifyendtime;
    }

    /**
     * @return int|null
     */
    public function getWillcancelmessage(): ?int
    {
        return $this->willcancelmessage;
    }

    /**
     * @param int|null $willcancelmessage
     */
    public function setWillcancelmessage(?int $willcancelmessage): void
    {
        $this->willcancelmessage = $willcancelmessage;
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
    public function getLotterydiscountprice(): string
    {
        return $this->lotterydiscountprice;
    }

    /**
     * @param string $lotterydiscountprice
     */
    public function setLotterydiscountprice(string $lotterydiscountprice): void
    {
        $this->lotterydiscountprice = $lotterydiscountprice;
    }

    /**
     * @return int|null
     */
    public function getContype(): ?int
    {
        return $this->contype;
    }

    /**
     * @param int|null $contype
     */
    public function setContype(?int $contype): void
    {
        $this->contype = $contype;
    }

    /**
     * @return int|null
     */
    public function getWxid(): ?int
    {
        return $this->wxid;
    }

    /**
     * @param int|null $wxid
     */
    public function setWxid(?int $wxid): void
    {
        $this->wxid = $wxid;
    }

    /**
     * @return string|null
     */
    public function getWxcardid(): ?string
    {
        return $this->wxcardid;
    }

    /**
     * @param string|null $wxcardid
     */
    public function setWxcardid(?string $wxcardid): void
    {
        $this->wxcardid = $wxcardid;
    }

    /**
     * @return string|null
     */
    public function getWxcode(): ?string
    {
        return $this->wxcode;
    }

    /**
     * @param string|null $wxcode
     */
    public function setWxcode(?string $wxcode): void
    {
        $this->wxcode = $wxcode;
    }

    /**
     * @return string
     */
    public function getDispatchkey(): string
    {
        return $this->dispatchkey;
    }

    /**
     * @param string $dispatchkey
     */
    public function setDispatchkey(string $dispatchkey): void
    {
        $this->dispatchkey = $dispatchkey;
    }

    /**
     * @return int
     */
    public function getQuickid(): int
    {
        return $this->quickid;
    }

    /**
     * @param int $quickid
     */
    public function setQuickid(int $quickid): void
    {
        $this->quickid = $quickid;
    }

    /**
     * @return int
     */
    public function getIstrade(): int
    {
        return $this->istrade;
    }

    /**
     * @param int $istrade
     */
    public function setIstrade(int $istrade): void
    {
        $this->istrade = $istrade;
    }

    /**
     * @return int
     */
    public function getIsnewstore(): int
    {
        return $this->isnewstore;
    }

    /**
     * @param int $isnewstore
     */
    public function setIsnewstore(int $isnewstore): void
    {
        $this->isnewstore = $isnewstore;
    }

    /**
     * @return int|null
     */
    public function getLiveid(): ?int
    {
        return $this->liveid;
    }

    /**
     * @param int|null $liveid
     */
    public function setLiveid(?int $liveid): void
    {
        $this->liveid = $liveid;
    }

    /**
     * @return string|null
     */
    public function getOrdersnTrade(): ?string
    {
        return $this->ordersnTrade;
    }

    /**
     * @param string|null $ordersnTrade
     */
    public function setOrdersnTrade(?string $ordersnTrade): void
    {
        $this->ordersnTrade = $ordersnTrade;
    }

    /**
     * @return int|null
     */
    public function getTradestatus(): ?int
    {
        return $this->tradestatus;
    }

    /**
     * @param int|null $tradestatus
     */
    public function setTradestatus(?int $tradestatus): void
    {
        $this->tradestatus = $tradestatus;
    }

    /**
     * @return int|null
     */
    public function getTradepaytype(): ?int
    {
        return $this->tradepaytype;
    }

    /**
     * @param int|null $tradepaytype
     */
    public function setTradepaytype(?int $tradepaytype): void
    {
        $this->tradepaytype = $tradepaytype;
    }

    /**
     * @return int|null
     */
    public function getTradepaytime(): ?int
    {
        return $this->tradepaytime;
    }

    /**
     * @param int|null $tradepaytime
     */
    public function setTradepaytime(?int $tradepaytime): void
    {
        $this->tradepaytime = $tradepaytime;
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
     * @return string
     */
    public function getBetweenprice(): string
    {
        return $this->betweenprice;
    }

    /**
     * @param string $betweenprice
     */
    public function setBetweenprice(string $betweenprice): void
    {
        $this->betweenprice = $betweenprice;
    }

    /**
     * @return int
     */
    public function getIsshare(): int
    {
        return $this->isshare;
    }

    /**
     * @param int $isshare
     */
    public function setIsshare(int $isshare): void
    {
        $this->isshare = $isshare;
    }

    /**
     * @return string
     */
    public function getOfficcode(): string
    {
        return $this->officcode;
    }

    /**
     * @param string $officcode
     */
    public function setOfficcode(string $officcode): void
    {
        $this->officcode = $officcode;
    }

    /**
     * @return string|null
     */
    public function getWxappPrepayId(): ?string
    {
        return $this->wxappPrepayId;
    }

    /**
     * @param string|null $wxappPrepayId
     */
    public function setWxappPrepayId(?string $wxappPrepayId): void
    {
        $this->wxappPrepayId = $wxappPrepayId;
    }

    /**
     * @return int|null
     */
    public function getCashtime(): ?int
    {
        return $this->cashtime;
    }

    /**
     * @param int|null $cashtime
     */
    public function setCashtime(?int $cashtime): void
    {
        $this->cashtime = $cashtime;
    }

    /**
     * @return string|null
     */
    public function getRandomCode(): ?string
    {
        return $this->randomCode;
    }

    /**
     * @param string|null $randomCode
     */
    public function setRandomCode(?string $randomCode): void
    {
        $this->randomCode = $randomCode;
    }

    /**
     * @return string|null
     */
    public function getPrintTemplate(): ?string
    {
        return $this->printTemplate;
    }

    /**
     * @param string|null $printTemplate
     */
    public function setPrintTemplate(?string $printTemplate): void
    {
        $this->printTemplate = $printTemplate;
    }

    /**
     * @return int|null
     */
    public function getCityExpressState(): ?int
    {
        return $this->cityExpressState;
    }

    /**
     * @param int|null $cityExpressState
     */
    public function setCityExpressState(?int $cityExpressState): void
    {
        $this->cityExpressState = $cityExpressState;
    }

    /**
     * @return int|null
     */
    public function getCes(): ?int
    {
        return $this->ces;
    }

    /**
     * @param int|null $ces
     */
    public function setCes(?int $ces): void
    {
        $this->ces = $ces;
    }

    /**
     * @return int|null
     */
    public function getIsCashier(): ?int
    {
        return $this->isCashier;
    }

    /**
     * @param int|null $isCashier
     */
    public function setIsCashier(?int $isCashier): void
    {
        $this->isCashier = $isCashier;
    }

    /**
     * @return string|null
     */
    public function getCommissionmoney(): ?string
    {
        return $this->commissionmoney;
    }

    /**
     * @param string|null $commissionmoney
     */
    public function setCommissionmoney(?string $commissionmoney): void
    {
        $this->commissionmoney = $commissionmoney;
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

    /**
     * @return int|null
     */
    public function getCycelbuyPredictTime(): ?int
    {
        return $this->cycelbuyPredictTime;
    }

    /**
     * @param int|null $cycelbuyPredictTime
     */
    public function setCycelbuyPredictTime(?int $cycelbuyPredictTime): void
    {
        $this->cycelbuyPredictTime = $cycelbuyPredictTime;
    }

    /**
     * @return string|null
     */
    public function getCycelbuyPeriodic(): ?string
    {
        return $this->cycelbuyPeriodic;
    }

    /**
     * @param string|null $cycelbuyPeriodic
     */
    public function setCycelbuyPeriodic(?string $cycelbuyPeriodic): void
    {
        $this->cycelbuyPeriodic = $cycelbuyPeriodic;
    }

    /**
     * @return string|null
     */
    public function getInvoiceImg(): ?string
    {
        return $this->invoiceImg;
    }

    /**
     * @param string|null $invoiceImg
     */
    public function setInvoiceImg(?string $invoiceImg): void
    {
        $this->invoiceImg = $invoiceImg;
    }

    /**
     * @return int|null
     */
    public function getIswxappcreate(): ?int
    {
        return $this->iswxappcreate;
    }

    /**
     * @param int|null $iswxappcreate
     */
    public function setIswxappcreate(?int $iswxappcreate): void
    {
        $this->iswxappcreate = $iswxappcreate;
    }

    /**
     * @return int
     */
    public function getHeadsid(): int
    {
        return $this->headsid;
    }

    /**
     * @param int $headsid
     */
    public function setHeadsid(int $headsid): void
    {
        $this->headsid = $headsid;
    }

    /**
     * @return string|null
     */
    public function getDividend(): ?string
    {
        return $this->dividend;
    }

    /**
     * @param string|null $dividend
     */
    public function setDividend(?string $dividend): void
    {
        $this->dividend = $dividend;
    }

    /**
     * @return int
     */
    public function getDividendApplytime(): int
    {
        return $this->dividendApplytime;
    }

    /**
     * @param int $dividendApplytime
     */
    public function setDividendApplytime(int $dividendApplytime): void
    {
        $this->dividendApplytime = $dividendApplytime;
    }

    /**
     * @return int
     */
    public function getDividendChecktime(): int
    {
        return $this->dividendChecktime;
    }

    /**
     * @param int $dividendChecktime
     */
    public function setDividendChecktime(int $dividendChecktime): void
    {
        $this->dividendChecktime = $dividendChecktime;
    }

    /**
     * @return int
     */
    public function getDividendPaytime(): int
    {
        return $this->dividendPaytime;
    }

    /**
     * @param int $dividendPaytime
     */
    public function setDividendPaytime(int $dividendPaytime): void
    {
        $this->dividendPaytime = $dividendPaytime;
    }

    /**
     * @return int
     */
    public function getDividendInvalidtime(): int
    {
        return $this->dividendInvalidtime;
    }

    /**
     * @param int $dividendInvalidtime
     */
    public function setDividendInvalidtime(int $dividendInvalidtime): void
    {
        $this->dividendInvalidtime = $dividendInvalidtime;
    }

    /**
     * @return int
     */
    public function getDividendDeletetime(): int
    {
        return $this->dividendDeletetime;
    }

    /**
     * @param int $dividendDeletetime
     */
    public function setDividendDeletetime(int $dividendDeletetime): void
    {
        $this->dividendDeletetime = $dividendDeletetime;
    }

    /**
     * @return int
     */
    public function getDividendStatus(): int
    {
        return $this->dividendStatus;
    }

    /**
     * @param int $dividendStatus
     */
    public function setDividendStatus(int $dividendStatus): void
    {
        $this->dividendStatus = $dividendStatus;
    }

    /**
     * @return string|null
     */
    public function getDividendContent(): ?string
    {
        return $this->dividendContent;
    }

    /**
     * @param string|null $dividendContent
     */
    public function setDividendContent(?string $dividendContent): void
    {
        $this->dividendContent = $dividendContent;
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

}
