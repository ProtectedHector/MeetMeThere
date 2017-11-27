<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="city")
 */
class City
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
     * @var Country
     *
     * Many Cities belong to One Country
     * @ORM\ManyToOne(targetEntity="Country", cascade="persist")
     */
    protected $country;

    /**
     * @var TripCityRelation
     *
     * @ORM\OneToMany(targetEntity="TripCityRelation", mappedBy="city")
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
     * @return City
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
     * @return City
     */
    public function setName(string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Country
     */
    public function getCountry(): Country
    {
        return $this->country;
    }

    /**
     * @param Country $country
     *
     * @return City
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;
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
     * @return City
     */
    public function setTripCityRelation(TripCityRelation $tripCityRelation)
    {
        $this->tripCityRelation = $tripCityRelation;
        return $this;
    }
}