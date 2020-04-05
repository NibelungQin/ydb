<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * GoodsLabel
 *
 * @Table(name="ims_ewei_shop_goods_label")
 * @Entity
 */
class GoodsLabel
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
     * @var int
     *
     * @Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid = '0';

    /**
     * @var string
     *
     * @Column(name="label", type="string", length=255, nullable=false)
     */
    private $label = '';

    /**
     * @var string
     *
     * @Column(name="labelname", type="text", length=65535, nullable=false)
     */
    private $labelname;

    /**
     * @var int
     *
     * @Column(name="status", type="smallint", nullable=false)
     */
    private $status = '0';

    /**
     * @var int
     *
     * @Column(name="displayorder", type="integer", nullable=false)
     */
    private $displayorder = '0';

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
     * @return int
     */
    public function getUniacid(): int
    {
        return $this->uniacid;
    }

    /**
     * @param int $uniacid
     */
    public function setUniacid(int $uniacid): void
    {
        $this->uniacid = $uniacid;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     */
    public function setLabel(string $label): void
    {
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getLabelname(): string
    {
        return $this->labelname;
    }

    /**
     * @param string $labelname
     */
    public function setLabelname(string $labelname): void
    {
        $this->labelname = $labelname;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return int
     */
    public function getDisplayorder(): int
    {
        return $this->displayorder;
    }

    /**
     * @param int $displayorder
     */
    public function setDisplayorder(int $displayorder): void
    {
        $this->displayorder = $displayorder;
    }

}
