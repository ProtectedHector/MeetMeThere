<?php

namespace App\Controller;

use App\Entity\Traveler;
use App\Form\TravelerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
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
            $file = $traveler->getPhoto();
            $filename = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('profile_pictures_dir'),
                $filename
            );
            $traveler->setPhoto($filename);
            $em->persist($traveler);
            $em->flush();

            return $this->redirectToRoute('login');
        }

        return $this->render('register/register.html.twig', array(
            'form' => $form->createView()
        ));
    }

}
