<?php

/**
 * This file is used to input login details in the database for testing
 *
 * To run Fixtures -> bin/console doctrine:fixtures:load
 */

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Traveler;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    private $container;

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new Traveler();
        $user->setUsername('admin');
        $user->setEmail('admin@email.com');

        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, '0000');
        $user->setPassword($password);
        $user->setFirstName('admin');
        $user->setLastName('admin');

        $manager->persist($user);
        $manager->flush();
    }

    /**
     * @param ContainerInterface|null $container
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


}