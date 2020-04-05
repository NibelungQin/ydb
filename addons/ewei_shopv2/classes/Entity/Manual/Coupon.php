<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsCoupon
 *
 * @ORM\Table(name="ims_ewei_shop_coupon", indexes={@ORM\Index(name="uniacid", columns={"uniacid", "acid"})})
 * @ORM\Entity
 */
class Coupon
{
    public const TABLE_NAME = 'ims_ewei_shop_coupon';

}
