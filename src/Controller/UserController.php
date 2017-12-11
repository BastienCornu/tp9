<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/user")
 */
class UserController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="user_index"
     * )
     */
    public function indexdAction()
    {
        return $this->render('User/index.html.twig');
    }
}
