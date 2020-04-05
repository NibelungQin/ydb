<?php

declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\Table;

/**
 * GoodsCards
 *
 * @Table(name="ims_ewei_shop_goods_cards")
 * @Entity
 */
class GoodsCards
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
     * @OColumn(name="uniacid", type="integer", nullable=true)
     */
    private $uniacid;

    /**
     * @var string|null
     *
     * @Column(name="card_id", type="string", length=255, nullable=true)
     */
    private $cardId;

    /**
     * @var string|null
     *
     * @Column(name="card_title", type="string", length=255, nullable=true)
     */
    private $cardTitle;

    /**
     * @var string|null
     *
     * @Column(name="card_brand_name", type="string", length=255, nullable=true)
     */
    private $cardBrandName;

    /**
     * @var int|null
     *
     * @Column(name="card_totalquantity", type="integer", nullable=true)
     */
    private $cardTotalquantity;

    /**
     * @var int|null
     *
     * @Column(name="card_quantity", type="integer", nullable=true)
     */
    private $cardQuantity;

    /**
     * @var string|null
     *
     * @Column(name="card_logoimg", type="string", length=255, nullable=true)
     */
    private $cardLogoimg;

    /**
     * @var string|null
     *
     * @Column(name="card_logowxurl", type="string", length=255, nullable=true)
     */
    private $cardLogowxurl;

    /**
     * @var int|null
     *
     * @Column(name="card_backgroundtype", type="smallint", nullable=true)
     */
    private $cardBackgroundtype;

    /**
     * @var string|null
     *
     * @Column(name="color", type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @var string|null
     *
     * @Column(name="card_backgroundimg", type="string", length=255, nullable=true)
     */
    private $cardBackgroundimg;

    /**
     * @var string|null
     *
     * @Column(name="card_backgroundwxurl", type="string", length=255, nullable=true)
     */
    private $cardBackgroundwxurl;

    /**
     * @var string|null
     *
     * @Column(name="prerogative", type="string", length=255, nullable=true)
     */
    private $prerogative;

    /**
     * @var string|null
     *
     * @Column(name="card_description", type="string", length=255, nullable=true)
     */
    private $cardDescription;

    /**
     * @var int|null
     *
     * @Column(name="freewifi", type="smallint", nullable=true)
     */
    private $freewifi;

    /**
     * @var int|null
     *
     * @Column(name="withpet", type="smallint", nullable=true)
     */
    private $withpet;

    /**
     * @var int|null
     *
     * @Column(name="freepark", type="smallint", nullable=true)
     */
    private $freepark;

    /**
     * @var int|null
     *
     * @Column(name="deliver", type="smallint", nullable=true)
     */
    private $deliver;

    /**
     * @var int|null
     *
     * @Column(name="custom_cell1", type="smallint", nullable=true)
     */
    private $customCell1;

    /**
     * @var string|null
     *
     * @Column(name="custom_cell1_name", type="string", length=255, nullable=true)
     */
    private $customCell1Name;

    /**
     * @var string|null
     *
     * @Column(name="custom_cell1_tips", type="string", length=255, nullable=true)
     */
    private $customCell1Tips;

    /**
     * @var string|null
     *
     * @Column(name="custom_cell1_url", type="string", length=255, nullable=true)
     */
    private $customCell1Url;

    /**
     * @var string|null
     *
     * @Column(name="color2", type="string", length=20, nullable=true)
     */
    private $color2 = '';

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
     * @return string|null
     */
    public function getCardId(): ?string
    {
        return $this->cardId;
    }

    /**
     * @param string|null $cardId
     */
    public function setCardId(?string $cardId): void
    {
        $this->cardId = $cardId;
    }

    /**
     * @return string|null
     */
    public function getCardTitle(): ?string
    {
        return $this->cardTitle;
    }

    /**
     * @param string|null $cardTitle
     */
    public function setCardTitle(?string $cardTitle): void
    {
        $this->cardTitle = $cardTitle;
    }

    /**
     * @return string|null
     */
    public function getCardBrandName(): ?string
    {
        return $this->cardBrandName;
    }

    /**
     * @param string|null $cardBrandName
     */
    public function setCardBrandName(?string $cardBrandName): void
    {
        $this->cardBrandName = $cardBrandName;
    }

    /**
     * @return int|null
     */
    public function getCardTotalquantity(): ?int
    {
        return $this->cardTotalquantity;
    }

    /**
     * @param int|null $cardTotalquantity
     */
    public function setCardTotalquantity(?int $cardTotalquantity): void
    {
        $this->cardTotalquantity = $cardTotalquantity;
    }

    /**
     * @return int|null
     */
    public function getCardQuantity(): ?int
    {
        return $this->cardQuantity;
    }

    /**
     * @param int|null $cardQuantity
     */
    public function setCardQuantity(?int $cardQuantity): void
    {
        $this->cardQuantity = $cardQuantity;
    }

    /**
     * @return string|null
     */
    public function getCardLogoimg(): ?string
    {
        return $this->cardLogoimg;
    }

    /**
     * @param string|null $cardLogoimg
     */
    public function setCardLogoimg(?string $cardLogoimg): void
    {
        $this->cardLogoimg = $cardLogoimg;
    }

    /**
     * @return string|null
     */
    public function getCardLogowxurl(): ?string
    {
        return $this->cardLogowxurl;
    }

    /**
     * @param string|null $cardLogowxurl
     */
    public function setCardLogowxurl(?string $cardLogowxurl): void
    {
        $this->cardLogowxurl = $cardLogowxurl;
    }

    /**
     * @return int|null
     */
    public function getCardBackgroundtype(): ?int
    {
        return $this->cardBackgroundtype;
    }

    /**
     * @param int|null $cardBackgroundtype
     */
    public function setCardBackgroundtype(?int $cardBackgroundtype): void
    {
        $this->cardBackgroundtype = $cardBackgroundtype;
    }

    /**
     * @return string|null
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * @param string|null $color
     */
    public function setColor(?string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return string|null
     */
    public function getCardBackgroundimg(): ?string
    {
        return $this->cardBackgroundimg;
    }

    /**
     * @param string|null $cardBackgroundimg
     */
    public function setCardBackgroundimg(?string $cardBackgroundimg): void
    {
        $this->cardBackgroundimg = $cardBackgroundimg;
    }

    /**
     * @return string|null
     */
    public function getCardBackgroundwxurl(): ?string
    {
        return $this->cardBackgroundwxurl;
    }

    /**
     * @param string|null $cardBackgroundwxurl
     */
    public function setCardBackgroundwxurl(?string $cardBackgroundwxurl): void
    {
        $this->cardBackgroundwxurl = $cardBackgroundwxurl;
    }

    /**
     * @return string|null
     */
    public function getPrerogative(): ?string
    {
        return $this->prerogative;
    }

    /**
     * @param string|null $prerogative
     */
    public function setPrerogative(?string $prerogative): void
    {
        $this->prerogative = $prerogative;
    }

    /**
     * @return string|null
     */
    public function getCardDescription(): ?string
    {
        return $this->cardDescription;
    }

    /**
     * @param string|null $cardDescription
     */
    public function setCardDescription(?string $cardDescription): void
    {
        $this->cardDescription = $cardDescription;
    }

    /**
     * @return int|null
     */
    public function getFreewifi(): ?int
    {
        return $this->freewifi;
    }

    /**
     * @param int|null $freewifi
     */
    public function setFreewifi(?int $freewifi): void
    {
        $this->freewifi = $freewifi;
    }

    /**
     * @return int|null
     */
    public function getWithpet(): ?int
    {
        return $this->withpet;
    }

    /**
     * @param int|null $withpet
     */
    public function setWithpet(?int $withpet): void
    {
        $this->withpet = $withpet;
    }

    /**
     * @return int|null
     */
    public function getFreepark(): ?int
    {
        return $this->freepark;
    }

    /**
     * @param int|null $freepark
     */
    public function setFreepark(?int $freepark): void
    {
        $this->freepark = $freepark;
    }

    /**
     * @return int|null
     */
    public function getDeliver(): ?int
    {
        return $this->deliver;
    }

    /**
     * @param int|null $deliver
     */
    public function setDeliver(?int $deliver): void
    {
        $this->deliver = $deliver;
    }

    /**
     * @return int|null
     */
    public function getCustomCell1(): ?int
    {
        return $this->customCell1;
    }

    /**
     * @param int|null $customCell1
     */
    public function setCustomCell1(?int $customCell1): void
    {
        $this->customCell1 = $customCell1;
    }

    /**
     * @return string|null
     */
    public function getCustomCell1Name(): ?string
    {
        return $this->customCell1Name;
    }

    /**
     * @param string|null $customCell1Name
     */
    public function setCustomCell1Name(?string $customCell1Name): void
    {
        $this->customCell1Name = $customCell1Name;
    }

    /**
     * @return string|null
     */
    public function getCustomCell1Tips(): ?string
    {
        return $this->customCell1Tips;
    }

    /**
     * @param string|null $customCell1Tips
     */
    public function setCustomCell1Tips(?string $customCell1Tips): void
    {
        $this->customCell1Tips = $customCell1Tips;
    }

    /**
     * @return string|null
     */
    public function getCustomCell1Url(): ?string
    {
        return $this->customCell1Url;
    }

    /**
     * @param string|null $customCell1Url
     */
    public function setCustomCell1Url(?string $customCell1Url): void
    {
        $this->customCell1Url = $customCell1Url;
    }

    /**
     * @return string|null
     */
    public function getColor2(): ?string
    {
        return $this->color2;
    }

    /**
     * @param string|null $color2
     */
    public function setColor2(?string $color2): void
    {
        $this->color2 = $color2;
    }
}
