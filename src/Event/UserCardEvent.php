<?php

namespace App\Event;

use Symfony\Component\EventDispatcher\Event;

class UserCardEvent extends Event
{
    private $usercard;

    /**
     * @return mixed
     */
    public function getUsercard()
    {
        return $this->usercard;
    }

    /**
     * @param mixed $usercard
     */
    public function setUsercard($usercard)
    {
        $this->usercard = $usercard;
    }




}