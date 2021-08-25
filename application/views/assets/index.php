<?php $this->load->view('header');?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assets </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Assets</li>
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
				<a class="btn btn-primary float-sm-right" href="<?php echo site_url('assets/create')?>">Create Asset</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>                    
                    <th>Asset Name</th>
                    <th>Asset Type</th>
                    <th>Manufacturer</th>
                    <th>Serial Number1</th>
                    <th>Serial Number2</th>
                    <th>Additional Info</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($assets as $asset) {?>
                  <tr>
                    <td><?php echo $asset->asset_name;?></td>
                    <td><?php echo $asset->asset_type;?></td>
                    <td> <?php echo $asset->manufacturer;?></td>
                    <td> <?php echo $asset->serial_number1;?></td>
                    <td> <?php echo $asset->serial_number2;?></td>
                    <td> <?php echo $asset->additional_info;?></td>
                    <td> <?php echo $asset->status;?></td>
                    <td> <?php echo $asset->created_at;?></td>
                    <td> <?php echo $asset->updated_at;?></td>
                    <td>
					<span class="btn-group">
						<a href="<?php echo site_url('/assets/edit/'.$asset->asset_id)?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
						<a href="javascript:void(0)" onclick="delete_this(<?php echo $asset->asset_id?>)" class="btn btn-danger"><i class="fa fa-trash"></i></a>
					</span>
					</td>
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
			url: "<?php echo base_url(); ?>assets/delete",
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