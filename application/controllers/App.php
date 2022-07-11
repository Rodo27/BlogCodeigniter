<?php

	class App extends MY_Controller{

		public function __construct(){
			parent::__construct();

			$this->load->helper(array("url","form","post","category","text","date"));
			$this->load->library(array("parser","form_validation"));

			$this->load->database();
			$this->load->model('post_model', 'Post');
			$this->load->model('category_model', 'Category');
		}
	
		public function login(){	
			$view["body"] = $this->load->view("app/login", NULL, TRUE);
			$this->parser->parse("admin/template/body_login", $view);
			//$view["body"]
		}

		public function ajax_login(){
			if( $this->input->is_ajax_request()){
				
				// Allow this page to be an accepted login page
				$this->config->set_item('allowed_pages_for_login', ['app/ajax_login'] );

				// Make sure we aren't redirecting after a successful login
				$this->authentication->redirect_after_login = FALSE;

				// Do the login attempt
				$this->auth_data = $this->authentication->user_status( 0 );

				// Set user variables if successful login
				if( $this->auth_data )
					$this->_set_user_variables();

				// Call the post auth hook
				$this->post_auth_hook();
				
				// Login attempt was successful
				if( $this->auth_data ){
					echo json_encode([
						'status'   => 1,
						'user_id'  => $this->auth_user_id,
						'username' => $this->auth_username,
						'level'    => $this->auth_level,
						'role'     => $this->auth_role,
						'email'    => $this->auth_email
					]);
				}
				else{	// Login attempt not successful

					$this->tokens->name = config_item('login_token_name');

					$on_hold = ( 
						$this->authentication->on_hold === TRUE OR 
						$this->authentication->current_hold_status()
					)
					? 1 : 0;

					echo json_encode([
						'status'  => 0,
						'count'   => $this->authentication->login_errors_count,
						'on_hold' => $on_hold, 
						'token'   => $this->tokens->token()
					]);
				}
			}
			else // Show 404 if not AJAX
				show_404();
		}

		public function logout(){
			$this->authentication->logout();

			// Set redirect protocol
			$redirect_protocol = USE_SSL ? 'https' : NULL;

			redirect( site_url( LOGIN_PAGE . '?' . AUTH_LOGOUT_PARAM . '=1', $redirect_protocol ) );
		}
	}