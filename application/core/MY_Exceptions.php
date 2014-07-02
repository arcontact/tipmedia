<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Exceptions extends CI_Exceptions {

	public function show_404($page = '', $log_error = FALSE) {
		include APPPATH . 'config/routes.php';
		if (!empty($route['404_override'])) {
			$CI = &get_instance();
			$CI->router->class = 'error';
			$CI->template->build('layouts/error/e404', $CI->data);
			echo $CI->output->get_output();
			exit;
		} else {
			$heading = "Błąd 404, nie znaleziono strony.";
			$message = "Przepraszamy, ale strona której szukasz jest niedostępna.";
			echo $this->show_error($heading, $message, 'error_404', 404);
			exit;
		}
	}
}
