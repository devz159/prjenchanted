<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="url" content="<?php echo base_url();?>" />
<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
	<?php getHeader(); ?>
	<?php $section = getProfileSideBar(TRUE); ?>
</head>

<body>
<div id="header">
	<div class="middle">
    	<div id="comlogo">
        	<img src="<?php echo base_url(); ?>images/companylogo_smaller.png" />
        </div>
        
        <div class="profmainmenu">
        	<ul>
            	<li class="firstchild"><a class="selected" href="<?php echo base_url(); ?>advertiser/my/section/active_list">My Listings</a></li>
                <li class="lastchild"><a href="<?php echo base_url(); ?>advertiser/my/section/payment">Payment History</a></li>
        	</ul>
        </div>
        
        <div class="profloginmenu">
        	<ul>
            	<li class="accntmenu"><a class="sprite" href="#"><span class="sprite"></span>Account</a>
                	<ul>
                    	<li class="accntsubmenu"><a href="<?php echo base_url(); ?>advertiser/my/section/profile">Account Info</a></li>
                        <li class="accntsubmenu"><a href="<?php echo base_url(); ?>advertiser/my/section/change_password">Change Password</a></li>
                        <li class="accntsubmenu"><a href="<?php echo base_url(); ?>directory/search">Browse Directory</a></li>
                        <li class="accntsubmenu"><a href="<?php echo base_url(); ?>advertiser/my/signout">Log-out</a></li>
                    </ul>
                
                </li>
            </ul>
        </div>                
    </div>    <div style="padding:0; margin:0;" class="clearthis"></div>
</div>
<div style="padding:0; margin:0;" class="clearthis"></div>

<?php if(strtolower($section) != 'profile' && strtolower($section) != 'change_password'): ?>
	<div class="skyline">
    	<div class="horzline">
	    	<div class="sprite mastmenuselector <?php if(isset($tabmenu)) echo ($tabmenu == 'payment') ? 'payment' : ''; ?>"></div>
		</div>
    </div>
<?php else: ?>
	<div class="skyline" style="visibility:hidden;">
    	<div class="horzline">
	    	<div class="sprite mastmenuselector <?php if(isset($tabmenu)) echo ($tabmenu == 'payment') ? 'payment' : ''; ?>"></div>
		</div>
    </div>
<?php endif; ?>


<div class="middle">
	<div id="left">
    
        <div class="profileshortinfo">
        	<div class="profilepic"><img src="<?php echo base_url(); ?>images/profile_pix.png" /></div>
            <div class="profilename">
            	<p>Welcome</p>
                <p><strong><?php echo $user; ?></strong></p>
            </div>
        </div>
        
        <?php getProfileSideBar(); ?>
                
        <p>&nbsp;</p>
    </div>
    
    
    
    <div id="container">
    	
        <div class="pane">
        	<div class="sprite sidebarselector <?php echo ($section) ? $section: ''; ?>"></div>
        	<div class="topproundcorner"></div>
            
            <div class="innercontent"><!-- innercontent --> 
            	
                <?php $this->load->view($main_content); ?>
                
               </div><!-- innercontent -->            
            <div class="bottomroundcorner"></div>
        </div>
        <p>&nbsp;</p>
        <p>&nbsp;</p>
    </div>    
</div>

<div class="clearthis"></div>

<?php getFooter(); ?>
<div class="tooltipbox hide"></div>
</body>
</html>