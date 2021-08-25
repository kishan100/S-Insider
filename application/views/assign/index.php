<?php $this->load->view('header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php echo @($_SESSION['roleId']==3)?"Request Asset(s)":"Assign(s)";?> 			
			</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./">Home</a></li>
              <li class="breadcrumb-item active">Assign</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"></h3>
				<?php if($_SESSION['roleId']==3){?><a class="btn btn-primary float-sm-right" href="<?php echo site_url('assign/create')?>">Create Request</a><?php }?>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr> 
					<?php if($_SESSION['roleId']!=3){?>
                    <th>User Name</th>
                    <th>User Email</th>
					<?php }?>
                    <th>Asset Type</th>                    
                    <th>Request Reason</th>
                    <th>Admin Note</th>
					<th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
					<?php if($_SESSION['roleId']!=3){?>
                    <th>Action</th>
					<?php }?>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($assigns as $assign) {?>
                  <tr>
					<?php if($_SESSION['roleId']!=3){?>
                    <td><?php echo $assign->username;?></td>
                    <td><?php echo $assign->useremail;?></td>
					<?php }?>
                    <td><?php echo $assign->asset_name;?></td>                    
                    <td> <?php echo $assign->request_reason;?></td>
                    <td> <?php echo $assign->admin_note;?></td>
					<td> <?php echo $assign->status;?></td>
                    <td> <?php echo $assign->created_at;?></td>
                    <td> <?php echo $assign->updated_at;?></td>
					<?php if($_SESSION['roleId']!=3){?>
                    <td>
					<span class="btn-group">
						<a href="<?php echo site_url('/assign/edit/'.$assign->employee_asset_id)?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0)" onclick="delete_this(<?php echo $assign->employee_asset_id?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					</span>
					</td>
					<?php }?>
                  </tr>
                  <?php }?>
            
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <script>
  function delete_this(del_id) {
	var con = confirm('Are you sure to want to delete this item.');
	if(con == true) {		
		$.ajax({
			url: "<?php echo base_url(); ?>assign/delete",
			method: "POST",
			dataType: "html",
			data: {del_id:del_id},
			success: function(data) {
				location.reload();
			}
		})
	}
}
  </script>
  <?php $this->load->view('footer');?>