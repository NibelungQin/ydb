<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;


use Doctrine\ORM\Mapping as ORM;

/**
 * ImsAccount
 *
 * @ORM\Table(name="ims_account", indexes={@ORM\Index(name="idx_uniacid", columns={"uniacid"})})
 * @ORM\Entity
 */
class Account
{
    public const TABLE_NAME = 'ims_account';

    /**
     * @var int
     *
     * @ORM\Column(name="acid", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $acid;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uniacid;

    /**
     * @var string
     *
     * @ORM\Column(name="hash", type="string", length=8, nullable=false)
     */
    private $hash;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="boolean", nullable=false)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="isconnect", type="boolean", nullable=false)
     */
    private $isconnect;

    /**
     * @var bool
     *
     * @ORM\Column(name="isdeleted", type="boolean", nullable=false)
     */
    private $isdeleted;

    /**
     * @var int
     *
     * @ORM\Column(name="endtime", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $endtime;


}
