<?php if(strtolower($section) == "profile" || strtolower($section) == 'change_password'): ?>
    <div class="sidebarmenu">
                <ul>
                    <li><a <?php echo ($section == 'profile') ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>advertiser/my/section/profile">Account Info</a></li>
                    <li><a <?php echo ($section == 'change_password') ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>advertiser/my/section/change_password">Change Password</a></li>                    
                </ul>
    </div>    
    
<?php elseif(strtolower($section) == 'active_list' || strtolower($section) == 'payment' || strtolower($section) == 'expired_list' || strtolower($section) == 'edit_list' || strtolower($section) == 'validate_edit'): ?>
	<div class="sidebarmenu">
                <ul>
                    <li><a <?php echo ($section == 'active_list' || $section == 'edit_list' || strtolower($section) == 'validate_edit') ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>advertiser/my/section/active_list">Active Listings</a></li>
                    <li><a <?php echo ($section == 'expired_list') ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>advertiser/my/section/expired_list">Expired Listings</a></li>
                    <li><a <?php echo ($section == 'payment') ? 'class="selected"' : ''; ?> href="<?php echo base_url(); ?>advertiser/my/section/payment">Payment History</a></li>
                </ul>
    </div>    
<?php endif; ?>
