<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual;

use Doctrine\ORM\Mapping as ORM;

/**
 * ImsEweiShopCreditshopComment
 *
 * @ORM\Table(name="ims_ewei_shop_creditshop_comment")
 * @ORM\Entity
 */
class CreditshopComment
{
    public const TABLE_NAME = 'ims_ewei_shop_creditshop_comment';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false)
     */
    private $uniacid = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="logid", type="integer", nullable=false)
     */
    private $logid = '0';

    /**
     * @var string
     *
     * @ORM\Column(name="logno", type="string", length=50, nullable=false)
     */
    private $logno = '';

    /**
     * @var int
     *
     * @ORM\Column(name="goodsid", type="integer", nullable=false)
     */
    private $goodsid = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="openid", type="string", length=50, nullable=true)
     */
    private $openid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nickname", type="string", length=50, nullable=true)
     */
    private $nickname;

    /**
     * @var string|null
     *
     * @ORM\Column(name="headimg", type="string", length=255, nullable=true)
     */
    private $headimg;

    /**
     * @var bool
     *
     * @ORM\Column(name="level", type="boolean", nullable=false)
     */
    private $level = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=255, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="images", type="text", length=65535, nullable=true)
     */
    private $images;

    /**
     * @var int
     *
     * @ORM\Column(name="time", type="integer", nullable=false)
     */
    private $time = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="reply_content", type="string", length=255, nullable=true)
     */
    private $replyContent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="reply_images", type="text", length=65535, nullable=true)
     */
    private $replyImages;

    /**
     * @var int
     *
     * @ORM\Column(name="reply_time", type="integer", nullable=false)
     */
    private $replyTime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="append_content", type="string", length=255, nullable=true)
     */
    private $appendContent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="append_images", type="text", length=65535, nullable=true)
     */
    private $appendImages;

    /**
     * @var int
     *
     * @ORM\Column(name="append_time", type="integer", nullable=false)
     */
    private $appendTime = '0';

    /**
     * @var string|null
     *
     * @ORM\Column(name="append_reply_content", type="string", length=255, nullable=true)
     */
    private $appendReplyContent;

    /**
     * @var string|null
     *
     * @ORM\Column(name="append_reply_images", type="text", length=65535, nullable=true)
     */
    private $appendReplyImages;

    /**
     * @var int
     *
     * @ORM\Column(name="append_reply_time", type="integer", nullable=false)
     */
    private $appendReplyTime = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="istop", type="boolean", nullable=false)
     */
    private $istop = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="checked", type="boolean", nullable=false)
     */
    private $checked = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="append_checked", type="boolean", nullable=false)
     */
    private $appendChecked = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="virtual", type="boolean", nullable=false)
     */
    private $virtual = '0';

    /**
     * @var bool
     *
     * @ORM\Column(name="deleted", type="boolean", nullable=false)
     */
    private $deleted = '0';

    /**
     * @var int
     *
     * @ORM\Column(name="merchid", type="integer", nullable=false)
     */
    private $merchid = '0';


}
