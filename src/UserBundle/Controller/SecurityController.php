<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction()
    {
        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('oc_platform_accueil');
        }

        $authenticationUtils = $this->get('security.authentication_utils');

        return $this->render('UserBundle:Security:login.html.twig', [
            'lastUsername' => $authenticationUtils->getLastUsername(),
            'error'        => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }

    /**
     * @Route("/login/check", name="login_check")
     */
    public function loginCheckAction()
    {
        return $this->render('UserBundle:Security:login.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
        return $this->render('UserBundle:Security:login.html.twig', array(
            // ...
        ));
    }
}
