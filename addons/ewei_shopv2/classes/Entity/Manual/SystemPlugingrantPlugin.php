<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantPlugin
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_plugin")
 * @ORM\Entity
 */
class SystemPlugingrantPlugin
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_plugin';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="pluginid", type="integer", nullable=false)
     */
    private $pluginid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="thumb", type="string", length=1000, nullable=false)
     */
    private $thumb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="data", type="text", length=65535, nullable=true)
     */
    private $data;

    /**
     * @var bool
     *
     * @ORM\Column(name="state", type="boolean", nullable=false)
     */
    private $state = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=false)
     */
    private $content;

    /**
     * @var int
     *
     * @ORM\Column(name="sales", type="integer", nullable=false)
     */
    private $sales = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=false)
     */
    private $displayorder = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="plugintype", type="boolean", nullable=false)
     */
    private $plugintype = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;


}
