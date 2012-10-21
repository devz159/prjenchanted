
        	<?php $cntr = 0; ?>	
           <?php foreach($listings as $list): ?>
            <tr
            	<?php 
            		echo (($cntr % 2) == 0) ?  ' class="even" ' : ' class="odd" ';
					$cntr++;
				?>
            >
                <!--<td><?php echo codeToImage($list->status); ?></td>-->
               <!-- <td><?php //echo categoryLookUp($list->subcategory); ?></td>-->
                <td><a class="hastooltip" tooltip="click to view details" href="<?php echo base_url() . 'directory/listing/details/overview/' . $list->lst_id; ?>"><?php echo $list->title; ?></a></td>
                <td class="number"><?php echo $list->pgviews; ?></td>
                <td class="number"><?php echo $list->pclicks; ?></td>
                <td class="number"><?php echo $list->uclicks; ?></td>
                <td class="number"><?php echo $list->enq; ?></td>
                <td><a class="sprite editbtn hastooltip" lst_id="<?php echo $list->lst_id; ?>" tooltip="edit" href="<?php echo base_url() . 'advertiser/my/section/edit_list/' . $list->lst_id; ?>">&nbsp;</a> <a class="sprite deletebtn hastooltip" tooltip="delete" lst_id="<?php echo $list->lst_id; ?>" href="<?php echo base_url() . 'advertiser/my/section/active_list'; ?>">&nbsp;</a> <a class="sprite upgradebtn hastooltip<?php echo ($list->package == '1') ? ' premium' : ''; ?>" tooltip="<?php echo ($list->package == '1') ? 'premium - can\'t be upgraded' : 'upgrade to premium'; ?>" lst_id="<?php echo $list->lst_id; ?>" href="#">&nbsp;</a></td>
            </tr>
            <?php endforeach; ?>
            <tr class="datastatus">
            <td colspan="7">Showing <?php echo isset($rowcount) ? ($rowcount > 1) ? $rowcount . ' records' : $rowcount . ' record' : 'no record'; ?></td>
            </tr>