<?php

namespace App\Controller;


use App\Entity\Card;
use App\Event\AppEvent;
use App\Event\UserCardEvent;
use App\Form\UserCardType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/usercard")
 */
class UserCardController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="usercard_index"
     * )
     */
    public function indexdAction()
    {
        $usercards = $this->getDoctrine()->getRepository(\App\Entity\UserCard::class)->findOneBy(array('user' => $this->getUser()));
        return $this->render('UserCard/index.html.twig', ['usercards' => $usercards]);
    }

    /**
     * @Route(
     *     path="/add/{id}",
     *     name="usercard_add"
     * )
     */
    public function addAction(Request $request, Card $card)
    {
        $usercard = $this->get(\App\Entity\UserCard::class);

        $form = $this->createForm(UserCardType::class,$usercard, ['card' => $card]);
        $form->handleRequest($request);
        if($form->isValid() && $form->isSubmitted()){
            $usercardEvent = $this->get(\App\Event\UserCardEvent::class);
            $usercardEvent->setUserCard($usercard);

            $dispatcher = $this->get('event_dispatcher');
            $dispatcher->dispatch(AppEvent::ADD, $usercardEvent);
            return $this->redirectToRoute("usercard_index");
        }
        return $this->render('UserCard/add.html.twig' , ['form' => $form->createView(),]);
    }


}
