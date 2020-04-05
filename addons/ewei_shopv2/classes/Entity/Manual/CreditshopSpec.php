<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopSpec
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_spec")
 * @ORM\Entity
 */
class CreditshopSpec
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_spec';

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
     * @ORM\Column(name="description", type="string", length=1000, nullable=true)
     */
    private $description = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="displaytype", type="boolean", nullable=true)
     */
    private $displaytype = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var int|null
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="propId", type="string", length=255, nullable=true)
     */
    private $propid = '';


}
