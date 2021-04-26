<?php

namespace App\Controller;

use App\Entity\Invite;
use App\Repository\InviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/post", name="post")
 */

class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(InviteRepository $inviteRepository): Response
    {
        $invites = $inviteRepository->findAll();
//        dump($invites);

        return $this->render('post/index.html.twig', [
            'invites' => $invites,
        ]);
    }



    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $invite = new Invite();
        $invite->setTitle('This is going to be an invite title 1');

        //entity manager
        $em = $this->getDoctrine()->getManager();
        $em->persist($invite);
        $em->flush();

        return $this->redirect($this->generateUrl('postindex'));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function remove(Invite $invite){
//        dump($invite); die;
        $em = $this->getDoctrine()->getManager();
        $em->remove($invite);
        $em->flush();

        return $this->redirect($this->generateUrl('postindex'));
    }


}
