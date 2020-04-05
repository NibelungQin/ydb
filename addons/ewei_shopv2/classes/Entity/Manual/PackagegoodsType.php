<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsType
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_type", indexes={@ORM\Index(name="idx_displayorder", columns={"displayorder"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_enabled", columns={"enabled"})})
 * @ORM\Entity
 */
class PackagegoodsType
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_type';

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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="displayorder", type="boolean", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="enabled", type="boolean", nullable=true, options={"default"="1"})
     */
    private $enabled = '1';

    /**
     * @var string|null
     *
     * @ORM\Column(name="advimg", type="string", length=255, nullable=true)
     */
    private $advimg = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="advurl", type="string", length=500, nullable=true)
     */
    private $advurl = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isrecommand", type="boolean", nullable=true)
     */
    private $isrecommand = '0';


}
