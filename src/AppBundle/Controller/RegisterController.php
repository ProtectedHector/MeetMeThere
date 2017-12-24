<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Traveler;
use AppBundle\Form\TravelerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends Controller
{
    /**
     * @Route("/register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @return Response
     */
    public function registerAction(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $em = $this->getDoctrine()->getManager();

        $traveler = new Traveler();

        $form = $this->createForm(TravelerType::class, $traveler);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $traveler->setPassword($passwordEncoder->encodePassword($traveler, $traveler->getPassword()));
            $em->persist($traveler);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('AppBundle:Register:register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
