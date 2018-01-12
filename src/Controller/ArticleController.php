<?php
/**
 * Created by PhpStorm.
 * User: dorianthornton
 * Date: 2018-01-11
 * Time: 7:53 PM
 */

namespace App\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class ArticleController
{
    /**
     * @Route("/")
     */

    public function homepage()
    {
        return new Response('sup');
    }

    /**
     * @Route("blog/{slug}")
     */

    public function show($slug)
    {
        return new Response(sprintf(
            'here is some content: %s',
            $slug
        ));
    }

}
