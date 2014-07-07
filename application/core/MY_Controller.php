<?php
/**
 * @property Auth $auth
 * @property User_model $user_model
 * @property Messages $messages
 * @property Assets $assets
 * @property Zen $zen
 * @author Michail Maksarov
 *
 */
Class MY_Controller extends CI_Controller
{
	public $view = null;
	public $layout = null;
	protected $data = array();

	function __construct()
	{
		parent::__construct();
		if ($this->auth->loggedin()) {
			$id = $this->auth->userid();
			$this->data['user'] = $this->user_model->get('id', $id);
		} else {
			if ($this->router->fetch_class()=='account' && $this->router->fetch_method()=='login') {
				//echo 'Login action';
			} else {
				if($this->input->is_ajax_request()) {
					show_error('Войдите в аккаунт', 401,'Требуется авторизация');
				} else {
					$this->messages->add('Требуется авторизация', 'warning');
					$uri = urlencode($_SERVER['REQUEST_URI']);
					redirect('account/login?return='.$uri);
				}
			}
		}
		$this->output->enable_profiler(!$this->input->is_ajax_request()&&$this->config->item('enable_profiler'));
	}

	/**
	 * Render Full page
	 * @param string $view
	 * @param string $data
	 * @param boolean $return
	 */
	protected function _render($view = null, $data = null, $return = false)
	{
		if(!empty($data)) {
			$this->load->vars($data);
		}
		if(empty($view)) {
			if(empty($this->view)) {
				if($this->router->fetch_class()==$this->router->fetch_module()) {
					$view = $this->router->fetch_class().'/'.$this->router->fetch_class().'/'.$this->router->fetch_method();
				} else {
					$view = $this->router->fetch_class().'/'.$this->router->fetch_method();
				}

			} else {
				$view = $this->view;
			}
		}

		$this->data['messages'] = $this->messages->get();

		if($this->layout===false || $this->input->is_ajax_request()) {
			return $this->load->view($view, $this->data, $return);
		} elseif(empty($this->layout)) {
			$layout = 'default';
		} else {
			$layout = $this->layout;
		}
		$this->data['yield'] = $this->load->view($view, $this->data, true);
		return $this->load->view('_layouts/'.$layout, $this->data, $return);
	}

}
