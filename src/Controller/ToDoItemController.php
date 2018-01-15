<?php

namespace App\Controller;

use App\Entity\ToDoItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ToDoItemController extends Controller
{
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => 'stoos'));
    }

    /**
     * @Route("/stood", name="to_do_item")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);
        $list = $repository->findAll();
        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => $list));
    }

    /**
     * @Route("/stood/{text}")
     */
    public function create($text)
    {

        $em = $this->getDoctrine()->getManager();

        $todo = new ToDoItem();
        $todo->setStood($text);
        $todo->setCompleted(false);

        $em->persist($todo);
        $em->flush();

        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => 'created'));
    }

    /**
     * @Route("/stood/completed/{id}")
     */
    public function completed($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);

        $todo = $repository->find($id);
        $todo->setCompleted(true);

        $em->persist($todo);
        $em->flush();

        $list = $repository->findAll();
        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => $list));
    }

    /**
     * @Route("/stood/not-completed/{id}")
     */
    public function not_completed($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);

        $todo = $repository->find($id);
        $todo->setCompleted(false);

        $em->persist($todo);
        $em->flush();

        $list = $repository->findAll();
        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => $list));
    }


}


