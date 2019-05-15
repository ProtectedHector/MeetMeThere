<?php


namespace AppBundle\Repository;


use Doctrine\ORM\EntityRepository;

class CountryRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->findBy(array(), array('name' => 'ASC'));
    }
}