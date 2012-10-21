 <div>
	<div class="signuplistinggauge">
    	<p>Listing: Free Listing<span class="grey"></span></p>

      <div class="sprite linegauge"></div>
    </div><div class="clearthis"></div>
    <p>&nbsp;</p>
  <?php echo form_open(base_url('advertiser/my'), array('method' => 'post', 'class' => 'repostfree')); ?>
  <?php foreach($listing as $list): ?>
    	<h3>Reposting</h3>
    	<h4>Title: <?php echo $list->title; ?></h4>
        <p>Package: <?php echo ($item_name !="") ?  ucfirst($item_name) . ' Listing' : ""; ?></p>
        <p>Amount: <span class="red"><?php echo $amount  . " AUD"; ?></span></p>
    
    <?php endforeach; ?>      
        <input type="submit" value="Proceed To My Profile" />
    </form>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
</div>