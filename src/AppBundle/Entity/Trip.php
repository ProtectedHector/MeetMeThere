<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @var TripCityRelation
     *
     * @ORM\OneToMany(targetEntity="TripCityRelation", mappedBy="trip")
     */
    protected $tripCityRelation;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Trip
     */
    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Trip
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Date
     */
    public function getFromDate(): Date
    {
        return $this->fromDate;
    }

    /**
     * @param Date $fromDate
     *
     * @return Trip
     */
    public function setFromDate(Date $fromDate)
    {
        $this->fromDate = $fromDate;
        return $this;
    }

    /**
     * @return Date
     */
    public function getToDate(): Date
    {
        return $this->toDate;
    }

    /**
     * @param Date $toDate
     *
     * @return Trip
     */
    public function setToDate(Date $toDate)
    {
        $this->toDate = $toDate;
        return $this;
    }

    /**
     * @return bool
     */
    public function isConfirmed(): bool
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     *
     * @return Trip
     */
    public function setConfirmed(bool $confirmed)
    {
        $this->confirmed = $confirmed;
        return $this;
    }

    /**
     * @return Traveler
     */
    public function getTraveler(): Traveler
    {
        return $this->traveler;
    }

    /**
     * @param Traveler $traveler
     *
     * @return Trip
     */
    public function setTraveler(Traveler $traveler)
    {
        $this->traveler = $traveler;
        return $this;
    }

    /**
     * @return TripCityRelation
     */
    public function getTripCityRelation(): TripCityRelation
    {
        return $this->tripCityRelation;
    }

    /**
     * @param TripCityRelation $tripCityRelation
     *
     * @return Trip
     */
    public function setTripCityRelation(TripCityRelation $tripCityRelation)
    {
        $this->tripCityRelation = $tripCityRelation;
        return $this;
    }
}