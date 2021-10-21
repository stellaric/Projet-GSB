<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class AccueilController extends AbstractController
{
    
    public function index(): Response
    {
        return $this->render('accueil/v_accueil.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
    public function diriger() : Response
    {
        return $this -> render('visiteur/v_connexion.html.twig', [
            'controller_name' => 'AccueilController',
        
        ]);
        
    
    }
    
    public function aller(): Response
    {
        return $this -> render('visiteur/v_menu.html.twig', [
            'controller_name' => 'AccueilController',
        
        ]);    
    }

    public function Serendre() :Response
    {
        return $this -> render('comptable/v_connexion.html.twig', [
            'controller_name' => 'AccueilController',
        
        ]); 
    }
}
