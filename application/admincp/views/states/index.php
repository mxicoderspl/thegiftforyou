<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/sm-logo.png">


<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">States</h4>
	
<!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#transaction">Transfer Amount</button>-->
        </div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="catm-alert-msg">
                        <?php if ($this->session->flashdata('success')) { ?>
                            <div class="alert alert-success">
                                <button type="button" class="close" onclick="closediv()" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('error')) { ?>
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true" onclick="closediv()">&times;</button>
                                <strong> <?php echo $this->session->flashdata('error'); ?> </strong>
                            </div>
                        <?php } ?>
                        <?php if ($this->session->flashdata('info')) { ?>
                            <div class="alert alert-info">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <strong><?php echo $this->session->flashdata('info'); ?> </strong>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-primary">
                        <div class="panel-body">
                            <h4 class="m-b-30 m-t-0">States
				<a href="#addmodal" class="btn btn-primary pull-right" title="Add" id="add_btn" data-toggle="modal" > Add<i class="glyphicon glyphicon-Add"></i></a>				
				</h4>
				
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12 table-responsive">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatable" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr role="row">
                                                            <!--<th class="col-cd-3">Image</th>-->
                                                            <th>Id</th>
                                                            <!--<th class="col-xs-6">Link</th>-->
                                                            <th>Name</th>
                                                            <th>Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
                                                        foreach ($states as $data) {
                                                            ?>
                                                            <tr role="row" class="odd">
                                                                
                                                                <td><?php echo $data['id']; ?></td>
                                                               <td><?php echo $data['name']; ?></td>
                                                                <!--<td class="text-center"> <?php if ($data['status'] == "Enable") { ?>
                                                                        <a class="btn btn-success btn-xs st" href="#change_status" data-id="<?php echo $data['id'] ?>" data-status="<?php echo $data['status'] ?>" data-toggle="modal">Enable</a>
                                                                    <?php } else { ?>
                                                                        <a class="btn btn-danger btn-xs st"  href="#change_status"  data-id="<?php echo $data['id'] ?>" data-status="<?php echo $data['status'] ?>" data-toggle="modal">Disable</a>
                                                                    <?php } ?>
                                                                </td>-->
                                                                <td class="">
                                                                    <a href="#editmodal" title="Edit" id="edit_btn" data-toggle="modal" onclick="edit_state('<?php echo base64_encode($data['id']); ?>');"> <i class="glyphicon glyphicon-edit"></i></a>
                                                                    <!--<a class="dt" href="#deletemodal" data-id="<?php echo $data['id'] ?>"  title="Delete" data-toggle="modal" > <i class="glyphicon glyphicon-trash"></i></a>-->
                                                                </td>

                                                            </tr>
                                                            <?php
                                                            $i++;
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>

                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!----------- add modal-------------------------->
<div id="addmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="add_model_data">
		<?php echo form_open('States/add', array('id' => 'frmAdd','method'=>'POST')); ?>
		<div class="modal-header"> 
    			<button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
			<h4 class="modal-title">Add States</h4>	
		</div>

		<div class="modal-body">
    			<div class="form-group col-md-6">
       			 <label class="form-lable">State Name<span class="text-danger">*</span></label>
       			 <input type="text" class="form-control" name="state" id="state"/>
    			</div>
  
    			<div class="form-group col-md-6">
       			 <label class="form-lable">Country</label>
	
        			<select class="form-control" name="country" id="country">
            				<option value="">Select Country</option>
					<?php foreach($countries as $country){ ?>
						<option value="<?php echo $country['id']?>"><?php echo $country['name']?></option>		
					<?php }?>
        			</select>
    		</div>
  
    <div class="clearfix"></div>
    
</div>
<div class="modal-footer"> 
    <input type="submit" class="btn btn-primary" value="Add" />
</div>
<?php echo form_close(); ?>

        </div>
    </div>
</div>

<!----------- edit modal-------------------------->
<div id="editmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="model_data">

        </div>
    </div>
</div>

<div class="modal fade" id="change_status" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="panelt panel-success-head">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Change Status</h3>
            </div>
            <?php echo form_open('BusinessType/update_status', array('class' => 'form-horizontal')); ?>
            <div class="modal-body">
                <input type="hidden" id="slideid" name="slideid"/>
                <input type="hidden" id="old_status" name="old_status"/>

                <h5>Are you sure you want to change the <b>STATUS</b> ?</h5>

            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>

                    <button type="submit" class="btn btn-success">Yes</button>

                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>

<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('Slider/delete', array('class' => 'form-horizontal')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete Slide</h3>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Slide ?</h5>
                <input type="hidden" value="" id="deleteslideid" name="deleteslideid"/>

            </div>
            <div class="modal-footer">
                <div class="pull-right">
                    <button type="submit" class="btn btn-danger">Yes</button>
                    <button data-dismiss="modal" class="btn btn-default">No</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>


<?php echo $footer ?>

<script>
$(document).on("click", ".st", function () {

        var id = $(this).data('id');
        var st = $(this).data('status');

        $('#slideid').val(id);
        $('#old_status').val(st);

    });


   function edit_state(id)
        {

            var state_id = id;
            $('#model_data').html('');
            $.ajax({
                url: "<?php echo site_url() . 'States/update' ?>",
                type: "POST",
                dataType: "html",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'state_id': state_id, },
                catch : false,
                success: function (data) {
                       
                    $('#model_data').append(data);
                 
                }
            });
        }

jQuery("#frmAdd").validate({

        rules: {

            state: {
                required: true,
            },
	    country:{
		required: true,
		}
          },
        messages: {
            state: {
                required: "Please enter name of the State"
            },
            country: {
             	required: "Please select Country"
             },
        }

    });

  $("#state").keypress(function (event) {
	
	var inputValue = event.which;
        // allow letters and whitespaces only.
        if(!(inputValue >= 65 && inputValue <= 120) && (inputValue != 32 && inputValue != 0) && (inputValue != 08)) { 
            event.preventDefault(); 
        }
    });

</script>
