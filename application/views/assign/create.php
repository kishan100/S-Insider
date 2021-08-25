<?php $this->load->view('header');?>
<div class="wrapper">

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Request Asset(s)</h1>
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
                <h3 class="card-title">Create Request</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <?php echo form_open('',array('class'=>"ajaxform",'id'=>"assignform",'name'=>"assignform",'method'=>"post",'accept-charset'=>"utf-8")); ?>
			  <div class="ajax_report alert" style="display:none">
					<button class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only"></span></button>
					<span class="ajax_message">Hello Message</span>
				</div> 
                <div class="card-body">
				  
				  <!--<div class="form-group">
					<label>Select User</label>
					<select class="form-control" name="user">
					<?php 
					if(!empty($users)){
						foreach($users as $user){?>
							<option value="<?php echo $user->id;?>"><?php echo $user->name." - ".$user->email;?></option>
						<?php }
					}
					?>
					</select>
				  </div>-->
				  
				  <div class="form-group">
					<label>Select Asset Type</label>
					<select class="form-control" name="asset_type">
					  <?php 
						if(!empty($assets)){
							foreach($assets as $asset){?>
								<option value="<?php echo $asset->asset_id;?>"><?php echo $asset->asset_name;?></option>
							<?php }
						}
						?>
					</select>
				  </div>
				  
				  <div class="form-group">
					<label>Request Reason</label>
					<textarea class="form-control" name="request_reason" rows="3" placeholder="Enter ..."></textarea>
				  </div>
				  
				  <!--<div class="form-group">
					<label>Status</label>
					<select class="form-control" name="status">
					  <option value="Pending">Pending</option>
					  <option value="Approved">Approved</option>
					  <option value="Cancelled">Cancelled</option>
					</select>
				  </div>-->

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