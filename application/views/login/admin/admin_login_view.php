<div class="login_box">
			<?php echo form_open(base_url('login/validate_admin_login'), array('id' => 'login_form')); ?>
				<div class="top_b"><img src="<?php echo base_url('theme/img/gCons/tree.png'); ?>" alt="" />Sign-in admin</div>    
                <?php if($error != ""): ?>
				<div class="alert alert-info alert-login">
					<?php echo $error; ?>
				</div>
                <?php endif; ?>
				<div class="cnt_b">
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-user"></i></span><input type="text" id="username" name="username" placeholder="Username" value="<?php echo set_value('username'); ?>" />
						</div>
					</div>
					<div class="formRow">
						<div class="input-prepend">
							<span class="add-on"><i class="icon-lock"></i></span><input type="password" id="password" name="password" placeholder="Password"/>
						</div>
					</div>
					<div class="formRow clearfix">
						<label class="checkbox"><input type="checkbox" /> Remember me</label>
					</div>
				</div>
				<div class="btm_b clearfix">
					<button class="btn btn-inverse pull-right" type="submit">Sign In</button>
					<span class="link_reg"><a href="#">Not registered? Sign up here</a></span>
				</div>  
			</form>
			
			<div class="links_b links_btm clearfix">
				<span class="linkform"><a href="<?php echo base_url('login/forgetpassword/' . strencode('advertiser')); ?>">Forgot password?</a></span>
				<span class="linkform" style="display:none">Never mind, <a href="#login_form">send me back to the sign-in screen</a></span>
			</div>
		</div>