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
 * GoodsComment
 *
 * @Table(name="ims_ewei_shop_goods_comment",
 *      indexes={
 *          @Index(name="idx_uniacid", columns={"uniacid"}),
 *          @Index(name="idx_openid", columns={"openid"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"}),
 *          @Index(name="idx_createtime", columns={"createtime"})})
 * @Entity
 */
class GoodsComment
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
     * @Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid = '';

    /**
     * @var string|null
     *
     * @Column(name="nickname", type="string", length=50, nullable=true)
     */
    private $nickname = '';

    /**
     * @var string|null
     *
     * @Column(name="headimgurl", type="string", length=255, nullable=true)
     */
    private $headimgurl = '';

    /**
     * @var string|null
     *
     * @Column(name="content", type="string", length=255, nullable=true)
     */
    private $content = '';

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
     * @return string|null
     */
    public function getNickname(): ?string
    {
        return $this->nickname;
    }

    /**
     * @param string|null $nickname
     */
    public function setNickname(?string $nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return string|null
     */
    public function getHeadimgurl(): ?string
    {
        return $this->headimgurl;
    }

    /**
     * @param string|null $headimgurl
     */
    public function setHeadimgurl(?string $headimgurl): void
    {
        $this->headimgurl = $headimgurl;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
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
