<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopPackagegoodsAbonusLog
 *
 * @ORM\Table(name="ims_ewei_shop_packagegoods_abonus_log")
 * @ORM\Entity
 */
class PackagegoodsAbonusLog
{
    public const TABLE_NAME = 'ims_ewei_shop_packagegoods_abonus_log';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"comment"="???????????ID"})
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
     * @ORM\Column(name="orderid", type="integer", nullable=true, options={"comment"="??ID"})
     */
    private $orderid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=50, nullable=true, options={"comment"="???openid"})
     */
    private $openid = '';

    /**
     * @var int|null
     *
     * @ORM\Column(name="bonusmoney_id", type="integer", nullable=true, options={"comment"="??????ID"})
     */
    private $bonusmoneyId = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="bonusmoney", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00","comment"="??????"})
     */
    private $bonusmoney = '0.00';

    /**
     * @var int|null
     *
     * @ORM\Column(name="createtime", type="integer", nullable=true, options={"comment"="????"})
     */
    private $createtime = '0';

    /**
     * @var bool|null
     *
     * @ORM\Column(name="status", type="boolean", nullable=true, options={"comment"="?????0???1???"})
     */
    private $status = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderno", type="string", length=45, nullable=true)
     */
    private $orderno;


}
