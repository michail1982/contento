<?php
Class Account extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
	}

	function login()
	{
		$this->load->library('form_validation');
		$this->form_validation->set_rules('identity','', 'trim|required');
		$this->form_validation->set_rules('password','', 'trim|required');
		$this->form_validation->set_rules('remember','','trim');
		if($this->form_validation->run()) {
			$user = $this->user_model->get('identity', $this->input->post('identity'));
			if ($user) {
				if ($this->user_model->check_password($this->input->post('password'), $user['password'])) {
					$this->auth->login($user['id'], $this->input->post('remember'));
					redirect($this->input->get('return'));
				} else {
					$this->messages->add('Неверный пароль','danger');
				}
			} else {
				$this->messages->add('Пользователь не найден','danger');
			}
		} else {
			$this->messages->add($this->form_validation->error_string(' ', ' '),'danger');
		}
		$this->_render('account/login');
	}

	function logout()
	{
		$this->auth->logout();
		redirect('account/login');
	}


}