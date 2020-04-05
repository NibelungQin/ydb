<?php
declare(strict_types=1);

namespace Ydb\Entity\Manual\Engine;


use Doctrine\ORM\Mapping as ORM;

/**
 * ImsUniAccount
 *
 * @ORM\Table(name="ims_uni_account")
 * @ORM\Entity
 */
class UniAccount
{
    public const TABLE_NAME = 'ims_uni_account';

    /**
     * @var int
     *
     * @ORM\Column(name="uniacid", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $uniacid;

    /**
     * @var int
     *
     * @ORM\Column(name="groupid", type="integer", nullable=false)
     */
    private $groupid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255, nullable=false)
     */
    private $description;

    /**
     * @var int
     *
     * @ORM\Column(name="default_acid", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $defaultAcid;

    /**
     * @var int|null
     *
     * @ORM\Column(name="rank", type="integer", nullable=true)
     */
    private $rank;

    /**
     * @var string
     *
     * @ORM\Column(name="title_initial", type="string", length=1, nullable=false)
     */
    private $titleInitial;


}
