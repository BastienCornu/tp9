<?php

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route(path="/admin")
 */
class AdminController extends Controller
{
    /**
     * @Route(
     *     path="/",
     *     name="admin_index"
     * )
     */
    public function indexdAction()
    {
        return $this->render('Admin/index.html.twig');
    }
}
