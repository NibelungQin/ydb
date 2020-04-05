<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopSystemPlugingrantSetting
 *
 * @ORM\Table(name="ims_ewei_shop_system_plugingrant_setting")
 * @ORM\Entity
 */
class SystemPlugingrantSetting
{
    public const TABLE_NAME = 'ims_ewei_shop_system_plugingrant_setting';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="com", type="string", length=1000, nullable=false)
     */
    private $com = '';

    /**
     * @var string
     *
     * @ORM\Column(name="adv", type="string", length=1000, nullable=false)
     */
    private $adv;

    /**
     * @var string
     *
     * @ORM\Column(name="plugin", type="string", length=1000, nullable=false)
     */
    private $plugin;

    /**
     * @var string
     *
     * @ORM\Column(name="customer", type="string", length=50, nullable=false)
     */
    private $customer = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="contact", type="text", length=65535, nullable=false)
     */
    private $contact;

    /**
     * @var string|null
     *
     * @ORM\Column(name="servertime", type="string", length=255, nullable=true)
     */
    private $servertime;

    /**
     * @var bool
     *
     * @ORM\Column(name="weixin", type="boolean", nullable=false)
     */
    private $weixin = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="appid", type="string", length=255, nullable=true)
     */
    private $appid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mchid", type="string", length=255, nullable=true)
     */
    private $mchid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="apikey", type="string", length=255, nullable=true)
     */
    private $apikey;

    /**
     * @var bool
     *
     * @ORM\Column(name="alipay", type="boolean", nullable=false)
     */
    private $alipay;

    /**
     * @var string|null
     *
     * @ORM\Column(name="account", type="string", length=255, nullable=true)
     */
    private $account;

    /**
     * @var string|null
     *
     * @ORM\Column(name="partner", type="string", length=255, nullable=true)
     */
    private $partner;

    /**
     * @var string|null
     *
     * @ORM\Column(name="secret", type="string", length=255, nullable=true)
     */
    private $secret;


}
