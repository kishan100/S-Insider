<div class="modal-header">
	<button type="button" class="close" data-dismiss="modal">
		<span aria-hidden="true">&times;</span>
		<span class="sr-only">Close</span>
	</button>
</div>
<div class="modal-body">
	<table class="table table-bordered table-striped dataTable" id="example1" aria-describedby="example1_info">
		<thead>
			<tr role="row">
			<th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 100px;">Fields</th>
			<th tabindex="0" aria-controls="example1" rowspan="1" colspan="1" style="width: 317px;">Data</th>
			</tr>
		</thead>
		
		<tbody role="alert" aria-live="polite" aria-relevant="all">
			<tr class="odd">
				<td class=" ">Id</td>
				<td><?=$record->id?></td>
			</tr>
			<tr class="even">
				<td>Name</td>
				<td><?=$record->name?></td>
			</tr>
			<tr class="odd">
				<td>Emaik</td>
				<td><?=$record->email?></td>
			</tr>
			<tr class="even">
				 <td>Mobile Number</td>
				<td><?=$record->mobile_number?></td>
			</tr>
			<tr class="odd">
				<td>EMployee Code</td>
				<td><?=$record->emp_code?></td>
			</tr>
			<tr class="even">
				 <td>Designation</td>
				<td><?=$record->designation?></td>
			</tr>
		
			<tr class="even">
				<td>Joining Date</td>
				<td><?=$record->joining_date?></td>
			</tr>
			<tr class="odd">
				<td>Add Date</td>
				<td><?=$record->created?></td>
			</tr>
			<?php if($record->profile_img){?>
			<tr>
				<td>User Image</td>
				<td> <img src="<?php echo site_url();?>assets/uploads/member/<?php echo $record->profile_img;?>" width="200px">
                           </td>
			</tr>
		<?php } ?>
		</tbody>
	</table>
	<div class="modal-footer">
		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	</div>
</div>
