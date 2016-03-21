<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\RaceMeeting;
use AppBundle\Form\RaceMeetingType;

/**
 * RaceMeeting controller.
 *
 * @Route("/event")
 */
class RaceMeetingController extends Controller
{
    /**
     * Lists all RaceMeeting entities.
     *
     * @Route("/", name="event_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $raceMeetings = $em->getRepository('AppBundle:RaceMeeting')->findAll();

        return $this->render('racemeeting/index.html.twig', array(
            'raceMeetings' => $raceMeetings,
        ));
    }

    /**
     * Creates a new RaceMeeting entity.
     *
     * @Route("/new", name="event_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $raceMeeting = new RaceMeeting();
        $form = $this->createForm('AppBundle\Form\RaceMeetingType', $raceMeeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($raceMeeting);
            $em->flush();

            return $this->redirectToRoute('event_show', array('id' => $raceMeeting->getId()));
        }

        return $this->render('racemeeting/new.html.twig', array(
            'raceMeeting' => $raceMeeting,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a RaceMeeting entity.
     *
     * @Route("/{id}", name="event_show")
     * @Method("GET")
     */
    public function showAction(RaceMeeting $raceMeeting)
    {
        $deleteForm = $this->createDeleteForm($raceMeeting);

        return $this->render('racemeeting/show.html.twig', array(
            'raceMeeting' => $raceMeeting,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing RaceMeeting entity.
     *
     * @Route("/{id}/edit", name="event_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RaceMeeting $raceMeeting)
    {
        $deleteForm = $this->createDeleteForm($raceMeeting);
        $editForm = $this->createForm('AppBundle\Form\RaceMeetingType', $raceMeeting);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($raceMeeting);
            $em->flush();

            return $this->redirectToRoute('event_edit', array('id' => $raceMeeting->getId()));
        }

        return $this->render('racemeeting/edit.html.twig', array(
            'raceMeeting' => $raceMeeting,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a RaceMeeting entity.
     *
     * @Route("/{id}", name="event_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RaceMeeting $raceMeeting)
    {
        $form = $this->createDeleteForm($raceMeeting);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($raceMeeting);
            $em->flush();
        }

        return $this->redirectToRoute('event_index');
    }

    /**
     * Creates a form to delete a RaceMeeting entity.
     *
     * @param RaceMeeting $raceMeeting The RaceMeeting entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RaceMeeting $raceMeeting)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('event_delete', array('id' => $raceMeeting->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
