<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsCoupon
 *
 * @ORM\Table(name="ims_coupon", indexes={@ORM\Index(name="uniacid", columns={"uniacid", "acid"})})
 * @ORM\Entity
 */
class Coupon
{
    public const TABLE_NAME = 'ims_coupon';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="acid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $acid;

    /**
     * @var string
     *
     * @ORM\Column(name="card_id", type="string", length=50, nullable=false)
     */
    private $cardId;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=15, nullable=false)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="logo_url", type="string", length=150, nullable=false)
     */
    private $logoUrl;

    /**
     * @var bool
     *
     * @ORM\Column(name="code_type", type="boolean", nullable=false)
     */
    private $codeType;

    /**
     * @var string
     *
     * @ORM\Column(name="brand_name", type="string", length=15, nullable=false)
     */
    private $brandName;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=15, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="sub_title", type="string", length=20, nullable=false)
     */
    private $subTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string", length=15, nullable=false)
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="notice", type="string", length=15, nullable=false)
     */
    private $notice;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="date_info", type="string", length=200, nullable=false)
     */
    private $dateInfo;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $quantity;

    /**
     * @var bool
     *
     * @ORM\Column(name="use_custom_code", type="boolean", nullable=false)
     */
    private $useCustomCode;

    /**
     * @var bool
     *
     * @ORM\Column(name="bind_openid", type="boolean", nullable=false)
     */
    private $bindOpenid;

    /**
     * @var bool
     *
     * @ORM\Column(name="can_share", type="boolean", nullable=false)
     */
    private $canShare;

    /**
     * @var bool
     *
     * @ORM\Column(name="can_give_friend", type="boolean", nullable=false)
     */
    private $canGiveFriend;

    /**
     * @var bool
     *
     * @ORM\Column(name="get_limit", type="boolean", nullable=false)
     */
    private $getLimit;

    /**
     * @var string
     *
     * @ORM\Column(name="service_phone", type="string", length=20, nullable=false)
     */
    private $servicePhone;

    /**
     * @var string
     *
     * @ORM\Column(name="extra", type="string", length=1000, nullable=false)
     */
    private $extra;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_display", type="boolean", nullable=false)
     */
    private $isDisplay;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_selfconsume", type="boolean", nullable=false)
     */
    private $isSelfconsume;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion_url_name", type="string", length=10, nullable=false)
     */
    private $promotionUrlName;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion_url", type="string", length=100, nullable=false)
     */
    private $promotionUrl;

    /**
     * @var string
     *
     * @ORM\Column(name="promotion_url_sub_title", type="string", length=10, nullable=false)
     */
    private $promotionUrlSubTitle;

    /**
     * @var bool
     *
     * @ORM\Column(name="source", type="boolean", nullable=false)
     */
    private $source;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dosage", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $dosage;


}
