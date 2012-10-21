<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>NewCastle-Hunter Directory Listing</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/main.css" />
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>

<!-- elRTE -->
<script src="<?php echo base_url();?>plugins/elrte/js/elrte.min.js" type="text/javascript" charset="utf-8"></script>
<script src="<?php echo base_url();?>plugins/elrte/js/jquery-ui-1.8.13.custom.min.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/smoothness/jquery-ui-1.8.13.custom.css" type="text/css" media="screen" charset="utf-8">
<script src="<?php echo base_url();?>plugins/elrte/js/i18n/elrte.ru.js" type="text/javascript" charset="utf-8"></script>
<link rel="stylesheet" href="<?php echo base_url();?>plugins/elrte/css/elrte.min.css" type="text/css" media="screen" charset="utf-8">


<script type="text/javascript" charset="utf-8">
		$().ready(function() {
			elRTE.prototype.options.panels.adminpanel = ['bold', 'italic', 'underline','strikethrough', 'subscript', 'superscript', 'insertorderedlist', 'insertunorderedlist','justifyleft', 'justifycenter', 'justifyright', 'link', 'unlink', 'anchor'];
			elRTE.prototype.options.panels.adminpanel2 = ['formatblock', 'fontsize', 'forecolor', 'table'];
			elRTE.prototype.options.toolbars.admintoolbar = ['adminpanel', 'images', 'adminpanel2']
			var opts = {
				/*cssClass : 'el-rte',*/
				styleWithCSS : false,
				width	 : 470,
				height	: 800,
				allowSource	: true,
				height   : 350,
				toolbar  : 'admintoolbar',
				cssfiles : ['css/elrte-inner.css']
			}
						
			$('#editor').elrte(opts);
			
		});
	</script>
<!-- elRTE -->
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
                    	<li class="accntsubmenu"><a href="#">Visit Site</a></li>
                        <li class="accntsubmenu"><a href="#">Log-out</a></li>                       
                    </ul>
                
                </li>
            </ul>
        </div>                
    </div>    <div style="padding:0; margin:0;" class="clearthis"></div>
</div>
<div style="padding:0; margin:0;" class="clearthis"></div>

<div class="middle">
	<div id="left">
    	<div class="sidebarmainmenu">
        	<ul>
            	<li><a href="#">Settings<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li><a href="#">Users</a></li>
                        
                    </ul>
                </li>
                <li class="selected"><a href="#">Articles<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li><a href="#">All Articles</a></li>
                        <li class="selectedsubmenu"><a href="#">Add New</a></li>
                        <li><a href="#">Sections</a></li>
                    </ul>
                </li>
                <li><a href="#">Master Files<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li><a href="#">Advertisers</a></li>
                        <li><a href="#">Categories</a></li>
                        <li><a href="#">Listings</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <p>&nbsp;</p>
    </div>
    
    
    
    <div id="container">
    	
        <div class="pane">
        	
            <div class="innercontent"><!-- innercontent --> 
            	
				<div class="toolbar">
                	<div class="titlebar"><h1>New Article</h1></div>
                    
                </div>
                
                <div class="texteditor">
                	<?php echo form_open(); ?>
                    	<p><input class="articletitle" type="text" name="articletitle" value="Enter title here" /></p>
                    	<p>
                        	<div id="editor"></div>
                        </p>
                        
                        <div class="utilitybar">
                        	<p><button class="publishbtn" type="submit" name="publishbtn">Publish</button></p>
                            <p><button class="savedraftbtn" type="submit" name="savedraftbtn">Save Draft</button></p>
                            <div>
                            	<h3>Meta Data</h3>                              
                                <p>
                                	<label>Keyword</label><br />
                                    <textarea name="keyword"></textarea>
                                </p>
                                <p>
                                	<label>Description</label>
                                    <textarea name="description"></textarea>
                                </p>
                                
                                <p>
                                	<label>Section</label><br />
                                    <select name="section">
                                    	<option value="">-- Select a section --</option>									<option value="home">Home</option>
                                        <option value="touristinfo">Tourist Information</option>
                                    </select>
                                </p>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    
                </div>
                
			</div><!-- innercontent -->            
            
        </div>
        <p>&nbsp;</p>
    </div>    
</div>

<div class="clearthis"></div>

<div id="footer">
	<div class="middle">
            <p>&copy; 2012 www.newcastle-hunter.com</p>
	</div>
</div>

</body>
</html>