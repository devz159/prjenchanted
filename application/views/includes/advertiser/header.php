<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>New Castle - Hunter Directory</title>
<link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>css/directory/main.css" />
</head>

<body>
	<div id="MainContainer">
    <?php if(isset($user)): ?>
    <div class="tempmenu">
    <p>Welcome <strong><?php echo $user; ?></strong> <a href="<?php echo base_url() . 'login/my_signout'; ?>">Sign-Out</a></p>
<ul>
	<li><a href="<?php echo base_url() . 'advertiser/my/listing'; ?>">Listing</a></li>
	<li><a href="<?php echo base_url() . 'advertiser/my/profile'; ?>">Profile</a></li>
	<li><a href="#">Change Password</a></li>
</ul>

</div>
<?php endif; ?>