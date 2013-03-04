<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="url" content="<?php echo base_url();?>" />
		<link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
        
        <?php $this->view('includes/directory/header'); ?>
        
    </head>
    
    <body>
		<div id="loading_layer" style="display:none"><img src="<?php echo base_url('theme/img/ajax_loader.gif'); ?>" alt="" /></div>
		<div class="style_switcher">
			<div class="sepH_c">
				<p>Colors:</p>
				<div class="clearfix">
					<a href="javascript:void(0)" class="style_item jQclr blue_theme style_active" title="blue">blue</a>
					<a href="javascript:void(0)" class="style_item jQclr dark_theme" title="dark">dark</a>
					<a href="javascript:void(0)" class="style_item jQclr green_theme" title="green">green</a>
					<a href="javascript:void(0)" class="style_item jQclr brown_theme" title="brown">brown</a>
					<a href="javascript:void(0)" class="style_item jQclr eastern_blue_theme" title="eastern_blue">eastern blue</a>
					<a href="javascript:void(0)" class="style_item jQclr tamarillo_theme" title="tamarillo">tamarillo</a>
				</div>
			</div>
			<div class="sepH_c">
				<p>Backgrounds:</p>
				<div class="clearfix">
					<span class="style_item jQptrn style_active ptrn_def" title=""></span>
					<span class="ssw_ptrn_a style_item jQptrn" title="ptrn_a"></span>
					<span class="ssw_ptrn_b style_item jQptrn" title="ptrn_b"></span>
					<span class="ssw_ptrn_c style_item jQptrn" title="ptrn_c"></span>
					<span class="ssw_ptrn_d style_item jQptrn" title="ptrn_d"></span>
					<span class="ssw_ptrn_e style_item jQptrn" title="ptrn_e"></span>
				</div>
			</div>
			<div class="sepH_c">
				<p>Layout:</p>
				<div class="clearfix">
					<label class="radio inline"><input type="radio" name="ssw_layout" id="ssw_layout_fluid" value="" checked /> Fluid</label>
					<label class="radio inline"><input type="radio" name="ssw_layout" id="ssw_layout_fixed" value="gebo-fixed" /> Fixed</label>
				</div>
			</div>
			<div class="sepH_c">
				<p>Sidebar position:</p>
				<div class="clearfix">
					<label class="radio inline"><input type="radio" name="ssw_sidebar" id="ssw_sidebar_left" value="" checked /> Left</label>
					<label class="radio inline"><input type="radio" name="ssw_sidebar" id="ssw_sidebar_right" value="sidebar_right" /> Right</label>
				</div>
			</div>
			<div class="sepH_c">
				<p>Show top menu on:</p>
				<div class="clearfix">
					<label class="radio inline"><input type="radio" name="ssw_menu" id="ssw_menu_click" value="" checked /> Click</label>
					<label class="radio inline"><input type="radio" name="ssw_menu" id="ssw_menu_hover" value="menu_hover" /> Hover</label>
				</div>
			</div>
			
			<div class="gh_button-group">
				<a href="#" id="showCss" class="btn btn-primary btn-mini">Show CSS</a>
				<a href="#" id="resetDefault" class="btn btn-mini">Reset</a>
			</div>
			<div class="hide">
				<ul id="ssw_styles">
					<li class="small ssw_mbColor sepH_a" style="display:none">body {<span class="ssw_mColor sepH_a" style="display:none"> color: #<span></span>;</span> <span class="ssw_bColor" style="display:none">background-color: #<span></span> </span>}</li>
					<li class="small ssw_lColor sepH_a" style="display:none">a { color: #<span></span> }</li>
				</ul>
			</div>
		</div>
		
		<div id="maincontainer" class="clearfix">
			<!-- header -->
            <header>
                <?php $this->load->view('includes/directory/navigation'); ?>                
            </header>
            
            <!-- main content -->
            <div id="contentwrapper">
                <div class="main_content">
                    
                    <nav>
                        <?php $this->load->view('includes/directory/bcrumbs'); ?>   
                    </nav>
                    
                    <?php $this->load->view($main_content); ?>
                        
                </div>
            </div>
            
			<!-- sidebar -->
			<a href="javascript:void(0)" class="sidebar_switch on_switch ttip_r" title="Hide Sidebar">Sidebar switch</a>
			<div class="sidebar">
				<div class="antiScroll">
					<div class="antiscroll-inner">
						<div class="antiscroll-content">
							<div class="sidebar_filters">
								<h3>Keyword</h3>
								<div class="filter_items">
									<input type="text" class="input-medium"/>
								</div>
								<h3>Lorem ipsum</h3>
								<div class="filter_items">
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
								</div>
								<h3>Lorem ipsum</h3>
								<div class="filter_items">
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Lorem ipsum dolor sit
									</label>
								</div>
								<h3>Lorem ipsum</h3>
								<div class="filter_items">
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										Under $25
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										$25 to $50
									</label>
									<label class="checkbox">
										<input type="checkbox" value="filter_item" name="filter_item">
										$100 to $200
									</label>
									<div class="form-inline">
										<input type="text" placeholder="from" class="span1"> - <input type="text" placeholder="to" class="span1">
									</div>
								</div>
								<a href="javascript:void(0)" class="btn btn-gebo">Search <i class="icon-chevron-right icon-white"></i></a>
							</div>
						</div>
					</div>
				</div>
			</div>
            
            <?php $this->view('includes/directory/footer'); ?>
		
		</div>
	</body>
</html>