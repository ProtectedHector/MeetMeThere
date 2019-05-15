<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Trip;
use AppBundle\Form\TripType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TripController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('', array('name' => $name));
    }

    /**
     * @Route(
     *     "trip/add",
     *     name = "add_trip"
     * )
     * @param Request $request
     * @return Response
     */
    public function addAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(TripType::class);
        $form->handleRequest($request);

        return $this->render('AppBundle:Trip:add.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(
     *     "trip/get-neighborhoods-from-city",
     *     name = "trip_list_cities"
     * )
     * Returns a JSON string with the cities of the Country with the provided id.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function listCitiesOfCountryAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $repoCity = $em->getRepository("AppBundle:City");

        // Search the cities that belongs to the country with the given id as GET parameter "countryid"
        $country = $em->getRepository('AppBundle:Country')->find($request->query->get("countryid"));
        $cities = $repoCity->getCitiesFromCountry($country);

        // Serialize into an array the data that we need, in this case only name and id
        // Note: you can use a serializer as well, for explanation purposes, we'll do it manually
        $responseArray = array();
        foreach($cities as $city){
            $responseArray[] = array(
                "id" => $city->getId(),
                "name" => $city->getName()
            );
        }

        // Return array with structure of the cities of the provided country id
        return new JsonResponse($responseArray);

        // e.g
        // [{"id":"3","name":"Treasure Island"},{"id":"4","name":"Presidio of San Francisco"}]
    }

}
