<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMemberFavorite
 *
 * @ORM\Table(name="ims_ewei_shop_member_favorite", indexes={@ORM\Index(name="idx_goodsid", columns={"goodsid"}), @ORM\Index(name="idx_deleted", columns={"deleted"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_createtime", columns={"createtime"})})
 * @ORM\Entity
 */
class MemberFavorite
{
    public const TABLE_NAME = 'ims_ewei_shop_member_favorite';
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
     * @var int|null
     *
     * @ORM\Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="merchid", type="integer", nullable=true)
     */
    private $merchid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="type", type="integer", nullable=true)
     */
    private $type = '0';


}
