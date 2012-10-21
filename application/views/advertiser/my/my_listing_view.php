<p>Displaying <?php echo isset($rowcount) ? ($rowcount > 1) ? $rowcount . ' records' : $rowcount . ' record' : 'no record'; ?></p>
<table>
	<thead>
    	<tr>
        	<th>Status</th><th>Category</th><th>Title</th><th>Page Views</th><th>Phone Clicks</th><th>URL Clicks</th><th>Enquiries</th><th>Action</th>
        </tr>
    </thead>
    <tbody>
    	<?php foreach($listings as $list): ?>
    	<tr>
        	<td><?php echo codeToImage($list->status); ?></td>
            <td><?php echo categoryLookUp($list->subcategory); ?></td>
            <td><?php echo $list->title; ?></td>
            <td><?php echo $list->pgviews; ?></td>
            <td><?php echo $list->pclicks; ?></td>
            <td><?php echo $list->uclicks; ?></td>
            <td><?php echo $list->enq; ?></td>
            <td>some icons</td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>