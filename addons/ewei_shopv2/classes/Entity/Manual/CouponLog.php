<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCouponLog
 *
 * @ORM\Table(name="ims_ewei_shop_coupon_log", indexes={@ORM\Index(name="idx_status", columns={"status"}), @ORM\Index(name="idx_createtime", columns={"createtime"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_paystatus", columns={"paystatus"}), @ORM\Index(name="idx_getfrom", columns={"getfrom"}), @ORM\Index(name="idx_couponid", columns={"couponid"})})
 * @ORM\Entity
 */
class CouponLog
{
    public const TABLE_NAME = 'ims_ewei_shop_coupon_log';

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
     * @ORM\Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="couponid", type="integer", nullable=true)
     */
    private $couponid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
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
     * @ORM\Column(name="creditstatus", type="boolean", nullable=true)
     */
    private $creditstatus = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="paytype", type="boolean", nullable=true)
     */
    private $paytype = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="getfrom", type="boolean", nullable=true)
     */
    private $getfrom = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';


}
