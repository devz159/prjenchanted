<div class="toolbar">
                	<div class="titlebar"><h1>New Article</h1></div>
                    
                </div>
                
                <div class="texteditor">
                	<?php echo form_open(base_url("admin/panel/validatenewarticle")); ?>
                    	<p><input class="articletitle watermarktext" type="text" name="articletitle" value="<?php echo set_value('articletitle'); ?>" /><?php echo display_error('articletitle'); ?></p>
                    	<p><?php echo display_error('editor'); ?>
                        	<div><input type="text"  id="editor" name="editor" /></div>
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
                                    	<option value="">-- Select a section --</option>
                                        <?php if(isset($sections)): ?>
                                        	<?php foreach($sections as $sec): ?>
                                        <option value="<?php echo $sec->sec_id; ?>"><?php echo $sec->name; ?></option>
	                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    
                </div>