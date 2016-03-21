<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\Points;
use AppBundle\Form\PointsType;

/**
 * Points controller.
 *
 * @Route("/points")
 */
class PointsController extends Controller
{
    /**
     * Lists all Points entities.
     *
     * @Route("/", name="points_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $points = $em->getRepository('AppBundle:Points')->findAll();

        return $this->render('points/index.html.twig', array(
            'points' => $points,
        ));
    }

    /**
     * Creates a new Points entity.
     *
     * @Route("/new", name="points_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $point = new Points();
        $form = $this->createForm('AppBundle\Form\PointsType', $point);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($point);
            $em->flush();

            return $this->redirectToRoute('points_show', array('id' => $point->getId()));
        }

        return $this->render('points/new.html.twig', array(
            'point' => $point,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Points entity.
     *
     * @Route("/{id}", name="points_show")
     * @Method("GET")
     */
    public function showAction(Points $point)
    {
        $deleteForm = $this->createDeleteForm($point);

        return $this->render('points/show.html.twig', array(
            'point' => $point,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Points entity.
     *
     * @Route("/{id}/edit", name="points_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Points $point)
    {
        $deleteForm = $this->createDeleteForm($point);
        $editForm = $this->createForm('AppBundle\Form\PointsType', $point);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($point);
            $em->flush();

            return $this->redirectToRoute('points_edit', array('id' => $point->getId()));
        }

        return $this->render('points/edit.html.twig', array(
            'point' => $point,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Points entity.
     *
     * @Route("/{id}", name="points_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Points $point)
    {
        $form = $this->createDeleteForm($point);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($point);
            $em->flush();
        }

        return $this->redirectToRoute('points_index');
    }

    /**
     * Creates a form to delete a Points entity.
     *
     * @param Points $point The Points entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Points $point)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('points_delete', array('id' => $point->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
