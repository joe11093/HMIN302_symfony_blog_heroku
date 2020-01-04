<?php

namespace App\Controller;

use \DateTime;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/post")
 */
class AdminPostController extends AbstractController
{
  /**
   * @Route("/new", name="post_new", methods={"GET","POST"})
   */
  public function new(Request $request): Response
  {
      $post = new Post();
      $form = $this->createForm(PostType::class, $post);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $post->setPublicationDate(new \DateTime());

          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($post);
          $entityManager->flush();

          return $this->redirectToRoute('post_index', ['page' => 1]);
      }

      return $this->render('admin/post/new.html.twig', [
          'post' => $post,
          'form' => $form->createView()
      ]);
  }

  /**
   * @Route("/{slug}/edit", name="post_edit", methods={"GET","POST"})
   */
  public function edit(Request $request, string $slug): Response
  {
      $post = $this->getDoctrine()
                   ->getRepository(Post::class)
                   ->findOneBy(['slug' => $slug]);

      $form = $this->createForm(PostType::class, $post);
      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
          $this->getDoctrine()->getManager()->flush();

          return $this->redirectToRoute('post_index', ['page' => 1]);
      }

      return $this->render('admin/post/edit.html.twig', [
          'post' => $post,
          'form' => $form->createView()
      ]);
  }

  /**
   * @Route("/{slug}/delete", name="post_delete", methods={"DELETE"})
   */
  public function delete(Request $request, string $slug): Response
  {
      $post = $this->getDoctrine()
                   ->getRepository(Post::class)
                   ->findOneBy(['slug' => $slug]);

      if ($this->isCsrfTokenValid('delete'.$post->getSlug(), $request->request->get('_token'))) {
          $entityManager = $this->getDoctrine()->getManager();
          $entityManager->remove($post);
          $entityManager->flush();
      }

      return $this->redirectToRoute('post_index', ['page' => 1]);
  }
}
