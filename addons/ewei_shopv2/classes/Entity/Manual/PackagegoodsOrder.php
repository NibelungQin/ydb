<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsOrder
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_order")
 * @ORM\Entity
 */
class PackagegoodsOrder
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_order';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"comment"="???ID"})
     */
    private $uniacid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="openid", type="string", length=45, nullable=false, options={"comment"="??openID"})
     */
    private $openid;

    /**
     * @var string
     *
     * @ORM\Column(name="orderno", type="string", length=45, nullable=false, options={"comment"="????"})
     */
    private $orderno;

    /**
     * @var int
     *
     * @ORM\Column(name="paytime", type="integer", nullable=false, options={"comment"="????"})
     */
    private $paytime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="decimal", precision=11, scale=2, nullable=true, options={"default"="0.00","comment"="????"})
     */
    private $price = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="freight", type="decimal", precision=11, scale=2, nullable=true, options={"default"="0.00","comment"="??"})
     */
    private $freight = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer", nullable=false, options={"comment"="????"})
     */
    private $status;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pay_type", type="string", length=45, nullable=true, options={"comment"="????"})
     */
    private $payType;

    /**
     * @var int
     *
     * @ORM\Column(name="goodid", type="integer", nullable=false, options={"comment"="??ID"})
     */
    private $goodid;

    /**
     * @var int
     *
     * @ORM\Column(name="is_team", type="integer", nullable=false)
     */
    private $isTeam;

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime;

    /**
     * @var int
     *
     * @ORM\Column(name="success", type="integer", nullable=false)
     */
    private $success = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="delete", type="integer", nullable=false)
     */
    private $delete = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="credit", type="integer", nullable=true)
     */
    private $credit = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="creditmoney", type="decimal", precision=11, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $creditmoney = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="dispatchid", type="integer", nullable=true)
     */
    private $dispatchid;

    /**
     * @var int
     *
     * @ORM\Column(name="addressid", type="integer", nullable=false)
     */
    private $addressid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=1000, nullable=true)
     */
    private $address;

    /**
     * @var int
     *
     * @ORM\Column(name="starttime", type="integer", nullable=false)
     */
    private $starttime;

    /**
     * @var int
     *
     * @ORM\Column(name="endtime", type="integer", nullable=false)
     */
    private $endtime;

    /**
     * @var int
     *
     * @ORM\Column(name="canceltime", type="integer", nullable=false)
     */
    private $canceltime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="finishtime", type="integer", nullable=false)
     */
    private $finishtime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="refundid", type="integer", nullable=false)
     */
    private $refundid = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="refundstate", type="boolean", nullable=false)
     */
    private $refundstate = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="refundtime", type="integer", nullable=false)
     */
    private $refundtime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="express", type="string", length=45, nullable=true)
     */
    private $express;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresscom", type="string", length=100, nullable=true)
     */
    private $expresscom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresssn", type="string", length=45, nullable=true)
     */
    private $expresssn;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sendtime", type="integer", nullable=true)
     */
    private $sendtime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="string", length=255, nullable=true)
     */
    private $remark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarkclose", type="text", length=65535, nullable=true)
     */
    private $remarkclose;

    /**
     * @var string|null
     *
     * @ORM\Column(name="remarksend", type="text", length=65535, nullable=true)
     */
    private $remarksend;

    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="realname", type="string", length=20, nullable=true)
     */
    private $realname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=11, nullable=true)
     */
    private $mobile;

    /**
     * @var int
     *
     * @ORM\Column(name="printstate", type="integer", nullable=false)
     */
    private $printstate = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="printstate2", type="integer", nullable=false)
     */
    private $printstate2 = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="apppay", type="boolean", nullable=false)
     */
    private $apppay = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isborrow", type="boolean", nullable=true)
     */
    private $isborrow = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="borrowopenid", type="string", length=50, nullable=true)
     */
    private $borrowopenid = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="source", type="boolean", nullable=true)
     */
    private $source = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="wxapp_prepay_id", type="string", length=255, nullable=true)
     */
    private $wxappPrepayId = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="cancel_reason", type="string", length=255, nullable=true)
     */
    private $cancelReason = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="goods_price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $goodsPrice = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="optionid", type="integer", nullable=true)
     */
    private $optionid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agentid", type="integer", nullable=true, options={"comment"="??ID"})
     */
    private $agentid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission1", type="text", length=65535, nullable=true)
     */
    private $commission1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission2", type="text", length=65535, nullable=true)
     */
    private $commission2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission3", type="text", length=65535, nullable=true)
     */
    private $commission3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="commissions", type="text", length=65535, nullable=true)
     */
    private $commissions;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="nocommission", type="boolean", nullable=true)
     */
    private $nocommission = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isabonus", type="boolean", nullable=true, options={"comment"="????"})
     */
    private $isabonus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isglobonus", type="boolean", nullable=true, options={"comment"="????"})
     */
    private $isglobonus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="is_achievement", type="boolean", nullable=true, options={"comment"="????????"})
     */
    private $isAchievement = '0';


}
