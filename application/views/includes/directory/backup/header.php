<title>New Castle - Hunter Directory</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/directory/main.css" />
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>plugins/neeuploader/css/jquery.neeuploader.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>js/utility.js"></script>

<?php if(strtolower($section) == 'listing'):  ?> <!-- don't load the elRTE plugin -->
	<!-- jQuery and jQuery UI -->
	<!--<script src="<?php echo base_url();?>plugins/elrte/js/jquery-1.6.1.min.js" type="text/javascript" charset="utf-8"></script>-->
	<script src="<?php echo base_url();?>plugins/elrte/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>plugin/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">
    

	<!-- elRTE -->
	<script src="<?php echo base_url();?>plugins/elrte/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
	<link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">

	<!-- elRTE translation messages -->
	<script src="<?php echo base_url();?>plugins/elrte/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
	
	<!-- file uploader -->
	<script type="text/javascript" src="<?php echo base_url(); ?>plugins/neeuploader/js/jquery.neeuploader.js"></script>

	<script type="text/javascript" charset="utf-8">
		$().ready(function() {
			var opts = {
				cssClass : 'el-rte',
				width	 : 550,
				allowSource	: false,
				height   : 350,
				toolbar  : 'tiny',
				cssfiles : ['css/elrte-inner.css']
			}
			$('#editor').elrte(opts);

			$('#file_uploader').each(function(){
				$('#file_uploader').neeuploader({
					max_width: 2500, 
					upload_path: 'uploaded/',
					script: '<?php echo base_url(); ?>ajax/ajxupload/do_upload', 
					gauge_path		:	'<?php echo base_url(); ?>plugins/neeuploader/images/uploader_icon.gif',
					max_height: 2500, 
					header_caption: 'Select Files', 
					header_footnote: 'Please click the upload button to select files.', 
					header_icon: true,
					create_thumbs : false
				});
			});
		})
	</script>
<?php endif; ?>