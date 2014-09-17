<?php

namespace Controllers;

use Controllers\BaseController;
use Input;
use View;
use Redirect;
use Authority;
use Mail;
use Repositories\Interfaces\MessageInterface;
use Repositories\Errors\Exceptions\NotAllowedException as NotAllowedException;
use Repositories\Errors\Exceptions\ValidationException as ValidationException;
use Repositories\Errors\Exceptions\NotFoundException as NotFoundException;

class MessagesController extends BaseController {

	protected $message;

	/**
	 * The layout that should be used for responses.
	 */
	//protected $layout = 'messages.layouts.main';

	/**
	 * We will use Laravel's dependency injection to auto-magically
	 * "inject" our repository instance into our controller
	 */
	public function __construct(MessageInterface $message){
		$this->message = $message;
	}

	/**
	 * Send a newly created message as email
	 *
	 * @return Response
	 */
	public function send(){
		$receivers = array('matriz@lojuz.com', 'cu@lojuz.com', 'reforma@lojuz.com', 'usa@lojuz.com');
		$input = Input::all();
		//var_dump($input);
		//$person = PersonInterface::findByEmail($input['person']['email']);
		try{
			//$message = $this->message->validation(array_merge($input, array('recaptcha_response_field' => isset( $input['recaptcha_response_field'] ) ? $input['recaptcha_response_field'] : '' )));
			$message = $this->message->validation($input);
			if( $message ){
				//Mail::pretend();
				Mail::send('emails.notification', array('input' => $input), function($email) use ($input, $receivers){
					$email
						->from( $input['email'], $input['name'] )
						->to( isset( $receivers[$input['attendant']] ) ? $receivers[$input['attendant']] : $receivers[0], 'Atención a clientes' )
						->subject( 'Notificación de mensaje de contacto (lojuz.com)' );
				});
				return Redirect::to('contact')->with('success', 'Tu mensaje ha sido enviado exitosamente.');
			}
			return Redirect::to('contact')->with('error', 'Ha sucedido un problema al enviar tu mensaje, por favor intentalo nuevamente mas tarde, o escribenos a matriz@lojuz.com. Muchas gracias.');
		}
		catch(ValidationException $e){
			return Redirect::to('contact')->with('error', 'Los datos provistos no son correctos')->withInput()->withErrors($e->getErrors());
		}
	}

}