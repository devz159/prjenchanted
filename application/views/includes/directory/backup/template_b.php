<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="url" content="<?php echo base_url();?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
<?php getHeader();  ?>

</head>

<body>
<div id="header" style="overflow:hidden;">
	<div class="middle">
    	<div id="comlogo">
        	<img src="<?php echo base_url(); ?>images/companylogo_smaller.png" />
        </div>
        
        <div class="teaser signup">
        	<p>Make your business visible on the internet and this is the right place to list it online.</p>
        </div>
               
        <div class="loggedin">
        	<ul>
        	<li><?php echo (isset($user) && $user != "") ? '<strong>Not ' . $user . '? <a href="' . base_url() . 'directory/listing/signout' . '">Sign-out</a></strong>' : ''; ?></li>	
            </ul>
        </div>
        <div class="clearthis"></div>
    </div>
</div>
   <div class="middle">
    	<div id="containercenter">
          		
            	<?php $this->load->view($main_content); ?>

    	</div>    
	</div>

<div class="clearthis"></div>
<p>&nbsp;</p>
<div id="footer_b">
	<div class="middle"><ul>
    	<li class="firstchild"><a href="#">home</a></li>
        <li><a href="<?php  echo base_url(); ?>directory/search">directory</a></li>
    </ul>
	</div>
</div>
<div class="tooltipbox hide"></div>
</body>
</html>