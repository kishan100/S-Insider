<?php $this->load->view('header');?>
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Assets</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6 mx-auto">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Update Assets</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('',array('class'=>"ajaxform",'id'=>"assetsform",'name'=>"assetsform",'method'=>"post",'accept-charset'=>"utf-8")); ?>
			  <div class="ajax_report alert" style="display:none">
					<button class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only"></span></button>
					<span class="ajax_message">Hello Message</span>
				</div> 
                <div class="card-body">
				  
				  <div class="form-group">
                    <label for="asset_name">Asset Name</label>
                    <input type="text" class="form-control" id="asset_name" name="asset_name" placeholder="Enter Asset Name" value="<?php echo $asset->asset_name;?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="asset_type">Asset Type</label>
                    <input type="text" class="form-control" id="asset_type" name="asset_type" placeholder="Enter Asset Type" value="<?php echo $asset->asset_type;?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="manufacturer">Manufacturer</label>
                    <input type="text" class="form-control" id="manufacturer" name="manufacturer" placeholder="Enter Manufacturer" value="<?php echo $asset->manufacturer;?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="serial_number1">Serial Number1</label>
                    <input type="text" class="form-control" id="serial_number1" name="serial_number1" placeholder="Enter Serial Number1" value="<?php echo $asset->serial_number1;?>">
                  </div>
				  
				  <div class="form-group">
                    <label for="serial_number2">Serial Number2</label>
                    <input type="text" class="form-control" id="serial_number2" name="serial_number2" placeholder="Enter Serial Number2" value="<?php echo $asset->serial_number2;?>">
                  </div>
				  
				  <div class="form-group">
					<label>Additional Info</label>
					<textarea class="form-control" id="additional_info" name="additional_info" rows="3" placeholder="Enter ..."><?php echo $asset->additional_info;?></textarea>
				  </div>

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
</div>
<!-- ./wrapper -->
<?php $this->load->view('footer');?>