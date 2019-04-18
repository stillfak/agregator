<?php

namespace App\Controller;

use App\Entity\User;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use FOS\RestBundle\Controller\Annotations as Rest;

class UserController extends FOSRestController
{
    /**
     * @Rest\Get("/api/auth/user", name="users")
     */
    public function getAction()
    {
        $repository = $this->getDoctrine()-> getRepository(User::class);
        $users = $repository->findAll();
        return $this-> handleView($this-> view($users));
    }

    /**
     * @Rest\Post("/api/reg/user", name="user")
     * @param Request $request
     * @return Response
     */

    public function createunit(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }
        return $this->handleView($this->view($form->getErrors()));
    }
}
