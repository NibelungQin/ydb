<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMemberLog
 *
 * @ORM\Table(name="ims_ewei_shop_member_log", indexes={@ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_createtime", columns={"createtime"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_type", columns={"type"}), @ORM\Index(name="idx_status", columns={"status"})})
 * @ORM\Entity
 */
class MemberLog
{
    public const TABLE_NAME = 'ims_ewei_shop_member_log';

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
     * @ORM\Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="type", type="boolean", nullable=true)
     */
    private $type;

    /**
     * @var string|null
     *
     * @ORM\Column(name="logno", type="string", length=255, nullable=true)
     */
    private $logno = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $money = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="rechargetype", type="string", length=255, nullable=true)
     */
    private $rechargetype = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="gives", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $gives;

    /**
     * @var int|null
     *
     * @ORM\Column(name="couponid", type="integer", nullable=true)
     */
    private $couponid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="transid", type="string", length=255, nullable=true)
     */
    private $transid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="realmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $realmoney = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="charge", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $charge = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="deductionmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $deductionmoney = '0.00';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isborrow", type="boolean", nullable=true)
     */
    private $isborrow = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="borrowopenid", type="string", length=100, nullable=true)
     */
    private $borrowopenid = '';

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="string", length=255, nullable=false)
     */
    private $remark = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="apppay", type="boolean", nullable=false)
     */
    private $apppay = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="alipay", type="string", length=50, nullable=false)
     */
    private $alipay = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bankname", type="string", length=50, nullable=false)
     */
    private $bankname = '';

    /**
     * @var string
     *
     * @ORM\Column(name="bankcard", type="string", length=50, nullable=false)
     */
    private $bankcard = '';

    /**
     * @var string
     *
     * @ORM\Column(name="realname", type="string", length=50, nullable=false)
     */
    private $realname = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="applytype", type="boolean", nullable=false)
     */
    private $applytype = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="sendmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $sendmoney = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="senddata", type="text", length=65535, nullable=true)
     */
    private $senddata;


}
