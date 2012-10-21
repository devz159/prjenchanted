<div class="toolbar">
                	<div class="titlebar">
                	  <h1>Edit Article</h1></div>
                    	<div class="actionbutton"><a href="<?php echo base_url("admin/panel/section/allarticles"); ?>">Cancel Edit Article</a></div>
                </div>
                
                <div class="texteditor">
<?php if(isset($articles)): ?>
	<?php foreach($articles as $article): ?>
                	<?php echo form_open(base_url("admin/panel/validateeditarticle")); ?>
                  
                    	<input type="hidden" name="arcle_id" value="<?php echo $arcle_id; ?>" />
                    	<p><input class="articletitle watermarktext" type="text" name="articletitle" value="<?php echo $article->title; ?>" /><?php echo display_error('articletitle'); ?></p>
                    	<p><?php echo display_error('editor'); ?>
                        	<div><textarea id="editor" name="editor"><?php echo $article->article; ?></textarea></div>                          
                        </p>
                        
                        <div class="utilitybar">
                        	<p><button class="publishbtn" type="submit" name="publishbtn">Publish</button></p>
                            <p><button class="savedraftbtn" type="submit" name="savedraftbtn">Save Draft</button></p>
                            <div>
                            	<h3>Meta Data</h3>                              
                                <p>
                                	<label>Keyword</label><br />
                                    <textarea name="keyword"><?php echo $article->mkeywords; ?></textarea>
                                </p>
                                <p>
                                	<label>Description</label>
                                    <textarea name="description"><?php echo $article->mdescription; ?></textarea>
                                </p>
                                
                                <p>
                                	<label>Section</label><br />
                                    <select name="section">
                                    	<option value="">-- Select a section --</option>
                                        <?php if(isset($sections)): ?>
                                        	<?php foreach($sections as $sec): ?>
                                        <option <?php echo ($article->section == $sec->sec_id) ? 'selected="selected"' : ''; ?> value="<?php echo $sec->sec_id; ?>"><?php echo $sec->name; ?></option>
	                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>
                                </p>
                            </div>
                        </div>
                    <?php echo form_close(); ?>
                    
	<?php endforeach; ?>
<?php endif; ?>

<!-- Element where elFinder will be created (REQUIRED) -->

                </div>                