<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Security\UserVoter;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use App\Entity\UserCard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoder;

/**
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="app_user_index"
     * )
     */
    public function indexdAction(AuthorizationCheckerInterface $authorizationChecker)
    {
        if($authorizationChecker->isGranted('ROLE_ADMIN')){

            $userCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findAll();

        }else{
            $userCards = $this->getDoctrine()->getManager()->getRepository(UserCard::class)->findBy(["user" => $this->getUser()]);
        }

        return $this->render('User/index.html.twig', ["userCards" => $userCards]);
    }

    /**
     * @Route(
     *     path="/register",
     *     name="app_user_new"
     * )
     */
    public function newAction(Request $request, EntityManagerInterface $em, UserPasswordEncoder $encoder){

        $form = $this->createForm(UserType::class);

        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $user = $form->getData();
            /** @var User $user */
            $user->setPassword($encoder->encodePassword($user, $user->getPassword()));

            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("app_user_index");
        }
        return $this->render('User/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(
     *     path="/edit",
     *     name="app_user_edit"
     * )
     */
    public function editMeAction(Request $request, EntityManagerInterface $em){

        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            /** @var User $user */
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("app_user_index");
        }
        return $this->render('User/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route(
     *     path="/edit/{id}",
     *     name="app_user_edit_all"
     * )
     */
    public function editAllAction(Request $request, EntityManagerInterface $em, User $user){


        $this->denyAccessUnlessGranted(UserVoter::USER_CAN_VIEW, $user);
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            /** @var User $user */
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute("app_user_index");
        }
        return $this->render('User/edit.html.twig', ['form' => $form->createView()]);
    }
}
