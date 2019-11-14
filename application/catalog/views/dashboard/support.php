<?php echo $header; ?>
<div class="content">
    <div class="m-t-10">
        <div class="page-header-title"> </div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">

            <div class="panel col-md-8 col-md-offset-2 col-xs-12">
                <div class="panel-body">
                    <h4 class="m-b-30 m-t-0"><i class="fa fa-envelope"></i>&nbsp;&nbsp;Support
                        <div class="col-sm-2 pull-right"> 
                            <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#support_frm_modal">Send Query</button>
                        </div>
                    </h4>
                    <div class="row">
                        <div class="col-xs-12">
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger">
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success">
                                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?> 

                            <table class="table">
                                <thead>
                                <th>Title</th>
                                <th>Message</th>
                                <th>Date</th>
                                </thead>
                                <tbody>
                                    <?php if(!empty($support_data)){ ?>
                                    <?php foreach ($support_data as $support) { ?>
                                        <tr>
                                            <td><?php echo $support['title']; ?></td>
                                            <td><?php echo $support['message']; ?></td>
                                            <td><?php echo date('d-m-Y h:i A', strtotime($support['created_date'])); ?></td>
                                        </tr>
                                    <?php } } else{ ?>
                                        <tr>
                                            <td colspan="3">No support request available.</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="support_frm_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <?php echo form_open('Dashboard/support', array('id' => 'support_frm', 'class' => 'form-horizontal')); ?>
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="m-b-30 m-t-0 text-center text-warning"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Send Query</h3>
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
                            <textarea id="message" name="message" placeholder="Add your query here..." class="form-control"></textarea>
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
<?php echo $footer; ?> 
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