<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsAccountWechats
 *
 * @ORM\Table(name="ims_account_wechats", indexes={@ORM\Index(name="idx_key", columns={"key"})})
 * @ORM\Entity
 */
class AccountWechats
{
    public const TABLE_NAME = 'ims_account_wechats';

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
     * @ORM\Column(name="token", type="string", length=32, nullable=false)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="encodingaeskey", type="string", length=255, nullable=false)
     */
    private $encodingaeskey;

    /**
     * @var bool
     *
     * @ORM\Column(name="level", type="boolean", nullable=false)
     */
    private $level;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=30, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="account", type="string", length=30, nullable=false)
     */
    private $account;

    /**
     * @var string
     *
     * @ORM\Column(name="original", type="string", length=50, nullable=false)
     */
    private $original;

    /**
     * @var string
     *
     * @ORM\Column(name="signature", type="string", length=100, nullable=false)
     */
    private $signature;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=10, nullable=false)
     */
    private $country;

    /**
     * @var string
     *
     * @ORM\Column(name="province", type="string", length=3, nullable=false)
     */
    private $province;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=15, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=30, nullable=false)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=32, nullable=false)
     */
    private $password;

    /**
     * @var int
     *
     * @ORM\Column(name="lastupdate", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $lastupdate;

    /**
     * @var string
     *
     * @ORM\Column(name="key", type="string", length=50, nullable=false)
     */
    private $key;

    /**
     * @var string
     *
     * @ORM\Column(name="secret", type="string", length=50, nullable=false)
     */
    private $secret;

    /**
     * @var int
     *
     * @ORM\Column(name="styleid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $styleid;

    /**
     * @var string
     *
     * @ORM\Column(name="subscribeurl", type="string", length=120, nullable=false)
     */
    private $subscribeurl;

    /**
     * @var string
     *
     * @ORM\Column(name="auth_refresh_token", type="string", length=255, nullable=false)
     */
    private $authRefreshToken;


}
