<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\Date;

/**
 * @ORM\Entity()
 * @ORM\Table(name="trip_city")
 */
class TripCityRelation
{
    /**
     * @var Trip
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="Trip", inversedBy="tripCityRelation", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $trip;

    /**
     * @var City
     *
     * @ORM\Id()
     * @ORM\ManyToOne(targetEntity="City", inversedBy="tripCityRelation", cascade="persist")
     * @ORM\JoinColumn(nullable=false)
     */
    protected $city;

    /**
     * @var Date
     */
    protected $fromDate;

    /**
     * @var Date
     */
    protected $toDate;

    /**
     * @return Trip
     */
    public function getTrip(): Trip
    {
        return $this->trip;
    }

    /**
     * @param Trip $trip
     *
     * @return TripCityRelation
     */
    public function setTrip(Trip $trip)
    {
        $this->trip = $trip;
        return $this;
    }

    /**
     * @return City
     */
    public function getCity(): City
    {
        return $this->city;
    }

    /**
     * @param City $city
     *
     * @return TripCityRelation
     */
    public function setCity(City $city)
    {
        $this->city = $city;
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
     * @return TripCityRelation
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
     * @return TripCityRelation
     */
    public function setToDate(Date $toDate)
    {
        $this->toDate = $toDate;
        return $this;
    }
}