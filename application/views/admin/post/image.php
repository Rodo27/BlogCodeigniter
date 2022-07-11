<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title><?php echo APP_NAME  ." | ". APP_DESCRIPTION ?></title>
	<meta charset="utf-8" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/fontawesome-free/css/all.min.css">
	<!-- adminlte-->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/custom.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/adminlte/css/magnific-popup.css">

	<script src="<?php echo base_url() ?>assets/adminlte/jquery/jquery.js"></script>     

</head>
<body>
	<?php foreach($images as $image) :?>
		<img class="img-presentation-small img-thumbnail" src="<?php echo "/" . PROJECT_FOLDER . "/files/post/" . $image ?>">
	<?php endforeach; ?>
	<div class="clearfix"></div>
	<br>

	<script type="text/javascript">

		let fileUrl = ""

		$("img").click(function(){
			fileUrl = $(this).attr("src")
			returnFileUrl()
		})

		function getUrlParam( paramName ) {
            let reParam = new RegExp( '(?:[\?&]|&)' + paramName + '=([^&]+)', 'i' )
            let match = window.location.search.match( reParam )

            return ( match && match.length > 1 ) ? match[1] : null
        }
        // Simulate user action of selecting a file to be returned to CKEditor.
        function returnFileUrl() {

        	if(fileUrl === ""){
        		return 
        	}

            let funcNum = getUrlParam( 'CKEditorFuncNum' )
            //var fileUrl = '/path/to/file.txt'
            window.opener.CKEDITOR.tools.callFunction( funcNum, fileUrl )
            window.close()
        }
	</script>

</body>
</html>