<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<link rel="shortcut icon" href="<?php echo base_url(); ?>/assets/images/favicon.ico">


<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Country</h4>
           
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
                            <h4 class="m-b-30 m-t-0 pull-left">Country</h4>
                             <div class="col-sm-2 pull-right"> 
                                         <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#support_frm_modal">Add New</button>
                                    </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="table-responsive">

                                        <div id="ebctransaction_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                        <table class="table table-primary mb30 table-hover table-bordered ">
		                        <thead>
		                        <th> ID</th>
		                        <th>Name</th>
                                        <th>Action</th>
		                        </thead>
		                        <tbody>
		                            <?php if(!empty($support)){ ?>
		                            <?php foreach ($support as $support) { ?>
		                                <tr>
		                                    <td><?php echo $support['id']; ?></td>
		                                    <td><?php echo $support['name']; ?></td>
		                                   
		                                     
		                                    <td >
                                                    <a href="#myModal" title="Edit" id="edit_btn" onclick="edit_setting('<?php echo base64_encode($support['id']); ?>');" data-toggle="modal"> <i class="glyphicon glyphicon-edit"></i></a>
                                                     <a class="dt" href="#deletemodal" data-id="<?php echo $support['id'] ?>"  title="Delete" data-toggle="modal" > <i class="glyphicon glyphicon-trash"></i></a>
                                                          
                                                </td>
		                                </tr>
		                            <?php } } else{ ?>
		                                <tr>
		                                    <td colspan="3">No support request available.</td>
		                                </tr>
		                            <?php } ?>
		                        </tbody>
		                    </table>

                                        <!--</div>-->
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
    </div>
</div>
<!----------- edit modal-------------------------->
<div class="modal fade" id="support_frm_modal" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="panelt panel-success-head">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Add new country</h3>
            </div>

		<?php echo form_open('Country/index', array('id' => 'support_frm', 'class' => 'form-horizontal')); ?>
		
		            
		            <div class="col-md-12 col-xs-12">
		                <div class="form-group1">
		                    <label >Name</label><span class="error">*</span>
		                    <input class="form-control" name="title" id="title" placeholder="Name" type="text" value="">
		                </div>
		            </div>
		            
		            

		           
		            <div class="clearfix"></div><br>
		            
		       
		    <div class="modal-footer">
		        <button type="submit" id="" class="btn btn-primary lg-btn">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		
		<?php echo form_close(); ?>
	    </div>
	</div>
	</div>
<div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <?php echo form_open('Country/delete', array('class' => 'form-horizontal')); ?>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Delete Country</h3>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to delete this Country ?</h5>
                <input type="hidden" value="" id="deleteuserid" name="deleteuserid"/>

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
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-hidden="true"> 
    <div class="modal-dialog">
        <div class="modal-content">
            <!--<div class="panelt panel-success-head">-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h3 class="modal-title">Edit Country</h3>
            </div>
		<div class="" id="model_data">
                        </div>
		</div>
	   </div>
	</div>

<?php echo $footer ?>

<script>
    $(document).on("click", ".dt", function () {

        var id = $(this).data('id');
      
          $('#deleteuserid').val(id);
     
    });
	$(document).ready(function(){
	   $('#support_frm').validate({
	       ignore: [],
	       rules:{
		   title:{
		       required:true
		       
		   },
		  
	       }
	   }); 
	});

	</script>



<script type="text/javascript">
    function edit_setting(id)
    {

        var setting_id = id;
        $('#model_data').html('');
        $.ajax({
            url: "<?php echo site_url() . 'country/update' ?>",
            type: "POST",
            dataType: "html",
            data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>', 'setting_id': setting_id, },
            catch : false,
            success: function (data) {
                $('#model_data').append(data);

            }
        });
    }
</script>
