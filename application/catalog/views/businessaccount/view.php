<?php echo $header; ?>
<?php echo $sidebar; ?>
<div class="content-page">
    <div class="content">
        <div class="m-t-10">
            <div class="page-header-title"> </div>
        </div>
        <div class="page-content-wrapper ">
            <div class="container">

                <div class="panel col-md-12 col-xs-10">
                    <div class="panel-body">
                        <h4 class="m-b-30 m-t-0"><i class="fa fa-user"></i>&nbsp;&nbsp;Enter Business Information
			</h4>
                            <?php if ($this->session->flashdata('error')) { ?>
                                <div class="alert alert-danger" id="myerror">
                                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>                        
                                </div>
                            <?php } ?>
                            <?php if ($this->session->flashdata('success')) { ?>
                                <div class="alert alert-success" id="myerror">
                                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                                </div>
                            <?php } ?> 
                            <div class="col-sm-2 pull-right"> 

                            </div>
                        
                        <div class="row">
			</div>
		   </div>
		</div>
	     </div>
	  </div>
	</div>	
