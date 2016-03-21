<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Race;
use AppBundle\Form\RaceType;

/**
 * Race controller.
 *
 * @Route("/race")
 */
class RaceController extends Controller
{
    public function importAction() {

    }

    /**
     * Lists all Race entities.
     *
     * @Route("/", name="race_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $races = $em->getRepository('AppBundle:Race')->findAll();

        return $this->render('race/index.html.twig', array(
            'races' => $races,
        ));
    }

    /**
     * Creates a new Race entity.
     *
     * @Route("/new", name="race_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $race = new Race();
        $form = $this->createForm('AppBundle\Form\RaceType', $race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($race);
            $em->flush();

            return $this->redirectToRoute('race_show', array('id' => $race->getId()));
        }

        return $this->render('race/new.html.twig', array(
            'race' => $race,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Race entity.
     *
     * @Route("/{id}", name="race_show")
     * @Method("GET")
     */
    public function showAction(Race $race)
    {
        $deleteForm = $this->createDeleteForm($race);

        return $this->render('race/show.html.twig', array(
            'race' => $race,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Race entity.
     *
     * @Route("/{id}/edit", name="race_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Race $race)
    {
        $deleteForm = $this->createDeleteForm($race);
        $editForm = $this->createForm('AppBundle\Form\RaceType', $race);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($race);
            $em->flush();

            return $this->redirectToRoute('race_edit', array('id' => $race->getId()));
        }

        return $this->render('race/edit.html.twig', array(
            'race' => $race,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Race entity.
     *
     * @Route("/{id}", name="race_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Race $race)
    {
        $form = $this->createDeleteForm($race);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($race);
            $em->flush();
        }

        return $this->redirectToRoute('race_index');
    }

    /**
     * Creates a form to delete a Race entity.
     *
     * @param Race $race The Race entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Race $race)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('race_delete', array('id' => $race->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
