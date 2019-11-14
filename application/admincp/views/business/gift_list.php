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
            <h4 class="page-title">Gifts</h4>
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
                            <div class="col-md-10 pull-left">
                            <h4 class="m-b-30 m-t-0">Gifts</h4>
                            </div>
                             <div class="col-md-2 pull-right"> 
                                         <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#support_frm_modal">Add Gift</button>
                                    </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <div id="datatable_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">

                                        <div class="row">
                                            <div class="col-sm-12">
                                                <table class="table table-striped table-bordered dataTable no-footer" id="datatable" role="grid" aria-describedby="datatable_info">
                                                    <thead>
                                                        <tr role="row">

                                                            <th class="col-md-3">Title</th>
                                                            <th class="col-md-3">Photo</th>
                                                           
                                                           
                                                            <th class="col-md-3 text-center">Action</th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $i = 0;
 
                                                        foreach ($giftlist as $sdata) {
                                                            
							?>
                                                            <tr role="row" class="odd">
                                                               
                                                                <td><?php echo $sdata['title']; ?></td>
                                                                <td><span class="pull-right"><?php echo $sdata['photo']; ?><img src="<?php base_url();?>..\uploads\gifts\<?php echo $sdata['photo']; ?>" ></span></td>
								
                                                               
                                                                
                                                                <td class="text-center">
                                                                    <a  href="#editmodal" title="Edit" id="edit_btn" data-toggle="modal" onclick="edit_setting('<?php echo base64_encode($sdata['id']); ?>');"> <i class="glyphicon glyphicon-edit"></i></a>
                                                                    
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
<!----------- edit modal-------------------------->
<div id="editmodal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content" id="model_data">

        </div>
    </div>
</div>

<div class="modal fade" id="support_frm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
		<?php echo form_open_multipart('Business/gift_add', array('id' => 'support_frm', 'class' => 'form-horizontal','enctype'=>'multipart/form-data')); ?>
		<div class="modal-content">
		    <div class="modal-body">
		        <h3 class="m-b-30 m-t-0 text-center text-primary">&nbsp;&nbsp;Add Gift</h3>
		        <div class="form-horizontal">
		            
		            <div class="row">
        <div class="col-md-3">Title</div>
        <div class="col-md-9">
            <input type="text" class="form-control" name="title" id="title"/><br>
                 
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">Photo</div>
        <div class="col-md-9">
            <input type="file" class="filestyle" data-buttonbefore="true" id="image" name="image" tabindex="-1" style="position: absolute; clip: rect(0px, 0px, 0px, 0px);">
        <div class="bootstrap-filestyle input-group">

        </div>
         
        </div>
    </div>
         
		           
		            <div class="clearfix"></div><br>
		            
		        </div>
		    </div>
		    <div class="modal-footer">
		        <button type="submit" id="" class="btn btn-primary lg-btn">Submit</button>
		        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		    </div>
		</div>
		<?php echo form_close(); ?>
	    </div>
	</div>



<?php echo $footer ?>

<script>
	$(document).ready(function(){
	   $('#support_frm').validate({
	       ignore: [],
	       rules:{
		   title:{
		       required:true
		   },
		   message:{
		       required: true
		   }
	       }
	   }); 
	});

	</script>



<!--jquer, javascript and ajax-->
<script type="text/javascript">
    function edit_setting(id)
    {

        var setting_id = id;
        $('#model_data').html('');
        $.ajax({
            url: "<?php echo site_url() . 'Business/update_gift' ?>",
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

<script>

jQuery("#support_frm").validate({

                                                rules: {
							
                                                    title: {
                                                        required: true,
                                                    },
                                                    
						                                                  
                                                },
                                                messages: {
                                                    title: {
                                                        required: "Please enter title",
                                                    },
						
                                                    
						   
                                                    
                                                }

                                            });
</script>

