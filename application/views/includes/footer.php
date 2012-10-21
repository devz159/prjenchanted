<?php if(strtolower($section) != 'admin'): ?>
    <div id="footer">
        <div class="middle">
            <div class="ftrLeft">
                <div class="copyright"><p>www.newcastle-hunter.com  © 2012</p></div>
                <div class="sitelinks">
                    <ul>
                        <li class="firstchild"><a href="#">home</a></li>
                        <li><a href="#">about</a></li>
                        <li><a href="#">contact</a></li>
                        <li><a href="<?php echo base_url(); ?>advertiser/my">advertiser</a></li>
                        <li class="lastchild"><a href="#">private policy</a></li>
                    </ul>
                </div>
                <div class="developer"><p><a href="#">Developed by: Mugs &amp; Coffee</a></p></div>
            </div>    
            <div class="ftrRight">
                <div class="feedcontainer"><a href="#"><span class="sprite feed"></span>Feed</a></div>
            </div>
        </div>
    </div>

<?php else: ?>
	<div id="footer">
	<div class="middle">
            <p>&copy; 2012 www.newcastle-hunter.com</p>
	</div>
</div>
<?php endif; ?>