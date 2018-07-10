<?php

namespace snakemkua\Warp12Bundle\Controller;

use snakemkua\Warp12Bundle\Entity\Page;
use snakemkua\Warp12Bundle\Entity\Slug;
use snakemkua\Warp12Bundle\Form\PageType;
use snakemkua\Warp12Bundle\Form\PageContentType;
use snakemkua\Warp12Bundle\WarpModuleInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PageController extends Controller implements WarpModuleInterface
{
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();
        $tree = $em->getRepository('Warp12Bundle:Page');
        //dump($tree->getRootNodes());
        return $this->render('@Warp12/Page/list.html.twig', [
            'pages' => $tree->getRootNodes(),
            'warp_current_controller' => __CLASS__
        ]);
    }

    public function viewContentAction(Page $page) {
        if (!$page) {
            throw new NotFoundHttpException();
        }
        $em = $this->getDoctrine()->getManager();
        $tree = $em->getRepository('Warp12Bundle:Page');
        $pages = $tree->children($page);

        return $this->render('@Warp12/Page/viewContent.html.twig', [
            'page' => $page,
            'warp_current_controller' => __CLASS__,
            'pages' => $pages
        ]);
    }

    public function createAction(Page $parent = NULL, Request $request) {
        $page = new Page();
        $page->setDateCreated(new \DateTime());
        $page->setDateUpdated(new \DateTime());

        if ($parent and $parent instanceof Page) {
            $page->setParent($parent);
        }

        $modules = $this->getParameter('warp12.modules');
        $form = $this->createForm(PageType::class, $page, array(
            'modules_list' => $modules
        ));
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        # check module
        $slug_class = __CLASS__;
        if ($page->getModule() && array_key_exists($page->getModule(), $modules)) {
            $slug_class = $modules[$page->getModule()]['controller'];
        }
        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($page);
            $slug = new Slug();
            $slug->setSrc($page->getTitle());
            $slug->setClass($slug_class);
            $slug->setConsumer($page);
            $slug->setTargetId($page->getId());
            $slug->setDateCreated(new \DateTime());
            $slug->setCurrent(true);
            $em->persist($slug);
            $em->flush();
            return $this->redirectToRoute('warp_page');
        }

        return $this->render('@Warp12/Page/form.html.twig', [
            'form' => $form->createView(),
            'warp_current_controller' => __CLASS__
        ]);
    }

    public function modifyAction(Page $page, Request $request) {
        $modules = $this->getParameter('warp12.modules');
        $form = $this->createForm(PageType::class, $page, array(
            'modules_list' => $modules
        ));
        $em = $this->getDoctrine()->getManager();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $page->setDateUpdated(new \DateTime());
            $em->persist($page);
            # check module
            $slug_class = __CLASS__;
            if ($page->getModule() && array_key_exists($page->getModule(), $modules)) {
                $slug_class = $modules[$page->getModule()]['controller'];
            }
            # update slug
            $current_slug = $em->getRepository('Warp12Bundle:Slug')->findOneBy(['src'=>$page->getTitle(), 'current'=>true, 'consumer'=>$page->getId()]);
            if (!$current_slug) {
                $slug = new Slug();
                $slug->setSrc($page->getTitle());
                $slug->setClass($slug_class);
                $slug->setConsumer($page);
                $slug->setTargetId($page->getId());
                $slug->setDateCreated(new \DateTime());
                $slug->setCurrent(true);
                $em->persist($slug);
                $em->flush();
                $this->get('warp12.slug')->updateCurrent($slug);
            } else {
                if ($current_slug->getClass() != $slug_class) {
                    $current_slug->setClassPrevious($current_slug->getClass());
                }
                $current_slug->setClass($slug_class);
                $em->persist($current_slug);
                $em->flush();
            }
            $em->flush();
            return $this->redirectToRoute('warp_page');
        }
        return $this->render('@Warp12/Page/form.html.twig', [
            'form' => $form->createView(),
            'warp_current_controller' => __CLASS__
        ]);
    }

    public function modifyContentAction(Page $page, Request $request) {

        $form = $this->createForm(PageContentType::class, $page);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $page->setDateUpdated(new \DateTime());
            $em->persist($page);
            $em->flush();
            return $this->redirectToRoute('warp_page');
        }

        return $this->render('@Warp12/Page/modifyContent.html.twig', [
            'form' => $form->createView(),
            'warp_current_controller' => __CLASS__
        ]);
    }

    public function warpDropdownMenu(Request $request)
    {
        $route = $request->attributes->get('_route');
        switch ($route) {
            case 'warp_page_content_view':
                return $this->render('@Warp12/Page/dropmenu_viewContent.html.twig', ['id' => $request->attributes->get('id')]);
                break;
        }
        return $this->render('@Warp12/Page/dropmenu_top.html.twig', []);
    }

    public function warpUIRenderLayout(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $tpl = '@Warp12/Page/ui-page-view.html.twig';
        $templates = $this->container->getParameter('warp12templates');
        if ($templates and array_key_exists('page_default', $templates)) {
            $tpl = $templates['page_default'];
        }
        $page = null;
        if ($request->attributes->get('slug')) {
            $slug = $em->getRepository('Warp12Bundle:Slug')->findOneBy(['url'=>$request->attributes->get('slug'), 'current'=>true]);
            if ($slug and $slug instanceof Slug) {
                $page = $slug->getConsumer();
            }
        }
        return $this->render($tpl, [
            'warp_current_controller' => __CLASS__,
            'page' => $page,
        ]);
    }

    public function warpTopLine(Request $request)
    {
        $state = '';
        $name = '';
        $page = $request->attributes->get('page');
        if ($page and $page instanceof Page) {
            $name = $page->getTitle();
        }

        return $this->render('@Warp12/Page/topline.html.twig', [
            'name' => $name
        ]);
    }
}
