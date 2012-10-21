<div class="toolbar">
                	<div class="titlebar"><h1>Advertiser</h1></div>
                    <!--<div class="actionbutton"><a href="#">Add New</a></div>-->
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                            	<th width="210">Title</th><th width="260">Address</th><th width="101">Phone</th><th width="100">Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($advertisers)): ?>
                        	<?php foreach($advertisers as $advr): ?>
                        	<tr>
                            	<td><input class="cboxSelector"  type="checkbox" /></td><td><?php echo $advr->fullname; ?></td><td><?php echo ucwords($advr->address); ?></td><td><?php echo ucwords($advr->phone); ?></td>
                            	<td><a class="advertiserbtn" advr_id="<?php echo $advr->ad_id; ?>" tooglestatus="<?php echo (strtolower($advr->status) == 'activate') ? '1' : '0'; ?>" href="#"><?php echo $advr->status; ?></a></td>
                            </tr>                            
							<?php endforeach; ?>
					<?php endif; ?>

                        </tbody>
                    </table>
<div class="clearthis"></div>
                    <div><?php echo $pagination; ?></div>
                    <!--<div class="bulkaction">
                    	<select name="bulkaction">
                        	<option value="">Bulk action</option>
                    		<option value="deleteselected">Delete selected</option>
                            <option value="deleteall">Delete all</option>
                    	</select>
					</div>-->
                    <!--<div class="applybutton">
                    	<a href="#">Apply</a>
                    </div>-->
                </div>
                                