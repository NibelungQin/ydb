<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopMember
 *
 * @ORM\Table(name="ims_ewei_shop_member", indexes={@ORM\Index(name="idx_uniacid", columns={"uniacid"}), @ORM\Index(name="idx_openid", columns={"openid"}), @ORM\Index(name="idx_agenttime", columns={"agenttime"}), @ORM\Index(name="idx_uid", columns={"uid"}), @ORM\Index(name="idx_level", columns={"level"}), @ORM\Index(name="idx_shareid", columns={"agentid"}), @ORM\Index(name="idx_status", columns={"status"}), @ORM\Index(name="idx_isagent", columns={"isagent"}), @ORM\Index(name="idx_groupid", columns={"groupid"}), @ORM\Index(name="IDX_GFLAG", columns={"gflag"})})
 * @ORM\Entity
 */
class Member
{
    public const TABLE_NAME = 'ims_ewei_shop_member';

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
     * @ORM\Column(name="uid", type="integer", nullable=true)
     */
    private $uid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="groupid", type="integer", nullable=true)
     */
    private $groupid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agentid", type="integer", nullable=true)
     */
    private $agentid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="realname", type="string", length=20, nullable=true)
     */
    private $realname = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobile", type="string", length=11, nullable=true)
     */
    private $mobile = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="pwd", type="string", length=32, nullable=true)
     */
    private $pwd = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="weixin", type="string", length=100, nullable=true)
     */
    private $weixin = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="text", length=65535, nullable=true)
     */
    private $content;

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agenttime", type="integer", nullable=true)
     */
    private $agenttime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true)
     */
    private $status = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isagent", type="boolean", nullable=true)
     */
    private $isagent = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="clickcount", type="integer", nullable=true)
     */
    private $clickcount = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agentlevel", type="integer", nullable=true)
     */
    private $agentlevel = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="noticeset", type="text", length=65535, nullable=true)
     */
    private $noticeset;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname", type="string", length=255, nullable=true)
     */
    private $nickname = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="credit1", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $credit1 = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="credit2", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $credit2 = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birthyear", type="string", length=255, nullable=true)
     */
    private $birthyear = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birthmonth", type="string", length=255, nullable=true)
     */
    private $birthmonth = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="birthday", type="string", length=255, nullable=true)
     */
    private $birthday = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="gender", type="boolean", nullable=true)
     */
    private $gender = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar", type="string", length=255, nullable=true)
     */
    private $avatar = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="province", type="string", length=255, nullable=true)
     */
    private $province = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="area", type="string", length=255, nullable=true)
     */
    private $area = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="childtime", type="integer", nullable=true)
     */
    private $childtime = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="inviter", type="integer", nullable=true)
     */
    private $inviter = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agentnotupgrade", type="integer", nullable=true)
     */
    private $agentnotupgrade = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="agentselectgoods", type="boolean", nullable=true)
     */
    private $agentselectgoods = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="agentblack", type="integer", nullable=true)
     */
    private $agentblack = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="fixagentid", type="boolean", nullable=true)
     */
    private $fixagentid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="diymemberid", type="integer", nullable=true)
     */
    private $diymemberid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diymemberfields", type="text", length=65535, nullable=true)
     */
    private $diymemberfields;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diymemberdata", type="text", length=65535, nullable=true)
     */
    private $diymemberdata;

    /**
     * @var int|null
     *
     * @ORM\Column(name="diymemberdataid", type="integer", nullable=true)
     */
    private $diymemberdataid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="diycommissionid", type="integer", nullable=true)
     */
    private $diycommissionid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diycommissionfields", type="text", length=65535, nullable=true)
     */
    private $diycommissionfields;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diycommissiondata", type="text", length=65535, nullable=true)
     */
    private $diycommissiondata;

    /**
     * @var int|null
     *
     * @ORM\Column(name="diycommissiondataid", type="integer", nullable=true)
     */
    private $diycommissiondataid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="isblack", type="integer", nullable=true)
     */
    private $isblack = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission_total", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commissionTotal = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="endtime2", type="integer", nullable=true)
     */
    private $endtime2 = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ispartner", type="boolean", nullable=true)
     */
    private $ispartner = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="partnertime", type="integer", nullable=true)
     */
    private $partnertime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="partnerstatus", type="boolean", nullable=true)
     */
    private $partnerstatus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="partnerblack", type="boolean", nullable=true)
     */
    private $partnerblack = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="partnerlevel", type="integer", nullable=true)
     */
    private $partnerlevel = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="partnernotupgrade", type="boolean", nullable=true)
     */
    private $partnernotupgrade = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="diyglobonusid", type="integer", nullable=true)
     */
    private $diyglobonusid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyglobonusdata", type="text", length=65535, nullable=true)
     */
    private $diyglobonusdata;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyglobonusfields", type="text", length=65535, nullable=true)
     */
    private $diyglobonusfields;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isaagent", type="boolean", nullable=true)
     */
    private $isaagent = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="aagentlevel", type="integer", nullable=true)
     */
    private $aagentlevel = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="aagenttime", type="integer", nullable=true)
     */
    private $aagenttime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aagentstatus", type="boolean", nullable=true)
     */
    private $aagentstatus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aagentblack", type="boolean", nullable=true)
     */
    private $aagentblack = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aagentnotupgrade", type="boolean", nullable=true)
     */
    private $aagentnotupgrade = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="aagenttype", type="boolean", nullable=true)
     */
    private $aagenttype = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="aagentprovinces", type="text", length=65535, nullable=true)
     */
    private $aagentprovinces;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aagentcitys", type="text", length=65535, nullable=true)
     */
    private $aagentcitys;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aagentareas", type="text", length=65535, nullable=true)
     */
    private $aagentareas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="aagenttowns", type="text", length=65535, nullable=true)
     */
    private $aagenttowns;

    /**
     * @var int|null
     *
     * @ORM\Column(name="diyaagentid", type="integer", nullable=true)
     */
    private $diyaagentid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyaagentdata", type="text", length=65535, nullable=true)
     */
    private $diyaagentdata;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyaagentfields", type="text", length=65535, nullable=true)
     */
    private $diyaagentfields;

    /**
     * @var string|null
     *
     * @ORM\Column(name="salt", type="string", length=32, nullable=true)
     */
    private $salt;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="mobileverify", type="boolean", nullable=true)
     */
    private $mobileverify = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="mobileuser", type="boolean", nullable=true)
     */
    private $mobileuser = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="carrier_mobile", type="string", length=11, nullable=true)
     */
    private $carrierMobile = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isauthor", type="boolean", nullable=true)
     */
    private $isauthor = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="authortime", type="integer", nullable=true)
     */
    private $authortime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="authorstatus", type="boolean", nullable=true)
     */
    private $authorstatus = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="authorblack", type="boolean", nullable=true)
     */
    private $authorblack = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="authorlevel", type="integer", nullable=true)
     */
    private $authorlevel = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="authornotupgrade", type="boolean", nullable=true)
     */
    private $authornotupgrade = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="diyauthorid", type="integer", nullable=true)
     */
    private $diyauthorid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyauthordata", type="text", length=65535, nullable=true)
     */
    private $diyauthordata;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyauthorfields", type="text", length=65535, nullable=true)
     */
    private $diyauthorfields;

    /**
     * @var int|null
     *
     * @ORM\Column(name="authorid", type="integer", nullable=true)
     */
    private $authorid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="comefrom", type="string", length=20, nullable=true)
     */
    private $comefrom;

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid_qq", type="string", length=50, nullable=true)
     */
    private $openidQq;

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid_wx", type="string", length=50, nullable=true)
     */
    private $openidWx;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="diymaxcredit", type="boolean", nullable=true)
     */
    private $diymaxcredit = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="maxcredit", type="integer", nullable=true)
     */
    private $maxcredit = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="datavalue", type="string", length=50, nullable=false)
     */
    private $datavalue = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid_wa", type="string", length=50, nullable=true)
     */
    private $openidWa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname_wechat", type="string", length=255, nullable=true)
     */
    private $nicknameWechat = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="avatar_wechat", type="string", length=255, nullable=true)
     */
    private $avatarWechat = '';

    /**
     * @var bool
     *
     * @ORM\Column(name="updateaddress", type="boolean", nullable=false)
     */
    private $updateaddress = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="membercardid", type="string", length=255, nullable=true)
     */
    private $membercardid = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="membercardcode", type="string", length=255, nullable=true)
     */
    private $membercardcode = '';

    /**
     * @var string|null
     *
     * @ORM\Column(name="membershipnumber", type="string", length=255, nullable=true)
     */
    private $membershipnumber = '';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="membercardactive", type="boolean", nullable=true)
     */
    private $membercardactive = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commission = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="commission_pay", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $commissionPay = '0.00';

    /**
     * @var string|null
     *
     * @ORM\Column(name="idnumber", type="string", length=255, nullable=true)
     */
    private $idnumber;

    /**
     * @var int|null
     *
     * @ORM\Column(name="wxcardupdatetime", type="integer", nullable=true)
     */
    private $wxcardupdatetime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="hasnewcoupon", type="boolean", nullable=true)
     */
    private $hasnewcoupon = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="isheads", type="boolean", nullable=false)
     */
    private $isheads = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="headsstatus", type="boolean", nullable=false)
     */
    private $headsstatus = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="headstime", type="integer", nullable=false)
     */
    private $headstime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="headsid", type="integer", nullable=false)
     */
    private $headsid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="diyheadsid", type="integer", nullable=false)
     */
    private $diyheadsid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyheadsdata", type="text", length=65535, nullable=true)
     */
    private $diyheadsdata;

    /**
     * @var string|null
     *
     * @ORM\Column(name="diyheadsfields", type="text", length=65535, nullable=true)
     */
    private $diyheadsfields;

    /**
     * @var int|null
     *
     * @ORM\Column(name="applyagenttime", type="integer", nullable=true)
     */
    private $applyagenttime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="gflag", type="string", length=2000, nullable=true, options={"default"=",-1,","comment"="??"})
     */
    private $gflag = ',-1,';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="generation", type="boolean", nullable=true, options={"default"="1","comment"="??"})
     */
    private $generation = '1';


}
