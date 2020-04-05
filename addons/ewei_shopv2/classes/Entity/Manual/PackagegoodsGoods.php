<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsGoods
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_goods", indexes={@ORM\Index(name="idx_createtime", columns={"createtime"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_status", columns={"status"})})
 * @ORM\Entity
 */
class PackagegoodsGoods
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_goods';

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
     * @ORM\Column(name="displayorder", type="integer", nullable=true, options={"comment"="??"})
     */
    private $displayorder = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=true, options={"comment"="???ID"})
     */
    private $uniacid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=false, options={"comment"="?????"})
     */
    private $title = '';

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer", nullable=false, options={"comment"="??"})
     */
    private $stock = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??"})
     */
    private $price = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="packageprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="???"})
     */
    private $packageprice = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="goodsnum", type="integer", nullable=false, options={"default"="1","comment"="??"})
     */
    private $goodsnum = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="units", type="string", length=255, nullable=false, options={"default"="?","comment"="??"})
     */
    private $units = '?';

    /**
     * @var string|null
     *
     * @ORM\Column(name="freight", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??"})
     */
    private $freight = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="sales", type="integer", nullable=false, options={"comment"="????"})
     */
    private $sales = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true, options={"comment"="?????"})
     */
    private $thumb = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="string", length=1000, nullable=true, options={"comment"="???"})
     */
    private $description;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true, options={"comment"="????"})
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false, options={"comment"="????"})
     */
    private $createtime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false, options={"comment"="???"})
     */
    private $status = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="followneed", type="boolean", nullable=false, options={"comment"="????"})
     */
    private $followneed = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="followtext", type="string", length=255, nullable=true, options={"comment"="?????"})
     */
    private $followtext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_title", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $shareTitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_icon", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $shareIcon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_desc", type="string", length=500, nullable=true, options={"comment"="????"})
     */
    private $shareDesc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="goodssn", type="string", length=50, nullable=true, options={"comment"="??"})
     */
    private $goodssn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productsn", type="string", length=50, nullable=true, options={"comment"="??"})
     */
    private $productsn;

    /**
     * @var bool
     *
     * @ORM\Column(name="showstock", type="boolean", nullable=false, options={"comment"="????"})
     */
    private $showstock;

    /**
     * @var bool
     *
     * @ORM\Column(name="dispatchtype", type="boolean", nullable=false, options={"comment"="????"})
     */
    private $dispatchtype;

    /**
     * @var int
     *
     * @ORM\Column(name="dispatchid", type="integer", nullable=false, options={"comment"="????id"})
     */
    private $dispatchid;

    /**
     * @var bool
     *
     * @ORM\Column(name="isindex", type="boolean", nullable=false, options={"comment"="??????"})
     */
    private $isindex = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="followurl", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $followurl;

    /**
     * @var bool
     *
     * @ORM\Column(name="rights", type="boolean", nullable=false, options={"default"="1"})
     */
    private $rights = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb_url", type="text", length=65535, nullable=true, options={"comment"="?????"})
     */
    private $thumbUrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="packagedata", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $packagedata = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="package_label", type="string", length=255, nullable=true, options={"comment"="????:1????2????3????"})
     */
    private $packageLabel = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="package_member_card", type="string", length=255, nullable=true, options={"comment"="?????????"})
     */
    private $packageMemberCard = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="commission_type", type="boolean", nullable=true, options={"comment"="??????????"})
     */
    private $commissionType = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="nocommission", type="boolean", nullable=true, options={"comment"="??????"})
     */
    private $nocommission = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="hascommission", type="boolean", nullable=true, options={"comment"="?????"})
     */
    private $hascommission = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission1_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??????"})
     */
    private $commission1Rate = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission1_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="????????"})
     */
    private $commission1Pay = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission2_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??????"})
     */
    private $commission2Rate = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission2_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="????????"})
     */
    private $commission2Pay = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission3_rate", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??????"})
     */
    private $commission3Rate = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission3_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="????????"})
     */
    private $commission3Pay = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission", type="text", length=65535, nullable=true, options={"comment"="??????"})
     */
    private $commission;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="globonus_type", type="boolean", nullable=true, options={"comment"="??????????"})
     */
    private $globonusType = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="globonus", type="text", length=65535, nullable=true, options={"comment"="??????"})
     */
    private $globonus;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="abonus_type", type="boolean", nullable=true, options={"comment"="??????????"})
     */
    private $abonusType = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="abonus", type="text", length=65535, nullable=true, options={"comment"="??????"})
     */
    private $abonus;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="achievement_proportion", type="boolean", nullable=true, options={"comment"="????????"})
     */
    private $achievementProportion = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="achievement_type", type="boolean", nullable=true, options={"comment"="??????"})
     */
    private $achievementType = '0';


}
