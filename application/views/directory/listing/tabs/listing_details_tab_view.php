<?php if(strtolower($tab) == 'overview'): ?>
<div class="wordpane">
        <div class="editorpane">
            <?php echo $list->description; ?>
        </div>
        
        <div class="editorsideinfo">
            <h4>Location</h4>
            <p>
                <?php echo $list->address; ?><br />
                <?php echo "$list->suburb, $list->state, $list->postcode"; ?><br />
                <?php echo $list->country; ?>
            </p>
            
            <h4>Contact</h4>
            <p>Suncoast Enclosures </p>
            
            <ul>
                <li><a class="sprite viewphone" href="#">View phone number</a></li>
                <li><a class="sprite sendemail" href="#">Send email</a></li>
                <li><a class="sprite viewsite" href="#">View website</a></li>
            </ul>
        </div>
    </div>
    
    <?php elseif(strtolower($tab) == 'photos'): ?>
	
    
    <?php elseif($strtolower($tab) == 'map'): ?>
	
    <?php elseif($strtolower($tab) == 'enquiry'): ?>
    
    <?php endif; ?>