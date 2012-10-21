<?php if(!isset($sidebar) || $sidebar == "") $sidebar = 'left'; ?>

<?php if(strtolower($sidebar) == 'left'): ?>

	<div class="left">
		<div class="latestlisting">
        	<h2>Latest Listing</h2>
            <ul>
            	<li><a href="#">Latest Listing 1</a></li>
                <li><a href="#">Latest Listing 2</a></li>
                <li><a href="#">Latest Listing 3</a></li>
            </ul>
        </div>
	</div>
<?php elseif(strtolower($sidebar) == 'right'): ?>

	<div class="right">
    	
    </div>
<?php endif; ?>