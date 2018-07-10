<?php

namespace snakemkua\Warp12Bundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use snakemkua\Warp12Bundle\Entity\Menuitem;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UIMenuController extends Controller
{
    public function getRootMenu()
    {
        $em = $this->getDoctrine()->getManager();
        $tree = $em->getRepository('Warp12Bundle:Page');
        $pages = $tree->findBy(['published' => true, 'parent' => NULL], ['sortPriority' => 'ASC']);
        $list = new ArrayCollection();
        foreach ($pages as $page) {
            $slug = $em->getRepository('Warp12Bundle:Slug')->findOneBy(['consumer'=>$page->getId(), 'current'=>true]);
            if ($slug) {
                $menuitem = new Menuitem();
                $menuitem->setName($page->getName());
                $menuitem->setRoute('seo_url');
                $menuitem->setSlug($slug->getUrl());
                $list->add($menuitem);
            }
        }
        return $list;
    }
}
