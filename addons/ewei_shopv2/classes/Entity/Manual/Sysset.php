<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSysset
 *
 * @ORM\Table(name="ims_ewei_shop_sysset", indexes={@ORM\Index(name="idx_uniacid", columns={"uniacid"})})
 * @ORM\Entity
 */
class Sysset
{
    public const TABLE_NAME = 'ims_ewei_shop_sysset';

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
     * @ORM\Column(name="sets", type="text", length=0, nullable=true)
     */
    private $sets;

    /**
     * @var string|null
     *
     * @ORM\Column(name="plugins", type="text", length=0, nullable=true)
     */
    private $plugins;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sec", type="text", length=65535, nullable=true)
     */
    private $sec;


}
