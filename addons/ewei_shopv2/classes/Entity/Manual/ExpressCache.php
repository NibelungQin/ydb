<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopExpressCache
 *
 * @ORM\Table(name="ims_ewei_shop_express_cache", indexes={@ORM\Index(name="idx_expresssn", columns={"expresssn"}), @ORM\Index(name="idx_express", columns={"express"})})
 * @ORM\Entity
 */
class ExpressCache
{
    public const TABLE_NAME = 'ims_ewei_shop_express_cache';

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
     * @ORM\Column(name="expresssn", type="string", length=50, nullable=true)
     */
    private $expresssn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="express", type="string", length=50, nullable=true)
     */
    private $express;

    /**
     * @var int
     *
     * @ORM\Column(name="lasttime", type="integer", nullable=false)
     */
    private $lasttime;

    /**
     * @var string|null
     *
     * @ORM\Column(name="datas", type="text", length=65535, nullable=true)
     */
    private $datas;


}
