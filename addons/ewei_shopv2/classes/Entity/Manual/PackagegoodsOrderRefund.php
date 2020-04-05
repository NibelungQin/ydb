<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsOrderRefund
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_order_refund")
 * @ORM\Entity
 */
class PackagegoodsOrderRefund
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_order_refund';

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
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="openid", type="string", length=45, nullable=false)
     */
    private $openid = '';

    /**
     * @var int
     *
     * @ORM\Column(name="orderid", type="integer", nullable=false)
     */
    private $orderid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="refundno", type="string", length=45, nullable=false)
     */
    private $refundno = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="refundstatus", type="boolean", nullable=false)
     */
    private $refundstatus = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="refundaddressid", type="integer", nullable=false)
     */
    private $refundaddressid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="refundaddress", type="string", length=1000, nullable=false)
     */
    private $refundaddress = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reason", type="string", length=255, nullable=true)
     */
    private $reason;

    /**
     * @var string|null
     *
     * @ORM\Column(name="images", type="string", length=255, nullable=true)
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="applytime", type="string", length=45, nullable=false)
     */
    private $applytime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="applycredit", type="integer", nullable=false)
     */
    private $applycredit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="applyprice", type="decimal", precision=11, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $applyprice = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="reply", type="text", length=65535, nullable=true)
     */
    private $reply;

    /**
     * @var string|null
     *
     * @ORM\Column(name="refundtype", type="string", length=45, nullable=true)
     */
    private $refundtype;

    /**
     * @var int
     *
     * @ORM\Column(name="rtype", type="integer", nullable=false)
     */
    private $rtype = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="refundtime", type="string", length=45, nullable=false)
     */
    private $refundtime;

    /**
     * @var string
     *
     * @ORM\Column(name="endtime", type="string", length=45, nullable=false)
     */
    private $endtime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=true)
     */
    private $message;

    /**
     * @var string
     *
     * @ORM\Column(name="operatetime", type="string", length=45, nullable=false)
     */
    private $operatetime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="realcredit", type="integer", nullable=false)
     */
    private $realcredit;

    /**
     * @var string
     *
     * @ORM\Column(name="realmoney", type="decimal", precision=11, scale=2, nullable=false)
     */
    private $realmoney;

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
     * @var string
     *
     * @ORM\Column(name="sendtime", type="string", length=45, nullable=false)
     */
    private $sendtime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="returntime", type="integer", nullable=false)
     */
    private $returntime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="rexpress", type="string", length=45, nullable=true)
     */
    private $rexpress;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rexpresscom", type="string", length=100, nullable=true)
     */
    private $rexpresscom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rexpresssn", type="string", length=45, nullable=true)
     */
    private $rexpresssn;


}
