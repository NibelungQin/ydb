<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopVerify
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_verify")
 * @ORM\Entity
 */
class CreditshopVerify
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_verify';

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
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=45, nullable=true)
     */
    private $openid = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="logid", type="integer", nullable=true)
     */
    private $logid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="verifycode", type="string", length=45, nullable=true)
     */
    private $verifycode;

    /**
     * @var int|null
     *
     * @ORM\Column(name="storeid", type="integer", nullable=true)
     */
    private $storeid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="verifier", type="string", length=45, nullable=true)
     */
    private $verifier = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="isverify", type="boolean", nullable=true)
     */
    private $isverify = '0';

    /**
     * @var int|null
     *
     * @ORM\Column(name="verifytime", type="integer", nullable=true)
     */
    private $verifytime = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';


}
