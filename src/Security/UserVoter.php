<?php

namespace App\Security;

use App\AppAccess;
use App\Entity\User;
use App\Entity\UserCard;

use Symfony\Component\Security\Core\Authorization\AccessDecisionManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{

    const USER_CAN_VIEW = 'user_can_view';

    protected function supports($attribute, $subject)
    {
        if(!$subject instanceof User){
            return false;
        }

        if($attribute !== self::USER_CAN_VIEW){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        return $subject === $token->getUser();
    }
}