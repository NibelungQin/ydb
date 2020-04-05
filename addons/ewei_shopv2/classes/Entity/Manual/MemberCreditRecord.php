<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMemberCreditRecord
 *
 * @ORM\Table(name="ims_ewei_shop_member_credit_record", indexes={@ORM\Index(name="uniacid", columns={"uniacid"}), @ORM\Index(name="openid", columns={"openid"})})
 * @ORM\Entity
 */
class MemberCreditRecord
{
    public const TABLE_NAME = 'ims_ewei_shop_member_credit_record';
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
     * @ORM\Column(name="uid", type="integer", nullable=false)
     */
    private $uid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

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
     * @ORM\Column(name="operator", type="integer", nullable=false)
     */
    private $operator;

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false)
     */
    private $createtime;

    /**
     * @var string
     *
     * @ORM\Column(name="remark", type="string", length=200, nullable=false)
     */
    private $remark;

    /**
     * @var string
     *
     * @ORM\Column(name="module", type="string", length=30, nullable=false)
     */
    private $module;


}
