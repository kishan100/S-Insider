
<link href="https://cdn.jsdelivr.net/gh/GedMarc/bootstrap4-dialog/dist/css/bootstrap-dialog.css" rel="stylesheet" type="text/css" />


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
          <div class="col-12">
           

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Users</h3>
				<?php if($_SESSION['roleId']!=3){?>
					<a class="btn btn-primary float-sm-right" href="<?php echo site_url('users/add_user');?>">Add New</a>
				<?php }?>
              </div>
              <!-- /.card-header -->
              <div class="alert alert-danger" style="display:none">
                  <button data-hide="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                  <span class="entypo-attention"></span>
                  <span class="error">Hello</span>
                </div>
                <div class="alert alert-success" style="display:none">
                  <button data-hide="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                  <span class="entypo-thumbs-up"></span>
                  <span class="success">Hello</span>
                </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobil Number</th>
                    <th>Employee Code</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($users as $user) {?>
                  <tr id="post_<?php echo $user->id?>">
                    <td><?php echo $user->name;?></td>
                    <td><?php echo $user->email;?></td>
                    <td><?php echo $user->mobile_number;?></td>
                    <td> <?php echo $user->emp_code;?></td>
                    <td class="text-center">
                      
					<span class="btn-group">
                      	<a class="btn btn-default viewDetail" data-toggle="modal" data-target="#myModal" href="<?php echo site_url('users/view_detail/'.$user->id);?>"><i class="fa fa-search"></i></a>
						<a href="<?php echo site_url('/users/edit/'.$user->id)?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
						<?php if($_SESSION['memberId']!=$user->id){?>
						<a onclick="javascript:performTask('delete','<?=$user->id?>')" class="btn btn-danger"><i class="fa fa-trash"></i></a>
						<?php }?>
						<?php /* if($user->is_active==0) { ?>
						<span class="status_<?php echo $user->id?>"><a onclick="javascript:performTask('t','<?php echo $user->id;?>')" class="btn btn-success"><i class="fa fa-check"></i></a></span>
						<?php } else  { ?>
						<span class="status_<?php echo $user->id?>"><a onclick="javascript:performTask('f','<?php echo $user->id;?>')" class="btn btn-danger"><i class="fa fa-times"></i></a></span>
						<?php } */?>
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
        
<!-- END PAGE CONTENT -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog ">
		<div class="modal-content">
				Loading..
		</div>
	</div>
</div>
<div class="modal fade" id="addNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			
		</div>
	</div>
</div>
<script>
	$('body').on('hidden.bs.modal', '.modal', function () {
		$(this).removeData('bs.modal');
	});
  $(document).on('click', '.viewDetail', function (e) {
    $('#myModal .modal-content').html('Loading..');
   	$.get(jQuery(this).attr('href'),function(res){
      $('#myModal .modal-content').html(res);
    });
	});
	$(function(){
	$("[data-hide]").on("click", function(){
			$(this).closest("." + $(this).attr("data-hide")).hide();
		});
	});
	function wait(){
	
	}
	function waitEnd(){
	
	}
	
function performTask(task,id)
{
	if(task=='t'){
		var status = 'Active';
	} else if(task=='f'){
		var status = 'Inactive';
	}
	else if(task=='No'){
		var status = 'No';
	}
	else if(task=='Yes'){
		var status = 'Yes';
	}
	else {
		var status = task;
	}

	BootstrapDialog.confirm({title:'Please Confirm',message:'Are you sure to '+status+' this post?',callback: function(r){
		if (r==true)
		{
			var posturl='<?=site_url('users')?>/performTask/'+task+'/'+id;
			$.ajax({
				url: posturl,
				dataType: 'json',
				type: "GET",
				beforeSend: function(){
					wait();
				},
				success: function(data){
					waitEnd();
					if(data.success_message)
					{ 	
            if(data.success==true){
              $(".alert-success").show('slow');
						$(".success").html(data.success_message);
            } else{
              $(".alert-danger").show('slow');
					  	$(".error").html(data.success_message);
            }
           
						if(task=='delete')
						{
              if(data.success){
                var status = $(".statusshow_"+id+" button").text();
					      $("#post_"+id).hide('slow');
              } else {
                var status = $(".statusshow_"+id+" button").text();
					     
              }
						
						}
						else if(task=='t')
						{
							$('.active_count').text(active_count+1);
							$('.inactive_count').text(inactive_count-1);
							var status = "'"+"f"+"'";
							var showid = "'"+id+"'";
							$(".status_"+id).html('<a title="Mark as Inactive" onclick="javascript:performTask('+status+','+showid+')" class="btn btn-danger"><i class="fa fa-times status_'+id+'"></i></a>');
							$(".statusshow_"+id).html('<button class="btn btn-success" type="button">Active</button>');
						}
						else if(task=='Yes')
						{
							var status = "'"+"No"+"'";
							var showid = "'"+id+"'";
							$(".status_"+id).html('<a title="Mark as Pending" onclick="javascript:performTask('+status+','+showid+')" class="btn btn-danger"><i class="fa fa-times"></i></a>');
							$(".statusshow_"+id).html('<button class="btn btn-success" type="button">Approved</button>');
						}
						else if(task=='No')
						{
							var status = "'"+"Yes"+"'";
							var showid = "'"+id+"'";
							$(".status_"+id).html('<a title="Mark as Approved" onclick="javascript:performTask('+status+','+showid+')" class="btn btn-success"><i class="fa fa-check"></i></a>');
							$(".statusshow_"+id).html('<button class="btn btn-danger" type="button">Pending</button>');
						}
						$("#success").fadeOut('slow');
					}
				},
				error: function (data) {
					console.log("Server Error.");
					return false;
				}
			});
		}
	}});
	return false;
}

</script>