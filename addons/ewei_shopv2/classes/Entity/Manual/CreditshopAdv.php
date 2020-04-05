<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopAdv
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_adv", indexes={@ORM\Index(name="idx_displayorder", columns={"displayorder"}), @ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_enabled", columns={"enabled"})})
 * @ORM\Entity
 */
class CreditshopAdv
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_adv';

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
     * @ORM\Column(name="advname", type="string", length=50, nullable=true)
     */
    private $advname = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="enabled", type="integer", nullable=true)
     */
    private $enabled = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';


}
