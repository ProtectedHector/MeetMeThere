<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Country;
use Doctrine\ORM\EntityRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class CityRepository extends EntityRepository
{
    /**
     * @param Country $country
     * @return array
     */
    public function getCitiesFromCountry(Country $country) {
        $cities = $this->CreateQueryBuilder("q")
                ->where("q.country = :countryId")
                ->setParameter("countryId", $country->getId())
                ->getQuery()
                ->getResult();

        return $cities;
    }
}