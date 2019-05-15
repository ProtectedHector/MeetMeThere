<?php

namespace AppBundle\Form;

use AppBundle\Entity\City;
use AppBundle\Entity\Country;
use AppBundle\Entity\Trip;
use AppBundle\Entity\TripCityRelation;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TripType extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Remove the dependent select from the original buildForm as this will be
        // dynamically added later and the trigger as well
        $builder
            ->add('name', TextType::class, [
                'attr' => array('class' => 'form-control'),
                'label' => 'Name of your trip'
            ])
            ->add('from', DateType::class, [
//                'attr' => array('class' => 'form-control js-datepicker'),
                'widget' => 'single_text',
                'html5' => false // do not render as type="date", to avoid HTML5 date pickers
            ])
            ->add('to', DateType::class, [
//                'attr' => array('class' => 'form-control js-datepicker'),
                'widget' => 'single_text',
                'html5' => false // do not render as type="date", to avoid HTML5 date pickers
            ])
            ->add('confirmed', CheckboxType::class, ['attr' => array('class' => 'form-control')])
            //->add('city', TripCityRelation::class, ['attr' => array('class' => 'form-control')])
            ->add('photo', FileType::class, array('label' => 'Photo'))
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success pull-right'
                ]
            ]);

        // Add 2 event listeners for the form
        $builder->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'));
        $builder->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmit'));
    }

    public function addElements(FormInterface $form, Country $country = null)
    {
        $repoCountry = $this->em->getRepository('AppBundle:Country');
        $countries = $repoCountry->findAll();

        // Add the country element
        $form->add('country', EntityType::class, array(
            'required' => true,
//            'data' => $countries,
            'placeholder' => 'Select a country...',
            'class' => 'AppBundle\Entity\Country',
            'query_builder' => function ($repoCountry) {
                return $repoCountry->createQueryBuilder('c')
                    ->orderBy('c.name', 'ASC');
            },
        ));

        // Cities empty, unless there is a selected Country (Edit View)
        $cities = array();

        // If there is a country stored in the Trip entity, load the cities of it
        if ($country) {
            // Fetch Cities of the Country if there's a selected country
            $repoCity = $this->em->getRepository('AppBundle:City');

            $cities = $repoCity->getCitiesFromCountry($country);
        }

        // Add the Cities field with the properly data
        $form->add('city', EntityType::class, array(
            'required' => true,
            'placeholder' => 'Select a Country first ...',
            'class' => 'AppBundle\Entity\City',
            'choices' => $cities
        ));
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        $data = $event->getData();

        // Search for selected Country and convert it into an Entity
        $country = $this->em->getRepository('AppBundle:Country')->findAll();

        $this->addElements($form, $country);
    }

    function onPreSetData(FormEvent $event) {
        $trip = $event->getData();
        $form = $event->getForm();

        // When you create a new person, the City is always empty
        $country = $trip ? ($trip->getCountry() ? $trip->getCountry() : null) : null;

        $this->addElements($form, $country);
//        $this->addElements($form, null);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trip::class
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_trip';
    }
}