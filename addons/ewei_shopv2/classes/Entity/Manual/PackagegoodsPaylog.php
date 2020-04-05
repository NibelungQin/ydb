<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsPaylog
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_paylog", indexes={@ORM\Index(name="uniontid", columns={"uniontid"}), @ORM\Index(name="idx_tid", columns={"tid"}), @ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"})})
 * @ORM\Entity
 */
class PackagegoodsPaylog
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_paylog';

    /**
     * @var int
     *
     * @ORM\Column(name="plid", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $plid;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20, nullable=false)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="acid", type="integer", nullable=false)
     */
    private $acid;

    /**
     * @var string
     *
     * @ORM\Column(name="openid", type="string", length=40, nullable=false)
     */
    private $openid;

    /**
     * @var string
     *
     * @ORM\Column(name="tid", type="string", length=64, nullable=false)
     */
    private $tid;

    /**
     * @var int
     *
     * @ORM\Column(name="credit", type="integer", nullable=false)
     */
    private $credit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="creditmoney", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $creditmoney;

    /**
     * @var string
     *
     * @ORM\Column(name="fee", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $fee;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=50, nullable=false)
     */
    private $module;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=2000, nullable=false)
     */
    private $tag;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_usecard", type="boolean", nullable=false)
     */
    private $isUsecard;

    /**
     * @var bool
     *
     * @ORM\Column(name="card_type", type="boolean", nullable=false)
     */
    private $cardType;

    /**
     * @var string
     *
     * @ORM\Column(name="card_id", type="string", length=50, nullable=false)
     */
    private $cardId;

    /**
     * @var string
     *
     * @ORM\Column(name="card_fee", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $cardFee;

    /**
     * @var string
     *
     * @ORM\Column(name="encrypt_code", type="string", length=100, nullable=false)
     */
    private $encryptCode;

    /**
     * @var string
     *
     * @ORM\Column(name="uniontid", type="string", length=50, nullable=false)
     */
    private $uniontid;


}
