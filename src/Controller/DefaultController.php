<?php

namespace App\Controller;

use App\Entity\NewRoutine;
use App\Entity\User;
use App\Entity\UserSecurity;
use App\Form\EditRoutineType;
use App\Form\LoginFType;
use App\Form\NewRoutineType;
use App\Form\UserRegType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class DefaultController extends AbstractController
{
    private $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }
    
    public function index()
    {
        return $this->render('index.html.twig');
    }


    public function createUser(Request $request){
            
        $em = $this->doctrine->getManager();

            $users = new User();

            $form = $this->createForm(UserRegType::class, $users);
            $form -> handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $em->persist($users);
                $em->flush();   

                return $this->render('index.html.twig');
            }

        return $this->render('userForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function login(Request $request){

        $em = $this->doctrine->getManager();

        $users = new UserSecurity();

        $form = $this->createForm(LoginFType::class, $users);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
          
            $em->flush();  
            
            $listUsers = $em -> getRepository(User::class)->findBy([] , ['name' => 'ASC']);

            return $this->render('routines.html.twig', [
                'listUsers' => $listUsers
            ]);
        }

    return $this->render('login.html.twig', [
        'form' => $form->createView()
    ]);
    }

    public function newRoutine(Request $request){
        
        $em = $this->doctrine->getManager();

        $routine = new NewRoutine();

        $form = $this->createForm(NewRoutineType::class, $routine);
        $form -> handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($routine);
            $em->flush();   

            return $this->render('index.html.twig');
        }

    return $this->render('newRoutine.html.twig', [
        'form' => $form->createView()
    ]);
    }

    public function editRoutine(Request $request, $id){
        
        $em = $this->doctrine->getManager();

        $userRoutine = $em->getRepository(NewRoutine::class)->find($id);

        $form = $this->createForm(EditRoutineType::class, $userRoutine);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($userRoutine);
            $em->flush();   

            return $this->render('index.html.twig');
        }

        return $this->render('editRoutine.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteRoutine(Request $request, $id){
        
        $em = $this->doctrine->getManager();

        $userRoutine = $em->getRepository(NewRoutine::class)->find($id);

        $em->remove($userRoutine);
        $em->flush();

        return $this->render('index.html.twig');
    }
}
