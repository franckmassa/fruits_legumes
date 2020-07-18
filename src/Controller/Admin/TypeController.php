<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Csrf\CsrfToken;

class TypeController extends AbstractController
{
    /**
     * @Route("/admin/type", name="admin_types")
     */
    public function index(TypeRepository $repo)
    {
        $types = $repo->findAll();
        return $this->render('admin/type/adminType.html.twig', [
            "types" => $types
        ]);
            
    }

    /**
     * @route("/admin/type/create", name="ajoutType")
     * @Route("/admin/type/{id}", name="modifType", methods="POST|GET")
     */
    public function ajout(Type $type = null, Request $request, EntityManagerInterface $entityManager )
    {
        // Si il n'y a pas de type (null), on instancie un nouvel objet
        if(!$type){
            $type = new Type();
        }

        // Si il y a un type, on récupère les valeurs dans les champs afin de pouvoir les modifier
        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $entityManager->persist($type);
            $entityManager->flush();
            $this->addFlash('success', "L'action a bien été réalisée");
            return $this->redirectToRoute("admin_types");
        }

        return $this->render('admin/type/ajoutEtModif.html.twig', [
            "type" => $type,
            "form" => $form->createView()
        ]);     
    }

     /**
     * @Route("/admin/type/{id}", name="supTypes", methods="delete")
     */
    public function suppression(Type $type, Request $request, EntityManagerInterface $entityManager)
    {
        // On compare l'information générée par le serveur à l'information qu'on va récupérer depuis le client
       if($this->isCsrfTokenValid('SUP' .$type->getId(), $request->get('_token'))){
           $entityManager->remove($type);
           $entityManager->flush();
           $this->addFlash('success', "L'action a bien été réalisée");
           return $this->redirectToRoute("admin_types");
       }
            
    }
}
