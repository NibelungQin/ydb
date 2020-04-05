<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsMcMembers
 *
 * @ORM\Table(name="ims_mc_members", indexes={@ORM\Index(name="uniacid", columns={"uniacid"}), @ORM\Index(name="mobile", columns={"mobile"}), @ORM\Index(name="groupid", columns={"groupid"}), @ORM\Index(name="email", columns={"email"})})
 * @ORM\Entity
 */
class McMembers
{
    public const TABLE_NAME = 'ims_mc_members';

    /**
     * @var int
     *
     * @ORM\Column(name="uid", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uid;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $uniacid;

    /**
     * @var string
     *
     * @ORM\Column(name="mobile", type="string", length=11, nullable=false)
     */
    private $mobile;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="string", length=8, nullable=false)
     */
    private $salt;

    /**
     * @var int
     *
     * @ORM\Column(name="groupid", type="integer", nullable=false)
     */
    private $groupid;

    /**
     * @var string
     *
     * @ORM\Column(name="credit1", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit1;

    /**
     * @var string
     *
     * @ORM\Column(name="credit2", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit2;

    /**
     * @var string
     *
     * @ORM\Column(name="credit3", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit3;

    /**
     * @var string
     *
     * @ORM\Column(name="credit4", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit4;

    /**
     * @var string
     *
     * @ORM\Column(name="credit5", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit5;

    /**
     * @var string
     *
     * @ORM\Column(name="credit6", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $credit6;

    /**
     * @var int
     *
     * @ORM\Column(name="createtime", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $createtime;

    /**
     * @var string
     *
     * @ORM\Column(name="realname", type="string", length=10, nullable=false)
     */
    private $realname;

    /**
     * @var string
     *
     * @ORM\Column(name="nickname", type="string", length=20, nullable=false)
     */
    private $nickname;

    /**
     * @var string
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=false)
     */
    private $avatar;

    /**
     * @var string
     *
     * @ORM\Column(name="qq", type="string", length=15, nullable=false)
     */
    private $qq;

    /**
     * @var bool
     *
     * @ORM\Column(name="vip", type="boolean", nullable=false)
     */
    private $vip;

    /**
     * @var bool
     *
     * @ORM\Column(name="gender", type="boolean", nullable=false)
     */
    private $gender;

    /**
     * @var int
     *
     * @ORM\Column(name="birthyear", type="smallint", nullable=false, options={"unsigned"=true})
     */
    private $birthyear;

    /**
     * @var bool
     *
     * @ORM\Column(name="birthmonth", type="boolean", nullable=false)
     */
    private $birthmonth;

    /**
     * @var bool
     *
     * @ORM\Column(name="birthday", type="boolean", nullable=false)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="constellation", type="string", length=10, nullable=false)
     */
    private $constellation;

    /**
     * @var string
     *
     * @ORM\Column(name="zodiac", type="string", length=5, nullable=false)
     */
    private $zodiac;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=15, nullable=false)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="idcard", type="string", length=30, nullable=false)
     */
    private $idcard;

    /**
     * @var string
     *
     * @ORM\Column(name="studentid", type="string", length=50, nullable=false)
     */
    private $studentid;

    /**
     * @var string
     *
     * @ORM\Column(name="grade", type="string", length=10, nullable=false)
     */
    private $grade;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="zipcode", type="string", length=10, nullable=false)
     */
    private $zipcode;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=30, nullable=false)
     */
    private $nationality;

    /**
     * @var string
     *
     * @ORM\Column(name="resideprovince", type="string", length=30, nullable=false)
     */
    private $resideprovince;

    /**
     * @var string
     *
     * @ORM\Column(name="residecity", type="string", length=30, nullable=false)
     */
    private $residecity;

    /**
     * @var string
     *
     * @ORM\Column(name="residedist", type="string", length=30, nullable=false)
     */
    private $residedist;

    /**
     * @var string
     *
     * @ORM\Column(name="graduateschool", type="string", length=50, nullable=false)
     */
    private $graduateschool;

    /**
     * @var string
     *
     * @ORM\Column(name="company", type="string", length=50, nullable=false)
     */
    private $company;

    /**
     * @var string
     *
     * @ORM\Column(name="education", type="string", length=10, nullable=false)
     */
    private $education;

    /**
     * @var string
     *
     * @ORM\Column(name="occupation", type="string", length=30, nullable=false)
     */
    private $occupation;

    /**
     * @var string
     *
     * @ORM\Column(name="position", type="string", length=30, nullable=false)
     */
    private $position;

    /**
     * @var string
     *
     * @ORM\Column(name="revenue", type="string", length=10, nullable=false)
     */
    private $revenue;

    /**
     * @var string
     *
     * @ORM\Column(name="affectivestatus", type="string", length=30, nullable=false)
     */
    private $affectivestatus;

    /**
     * @var string
     *
     * @ORM\Column(name="lookingfor", type="string", length=255, nullable=false)
     */
    private $lookingfor;

    /**
     * @var string
     *
     * @ORM\Column(name="bloodtype", type="string", length=5, nullable=false)
     */
    private $bloodtype;

    /**
     * @var string
     *
     * @ORM\Column(name="height", type="string", length=5, nullable=false)
     */
    private $height;

    /**
     * @var string
     *
     * @ORM\Column(name="weight", type="string", length=5, nullable=false)
     */
    private $weight;

    /**
     * @var string
     *
     * @ORM\Column(name="alipay", type="string", length=30, nullable=false)
     */
    private $alipay;

    /**
     * @var string
     *
     * @ORM\Column(name="msn", type="string", length=30, nullable=false)
     */
    private $msn;

    /**
     * @var string
     *
     * @ORM\Column(name="taobao", type="string", length=30, nullable=false)
     */
    private $taobao;

    /**
     * @var string
     *
     * @ORM\Column(name="site", type="string", length=30, nullable=false)
     */
    private $site;

    /**
     * @var string
     *
     * @ORM\Column(name="bio", type="text", length=65535, nullable=false)
     */
    private $bio;

    /**
     * @var string
     *
     * @ORM\Column(name="interest", type="text", length=65535, nullable=false)
     */
    private $interest;

    /**
     * @var string
     *
     * @ORM\Column(name="pay_password", type="string", length=30, nullable=false)
     */
    private $payPassword;


}
