<div id="left">
    	<div class="sidebarmainmenu">
        	<ul>
            	<li <?php echo topMenu(4, $section); ?>><a href="#">Settings<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li <?php echo selectSubMenu('users', $section); ?>><a href="<?php echo base_url("admin/panel/section/users"); ?>">Users</a></li>
                        <li <?php echo selectSubMenu('emails', $section); ?>><a href="<?php echo base_url("admin/panel/section/emails"); ?>">Emails</a></li>                                                                      
                        <li <?php echo selectSubMenu('generalsetttings', $section); ?>><a href="<?php echo base_url("admin/panel/section/generalsetttings"); ?>">General Settings</a></li>
                        
                    </ul>
                </li>
                <li <?php echo topMenu(2, $section); ?>><a href="#">Articles<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li <?php echo selectSubMenu('allarticles', $section); ?>><a href="<?php echo base_url("admin/panel/section/allarticles"); ?>">All Articles</a></li>
                        <li <?php echo selectSubMenu('newarticle', $section); ?>><a href="<?php echo base_url("admin/panel/section/newarticle"); ?>">Add New</a></li>
                        <li <?php echo selectSubMenu('sections', $section); ?>><a href="<?php echo base_url("admin/panel/section/sections"); ?>">Sections</a></li>
                    </ul>
                </li>
                <li <?php echo topMenu(1, $section); ?>><a href="#">Master Files<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li <?php echo selectSubMenu('advertisers', $section); ?>><a href="<?php echo base_url("admin/panel/section/advertisers"); ?>">Advertisers</a></li>
                        <li <?php echo selectSubMenu('categories', $section); ?>><a href="<?php echo base_url("admin/panel/section/categories"); ?>">Categories</a></li>
                        <li <?php echo selectSubMenu('countries', $section); ?>><a href="<?php echo base_url("admin/panel/section/countries"); ?>">Countries</a></li>
                        <li <?php echo selectSubMenu('listings', $section); ?>><a href="<?php echo base_url("admin/panel/section/listings"); ?>">Listings</a></li>
                        <li <?php echo selectSubMenu('subcategories', $section); ?>><a href="<?php echo base_url("admin/panel/section/subcategories"); ?>">Sub-Categories</a></li>                                                
                        <li <?php echo selectSubMenu('states', $section); ?>><a href="<?php echo base_url("admin/panel/section/states"); ?>">States</a></li>
                        <li <?php echo selectSubMenu('products', $section); ?>><a href="<?php echo base_url("admin/panel/section/products"); ?>">Products</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <p>&nbsp;</p>
    </div>
<?php
	// utility
	function topMenu($topmenu, $submenu) {
		$flag = 0;
		switch($submenu) {
			case 'advertisers':
			case 'categories':
			case 'subcategories':
			case 'products':
			case 'listings':
				$flag = 1;
				break;
			
			case 'allarticles':
			case 'newarticle':
			case 'editarticle':
			case 'sections':
				$flag = 2;
				break;
			
			case 'users':
			case 'generalsetttings':
			case 'emails':
				$flag = 4;
				break;

			default:
				$flag = 1;
		}
		
		if($topmenu & $flag)
			return ' class="selected" ';
		else
			return '';
	}
	
	function selectSubMenu($curmenu, $section) {
		
		if(strtolower($curmenu)==strtolower($section))
			return 'class="selectedsubmenu"';
		else
			return '';
	}
?>