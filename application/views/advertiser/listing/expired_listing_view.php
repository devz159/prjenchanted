<div>
    <div class="datatable">
    <div class="addnewlisting"><a href="<?php echo base_url() . 'directory/listing'; ?>">Add new listing</a></div>
    <table>
        <thead>
            <tr>
                <!--<th class="firstchild">Status</th><th>Category</th>--><th>Title</th><th>Page Views</th><th>Phone Clicks</th><th>URL Clicks</th><th>Enquiries</th><th>Action</th>
            </tr>
        </thead>
        <tbody>
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
                <td><a class="hastooltip" tooltip="click to edit details" href="<?php echo base_url() . 'directory/listing/details/overview/' . $list->lst_id; ?>"><?php echo $list->title; ?></a></td>
                <td class="number"><?php echo $list->pgviews; ?></td>
                <td class="number"><?php echo $list->pclicks; ?></td>
                <td class="number"><?php echo $list->uclicks; ?></td>
                <td class="number"><?php echo $list->enq; ?></td>
                <td><a class="sprite repostbtn hastooltip" tooltip="repost this ad" lst_id="<?php echo $list->lst_id; ?>" href="<?php echo base_url("directory/listing/repost/$list->lst_id/$list->advr"); ?>">repost</a></td>
            </tr>
            <?php endforeach; ?>
            <tr class="datastatus">
            <td colspan="7">Showing <?php echo isset($rowcount) ? ($rowcount > 1) ? $rowcount . ' records' : $rowcount . ' record' : 'no record'; ?></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>