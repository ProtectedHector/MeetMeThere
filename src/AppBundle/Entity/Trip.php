<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity()
 * @ORM\Table(name="trip")
 */
class Trip
{
    /**
     * @var integer
     *
     * @ORM\Id()
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue()
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var Date
     *
     * @ORM\Column(type="date")
     */
    protected $fromDate;

    /**
     * @var Date
     *
     * @ORM\Column(type="date")
     */
    protected $toDate;

    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean")
     */
    protected $confirmed;

    /**
     * @var Traveler
     *
     * @ORM\ManyToOne(targetEntity="Traveler", cascade="persist")
     */
    protected $traveler;
}