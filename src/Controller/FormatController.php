<?php

namespace App\Controller;

use App\Entity\Format;
use App\Repository\FormatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormatController extends AbstractController
{
    #[Route('/format', name: 'app_format')]
    public function index(FormatRepository $format): Response // on va chercher FormatRepository et on crée la variable $format
    {
        return $this->render('format/format.html.twig', [
            'title' => 'Les formats disponibles',
            'formats'=>$format->findAll(), // on peut du coup réutiliser format 
        ]);
    }


    #[Route('/format/{name}', name: 'app_format_show')]
    public function show(Format $format): Response // on va chercher la classe et on crée la variable $format
    {
        return $this->render('format/show.html.twig', [
            'title' => 'le format :',
            'format'=>$format, // on peut du coup réutiliser format 
        ]);
    }



    #[Route('/format/delete/{name}', name: 'app_format_delete')]
    public function delete(
        Format $format,
        EntityManagerInterface $em 
    ): Response
    {
        $em->remove($format);
        $em->flush();
        return $this -> redirectToRoute('app_format');
    
    }
}
