<?php

namespace App\Controller;

use App\Entity\Invite;
use App\Form\InviteType;
use App\Repository\InviteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @Route("/post", name="post")
 */

class PostController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(InviteRepository $inviteRepository, UserInterface $user): Response
    {
        $userId = $user->getId();

        $qb = $inviteRepository->findByExampleField ($userId);
         /*$qb = $this->createQueryBui ('invite');
         $qb->select('invite.title')
            ->where('invite.profilename_id = :user')
            ->getQuery();*/
//        dump($qb);
//        echo'<pre>';
//            print_r($qb);
//        exit('sggffff');

//        $invites = $inviteRepository->findAll();
//        dump($invites);

        return $this->render('post/index.html.twig', [
            'invites' => $qb,
        ]);
    }



    /**
     * @Route("/create", name="create")
     * @param Request $request
     * @return Response
     */

    public function create(Request $request){
        $invite = new Invite();


        $form = $this->createForm(InviteType::class, $invite);
        $form->handleRequest($request);

        if($form->isSubmitted()){
            $em = $this->getDoctrine()->getManager();
            $title = $request->get('invite')['title'];

            if($title){
                $em->persist($invite);
                $em->flush();
            }
            $this->addFlash('success', 'Post was created');

            return $this->redirectToRoute('postindex', [ ]);
        }

        return $this->render('post/create.html.twig', [ 'form' => $form->createView() ]);



//        //entity manager
//        $em = $this->getDoctrine()->getManager();
//        $em->persist($invite);
//        $em->flush();
//
//        return $this->redirect($this->generateUrl('postindex'));
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function remove(Invite $invite){
//        dump($invite); die;
        $em = $this->getDoctrine()->getManager();
        $em->remove($invite);
        $em->flush();

        $this->addFlash('success', 'Invitation was canceled');

        return $this->redirect($this->generateUrl('postindex'));
    }


}
