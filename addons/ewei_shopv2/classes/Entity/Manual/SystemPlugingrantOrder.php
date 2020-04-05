<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantOrder
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_order")
 * @ORM\Entity
 */
class SystemPlugingrantOrder
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_order';

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
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pluginid", type="string", length=255, nullable=true)
     */
    private $pluginid;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $price = '0.00';

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="integer", nullable=false)
     */
    private $month = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="paystatus", type="boolean", nullable=false)
     */
    private $paystatus = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="paytime", type="integer", nullable=false)
     */
    private $paytime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="paytype", type="boolean", nullable=false)
     */
    private $paytype = '0';


}
