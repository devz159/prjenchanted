<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>NewCastle-Hunter Directory Listing</title>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/admin/main.css" />

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
                <li><a href="#">Articles<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li><a href="#">All Articles</a></li>
                        <li><a href="#">Add New</a></li>
                        <li><a href="#">Sections</a></li>
                    </ul>
                </li>
                <li class="selected"><a href="#">Master Files<div class="sprite arrowselector"><div class="sprite"></div></div></a>
                	<ul>
                    	<li class="selectedsubmenu"><a href="#">Advertisers</a></li>
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
                	<div class="titlebar"><h1>Advertiser</h1></div>
                    <div class="actionbutton"><a href="#">Add New</a></div>
                    <div class="extrabar"></div>
                </div>
                
                <div class="runninglist">
                	
                    <table>
                    	<thead>
                        	<tr>
                            	<th><input type="checkbox" /></th><th>Name</th><th>Address</th><th>Phone</th><th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                        	<tr>
                            	<td><input type="checkbox" /></td><td>Kenneth Vallejos </td><td> Zone 2, Cugman, Cagayan de Oro City</td><td>754631254</td>
                            	<td><a href="#">edit</a> <span>|</span> <a href="#">delete</a></td>
                            </tr>
                            <tr>
                            	<td><input type="checkbox" /></td>
                            	<td>Myla Vallejos </td>
                            	<td> Zone 2, Cugman, Cagayan de Oro City</td>
                            	<td>+639283030558</td>
                            	<td><a href="#">edit</a> <span>|</span> <a href="#">delete</a></td>
                            </tr>
                            <tr>
                            	<td><input type="checkbox" /></td>
                            	<td>Miko Vallejos </td>
                            	<td> Zone 2, Cugman, Cagayan de Oro City</td><td>754631254</td><td><a href="#">edit</a> <span>|</span> <a href="#">delete</a></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="clearthis"></div>
                    <div class="bulkaction">
                    	<select name="bulkaction">
                        	<option value="">Bulk action</option>
                    		<option value="deleteselected">Delete selected</option>
                            <option value="deleteall">Delete all</option>
                    	</select>
					</div>
                    <div class="applybutton">
                    	<a href="#">Apply</a>
                    </div>
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