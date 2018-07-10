<?php

namespace snakemkua\Warp12Bundle\Controller;

use snakemkua\Warp12Bundle\Entity\Admin;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{

    public function dashboardAction(Request $request) {
        return $this->render('@Warp12/Admin/dashboard.html.twig',[
            'warp_current_controller' => __CLASS__
        ]);
    }

    /*
    public function modifyAction(Admin $manager, Request $request) {
        $oldPassPlain = $manager->getPlainPassword();
        $form = $this->createForm(ManagerType::class,$manager);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            if ($manager->getPlainPassword()==null) {
                $manager->setPlainPassword($oldPassPlain);
            }
            $password = $this->get('security.password_encoder')->encodePassword($manager,$manager->getPlainPassword());
            $manager->setPassword($password);
            $em = $this->getDoctrine()->getManager();
            $em->persist($manager);
            $em->flush();
            $this->redirectToRoute('manager_list');
        }

        return $this->render(
            'STOBundle:Manager:form.html.twig',array(
            'form' => $form->createView()
        ));
    }

    public function createAction(Request $request) {
        $man = new Manager();
        //dump($this->getUser());
        $form = $this->createForm(ManagerType::class,$man);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $this->get('security.password_encoder')->encodePassword($man,$man->getPlainPassword());
            $man->setPassword($password);
            $man->setCreated(new \DateTime());
            $man->setUpdated(new \DateTime());
            $man->setUpdatedBy($this->getUser()->getId());
            $em = $this->getDoctrine()->getManager();
            $em->persist($man);
            $em->flush();

            if ($man->getActive()) {
                $this->addFlash('notice', 'Новая учетная запись создана и активирована.');
            } else {
                $this->addFlash('notice', 'Новая учетная запись создана но пока не активна.');
            }
            $this->redirectToRoute('dashboard');
        }
        return $this->render(
            'STOBundle:Manager:form.html.twig',array(
            'form' => $form->createView()
        ));
    }
    */
    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render(
            '@Warp12/Admin/login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
        );
    }

    public function logoutAction() {
        return $this->redirectToRoute('admin_logout');
    }

}
