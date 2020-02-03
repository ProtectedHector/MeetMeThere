<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="country")
 */
class Country
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
     * @var string
     *
     * @ORM\Column(type="string", length=2)
     */
    protected $iso3166Alpha2;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     */
    protected $iso3166Alpha3;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=3)
     */
    protected $iso3166Numeric3;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Country
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getIso3166Alpha2()
    {
        return $this->iso3166Alpha2;
    }

    /**
     * @param string $iso3166Alpha2
     *
     * @return Country
     */
    public function setIso3166Alpha2($iso3166Alpha2)
    {
        $this->iso3166Alpha2 = $iso3166Alpha2;
        return $this;
    }

    /**
     * @return string
     */
    public function getIso3166Alpha3()
    {
        return $this->iso3166Alpha3;
    }

    /**
     * @param string $iso3166Alpha3
     *
     * @return Country
     */
    public function setIso3166Alpha3($iso3166Alpha3)
    {
        $this->iso3166Alpha3 = $iso3166Alpha3;
        return $this;
    }

    /**
     * @return string
     */
    public function getIso3166Numeric3()
    {
        return $this->iso3166Numeric3;
    }

    /**
     * @param string $iso3166Numeric3
     *
     * @return Country
     */
    public function setIso3166Numeric3($iso3166Numeric3)
    {
        $this->iso3166Numeric3 = $iso3166Numeric3;
        return $this;
    }


}