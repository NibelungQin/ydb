<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPlugin
 *
 * @ORM\Table(name="ims_ewei_shop_plugin", indexes={@ORM\Index(name="idx_identity", columns={"identity"}), @ORM\Index(name="idx_displayorder", columns={"displayorder"})})
 * @ORM\Entity
 */
class Plugin
{
    public const TABLE_NAME = 'ims_ewei_shop_plugin';

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
     * @ORM\Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="identity", type="string", length=50, nullable=true)
     */
    private $identity = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="category", type="string", length=255, nullable=true)
     */
    private $category = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="version", type="string", length=10, nullable=true)
     */
    private $version = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="author", type="string", length=20, nullable=true)
     */
    private $author = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="status", type="integer", nullable=true)
     */
    private $status = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="thumb", type="string", length=255, nullable=true)
     */
    private $thumb = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="desc", type="text", length=65535, nullable=true)
     */
    private $desc;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="iscom", type="boolean", nullable=true)
     */
    private $iscom = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="deprecated", type="boolean", nullable=true)
     */
    private $deprecated = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isv2", type="boolean", nullable=true)
     */
    private $isv2 = '0';


}
