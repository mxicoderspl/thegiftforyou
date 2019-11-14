<?php echo $header; ?>
<?php echo $sidebar; ?>

<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">

            <!--<div class="container">-->
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
                <div class="col-xs-12">
                    <div class="panel">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <h4 class="m-b-30 m-t-0"><i class="fa fa-credit-card"></i>&nbsp;&nbsp;Support
                                    <div class="col-sm-2 pull-right"> 
                                         <button class="btn btn-primary pull-right" type="button" data-toggle="modal" data-target="#support_frm_modal">Send Query</button>
                                    </div>
                                </h4>
                               
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="table-responsive">

                                        <div id="ebctransaction_processing" class="dataTables_processing" style="display: none;">Processing...</div>
                                        <table class="table ">
		                        <thead>
		                        <th>Ticket ID</th>
		                        <th>Title</th>
		                        <th>Message</th>
		                        <th>Reply</th>
		                        <th>Status</th>
		                        <th>Date</th>
		                        </thead>
		                        <tbody>
		                            <?php if(!empty($support_data)){ ?>
		                            <?php foreach ($support_data as $support) { ?>
		                                <tr>
		                                    <td><?php echo "10000".$support['id']."10"; ?></td>
		                                    <td><?php echo $support['title']; ?></td>
		                                    <td><?php echo nl2br($support['message']); ?></td>
		                                    <td><?php echo nl2br($support['reply']); ?></td>
		                                     <td><?php if ($support['status'] == 'Open') : ?>
		                                                <a href="#" class="btn btn-success btn-xs" title="Open"><?php echo ($support['status']); ?></a>
		                                            <?php else: ?>
		                                                <a href="#" class="btn btn-danger btn-xs" title="Colse"><?php echo ($support['status']); ?></a>
		                                            <?php endif; ?></td>
		                                    <td><?php echo $support['created_date']; ?></td>
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

                <!--</div>-->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="support_frm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	    <div class="modal-dialog" role="document">
		<?php echo form_open('Support/send_query', array('id' => 'support_frm', 'class' => 'form-horizontal')); ?>
		<div class="modal-content">
		    <div class="modal-body">
		        <h3 class="m-b-30 m-t-0 text-center text-primary"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Send Query</h3>
		        <div class="form-horizontal">
		            
		            <div class="col-md-12 col-xs-12">
		                <div class="form-group1">
		                    <label >Title</label><span class="error">*</span>
		                    <input class="form-control" name="title" id="title" placeholder="Title" type="text" value="">
		                </div>
		            </div>
		            
		            <div class="col-md-12 col-xs-12">
		                <div class="form-group1">
		                    <label >Message</label><span class="error">*</span>
		                    <textarea rows="10" id="message" name="message" placeholder="Add your query here..." class="form-control"></textarea>
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
