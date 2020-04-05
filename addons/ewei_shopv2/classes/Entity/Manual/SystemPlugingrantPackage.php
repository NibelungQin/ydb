<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantPackage
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_package")
 * @ORM\Entity
 */
class SystemPlugingrantPackage
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_package';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="pluginid", type="string", length=255, nullable=false)
     */
    private $pluginid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="string", length=255, nullable=true)
     */
    private $text;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=1000, nullable=true)
     */
    private $thumb;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=false)
     */
    private $data;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean", nullable=false)
     */
    private $state = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="rec", type="boolean", nullable=false)
     */
    private $rec = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="desc", type="string", length=255, nullable=true)
     */
    private $desc;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=false)
     */
    private $displayorder = '0';


}
