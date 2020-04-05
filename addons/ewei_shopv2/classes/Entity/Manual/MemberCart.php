<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMemberCart
 *
 * @ORM\Table(name="ims_ewei_shop_member_cart", indexes={@ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_goodsid", columns={"goodsid"}), @ORM\Index(name="idx_deleted", columns={"deleted"})})
 * @ORM\Entity
 */
class MemberCart
{
    public const TABLE_NAME = 'ims_ewei_shop_member_cart';

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
     * @ORM\Column(name="openid", type="string", length=100, nullable=true)
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
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="marketprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $marketprice = '0.00';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="optionid", type="integer", nullable=true)
     */
    private $optionid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="diyformdataid", type="integer", nullable=true)
     */
    private $diyformdataid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyformdata", type="text", length=65535, nullable=true)
     */
    private $diyformdata;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyformfields", type="text", length=65535, nullable=true)
     */
    private $diyformfields;

    /**
     * @var int|null
     *
     * @ORM\Column(name="diyformid", type="integer", nullable=true)
     */
    private $diyformid = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="selected", type="boolean", nullable=true, options={"default"="1"})
     */
    private $selected = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="selectedadd", type="boolean", nullable=true, options={"default"="1"})
     */
    private $selectedadd = '1';

    /**
     * @var int|null
     *
     * @ORM\Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="isnewstore", type="boolean", nullable=false)
     */
    private $isnewstore = '0';


}
