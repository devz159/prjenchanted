<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<meta name="url" content="<?php echo base_url();?>" />
	<title>Newcastle-Hunter Directory</title>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>images/favicon.ico" />
    <?php getHeader(); ?>
</head>

<body>

<div id="MainContainer">
	<?php $this->load->view($main_content); ?>
</div>

</body>
</html>