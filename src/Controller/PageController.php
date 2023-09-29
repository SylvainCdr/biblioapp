<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\BookRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'app_page')]
    public function index(BookRepository $books): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'Page',
            'books'=> $books->findBy(
                [], // WHERE ..
                ['year'=>'DESC'], // Ordonner par ..
                10 // Limité à .. 
            ),
        ]);
    }

    #[Route('/contact', name: 'app_contact', methods: ['GET', 'POST'])]
    public function contact(
        ContactType $form,
        Request $request,
        MailerInterface $mailer
        ): Response
    {
       
        $form = $this->createForm(ContactType::class);
        // on réceptionne les données du formulaire avec request
        $form->handleRequest($request);
        // si le formulaire est soumis et valide alors
        if($form->isSubmitted() && $form->isValid()) {

       // on récupère les données du formulaire pour les mettre dans le mail
       $name = $form->get('name')->getData();
       $email = $form->get('email')->getData();
       $objet = $form->get('objet')->getData();
       $message = $form->get('message')->getData();
       
    //    dd($name, $email, $objet, $message);


    
        // on instancie le nouveau mail
        $mail = (new Email())
        //On paramètre le mail
        ->from($email)
        ->to('biblioapp@gmail.com')
        ->priority(Email::PRIORITY_HIGH)
        ->subject($objet)
        ->html(
            '<div> Vous avez reçu le message suivant de ' . $name . '. <br> Contenu :<br>' . $message .'</div>');
        //On envoie le mail
        $mailer->send($mail);
        // On affiche un msg de confirmation
        $this->addFlash('success', 'Votre message a bien été envoyé !');
    }

        return $this->render('page/contact.html.twig', [ 
            'contact' => $form,
        ]);
    }
}
