<div class="row">
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h4><i class="fa fa-cog"></i> Change Password </h4>
			</div>
			<div class="card-body">
				<?php echo form_open('','class="my_form"') ?>
					<div class="form-group">
						<?php echo form_label('Current password','old_passwd') ?>
						<?php $text_input = array('name' => 'old_passwd','id' => 'old_passwd', 'type' => 'password','value' => '', 'minlength' => 8,'maxlength' => 72, 'class' => 'form-control input-lg', 'required' => 'required'); 
							echo form_input($text_input);?>
						<?php echo form_error('old_passwd', '<div class="text-danger">','</div>') ?>
					</div> 
					<div class="form-group">
						<?php echo form_label('New password','new_passwd') ?>
						<?php $text_input = array('name' => 'new_passwd','id' => 'new_passwd', 'type' => 'password','value' => '', 'minlength' => 8,'maxlength' => 72, 'class' => 'form-control input-lg', 'required' => 'required'); 
							echo form_input($text_input);?>
						<?php echo form_error('new_passwd', '<div class="text-danger">','</div>') ?>
					</div> 
					<div class="form-group">
						<?php echo form_label('Verify password','new_passwd_verify') ?>
						<?php $text_input = array('name' => 'new_passwd_verify','id' => 'new_passwd_verify', 'type' => 'password','value' => '', 'minlength' => 8,'maxlength' => 72, 'class' => 'form-control input-lg', 'required' => 'required'); 
							echo form_input($text_input);?>
						<?php echo form_error('new_passwd_verify', '<div class="text-danger">','</div>') ?>
					</div>   
					<?php echo form_submit('mysubmit','Save','class="btn btn-primary"') ?>
				<?php echo form_close() ?>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="card">
			<div class="card-header">
				<h4><i class="fa fa-user"></i> User Data </h4>
			</div>
			<div class="card-body">
				<div class="form-group">
					<?php echo form_label('User','name') ?>
					<?php $text_input = array('value' => $this->session->userdata('name'), 'readonly' => 'readonly','class' => 'form-control input-lg'); 
						echo form_input($text_input);?>
					<?php echo form_error('title', '<div class="text-danger">','</div>') ?>
				</div> 
				
				<div class="form-group">
					<?php echo form_label('Email','email') ?>
					<?php $text_input = array('value' => $this->session->userdata('email'), 'readonly' => 'readonly','class' => 'form-control input-lg'); 
						echo form_input($text_input);?>
					<?php echo form_error('title', '<div class="text-danger">','</div>') ?>
				</div> 
			</div>
		</div>
	</div>
</div>