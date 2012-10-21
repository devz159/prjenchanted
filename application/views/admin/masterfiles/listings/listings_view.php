<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Listings</h1></div>
                    
                    <div class="extrabar"></div>
                </div>                
<div class="runninglist">
                	
                    <table width="745">
                    	<thead>
                        	<tr>
                            	<th width="50"><input class="cboxToggleSelectAll" type="checkbox" /></th>
                              <th width="423">Name</th>
								<th width="119">Advertiser</th>
                                <th width="57">Status</th>
                                <th width="91">Action</th>		
                            </tr>
                        </thead>
                        
                        <tbody>
					<?php if(isset($listings)): ?>
                        	<?php foreach($listings as $list): ?>
                        	<tr>
                            	<td><input class="cboxSelector" type="checkbox" /></td>
                                <td class="hastooltip" tooltip="<?php echo ($list->categories != "") ? 'Categories: ' . $list->categories : 'No categories provided' ; ?>"><?php echo $list->title; ?></td>
                                <td><?php echo $list->advr; ?></td>
                                <td><?php echo ($list->expired == '1') ? 'Active': 'Expired' ;?></td>
                            	<td><a href="#">View</a></td>
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
					</div>
                    <div class="applybutton">
                    	<a href="#">Apply</a>
                    </div> -->
                </div>