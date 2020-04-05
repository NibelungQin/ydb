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
 * GoodsOption
 *
 * @Table(name="ims_ewei_shop_goods_option",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_displayorder", columns={"displayorder"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"})})
 * @Entity
 */
class GoodsOption
{
    public const TABLE_NAME = 'ims_ewei_shop_goods_option';

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
     * @Column(name="goodsid", type="integer", nullable=true)
     */
    private $goodsid = '0';

    /**
     * @var string|null
     *
     * @Column(name="title", type="string", length=50, nullable=true)
     */
    private $title = '';

    /**
     * @var string|null
     *
     * @Column(name="thumb", type="string", length=60, nullable=true)
     */
    private $thumb = '';

    /**
     * @var string|null
     *
     * @Column(name="productprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $productprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="marketprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $marketprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="costprice", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $costprice = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="stock", type="integer", nullable=true)
     */
    private $stock = '0';

    /**
     * @var string|null
     *
     * @Column(name="weight", type="decimal", precision=10, scale=2, nullable=true, options={"default"="0.00"})
     */
    private $weight = '0.00';

    /**
     * @var int|null
     *
     * @Column(name="displayorder", type="integer", nullable=true)
     */
    private $displayorder = '0';

    /**
     * @var string|null
     *
     * @Column(name="specs", type="text", length=65535, nullable=true)
     */
    private $specs;

    /**
     * @var string|null
     *
     * @Column(name="skuId", type="string", length=255, nullable=true)
     */
    private $skuid = '';

    /**
     * @var string|null
     *
     * @Column(name="goodssn", type="string", length=255, nullable=true)
     */
    private $goodssn = '';

    /**
     * @var string|null
     *
     * @Column(name="productsn", type="string", length=255, nullable=true)
     */
    private $productsn = '';

    /**
     * @var int|null
     *
     * @Column(name="`virtual`", type="integer", nullable=true)
     */
    private $virtual = '0';

    /**
     * @var int|null
     *
     * @Column(name="exchange_stock", type="integer", nullable=true)
     */
    private $exchangeStock = '0';

    /**
     * @var string
     *
     * @Column(name="exchange_postage", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $exchangePostage = '0.00';

    /**
     * @var string
     *
     * @Column(name="presellprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $presellprice = '0.00';

    /**
     * @var int
     *
     * @Column(name="day", type="integer", nullable=false)
     */
    private $day;

    /**
     * @var string
     *
     * @Column(name="allfullbackprice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $allfullbackprice;

    /**
     * @var string
     *
     * @Column(name="fullbackprice", type="decimal", precision=10, scale=2, nullable=false)
     */
    private $fullbackprice;

    /**
     * @var string|null
     *
     * @Column(name="allfullbackratio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $allfullbackratio;

    /**
     * @var string|null
     *
     * @Column(name="fullbackratio", type="decimal", precision=10, scale=2, nullable=true)
     */
    private $fullbackratio;

    /**
     * @var int
     *
     * @Column(name="isfullback", type="smallint", nullable=false)
     */
    private $isfullback;

    /**
     * @var int
     *
     * @Column(name="islive", type="integer", nullable=false)
     */
    private $islive;

    /**
     * @var string
     *
     * @Column(name="liveprice", type="decimal", precision=10, scale=2, nullable=false, options={"default"="0.00"})
     */
    private $liveprice = '0.00';

    /**
     * @var string|null
     *
     * @Column(name="cycelbuy_periodic", type="string", length=255, nullable=true)
     */
    private $cycelbuyPeriodic = '';

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
    public function getGoodsid(): ?int
    {
        return $this->goodsid;
    }

    /**
     * @param int|null $goodsid
     */
    public function setGoodsid(?int $goodsid): void
    {
        $this->goodsid = $goodsid;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getThumb(): ?string
    {
        return $this->thumb;
    }

    /**
     * @param string|null $thumb
     */
    public function setThumb(?string $thumb): void
    {
        $this->thumb = $thumb;
    }

    /**
     * @return string|null
     */
    public function getProductprice(): ?string
    {
        return $this->productprice;
    }

    /**
     * @param string|null $productprice
     */
    public function setProductprice(?string $productprice): void
    {
        $this->productprice = $productprice;
    }

    /**
     * @return string|null
     */
    public function getMarketprice(): ?string
    {
        return $this->marketprice;
    }

    /**
     * @param string|null $marketprice
     */
    public function setMarketprice(?string $marketprice): void
    {
        $this->marketprice = $marketprice;
    }

    /**
     * @return string|null
     */
    public function getCostprice(): ?string
    {
        return $this->costprice;
    }

    /**
     * @param string|null $costprice
     */
    public function setCostprice(?string $costprice): void
    {
        $this->costprice = $costprice;
    }

    /**
     * @return int|null
     */
    public function getStock(): ?int
    {
        return $this->stock;
    }

    /**
     * @param int|null $stock
     */
    public function setStock(?int $stock): void
    {
        $this->stock = $stock;
    }

    /**
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string|null $weight
     */
    public function setWeight(?string $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return int|null
     */
    public function getDisplayorder(): ?int
    {
        return $this->displayorder;
    }

    /**
     * @param int|null $displayorder
     */
    public function setDisplayorder(?int $displayorder): void
    {
        $this->displayorder = $displayorder;
    }

    /**
     * @return string|null
     */
    public function getSpecs(): ?string
    {
        return $this->specs;
    }

    /**
     * @param string|null $specs
     */
    public function setSpecs(?string $specs): void
    {
        $this->specs = $specs;
    }

    /**
     * @return string|null
     */
    public function getSkuid(): ?string
    {
        return $this->skuid;
    }

    /**
     * @param string|null $skuid
     */
    public function setSkuid(?string $skuid): void
    {
        $this->skuid = $skuid;
    }

    /**
     * @return string|null
     */
    public function getGoodssn(): ?string
    {
        return $this->goodssn;
    }

    /**
     * @param string|null $goodssn
     */
    public function setGoodssn(?string $goodssn): void
    {
        $this->goodssn = $goodssn;
    }

    /**
     * @return string|null
     */
    public function getProductsn(): ?string
    {
        return $this->productsn;
    }

    /**
     * @param string|null $productsn
     */
    public function setProductsn(?string $productsn): void
    {
        $this->productsn = $productsn;
    }

    /**
     * @return int|null
     */
    public function getVirtual(): ?int
    {
        return $this->virtual;
    }

    /**
     * @param int|null $virtual
     */
    public function setVirtual(?int $virtual): void
    {
        $this->virtual = $virtual;
    }

    /**
     * @return int|null
     */
    public function getExchangeStock(): ?int
    {
        return $this->exchangeStock;
    }

    /**
     * @param int|null $exchangeStock
     */
    public function setExchangeStock(?int $exchangeStock): void
    {
        $this->exchangeStock = $exchangeStock;
    }

    /**
     * @return string
     */
    public function getExchangePostage(): string
    {
        return $this->exchangePostage;
    }

    /**
     * @param string $exchangePostage
     */
    public function setExchangePostage(string $exchangePostage): void
    {
        $this->exchangePostage = $exchangePostage;
    }

    /**
     * @return string
     */
    public function getPresellprice(): string
    {
        return $this->presellprice;
    }

    /**
     * @param string $presellprice
     */
    public function setPresellprice(string $presellprice): void
    {
        $this->presellprice = $presellprice;
    }

    /**
     * @return int
     */
    public function getDay(): int
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay(int $day): void
    {
        $this->day = $day;
    }

    /**
     * @return string
     */
    public function getAllfullbackprice(): string
    {
        return $this->allfullbackprice;
    }

    /**
     * @param string $allfullbackprice
     */
    public function setAllfullbackprice(string $allfullbackprice): void
    {
        $this->allfullbackprice = $allfullbackprice;
    }

    /**
     * @return string
     */
    public function getFullbackprice(): string
    {
        return $this->fullbackprice;
    }

    /**
     * @param string $fullbackprice
     */
    public function setFullbackprice(string $fullbackprice): void
    {
        $this->fullbackprice = $fullbackprice;
    }

    /**
     * @return string|null
     */
    public function getAllfullbackratio(): ?string
    {
        return $this->allfullbackratio;
    }

    /**
     * @param string|null $allfullbackratio
     */
    public function setAllfullbackratio(?string $allfullbackratio): void
    {
        $this->allfullbackratio = $allfullbackratio;
    }

    /**
     * @return string|null
     */
    public function getFullbackratio(): ?string
    {
        return $this->fullbackratio;
    }

    /**
     * @param string|null $fullbackratio
     */
    public function setFullbackratio(?string $fullbackratio): void
    {
        $this->fullbackratio = $fullbackratio;
    }

    /**
     * @return int
     */
    public function getIsfullback(): int
    {
        return $this->isfullback;
    }

    /**
     * @param int $isfullback
     */
    public function setIsfullback(int $isfullback): void
    {
        $this->isfullback = $isfullback;
    }

    /**
     * @return int
     */
    public function getIslive(): int
    {
        return $this->islive;
    }

    /**
     * @param int $islive
     */
    public function setIslive(int $islive): void
    {
        $this->islive = $islive;
    }

    /**
     * @return string
     */
    public function getLiveprice(): string
    {
        return $this->liveprice;
    }

    /**
     * @param string $liveprice
     */
    public function setLiveprice(string $liveprice): void
    {
        $this->liveprice = $liveprice;
    }

    /**
     * @return string|null
     */
    public function getCycelbuyPeriodic(): ?string
    {
        return $this->cycelbuyPeriodic;
    }

    /**
     * @param string|null $cycelbuyPeriodic
     */
    public function setCycelbuyPeriodic(?string $cycelbuyPeriodic): void
    {
        $this->cycelbuyPeriodic = $cycelbuyPeriodic;
    }

}
