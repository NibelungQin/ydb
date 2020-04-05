<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Table;

/**
 * OrderBuySend
 * @Table(name="ims_ewei_shop_order_buysend",
 *      indexes={
 *          @Index(name="idx_orderid", columns={"orderid"}),
 *          @Index(name="idx_openid", columns={"openid"}),
 *          @Index(name="idx_uniacid", columns={"uniacid"})})
 * @Entity
 */
class OrderBuySend
{
    public const TABLE_NAME = 'ims_ewei_shop_order_buysend';
    /**
     * @var int
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int|null
     *
     * @Column(name="uniacid", type="integer", nullable=true)
     */
    private $uniacid = '0';

    /**
     * @var int|null
     *
     * @Column(name="orderid", type="integer", nullable=true)
     */
    private $orderid = '0';

    /**
     * @var string|null
     *
     * @Column(name="openid", type="string", length=255, nullable=true)
     */
    private $openid = '';

    /**
     * @var float|null
     *
     * @Column(name="credit", type="float", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $credit = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="money", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $money = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int|null
     */
    public function getUniacid(): ?int
    {
        return $this->uniacid;
    }

    /**
     * @param int|null $uniacid
     */
    public function setUniacid(?int $uniacid): void
    {
        $this->uniacid = $uniacid;
    }

    /**
     * @return int|null
     */
    public function getOrderid(): ?int
    {
        return $this->orderid;
    }

    /**
     * @param int|null $orderid
     */
    public function setOrderid(?int $orderid): void
    {
        $this->orderid = $orderid;
    }

    /**
     * @return string|null
     */
    public function getOpenid(): ?string
    {
        return $this->openid;
    }

    /**
     * @param string|null $openid
     */
    public function setOpenid(?string $openid): void
    {
        $this->openid = $openid;
    }

    /**
     * @return float|null
     */
    public function getCredit(): ?float
    {
        return $this->credit;
    }

    /**
     * @param float|null $credit
     */
    public function setCredit(?float $credit): void
    {
        $this->credit = $credit;
    }

    /**
     * @return string|null
     */
    public function getMoney(): ?string
    {
        return $this->money;
    }

    /**
     * @param string|null $money
     */
    public function setMoney(?string $money): void
    {
        $this->money = $money;
    }

    /**
     * @return int|null
     */
    public function getCreatetime(): ?int
    {
        return $this->createtime;
    }

    /**
     * @param int|null $createtime
     */
    public function setCreatetime(?int $createtime): void
    {
        $this->createtime = $createtime;
    }

}
