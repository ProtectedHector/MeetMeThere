<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Collection|Trip[]
     *
     * @ORM\ManyToMany(targetEntity="Trip", mappedBy="trip")
     */
    protected $trips;

    /**
     * Default constructor, initializes collections
     */
    public function __construct()
    {
        $this->trips = new ArrayCollection();
    }

    public function addTrip(Trip $trip)
    {
        if ($this->trips->contains($trip)) {
            return ;
        }

        $this->trips->add($trip);
    }

    public function removeTrip(Trip $trip)
    {
        if (!$this->trips->contains($trip)) {
            return ;
        }

        $this->trips->removeElement($trip);
    }
}