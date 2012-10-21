<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="url" content="<?php echo base_url();?>" />
<title>NewCastle-Hunter Directory Listing</title>
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
	<?php getHeader(); ?>

</head>

<body>
<div id="header">
	<div class="middle">
    	<div id="comlogo">
        	<img src="<?php echo base_url(); ?>images/companylogo_grey.png" />
        </div>
        <div class="profloginmenu">
        	<ul>
            	<li class="accntmenu"><a class="sprite" href="#"><span class="sprite"></span>Admin</a>
                	<ul>
                    	<li class="accntsubmenu"><a target="_blank" href="<?php echo base_url('directory/search'); ?>">Visit Site</a></li>
                        <li class="accntsubmenu"><a href="<?php echo base_url("login/admin_signout"); ?>">Log-out</a></li>                       
                    </ul>
                
                </li>
            </ul>
        </div>
        <div class="usericon">
        	<ul>
            	<li><img  src="<?php echo base_url('images/advricon.png'); ?>" width="13" height="17" tooltip="Number of advertisers logged-in" alt="Number of advertiser logged-in" class="hastooltip advricon" /><?php echo (isset($advertisersCount)) ? $advertisersCount: '0'; ?></li>
                <li><img src="<?php echo base_url('images/admnicon.png'); ?>" width="13" height="17" alt="Number of web admins logged in" tooltip="Number of web admins logged in" class=" hastooltip admnicon" /><?php echo (isset($webAdminCount)) ? $webAdminCount : '0'; ?></li>
            </ul>
        </div>
        
                        
    </div>    <div style="padding:0; margin:0;" class="clearthis"></div>
</div>
<div style="padding:0; margin:0;" class="clearthis"></div>

<div class="middle">
	<!-- admin sidebar here -->
    <?php getAdminSideBar(); ?>
    
    <div id="container">
    	
        <div class="pane">
        	
            <div class="innercontent"><!-- innercontent --> 
            	
				<?php $this->load->view($main_content); ?>
                
			</div><!-- innercontent -->            
            
        </div>
        <p>&nbsp;</p>
    </div>    
</div> <!-- admin sidebar here -->

<div class="clearthis"></div>
<div class="tooltipbox hide"></div>
<?php getFooter(); ?>


</body>
</html>