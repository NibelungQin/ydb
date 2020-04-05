<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsMcMappingFans
 *
 * @ORM\Table(name="ims_mc_mapping_fans", uniqueConstraints={@ORM\UniqueConstraint(name="openid_2", columns={"openid"})}, indexes={@ORM\Index(name="acid", columns={"acid"}), @ORM\Index(name="updatetime", columns={"updatetime"}), @ORM\Index(name="uid", columns={"uid"}), @ORM\Index(name="uniacid", columns={"uniacid"}), @ORM\Index(name="nickname", columns={"nickname"}), @ORM\Index(name="openid", columns={"openid"})})
 * @ORM\Entity
 */
class McMappingFans
{
    public const TABLE_NAME = 'ims_mc_mapping_fans';

    /**
     * @var int
     *
     * @ORM\Column(name="fanid", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $fanid;

    /**
     * @var int
     *
     * @ORM\Column(name="acid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $acid;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uid;

    /**
     * @var string
     *
     * @ORM\Column(name="openid", type="string", length=50, nullable=false)
     */
    private $openid;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=50, nullable=false)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="groupid", type="string", length=30, nullable=false)
     */
    private $groupid;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=8, nullable=false, options={"fixed"=true})
     */
    private $salt;

    /**
     * @var bool
     *
     * @ORM\Column(name="follow", type="boolean", nullable=false)
     */
    private $follow;

    /**
     * @var int
     *
     * @ORM\Column(name="followtime", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $followtime;

    /**
     * @var int
     *
     * @ORM\Column(name="unfollowtime", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $unfollowtime;

    /**
     * @var string
     *
     * @ORM\Column(name="tag", type="string", length=1000, nullable=false)
     */
    private $tag;

    /**
     * @var int|null
     *
     * @ORM\Column(name="updatetime", type="integer", nullable=true, options={"unsigned"=true})
     */
    private $updatetime;

    /**
     * @var string
     *
     * @ORM\Column(name="unionid", type="string", length=64, nullable=false)
     */
    private $unionid;


}
