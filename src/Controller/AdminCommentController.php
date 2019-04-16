<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Service\Paginator;
use App\Form\AdminCommentType;
use App\Repository\CommentRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminCommentController extends AbstractController
{
    /**
     * @Route("/admin/comments/{page<\d+>?1}", name="admin_comment_index")
     */
    public function index(CommentRepository $repo, $page, Paginator $paginator)
    {
        $paginator->setEntityClass(Comment::class)
                  ->setPage($page)
                  ->setLimit(5);

        return $this->render('admin/comment/index.html.twig', [
           'paginator' => $paginator
        ]);

    }

    /**
     * Edit an Comment
     * 
     * @Route("/admin/comments/{id}/edit", name="admin_comment_edit")
     *
     * @param Comment $comment
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function edit(Comment $comment, Request $request, ObjectManager $manager){
        $form = $this->createForm(AdminCommentType::class, $comment);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($comment);
            $manager->flush();

            $this->addFlash(
                'success',
                "Le commentaire n°{$comment->getId()} a bien été modifié !"
            );

        }


        return $this->render('admin/comment/edit.html.twig', [
            'comment' => $comment,
            'form' => $form->createView()
        ]);
    }

    /**
     * Delete an Comment
     * 
     * @Route("/admin/comments/{id}/delete", name="admin_comment_delete")
     *
     * @param Comment $comment
     * @param Request $request
     * @param ObjectManager $manager
     * @return Response
     */
    public function delete(Comment $comment, Request $request, ObjectManager $manager){
        
        $manager->remove($comment);
        $manager->flush();

        $this->addFlash(
                'success',
                "Le commentaire de {$comment->getAuthor()->getFullName()} a bien été supprimé !"
            );
        
        return $this->redirectToRoute('admin_comment_index');
    }
}
