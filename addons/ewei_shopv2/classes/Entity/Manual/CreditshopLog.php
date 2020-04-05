<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopLog
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_log")
 * @ORM\Entity
 */
class CreditshopLog
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_log';

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
     * @var string|null
     *
     * @ORM\Column(name="logno", type="string", length=255, nullable=true)
     */
    private $logno = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="eno", type="string", length=255, nullable=true)
     */
    private $eno = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

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
     * @ORM\Column(name="paystatus", type="boolean", nullable=true)
     */
    private $paystatus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="paytype", type="boolean", nullable=true, options={"default"="-1"})
     */
    private $paytype = '-1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="dispatchstatus", type="boolean", nullable=true)
     */
    private $dispatchstatus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="creditpay", type="boolean", nullable=true)
     */
    private $creditpay = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="addressid", type="integer", nullable=true)
     */
    private $addressid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatchno", type="string", length=255, nullable=true)
     */
    private $dispatchno = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="usetime", type="integer", nullable=true)
     */
    private $usetime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="express", type="string", length=255, nullable=true)
     */
    private $express = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresssn", type="string", length=255, nullable=true)
     */
    private $expresssn = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresscom", type="string", length=255, nullable=true)
     */
    private $expresscom = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="verifyopenid", type="string", length=255, nullable=true)
     */
    private $verifyopenid = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="storeid", type="integer", nullable=true)
     */
    private $storeid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="realname", type="string", length=255, nullable=true)
     */
    private $realname = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=255, nullable=true)
     */
    private $mobile = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="couponid", type="integer", nullable=true)
     */
    private $couponid = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="dupdate1", type="boolean", nullable=true)
     */
    private $dupdate1 = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="transid", type="string", length=255, nullable=true)
     */
    private $transid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatchtransid", type="string", length=255, nullable=true)
     */
    private $dispatchtransid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="text", length=65535, nullable=true)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="optionid", type="integer", nullable=false)
     */
    private $optionid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="time_send", type="integer", nullable=false)
     */
    private $timeSend = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="time_finish", type="integer", nullable=false)
     */
    private $timeFinish = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="iscomment", type="boolean", nullable=false)
     */
    private $iscomment = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="dispatchtime", type="integer", nullable=false)
     */
    private $dispatchtime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="verifynum", type="integer", nullable=false, options={"default"="1"})
     */
    private $verifynum = '1';

    /**
     * @var int
     *
     * @ORM\Column(name="verifytime", type="integer", nullable=false)
     */
    private $verifytime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarksaler", type="text", length=65535, nullable=true)
     */
    private $remarksaler;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatch", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $dispatch = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $money = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="credit", type="integer", nullable=true)
     */
    private $credit = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="goods_num", type="integer", nullable=true)
     */
    private $goodsNum = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="merchapply", type="boolean", nullable=false)
     */
    private $merchapply = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="pay_time", type="integer", nullable=true)
     */
    private $payTime = '0';


}
