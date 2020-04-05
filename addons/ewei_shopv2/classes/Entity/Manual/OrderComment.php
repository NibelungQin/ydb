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
 * OrderComment
 * @Table(name="ims_ewei_shop_order_comment",
 *      indexes={
 *          @Index(name="idx_createtime", columns={"createtime"}),
 *          @Index(name="idx_goodsid", columns={"goodsid"}),
 *          @Index(name="idx_openid", columns={"openid"}),
 *          @Index(name="idx_orderid", columns={"orderid"}),
 *          @Index(name="idx_uniacid", columns={"uniacid"})})
 * @Entity
 */
class OrderComment
{
    public const TABLE_NAME = 'ims_ewei_shop_order_comment';

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
     * @var int|null
     *
     * @Column(name="level", type="smallint", nullable=true)
     */
    private $level = '0';

    /**
     * @var string|null
     *
     * @Column(name="content", type="string", length=255, nullable=true)
     */
    private $content = '';

    /**
     * @var string|null
     *
     * @Column(name="images", type="text", length=65535, nullable=true)
     */
    private $images;

    /**
     * @var int|null
     *
     * @Column(name="createtime", type="integer", nullable=true)
     */
    private $createtime = '0';

    /**
     * @var int|null
     *
     * @Column(name="deleted", type="smallint", nullable=true)
     */
    private $deleted = '0';

    /**
     * @var string|null
     *
     * @Column(name="append_content", type="string", length=255, nullable=true)
     */
    private $appendContent = '';

    /**
     * @var string|null
     *
     * @Column(name="append_images", type="text", length=65535, nullable=true)
     */
    private $appendImages;

    /**
     * @var string|null
     *
     * @Column(name="reply_content", type="string", length=255, nullable=true)
     */
    private $replyContent = '';

    /**
     * @var string|null
     *
     * @Column(name="reply_images", type="text", length=65535, nullable=true)
     */
    private $replyImages;

    /**
     * @var string|null
     *
     * @Column(name="append_reply_content", type="string", length=255, nullable=true)
     */
    private $appendReplyContent = '';

    /**
     * @var string|null
     *
     * @Column(name="append_reply_images", type="text", length=65535, nullable=true)
     */
    private $appendReplyImages;

    /**
     * @var int|null
     *
     * @Column(name="istop", type="smallint", nullable=true)
     */
    private $istop = '0';

    /**
     * @var int
     *
     * @Column(name="checked", type="smallint", nullable=false)
     */
    private $checked = '0';

    /**
     * @var int
     *
     * @Column(name="replychecked", type="smallint", nullable=false)
     */
    private $replychecked = '0';

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
     * @return int|null
     */
    public function getLevel(): ?int
    {
        return $this->level;
    }

    /**
     * @param int|null $level
     */
    public function setLevel(?int $level): void
    {
        $this->level = $level;
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
     * @return string|null
     */
    public function getImages(): ?string
    {
        return $this->images;
    }

    /**
     * @param string|null $images
     */
    public function setImages(?string $images): void
    {
        $this->images = $images;
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

    /**
     * @return int|null
     */
    public function getDeleted(): ?int
    {
        return $this->deleted;
    }

    /**
     * @param int|null $deleted
     */
    public function setDeleted(?int $deleted): void
    {
        $this->deleted = $deleted;
    }

    /**
     * @return string|null
     */
    public function getAppendContent(): ?string
    {
        return $this->appendContent;
    }

    /**
     * @param string|null $appendContent
     */
    public function setAppendContent(?string $appendContent): void
    {
        $this->appendContent = $appendContent;
    }

    /**
     * @return string|null
     */
    public function getAppendImages(): ?string
    {
        return $this->appendImages;
    }

    /**
     * @param string|null $appendImages
     */
    public function setAppendImages(?string $appendImages): void
    {
        $this->appendImages = $appendImages;
    }

    /**
     * @return string|null
     */
    public function getReplyContent(): ?string
    {
        return $this->replyContent;
    }

    /**
     * @param string|null $replyContent
     */
    public function setReplyContent(?string $replyContent): void
    {
        $this->replyContent = $replyContent;
    }

    /**
     * @return string|null
     */
    public function getReplyImages(): ?string
    {
        return $this->replyImages;
    }

    /**
     * @param string|null $replyImages
     */
    public function setReplyImages(?string $replyImages): void
    {
        $this->replyImages = $replyImages;
    }

    /**
     * @return string|null
     */
    public function getAppendReplyContent(): ?string
    {
        return $this->appendReplyContent;
    }

    /**
     * @param string|null $appendReplyContent
     */
    public function setAppendReplyContent(?string $appendReplyContent): void
    {
        $this->appendReplyContent = $appendReplyContent;
    }

    /**
     * @return string|null
     */
    public function getAppendReplyImages(): ?string
    {
        return $this->appendReplyImages;
    }

    /**
     * @param string|null $appendReplyImages
     */
    public function setAppendReplyImages(?string $appendReplyImages): void
    {
        $this->appendReplyImages = $appendReplyImages;
    }

    /**
     * @return int|null
     */
    public function getIstop(): ?int
    {
        return $this->istop;
    }

    /**
     * @param int|null $istop
     */
    public function setIstop(?int $istop): void
    {
        $this->istop = $istop;
    }

    /**
     * @return int
     */
    public function getChecked(): int
    {
        return $this->checked;
    }

    /**
     * @param int $checked
     */
    public function setChecked(int $checked): void
    {
        $this->checked = $checked;
    }

    /**
     * @return int
     */
    public function getReplychecked(): int
    {
        return $this->replychecked;
    }

    /**
     * @param int $replychecked
     */
    public function setReplychecked(int $replychecked): void
    {
        $this->replychecked = $replychecked;
    }

}
