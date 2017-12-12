<?php


namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Security\User\UserLoaderInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class TravelerRepository extends EntityRepository implements UserLoaderInterface
{
    /**
     * @param string $username
     *
     * @return UserInterface|null
     */
    public function loadUserByUsername($username)
    {
        $user = $this->createQueryBuilder('t')
            ->where('t.username = :username OR t.email = :email')
            ->setParameter('username', $username)
            ->setParameter('email', $username)
            ->getQuery()
            ->getOneOrNullResult();

        return $user;
    }
}