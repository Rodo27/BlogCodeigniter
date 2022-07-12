<?php echo form_open_multipart('','class="my_form"') ?>
	<div class="form-group">
		<?php echo form_label('Title','title') ?>
		<?php $text_input = array('name' => 'title','id' => 'title','value' => $title, 'minlength' => 10,'maxlength' => 65, 'class' => 'form-control input-lg', 'required' => 'required'); 
			echo form_input($text_input);?>
		<?php echo form_error('title', '<div class="text-danger">','</div>') ?>
	</div>   
	<div class="form-group">
		<?php echo form_label('Url clean','url_clean') ?>
		<?php $text_input = array('name' => 'url_clean','id' => 'url_clean','value' => $url_clean,'class' => 'form-control input-lg'); 
			echo form_input($text_input);?>
		<?php echo form_error('url_clean', '<div class="text-danger">','</div>') ?>
	</div>
	<div class="form-group">
		<?php echo form_label('Content','content') ?>
		<?php $text_input = array('name' => 'content','id' => 'content','value' => $content,'rows' => '2','class' => 'form-control input-lg'); 
			echo form_textarea($text_input);?>
		<?php echo form_error('content', '<div class="text-danger">','</div>') ?>
	</div>
	<div class="form-group">
		<?php echo form_label('Description','description') ?>
		<?php $text_input = array('name' => 'description','id' => 'description','value' => $description,'rows' => '2','class' => 'form-control input-lg'); 
			echo form_textarea($text_input);?>
		<?php echo form_error('description', '<div class="text-danger">','</div>') ?>
	</div>
	<div class="form-group">
		<?php echo form_label('Image','image') ?>
		<?php $text_input = array('name' => 'upload','id' => 'upload','value' => '','class' => 'form-control input-lg', 'type' => 'file'); 
			echo form_input($text_input);?>
		
		<?php echo 
		    $image != "" ? 
		    '<a class="test-popup-link" href="' . base_url('files/post/') . $image . '" >
		        <img class="img-post img-thumbnail img-presentation-small" src="' . base_url('files/post/') . $image . '">
		    </a>' :
		    ''
        ?>
		<?php echo form_error('image', '<div class="text-danger">','</div>') ?>
	</div>
	<div class="form-group">
		<?php echo form_label('Posted','posted') ?>
		<?php echo form_dropdown('posted', $data_posted, null, 'class="form-control input-lg"');?>
		<?php echo form_error('posted', '<div class="text-danger">','</div>') ?>
	</div>
	<div class="form-group">
		<?php echo form_label('Category','category') ?>
		<?php echo form_dropdown('category_id', $categories, $category_id, 'class="form-control input-lg"');?>
		<?php echo form_error('category', '<div class="text-danger">','</div>') ?>
	</div>
	<?php echo form_submit('mysubmit','Save','class="btn btn-primary"') ?>
<?php echo form_close() ?>

<script type="text/javascript">
	//$(document).ready(function() {
	//  $('#summernote').summernote()
	//})
	
	/*
	$(function(){
		let editor = CKEDITOR.replace('content',{
			height:400,
			filebrowserUploadUrl: "<?php echo base_url('admin/upload') ?>",
			filebrowserBrowserUrl: "<?php echo base_url('admin/images_server') ?>"
		})
	})
	*/
</script>