<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;  
use AppBundle\Entity\movies;


class DefaultController extends Controller
{
    /**
     * @Route("/admin")
     */
    public function adminAction(Request $request)
    {
      $film=$this->getDoctrine()->getRepository('AppBundle:movies');
      $films=$film->findAll();
        // replace this example code with whatever you need
      return $this->render('list.html.twig', array(
        'movies' => $films,
        ));
    }


    /**
     * @Route("/movies")
     */
    public function indexAction(Request $request)
    {
      $film=$this->getDoctrine()->getRepository('AppBundle:movies');
      $films=$film->findAll();
        // replace this example code with whatever you need
      return $this->render('list.html.twig', array(
        'movies' => $films,
        ));
    }

    public function editAction($slug, Request $request)
    {
      $movies = $this->getDoctrine()
      ->getRepository('AppBundle:movies')
      ->find($slug);
      if (!$todo) {
        throw $this->createNotFoundException(
          'No todo found for id '.$slug
          );
      }
      $form = $this->createFormBuilder($movies)
      ->add('title', TextType::class)
      ->add('summary', TextType::class)
      
      ->add('director', TextType::class)
      ->add('release_date', TextType::class)
      ->add('poster', TextType::class)
      ->add('save', SubmitType::class, array('label' => 'Modify movies'))
      ->getForm();
      $form->handleRequest($request);
      if ($form->isSubmitted() && $form->isValid()) {
        $em = $this->getDoctrine()->getManager();
        $em->flush();
        return $this->redirectToRoute('movies');
      }
      return $this->render('movies/form.html.twig', array(
        'form' => $form->createView(),
        ));
    }
    /**
    * Matches /todo_delete/*
    *
    * @Route("/todo_delete/{slug}", name="todo_delete")
    */
  }
