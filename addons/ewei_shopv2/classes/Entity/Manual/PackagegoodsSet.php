<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsSet
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_set")
 * @ORM\Entity
 */
class PackagegoodsSet
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_set';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="uniacid", type="string", length=45, nullable=true)
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="packagegoods", type="integer", nullable=false)
     */
    private $packagegoods = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="followurl", type="string", length=255, nullable=true, options={"comment"="?????(???)"})
     */
    private $followurl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="packagegoodsurl", type="string", length=255, nullable=true, options={"comment"="????????"})
     */
    private $packagegoodsurl;

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
     * @ORM\Column(name="share_desc", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $shareDesc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="packagegoods_description", type="text", length=65535, nullable=true, options={"comment"="????"})
     */
    private $packagegoodsDescription;

    /**
     * @var int
     *
     * @ORM\Column(name="description", type="integer", nullable=false, options={"comment"="????????"})
     */
    private $description = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="followqrcode", type="string", length=255, nullable=true, options={"comment"="?????"})
     */
    private $followqrcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="share_url", type="string", length=255, nullable=true, options={"comment"="????"})
     */
    private $shareUrl;

    /**
     * @var bool
     *
     * @ORM\Column(name="creditdeduct", type="boolean", nullable=false, options={"comment"="??????"})
     */
    private $creditdeduct = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="packagegoodsdeduct", type="boolean", nullable=false, options={"comment"="?????????????"})
     */
    private $packagegoodsdeduct = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="credit", type="integer", nullable=false, options={"default"="1","comment"="????????"})
     */
    private $credit = '1';

    /**
     * @var string
     *
     * @ORM\Column(name="packagegoodsmoney", type="decimal", precision=11, scale=2, nullable=false, options={"default"="0.00","comment"="????"})
     */
    private $packagegoodsmoney = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="refund", type="integer", nullable=false, options={"comment"="????? ?????X???????"})
     */
    private $refund = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="refundday", type="integer", nullable=false, options={"comment"="????????????"})
     */
    private $refundday = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="goodsid", type="text", length=65535, nullable=false, options={"comment"="???????ID"})
     */
    private $goodsid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="rules", type="text", length=65535, nullable=true, options={"comment"="???????"})
     */
    private $rules;

    /**
     * @var int|null
     *
     * @ORM\Column(name="receive", type="integer", nullable=true, options={"comment"="?????????????"})
     */
    private $receive = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="discount", type="boolean", nullable=true, options={"comment"="??????????"})
     */
    private $discount = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="headstype", type="boolean", nullable=true, options={"comment"="??????:1????2????"})
     */
    private $headstype = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="headsmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="????"})
     */
    private $headsmoney = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="headsdiscount", type="integer", nullable=true, options={"comment"="????"})
     */
    private $headsdiscount = '0';


}
