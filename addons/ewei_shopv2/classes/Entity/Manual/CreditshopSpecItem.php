<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopSpecItem
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_spec_item")
 * @ORM\Entity
 */
class CreditshopSpecItem
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_spec_item';

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
     * @ORM\Column(name="specid", type="integer", nullable=true)
     */
    private $specid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="show", type="integer", nullable=true)
     */
    private $show = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="valueId", type="string", length=255, nullable=true)
     */
    private $valueid = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="virtual", type="integer", nullable=true)
     */
    private $virtual = '0';


}
