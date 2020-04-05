<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsMcCreditsRecord
 *
 * @ORM\Table(name="ims_mc_credits_record", indexes={@ORM\Index(name="uniacid", columns={"uniacid"}), @ORM\Index(name="uid", columns={"uid"})})
 * @ORM\Entity
 */
class McCreditsRecord
{
    public const TABLE_NAME = 'ims_mc_credits_record';

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
     * @ORM\Column(name="uid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid;

    /**
     * @var string
     *
     * @ORM\Column(name="credittype", type="string", length=10, nullable=false)
     */
    private $credittype;

    /**
     * @var string
     *
     * @ORM\Column(name="num", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $num;

    /**
     * @var int
     *
     * @ORM\Column(name="operator", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $operator;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=30, nullable=false)
     */
    private $module;

    /**
     * @var int
     *
     * @ORM\Column(name="clerk_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $clerkId;

    /**
     * @var int
     *
     * @ORM\Column(name="store_id", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $storeId;

    /**
     * @var bool
     *
     * @ORM\Column(name="clerk_type", type="boolean", nullable=false)
     */
    private $clerkType;

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $createtime;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="string", length=200, nullable=false)
     */
    private $remark;


}
