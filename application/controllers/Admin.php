<?php

	class Admin extends MY_Controller{

		public function __construct(){
			parent::__construct();

			$this->load->library(array("form_validation","grocery_CRUD"));
			$this->load->helper(array("form","category"));
			
			/*
				$this->load->database();
				$this->load->model('post_model', 'Post');
				$this->load->model('category_model', 'Category');
				$this->load->model('user_model', 'User');
			*/


			$this->init_seccion_auto(9);
		}
	
		public function index(){	
			//$this->load->view("admin/test");
			redirect('admin/post_list');
		}

		public function user_crud(){

			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('users');
			$crud->set_subject('User');
			$crud->where('auth_level', 9);
			
			//$crud->required_fields('city');

			$state = $crud->getState(); // return status by grocery crud

			$crud->columns('username','email','avatar');
			
			if($state == "edit" || $state == "update" || $state == "update_validation"){
				$crud->fields('auth_level','created_at','user_id','avatar');
			}
			
			else{
				$crud->fields('auth_level','created_at','user_id','username','email','passwd','avatar');
				$crud->set_rules('email', 'Email', 'required|valid_email|is_unique['.config_item('user_table').'.email]');
				$crud->set_rules('username', 'Username', 'required|max_length[50]|is_unique['.config_item('user_table').'.username]');
				$crud->set_rules('passwd', 'Password', 'required|min_length[8]|max_length[72]|callback_validate_passwd');
			}
		
			$crud->callback_before_insert(array($this, 'user_before_insert_callback'));
			$crud->callback_after_upload(array($this, 'user_after_upload_callback'));
			
			$crud->display_as('passwd', 'Password');
			$crud->display_as('username', 'User');
			//$crud->display_as('created_at', 'Date');

			$crud->field_type('auth_level', 'hidden');
			$crud->field_type('created_at', 'hidden');
			$crud->field_type('user_id', 'hidden');
			$crud->field_type('passwd', 'password');
			$crud->set_field_upload('avatar', 'files/user','png|jpg|jpeg');


			//$crud->set_rules('name', 'Name', 'required|min_length[10]|max_length[100]');
			$crud->unset_jquery();
			$crud->unset_clone();
			$crud->unset_read();
			//$crud->unset_edit();
			$crud->unset_export();
			$crud->unset_print();


			$output = $crud->render();

			$view["grocery_crud"] =  json_encode($output);

			$view["title"] = "Users";
			$this->parser->parse("admin/template/body", $view);
		}

		public function post_list(){	
			//$data["posts"] =  $this->Post->findAll();
			//$view["body"] = $this->load->view("admin/post/list", $data, TRUE);
			
			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('post');
			$crud->set_subject('Post');
			//$crud->required_fields('city');
			$crud->columns('title','description','created_at','image','posted');

			$crud->callback_before_insert(array($this, 'category_iu_before_callback'));
			$crud->callback_before_update(array($this, 'category_iu_before_callback'));

			$crud->unset_jquery();
			$crud->unset_clone();
			$crud->unset_read();
			$crud->unset_add();
			$crud->unset_edit();
			$crud->unset_export();
			$crud->unset_print();

			$crud->add_action('Editar','','admin/post_save','ui-icon-pencil');
			//$crud->add_action('Editar','','admin/post_save','edit-icon'); use this when no set theme

			$output = $crud->render();

			$view["grocery_crud"] =  json_encode($output);

			$view["title"] = "Posts";
			$this->parser->parse("admin/template/body", $view);
		}

		public function post_save($post_id = null){

			if(empty($post_id)){
				// Make a Post
				$data['title'] = $data['content'] = $data['description'] = $data['posted'] = $data['url_clean'] = $data['image'] = $data['category_id'] = "";
				$view["title"] = "Make Post";
			}else{
				// Update a Post
				$post = $this->Post->find($post_id);

				if(!isset($post)){
					show_404();
				}
				
				$data['title'] = $post->title; 
				$data['content'] = $post->content;
				$data['description'] = $post->description;
				$data['posted'] =  $post->posted;
				$data['url_clean'] = $post->url_clean;
				$data['image'] = $post->image;
				$data['category_id'] = $post->category_id;

				$view["title"] = "Update Post";
			}
			
			// Get all list categories using our Category helper
			$data['categories'] = categories_to_form($this->Category->findAll()); 

			if($this->input->server('REQUEST_METHOD') == "POST"){

				$this->form_validation->set_rules('title', 'title', 'required|min_length[10]|max_length[50]');
				$this->form_validation->set_rules('content', 'content', 'required|min_length[10]');
				$this->form_validation->set_rules('description', 'description', 'max_length[100]');
				$this->form_validation->set_rules('posted', 'posted', 'required');

				$data['title'] = $this->input->post('title'); 
				$data['content'] = $this->input->post('content');
				$data['description'] = $this->input->post('description');
				$data['posted'] =  $this->input->post('posted');
				$data['url_clean'] = $this->input->post('url_clean');
				$data['upload'] = $this->input->post('upload');

				if($this->form_validation->run()){

					$url_clean  = empty($this->input->post('url_clean')) ? $this->input->post('title') : 
						$this->input->post('url_clean');

					// Validated
					$save = array(
						"title" => $this->input->post('title'),
						"content" => $this->input->post('content'),
						"description" => $this->input->post('description'),
						"posted" => $this->input->post('posted'),
						"url_clean" => clean_name($url_clean),
						"category_id" => $this->input->post('category_id')
					);

					if(empty($post_id)){
						$post_id =$this->Post->insert($save);
					}else{
						$this->Post->update($post_id, $save);
					}
					
					$this->upload($post_id, $this->input->post('title'));

					redirect("admin/post_save/$post_id");

				}else{
					//echo validation_errors();
					echo '';
				}
			}

			$data["data_posted"] = posted();
			$view["body"] = $this->load->view("admin/post/save", $data, TRUE);
			
			$this->parser->parse("admin/template/body", $view);
		}

		public function post_delete($post_id = null){
			if($post_id == null){
				echo FALSE;
			}else{
				$this->Post->delete($post_id);
				echo TRUE;
			}
		}

		function images_server(){
			$data["images"] = all_images();
			var_dump($data);
			//$this->load->view("admin/post/image", $data);
		}


		public function upload($post_id = null, $title = null){

			$image = "upload";

			if(!empty($title))
				$title = clean_name($title);
			// configurations to load



			$config['upload_path'] = 'files/post';
			if(!empty($title))
				$config['file_name'] = $title;
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size'] = 1000;
			//$config['max_width'] = 1024;
			//$config['max_height'] = 768;
			$config['overwrite'] = TRUE;

			// load library
			$this->load->library('upload', $config);

			if($this->upload->do_upload($image)){
				
				$data = $this->upload->data();
				if($title != null ){

					$save = array(
						"image" => $title . $data["file_ext"]
					);

					$this->Post->update($post_id, $save);
				}else{
					$title = $data["file_name"];
					echo json_encode(array("filename" =>$title, "uploaded" => 1, "url" => "/". PROJECT_FOLDER . "/files/post/" . $title));
				}
				$this->resize_image($data["full_path"]);
			}else{
				$error = array('error' => $this->upload->display_errors());

                //$this->load->view('upload_form', $error);

                var_dump($error);
			}

		}

		function resize_image($path){
			$config['image_library'] = 'gd2';
			$config['source_image'] = $path;
			//$config['create_thumb'] = TRUE;
			$config['maintain_ratio'] = TRUE;
			$config['width'] = 500;
			$config['height'] = 500;

			$this->load->library('image_lib', $config);

			$this->image_lib->resize();
		}


		/* CRUD FOR CATEGORY*/


		public function category_list(){	
			//$data["categories"] =  $this->Category->findAll();
			//$view["body"] = $this->load->view("admin/category/list", $data, TRUE);

			$crud = new grocery_CRUD();

			$crud->set_theme('datatables');
			$crud->set_table('category');
			$crud->set_subject('Category');
			//$crud->required_fields('city');
			$crud->columns('category_id','name','url_clean');

			$crud->callback_before_insert(array($this, 'category_iu_before_callback'));
			$crud->callback_before_update(array($this, 'category_iu_before_callback'));

			$crud->set_rules('name', 'Name', 'required|min_length[10]|max_length[100]');

			$crud->unset_jquery();
			$crud->unset_clone();
			$crud->unset_read();

			$output = $crud->render();

			//$this->_example_output($output);

			$view["grocery_crud"] =  json_encode($output);
			$view["title"] = "Categories";

			$this->parser->parse("admin/template/body", $view);
		}

		public function category_save($category_id = null){

			if(empty($category_id)){
				// Make a Category
				$data['name'] = $data['url_clean'] = "";
				$view["title"] = "Make Category";
			}else{
				// Update a Category
				$category = $this->Category->find($category_id);
				
				$data['name'] = $category->name; 
				$data['url_clean'] = $category->url_clean;
			
				$view["title"] = "Update Category";
			}
	
			if($this->input->server('REQUEST_METHOD') == "POST"){

				$this->form_validation->set_rules('name', 'name', 'required|min_length[10]|max_length[100]');

				$data['name'] = $this->input->post('name'); 
				$data['url_clean'] = $this->input->post('url_clean');

				if($this->form_validation->run()){

					$url_clean  = empty($this->input->post('url_clean')) ? $this->input->post('name') : 
						$this->input->post('url_clean');

					// Validated
					$save = array(
						"name" => $this->input->post('name'),
						"url_clean" => clean_name($url_clean)
					);

					if(empty($category_id))
						$category_id =$this->Category->insert($save);
					else
						$this->Category->update($category_id, $save);

				}else{
					//echo validation_errors();
					echo '';
				}
			}

			$view["body"] = $this->load->view("admin/category/save", $data, TRUE);
			
			$this->parser->parse("admin/template/body", $view);
		}

		public function category_delete($category_id = null){
			if($category_id == null)
				echo FALSE;
			else{
				$this->Category->delete($category_id);
				echo TRUE;
			}
		}

		// CALLBACKS

		function category_iu_before_callback($post_array, $pk = null){

			$post_array['url_clean']  = ($post_array['url_clean']) == "" ? clean_name($post_array['name']) :
				$post_array['url_clean'];

			return $post_array;

		}

		function user_before_insert_callback($post_array){
			$post_array['passwd'] = $this->authentication->hash_passwd($post_array['passwd']);
			$post_array['user_id'] = $this->User->get_unused_id();
			$post_array['created_at'] = date('Y-m-d H:i:s');
			$post_array['auth_level'] = 9;

			return $post_array;
		}

		function user_before_after_upload($uploader_response, $field_info, $files_to_upload){

			$this->load->library('Image_moo');
			$file_uploaded = $field_info->upload_path . '/' . $uploader_response[0]->name;
			$this->image_moo->load($files_uploaded)->resize(500,500)->save($file_uploaded, true); 

			return TRUE;
		}

		// VALIDATION

		function validate_passwd($pass){

			// At least one digit required
			$regex = '(?=.*\d)';

			// At least one lower case letter required
			$regex .= '(?=.*[a-z])';

			// At least one upper case letter required
			$regex .= '(?=.*[A-Z])';

			// No space, tab or other whitespace chars allowed
			$regex .= '(?!.*\s)';

			//No backslash, apostrophe or quote chars are allowed
			$regex .= '(?!.*[\\\\\'"])';

			if(preg_match('/^' . $regex . '.*$/', $pass)){
				return TRUE;
			}		

			return FALSE;	 
		}

	}