<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopOption
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_option")
 * @ORM\Entity
 */
class CreditshopOption
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_option';
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
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=60, nullable=true)
     */
    private $thumb = '';

    /**
     * @var int
     *
     * @ORM\Column(name="credit", type="integer", nullable=false)
     */
    private $credit = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="money", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $money = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="total", type="integer", nullable=true)
     */
    private $total = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="weight", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $weight = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="specs", type="text", length=65535, nullable=true)
     */
    private $specs;

    /**
     * @var string|null
     *
     * @ORM\Column(name="skuId", type="string", length=255, nullable=true)
     */
    private $skuid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="goodssn", type="string", length=255, nullable=true)
     */
    private $goodssn = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="productsn", type="string", length=255, nullable=true)
     */
    private $productsn = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="virtual", type="integer", nullable=true)
     */
    private $virtual = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="exchange_stock", type="integer", nullable=false, options={"default"="-1"})
     */
    private $exchangeStock = '-1';


}
