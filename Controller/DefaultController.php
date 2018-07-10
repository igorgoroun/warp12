<?php

namespace snakemkua\Warp12Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('Warp12Bundle:Admin:login.html.twig');
    }

    public function renderSideBarMenuAction() {
        $allmodules = $this->getModulesList();
        $modules = [];
        foreach ($allmodules as $uin => $rec) {
            if ((array_key_exists('menuvisible', $rec) and $rec['menuvisible']) or !isset($rec['menuvisible'])) {
                $modules[$uin] = $rec;
            }
        }

        return $this->render('@Warp12/Admin/sidebar.html.twig', [
            'menulist' => $modules,
        ]);
    }

    public function getModulesList() {
        $menulist = $this->getParameter('warp12.modules');
        return $menulist;
    }
}
