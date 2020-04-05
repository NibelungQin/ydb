<?php
declare(strict_types=1);

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCycelbuyPeriods
 *
 * @ORM\Table(name="ims_ewei_shop_cycelbuy_periods")
 * @ORM\Entity
 */
class CycelbuyPeriods
{
    public const TABLE_NAME = 'ims_ewei_shop_cycelbuy_periods';

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
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="orderid", type="integer", nullable=false)
     */
    private $orderid;

    /**
     * @var string
     *
     * @ORM\Column(name="cycelsn", type="string", length=255, nullable=false)
     */
    private $cycelsn;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sendtime", type="integer", nullable=true)
     */
    private $sendtime;

    /**
     * @var int|null
     *
     * @ORM\Column(name="receipttime", type="integer", nullable=true)
     */
    private $receipttime;

    /**
     * @var bool
     *
     * @ORM\Column(name="status", type="boolean", nullable=false)
     */
    private $status = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="remark", type="string", length=255, nullable=true)
     */
    private $remark;

    /**
     * @var int|null
     *
     * @ORM\Column(name="addressid", type="integer", nullable=true)
     */
    private $addressid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="dispatchprice", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $dispatchprice;

    /**
     * @var int|null
     *
     * @ORM\Column(name="dispatchid", type="integer", nullable=true)
     */
    private $dispatchid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="dispatchtype", type="boolean", nullable=true)
     */
    private $dispatchtype;

    /**
     * @var int|null
     *
     * @ORM\Column(name="finishtime", type="integer", nullable=true)
     */
    private $finishtime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresscom", type="string", length=255, nullable=true)
     */
    private $expresscom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="expresssn", type="string", length=255, nullable=true)
     */
    private $expresssn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="express", type="string", length=255, nullable=true)
     */
    private $express;

    /**
     * @var string|null
     *
     * @ORM\Column(name="address", type="text", length=65535, nullable=true)
     */
    private $address;

    /**
     * @var string|null
     *
     * @ORM\Column(name="updatelog", type="text", length=65535, nullable=true)
     */
    private $updatelog;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ispostpone", type="boolean", nullable=true)
     */
    private $ispostpone = '0';


}
