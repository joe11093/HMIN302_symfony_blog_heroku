<?php

namespace App\Controller;

use \DateTime;
use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/post")
 */
class PostController extends AbstractController
{

    // const POSTS_PER_PAGE = 3;

    ///**
    // * @Route("/catalog/page/{page<\d+>}", name="post_index", methods={"GET"})
    // */

     /**
     * @Route("/", name="post_index", methods={"GET"})
     */
    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $em = $this->getDoctrine()->getManager();
        $postRepository = $em->getRepository(Post::class);

        $allPostsQuery = $postRepository->createQueryBuilder('p')
            ->getQuery();

        // Paginate the results of the query
        $posts = $paginator->paginate(
        // Doctrine Query, not results
            $allPostsQuery,
            // Define the page parameter
            $request->query->getInt('page', 1),
            // Items per page
            3
        );

        return $this->render('post/index.html.twig', [
            'posts'=>$posts]);
        /*if ($page === 0)
            $page++;

        return $this->render('post/index.html.twig', [
            'posts' => $this->getDoctrine()
                            ->getRepository(Post::class)
                            ->findMostRecentPosts($page-1, 3),
            'page' => $page
            // 'limit' => self::POSTS_PER_PAGE
            // next offset should be here to create the pagination index
        ]);*/
    }

    /**
     * @Route("/{slug}", name="post_show", methods={"GET"})
     */
    public function show(string $slug): Response
    {
        $post = $this->getDoctrine()
                     ->getRepository(Post::class)
                     ->findOneBy(['slug' => $slug]);

        return $this->render('post/show.html.twig', [
            'post' => $post
        ]);
    }

}
