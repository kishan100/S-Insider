

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo site_url();?>">Home</a></li>
              <li class="breadcrumb-item active">Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
      
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">User Details</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <?php echo form_open('',array('class'=>"ajaxform","enctype"=>"multipart/form-data",'id'=>"adduser",'name'=>"form",'method'=>"post",'accept-charset'=>"utf-8")); ?>
			<div class="ajax_report alert" style="display:none">
				<button class="close" type="button"><span aria-hidden="true">×</span><span class="sr-only"></span></button>
				<span class="ajax_message">Hello Message</span>
			</div> 
                      <div class="card-body">
                        <?php if($this->session->userdata('roleId')==1){?>
                        <div class="form-group">
                              <label for="phonenumber">Select Role</label>
                              <select name="role_id" class="form-control">
                                <option  <?php if(isset($taskData->role_id) && $taskData->role_id==1){ echo "selected";}?> value="1">Admin</option>
                                <option <?php if(isset($taskData->role_id) && $taskData->role_id==2){ echo "selected";}?> value="2">IT Support</option>
                                <option <?php if(isset($taskData->role_id) && $taskData->role_id==3){ echo "selected";}?> value="3">Employee</option>
                              </select>
                          </div>
                          <?php }?>
                          <div class="form-group">
                              <label for="username">Name</label>
                              <input name="name" type="text" value="<?php echo isset($taskData->name)?$taskData->name:'';?>" class="form-control" id="username" placeholder="Enter your name">
                          </div>
                          <div class="form-group">
                              <label for="emailaddress">Email address</label>
                              <input type="email" name="email" class="form-control" value="<?php echo isset($taskData->email)?$taskData->email:'';?>" id="emailaddress" placeholder="Enter email" <?php echo @($_SESSION['memberId']==$taskData->id)?"readonly":"";?>>
                          </div>
                          <div class="form-group">
                              <label for="sarvikaid">Sarvika ID</label>
                              <input type="text" name="emp_code" class="form-control" value="<?php echo isset($taskData->emp_code)?$taskData->emp_code:'';?>" id="sarvikaid" placeholder="Enter your ID">
                          </div>
                          <div class="form-group">
                              <label for="designation">Designation</label>
                              <input type="text" name="designation" value="<?php echo isset($taskData->designation)?$taskData->designation:'';?>" class="form-control" id="designation" placeholder="Enter your designation">
                          </div>
                          <div class="form-group">
                              <label for="phonenumber">Mobile number</label>
                              <input type="text" name="mobile_number" value="<?php echo isset($taskData->mobile_number)?$taskData->mobile_number:'';?>" class="form-control" id="phonenumber" placeholder="Enter your number">
                          </div>
                          <?php if(isset($taskData->profile_img) && $taskData->profile_img!=""){?>
                            <img src="<?php echo site_url();?>assets/uploads/member/<?php echo $taskData->profile_img;?>" width="200px">
                            <?php }?>
                          <div class="form-group">
                              <label for="profilepicture">Profile Picture</label>
                              <input type="file" name="profile_img" value="" class="form-control" id="profilepicture" >
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
            
      
        <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>