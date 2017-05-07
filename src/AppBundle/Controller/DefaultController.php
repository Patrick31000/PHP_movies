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
     * @Route("/movies", name="movies")
     */
    public function indexAction(Request $request)
    {
      $film=$this->getDoctrine()->getRepository('AppBundle:movies');
      $films=$film->findAll();
        // replace this example code with whatever you need
      return $this->render('/list.html.twig', array(
        'movies' => $films,
        ));

    }  
     /**
     * @Route("/admin", name="admin")
     */
     public function adminAction(Request $request)
     {
      $film=$this->getDoctrine()->getRepository('AppBundle:movies');
      $films=$film->findAll();
        // replace this example code with whatever you need
      return $this->render('admin/list.html.twig', array(
        'movies' => $films,
        ));
    }
/**
    * Matches /movie_edit/*
    *
    * @Route("/movie_edit/{slug}", name="movie_edit")
    */
public function editAction($slug, Request $request)
{
  $movies = $this->getDoctrine()
  ->getRepository('AppBundle:movies')
  ->find($slug);
  if (!$movies) {
    throw $this->createNotFoundException(
      'No todo found for id '.$slug
      );
  }
  $form = $this->createFormBuilder($movies)
  ->add('title', TextType::class)
  ->add('summary', TextType::class)
  ->add('director', TextType::class)
  ->add('save', SubmitType::class, array('label' => 'Modify movies'))
  ->getForm();
  $form->handleRequest($request);
  if ($form->isSubmitted() && $form->isValid()) {
    $em = $this->getDoctrine()->getManager();
    $em->flush();
    return $this->redirectToRoute('admin');
  }
  return $this->render('./admin/form.html.twig', array(
    'form' => $form->createView(),
    ));
}
 /**
    * Matches /movie_delete/*
    *
    * @Route("/movie_delete/{slug}", name="movie_delete")
    */
 public function deleteAction($slug)
 {
  $movies = $this->getDoctrine()
  ->getRepository('AppBundle:movies')
  ->find($slug);
  if (!$movies) {
    throw $this->createNotFoundException(
      'No movie found for id '.$slug
      );
  }
  $em = $this->getDoctrine()->getManager();
  $em->remove($movies);
  $em->flush();
  return $this->redirectToRoute('admin');
}
}
