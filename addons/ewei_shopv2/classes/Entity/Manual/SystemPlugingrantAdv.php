<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantAdv
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_adv", indexes={@ORM\Index(name="idx_enabled", columns={"enabled"}), @ORM\Index(name="idx_displayorder", columns={"displayorder"})})
 * @ORM\Entity
 */
class SystemPlugingrantAdv
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_adv';

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


}
