<?php

/**
 * evento actions.
 *
 * @package    taxi
 * @subpackage evento
 * @author     Brus
 */
class eventoActions extends sfActions
{
  // public function executeIndex(sfWebRequest $request)
  // {
  //   $this->eventos = EventoPeer::doSelect(new Criteria());
  // }

  // public function executeShow(sfWebRequest $request)
  // {
  //   $this->evento = EventoPeer::retrieveByPk($request->getParameter('id'));
  //   $this->forward404Unless($this->evento);
  // }

  // public function executeNew(sfWebRequest $request)
  // {
  //   $this->form = new eventoForm();
  // }

  // public function executeCreate(sfWebRequest $request)
  // {
  //   $this->forward404Unless($request->isMethod(sfRequest::POST));

  //   $this->form = new eventoForm();

  //   $this->processForm($request, $this->form);

  //   $this->setTemplate('new');
  // }

  // public function executeEdit(sfWebRequest $request)
  // {
  //   $this->forward404Unless($evento = EventoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object evento does not exist (%s).', $request->getParameter('id')));
  //   $this->form = new eventoForm($evento);
  // }

  // public function executeUpdate(sfWebRequest $request)
  // {
  //   $this->forward404Unless($request->isMethod(sfRequest::POST) || $request->isMethod(sfRequest::PUT));
  //   $this->forward404Unless($evento = EventoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object evento does not exist (%s).', $request->getParameter('id')));
  //   $this->form = new eventoForm($evento);

  //   $this->processForm($request, $this->form);

  //   $this->setTemplate('edit');
  // }

  // public function executeDelete(sfWebRequest $request)
  // {
  //   $request->checkCSRFProtection();

  //   $this->forward404Unless($evento = EventoPeer::retrieveByPk($request->getParameter('id')), sprintf('Object evento does not exist (%s).', $request->getParameter('id')));
  //   $evento->delete();

  //   $this->redirect('evento/index');
  // }

  // protected function processForm(sfWebRequest $request, sfForm $form)
  // {
  //   $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
  //   if ($form->isValid())
  //   {
  //     $evento = $form->save();

  //     $this->redirect('evento/edit?id='.$evento->getId());
  //   }
  // }
}
