<?php

namespace snakemkua\Warp12Bundle\Controller;

use snakemkua\Warp12Bundle\Entity\Page;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class RouterController extends Controller
{
    public function routeAction($slug, $_format)
    {
        //$logger = $this->get('logger');
        //$logger->info('SLUG: '.$slug);
        //$logger->info('FORMAT: '.$_format);

        $em = $this->getDoctrine()->getManager();
        $rep = $em->getRepository('Warp12Bundle:Slug');
        $slug_obj = $rep->findOneBy(['url' => $slug]);
        if (!$slug_obj) {
            return $this->route404Action($slug);
        }
        if (!$slug_obj->getCurrent()) {
            $current_slug = $rep->findOneBy(['current'=>true, 'targetId'=>$slug_obj->getTargetId(), 'class'=>$slug_obj->getClass()]);
            if ($current_slug) {
                return $this->redirectToRoute('seo_url', [
                    'slug' => $current_slug->getUrl(),
                ], 301);
            } else {
                // try to find previous class
                $previous_slug = $rep->findOneBy(['current'=>true, 'targetId'=>$slug_obj->getTargetId(), 'class_previous'=>$slug_obj->getClass()]);
                if ($previous_slug) {
                    return $this->redirectToRoute('seo_url', [
                        'slug' => $previous_slug->getUrl(),
                    ], 301);
                } else {
                    return $this->route404Action('undefined.html');
                }
            }
        }

        return $this->render('@Warp12/Default/ui-key.html.twig', array(
            'warp_current_controller' => $slug_obj->getClass(),
        ));
    }

    public function routeMainAction() {
        $em = $this->getDoctrine()->getManager();
        $tree = $em->getRepository('Warp12Bundle:Page');
        $homepage = $tree->findOneBy(['homepage'=>true]);
        if (!$homepage) {
            return $this->route404Action('undefined.html');
        }
        $slug = $em->getRepository('Warp12Bundle:Slug')->findOneBy(['current'=>true, 'consumer'=>$homepage]);
        if (!$slug) {
            return $this->route404Action('undefined.html');
        }
        return $this->redirectToRoute('seo_url', [
            'slug' => $slug->getUrl(),
            '_format' => 'html'
        ], 301);
    }

    public function route404Action($_incorrect) {
        $template = 'Warp12Bundle:Default:404.html.twig';
        $templates = $this->container->getParameter('warp12templates');
        if (array_key_exists('page_404', $templates) && $templates['page_404']) {
            $template = $templates['page_404'];
        }
        return $this->render($template, array('requested_link'=>$_incorrect), new Response('Error 404', 404));
    }
}
