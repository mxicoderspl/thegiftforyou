<?php echo $header; ?><?php echo $sidebar; ?>

<div class="content-page">
  <div class="content">
    <div class="m-t-10">
      <div class="page-header-title"> </div>
    </div>
    <div class="page-content-wrapper ">
      <div class="container">
        <div class="panel col-md-12 col-xs-10">
          <div class="panel-body">
            <h4 class="m-b-30 m-t-0"><i class="fa fa-user"></i>&nbsp;&nbsp;Service Finder </h4>
            <?php if ($this->session->flashdata('error')) { ?>
            <div class="alert alert-danger" id="myerror"> <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?> </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
            <div class="alert alert-success" id="myerror"> <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?> </div>
            <?php } ?>
            <div class="col-sm-2 pull-right"> </div>
            <div class="row">
              <div class="col-md-3">
                <div class="form-group">
                  <label>Keywords</label>
                  <input type="text" class="form-control" required="" placeholder="Keywords">
                </div>
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>Address</label>
                  <input type="text" class="form-control" required="" placeholder="Address">
                </div>
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>Business Category</label>
                  <input type="text" class="form-control" required="" placeholder="Business Category">
                </div>
              </div>
			  <div class="col-md-3">
                <div class="form-group">
                  <label>&nbsp;</label>
                  <button type="button" class="btn btn-default col-xs-12 padng_rmv">Find</button>
                </div>
              </div>
            </div>
			<div class="clearfix"></div><br>
			<div class="row">
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="clearfix"></div>
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div class="col-sm-4">
			  <div class="panel">
				<div class="panel-body user-card">
				  <div class="media-main"> <a class="pull-left" href="#"> <img class="thumb-lg img-circle" src="http://mbdbtechnology.com/projects/dhaval/admin-design1/web-admin/assets/images/users/avatar-2.jpg" alt=""> </a>
					<div class="info">
					  <h4>Pauline I. Bird</h4>
					  <p class="text-muted">Family Member</p>
					</div>
				  </div>
				  <div class="clearfix"></div>
				  <p class="text-muted info-text"> Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Deo,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.</p>
				  <hr>
				  <ul class="social-links list-inline m-b-0">
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Facebook"><i class="fa fa-facebook"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="Twitter"><i class="fa fa-twitter"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="1234567890"><i class="fa fa-phone"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="@skypename"><i class="fa fa-skype"></i></a></li>
					<li> <a title="" data-placement="top" data-toggle="tooltip" class="tooltips" href="#" data-original-title="email@email.com"><i class="fa fa-envelope-o"></i></a></li>
				  </ul>
				</div>
			  </div>
			</div>
			<div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
