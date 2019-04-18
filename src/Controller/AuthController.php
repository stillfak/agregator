<?php

namespace App\Controller;

use App\Security\UserAuthAuthenticator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Guard\GuardAuthenticatorHandler;

class AuthController extends AbstractController
{
    /**
     * @Rest\Get("/api/auth/user", name="users")
     * @param UserAuthAuthenticator $authenticator
     * @param GuardAuthenticatorHandler $guardHandler
     * @param Request $request
     * @return null|\Symfony\Component\HttpFoundation\Response
     */
    public function register(UserAuthAuthenticator $authenticator, GuardAuthenticatorHandler $guardHandler, Request $request)
    {
        // ...

        // after validating the user and saving them to the database
        // authenticate the user and use onAuthenticationSuccess on the authenticator
        return $guardHandler->authenticateUserAndHandleSuccess(
            $user,          // the User object you just created
            $request,
            $authenticator, // authenticator whose onAuthenticationSuccess you want to use
            'main'          // the name of your firewall in security.yaml
        );
    }
}
