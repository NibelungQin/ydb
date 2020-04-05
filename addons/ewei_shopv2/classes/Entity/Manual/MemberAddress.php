<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMemberAddress
 *
 * @ORM\Table(name="ims_ewei_shop_member_address", indexes={@ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_isdefault", columns={"isdefault"}), @ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_deleted", columns={"deleted"})})
 * @ORM\Entity
 */
class MemberAddress
{
    public const TABLE_NAME = 'ims_ewei_shop_member_address';

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
     * @ORM\Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="realname", type="string", length=20, nullable=true)
     */
    private $realname = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=11, nullable=true)
     */
    private $mobile = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="province", type="string", length=30, nullable=true)
     */
    private $province = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=30, nullable=true)
     */
    private $city = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="area", type="string", length=30, nullable=true)
     */
    private $area = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="string", length=300, nullable=true)
     */
    private $address = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isdefault", type="boolean", nullable=true)
     */
    private $isdefault = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="zipcode", type="string", length=255, nullable=true)
     */
    private $zipcode = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="street", type="string", length=50, nullable=false)
     */
    private $street = '';

    /**
     * @var string
     *
     * @ORM\Column(name="datavalue", type="string", length=50, nullable=false)
     */
    private $datavalue = '';

    /**
     * @var string
     *
     * @ORM\Column(name="streetdatavalue", type="string", length=30, nullable=false)
     */
    private $streetdatavalue = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=255, nullable=false)
     */
    private $lng = '';

    /**
     * @var string
     *
     * @ORM\Column(name="lat", type="string", length=255, nullable=false)
     */
    private $lat = '';


}
