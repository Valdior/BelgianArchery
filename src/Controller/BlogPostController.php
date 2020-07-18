<?php

namespace App\Controller;

use App\Entity\BlogPost;
use App\Repository\BlogPostRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/blog")
 */
class BlogPostController extends AbstractController
{
    /**
     * @Route("/", name="blog_index", methods={"GET"})
     */
    public function index(BlogPostRepository $repo): Response
    {
        $max = 5;
        $posts = $repo->lastNews($max);

        return $this->render('blog/index.html.twig', [
            'current_menu' => 'blog',
            'posts' => $posts,
        ]);
    }

    /**
     * @Route("/{slug}", name="blog_show", methods={"GET"})
     */
    public function show(BlogPost $post): Response
    {
        return $this->render('blog/show.html.twig', [
            'current_menu' => 'blog',
            'post' => $post,
        ]);
    }

    /**
     * @Route("/lastNews", name="blog_lastnews", methods="GET")
     */
    public function lastNews($max = 5, BlogPostRepository $repo): Response
    {
        $posts = $repo->lastNews($max);

        return $this->render('blog/_lastNews.html.twig', [
            'posts' => $posts,
        ]);
    }
}
