<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * OrderPrint
 *
 * @Table(name="ims_ewei_shop_order_print")
 * @Entity
 */
class OrderPrint
{
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
     * @Column(name="status", type="smallint", nullable=true)
     */
    private $status = '0';

    /**
     * @var int|null
     *
     * @Column(name="sid", type="smallint", nullable=true)
     */
    private $sid = '0';

    /**
     * @var int|null
     *
     * @Column(name="foid", type="smallint", nullable=true)
     */
    private $foid = '0';

    /**
     * @var int|null
     *
     * @Column(name="oid", type="integer", nullable=true)
     */
    private $oid = '0';

    /**
     * @var int|null
     *
     * @Column(name="pid", type="integer", nullable=true)
     */
    private $pid = '0';

    /**
     * @var int|null
     *
     * @Column(name="uniacid", type="integer", nullable=true)
     */
    private $uniacid = '0';

    /**
     * @var int|null
     *
     * @Column(name="addtime", type="integer", nullable=true)
     */
    private $addtime = '0';

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
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int|null
     */
    public function getSid(): ?int
    {
        return $this->sid;
    }

    /**
     * @param int|null $sid
     */
    public function setSid(?int $sid): void
    {
        $this->sid = $sid;
    }

    /**
     * @return int|null
     */
    public function getFoid(): ?int
    {
        return $this->foid;
    }

    /**
     * @param int|null $foid
     */
    public function setFoid(?int $foid): void
    {
        $this->foid = $foid;
    }

    /**
     * @return int|null
     */
    public function getOid(): ?int
    {
        return $this->oid;
    }

    /**
     * @param int|null $oid
     */
    public function setOid(?int $oid): void
    {
        $this->oid = $oid;
    }

    /**
     * @return int|null
     */
    public function getPid(): ?int
    {
        return $this->pid;
    }

    /**
     * @param int|null $pid
     */
    public function setPid(?int $pid): void
    {
        $this->pid = $pid;
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
    public function getAddtime(): ?int
    {
        return $this->addtime;
    }

    /**
     * @param int|null $addtime
     */
    public function setAddtime(?int $addtime): void
    {
        $this->addtime = $addtime;
    }

}
