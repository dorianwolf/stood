<?php

namespace App\Controller;

use App\Entity\ToDoItem;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;

class ToDoItemController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);
        $list = $repository->findAll();

        $stood = new ToDoItem();

        $form = $this->createFormBuilder($stood)
            ->add('stood', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $stood = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($stood);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->render('todo/show.html.twig', array('title' => 'sup', 'stood' => $list, 'form' => $form->createView()));
    }

    /**
     * @Route("/stood")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);
        $list = $repository->findAll();

        $stood = new ToDoItem();

        $form = $this->createFormBuilder($stood)
            ->add('stood', TextType::class)
            ->add('completed', TextType::class)
            ->add('save', SubmitType::class, array('label' => 'Add'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $stood = $form->getData();

            $em = $this->getDoctrine()->getManager();
            $em->persist($stood);
            $em->flush();

            return $this->redirect($request->getUri());
        }

        return $this->redirectToRoute('home');
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
     * @Route("/stood/completed/{id}", name="completed")
     */
    public function completed($id)
    {
        $em = $this->getDoctrine()->getManager();
        $repository = $this->getDoctrine()->getRepository(ToDoItem::class);

        $todo = $repository->find($id);
        $todo->setCompleted(true);

        $em->persist($todo);
        $em->flush();

        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/stood/not-completed/{id}", name="not_completed")
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
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/stood/delete/{id}", name="delete")
     */
    public function delete($id)
    {
        $em = $this->getDoctrine()->getManager();

        if(!$id)
        {
            throw $this->createNotFoundException('No ID found');
        }

        $todo = $this->getDoctrine()->getRepository(ToDoItem::class)->Find($id);

        if($todo != null)
        {
            $em->remove($todo);
            $em->flush();
        }

        return $this->redirectToRoute('home');
    }


}


