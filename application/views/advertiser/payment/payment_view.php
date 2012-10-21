<div>
	
	
    <div class="datatable">
    
    <table>
        <thead>
            <tr>
                <th>Payment Date</th>
                <th>PayPal Transaction ID</th><th>Amount</th><th>Status</th>
            </tr>
        </thead>
        <tbody>
        	<?php $cntr = 0; ?>	
           <?php foreach($payments as $p): ?>
            <tr class="hastooltip" tooltip="<?php echo ($p->title) ? 'Listing Title: ' . $p->title : 'No title has been supplied'; ?>"
            	<?php 
            		echo (($cntr % 2) == 0) ?  ' class="even" ' : ' class="odd" ';
					$cntr++;
				?>
            >
               
                <td><?php echo getDateArr($p->created_at); ?></td>
                <td><?php echo $p->paypal_trans_id; ?></td>
                <td class="number"><?php echo '<span class="red">' . $p->amount . ' ' . $this->config->item('currency_code') . '</span>'; ?></td>
                <td><?php echo $p->status; ?></td>               
            </tr>
            <?php endforeach; ?>
            <tr class="datastatus">
            <td colspan="7">Showing <?php echo isset($rowcount) ? ($rowcount > 1) ? $rowcount . ' records' : $rowcount . ' record' : 'no record'; ?></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>