<?php
/**
 * Created by PhpStorm.
 * User: dorianthornton
 * Date: 2018-01-11
 * Time: 7:53 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends AbstractController
{

    /**
     * @Route("blog/{title}")
     */

    public function show($title)
    {
        $comments = array('sup', 'cool', $title);
        return $this->render('todo/show.html.twig', array('title' => $title, 'stood' => $comments[0]));
    }

}
