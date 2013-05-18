<?php

/**
 * home actions.
 *
 * @package    taxi
 * @subpackage home
 * @author     Brus
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class homeActions extends sfActions {

    /**
     * Executes index action
     *
     * @param sfRequest $request A request object
     */
    public function executeIndex(sfWebRequest $request) {

        // Se chequea si el request llegó por AJAX.
        if ($request->isXmlHttpRequest()) {
            // Si el request llegó por AJAX es probable que sea porque, al realizarse
            // un pedido de un diálogo expiró la sesión y fue forwardeado por symfony
            // a esta acción (ver config/settings.yml)
            if (!$this->getUser()->isAuthenticated()) {
                // Si el usuario no se encuentra autenticado se devuelve un status code
                // 401 Unauthorized con la dirección para que js redireccione.
                $response = $this->getResponse();
                $response->setStatusCode(401, $this->getController()->genUrl('home/index', TRUE));
                
                // Se devuelve la respuesta sin contenido para hacerla más liviana.
                return $this->renderText('');
            }
        }
        
    }

    public function executeMail(sfWebRequest $request){

        $this->getMailer()->composeAndSend(
          'brunovierag@hotmail.com',
          'brunovierag@gmail.com',
          'Asunto',
          'Cuerpo'
        );

        $this->getMailer()->composeAndSend(
          'brunovierag@gmail.com',
          'brunovierag@hotmail.com',
          'Asunto',
          'Cuerpo'
        );
    }

}
