<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantLog
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_log")
 * @ORM\Entity
 */
class SystemPlugingrantLog
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_log';

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
     * @ORM\Column(name="logno", type="string", length=50, nullable=true)
     */
    private $logno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="code", type="string", length=255, nullable=true)
     */
    private $code;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="pluginid", type="integer", nullable=false)
     */
    private $pluginid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="identity", type="string", length=50, nullable=true)
     */
    private $identity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer", nullable=false)
     */
    private $month = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="permendtime", type="integer", nullable=false)
     */
    private $permendtime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="permlasttime", type="integer", nullable=false)
     */
    private $permlasttime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="isperm", type="boolean", nullable=false)
     */
    private $isperm = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime = '0';


}
