<?php

namespace App\Subscribers;

use App\Event\AppEvent;
use App\Event\UserCardEvent;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserCardSubscriber implements EventSubscriberInterface
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
            AppEvent::ADD => 'add',
            AppEvent::EDIT => 'edit',
            AppEvent::DELETE => 'delete'
        );
    }

    public function add(UserCardEvent $userCardEvent){
        $usercard = $userCardEvent->getUsercard();
        $this->em->persist($usercard);
        $this->em->flush();
    }

    public function edit(){

    }

    public function delete(){

    }
}