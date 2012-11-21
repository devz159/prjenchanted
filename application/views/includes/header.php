<title>New Castle - Hunter Directory</title>
	<?php if(strtolower($section) == 'home'): ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/main.css" />
        <!--[if lte IE 7]> <link href="<?php echo base_url(); ?>css/main_ie7.css" rel="stylesheet" type="text/css"> <![endif]-->
        <!--[if IE 8]> <link href="<?php echo base_url(); ?>css/main_ie8.css" rel="stylesheet" type="text/css"> <![endif]-->
       
    <?php endif; ?>
    
    <?php if(strtolower($section) == 'search' || strtolower($section) == 'listing' || strtolower($section) == 'register'): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>plugins/neeuploader/css/jquery.neeuploader.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/directory/main.css" />
        
    <?php endif; ?>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<!--<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>-->
<script type="text/javascript" src="<?php echo base_url(); ?>js/utility.js"></script>

	<?php 
		/* ### LISTING ### */
		if(strtolower($section) == 'listing'):  ?>
    <!-- don't load the elRTE plugin -->
       <!-- <script src="<?php echo base_url();?>plugins/elrte/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>plugin/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">-->
        <!-- elfinder -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />
       	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>plugins/elfinder/css/elfinder.min.css">
        <!-- Mac OS X Finder style for jQuery UI smoothness theme (OPTIONAL) -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>plugins/elfinder/css/theme.css">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>plugins/elfinder/js/elfinder.min.js"></script>
        
        <!-- elRTE -->
        <script src="<?php echo base_url();?>plugins/elrte/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
    
        <!-- elRTE translation messages -->
        <script src="<?php echo base_url();?>plugins/elrte/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
        
        <!-- file uploader -->
        <script type="text/javascript" src="<?php echo base_url(); ?>plugins/neeuploader/js/jquery.neeuploader.js"></script>
    	
        <!-- google maps -->
        <script type="text/javascript" src="<?php echo base_url(); ?>js/googlemap.query.js"></script>
		<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
        
        <script type="text/javascript" charset="utf-8">
            $().ready(function() {
               /* var opts = {
                    cssClass : 'el-rte',
                    width	 : 550,
                    allowSource	: false,
                    height   : 350,
                    toolbar  : 'adminToolbar',
                    cssfiles : ['css/elrte-inner.css'],
					
                }
                $('#editor').elrte(opts);*/
				
				<?php $this->load->view('includes/settings/elrtesettings'); ?>
    
                $('#file_uploader').each(function(){
                    $('#file_uploader').neeuploader({
                        max_width: 2500, 
                        upload_path: 'uploaded/',
                        script: '<?php echo base_url(); ?>ajax/ajxupload/do_upload', 
                        gauge_path		:	'<?php echo base_url(); ?>plugins/neeuploader/images/uploader_icon.gif',
                        max_height: 2500, 
                        header_caption: 'Select Files', 
                        header_footnote: 'Please click the upload button to select files.', 
                        header_icon: true
                    });
                });
				
				<?php echo isset($mapdata) ?'var r = ' . json_encode($mapdata) . ';' : 'var r = {}'; ?>				
				$('#mnmap').googlemap(r, 'New Castle, Australia', '<?php echo base_url(); ?>images/markers/');
				$('#hugemap').googlemap(r, 'New Castle, Australia', '<?php echo base_url(); ?>images/markers/');
            });
        </script>
        
    <?php 
		/* ### MY/ADVERTISER ### */		
		elseif(strtolower($section) == 'my'): ?>	
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/advertiser/main.css" />
    
    <?php 
		/* ### EDITLIST & VALIDATE_EDIT ### */
		elseif (strtolower($section) == 'edit_list' || strtolower($section) == 'validate_edit'): ?>
    	<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>plugins/neeuploader/css/jquery.neeuploader.css" />
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/advertiser/main.css" />
        
         <!-- elRTE -->
        <script src="<?php echo base_url();?>plugins/elrte/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
    
        <!-- elRTE translation messages -->
        <script src="<?php echo base_url();?>plugins/elrte/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
              
        <!-- file uploader -->
        <script type="text/javascript" src="<?php echo base_url(); ?>plugins/neeuploader/js/jquery.neeuploader.js"></script>
        <script type="text/javascript">
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
                        header_icon: true
                    });
                });
			});
		</script>

    <?php 
		/* ### LOGIN ### */
		elseif(strtolower($section) == 'login'): ?>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/login/main.css" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.js"></script>
    	<script type="text/javascript" src="<?php echo base_url(); ?>js/utility.js"></script>
        
   
    <?php 
		/* ### ADMIN ### */
		elseif(strtolower($section) == 'admin'): ?>
		<!--- admin layout -->
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/main.css" />
        
    	<!-- elfinder -->
		<link rel="stylesheet" type="text/css" media="screen" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/themes/smoothness/jquery-ui.css" />
       	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>plugins/elfinder/css/elfinder.min.css">
        <!-- Mac OS X Finder style for jQuery UI smoothness theme (OPTIONAL) -->
		<link rel="stylesheet" type="text/css" media="screen" href="<?php echo base_url(); ?>plugins/elfinder/css/theme.css">

		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.14/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url(); ?>plugins/elfinder/js/elfinder.min.js"></script>

         <!-- elRTE -->
        <script src="<?php echo base_url();?>plugins/elrte/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
        <link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">
    
        <!-- elRTE translation messages -->
        <script src="<?php echo base_url();?>plugins/elrte/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
        
        <script type="text/javascript">
			$().ready(function() {
				// loads the settings of the text editor
				<?php $this->load->view('includes/settings/elrtesettings'); ?>			
			});
		</script>
        
	<?php 
		/* ### PAYPAL ### */
		elseif(strtolower($section) == 'paypal'): ?>
    	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/directory/main.css" />
    <?php endif; ?>