<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopExpress
 *
 * @ORM\Table(name="ims_ewei_shop_express")
 * @ORM\Entity
 */
class Express
{
    public const TABLE_NAME = 'ims_ewei_shop_express';

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
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    private $name = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="express", type="string", length=50, nullable=true)
     */
    private $express = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true, options={"default"="1"})
     */
    private $status = '1';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="displayorder", type="boolean", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=30, nullable=false)
     */
    private $code = '';


}
