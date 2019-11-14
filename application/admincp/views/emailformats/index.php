<?php echo $header; ?>
<?php echo $sidebar; ?>
    
    <div class="content-page">
    
    
    
        <div style="position: fixed; top: 0px; bottom: 0px; left: 0px; right: 0px; margin: auto; padding: 8px; text-align: center; vertical-align: middle; width: 85px; height: 85px; z-index: 1000000; background: rgba(0, 0, 0, 0.7) none repeat scroll 0% 0%; border-radius: 4px; display: none;" id="ajaxLoading1"><img style="margin-bottom:8px;width:45px;height:45px" src="<?php echo base_url();?>/assets/images/ajax-loading.gif">
            <p style="margin:0;font-size:14px;color:#fff">loading...</p>
        </div>
<div class="content">
    <div class="">
        <div class="page-header-title">
            <h4 class="page-title">Email Templates Frontend</h4>
        </div>
    </div>
    <div class="page-content-wrapper ">
        <div class="container">
            <div class="row row-stat">
                <?php if ($this->session->flashdata('success')) { ?>
                    <div class="alert alert-success fade in" style="margin-top:18px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong><?php echo $this->session->flashdata('success'); ?></strong> 
                    </div>
                <?php } ?>
                <?php if ($this->session->flashdata('error')) { ?>
                    <div class="alert alert-success fade in" style="margin-top:18px;">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">×</a>
                        <strong><?php echo $this->session->flashdata('fail'); ?></strong> 
                    </div>
                <?php } ?>
            </div>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel">
                        <div class="panel-body">

                            <h4 class="m-b-30 m-t-0"></h4>
                            <div class="row">
                                <div class="table-responsive">


                                    <table class="table table-primary mb30 table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <!--th>#</th-->
                                                <th>Title</th>
                                                <th>Subject</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <?php if (!empty($emailformats)) { ?>
                                            <?php for ($i = 0; $i < count($emailformats); $i++) { ?>
                                                <tbody>
                                                    <tr>
                                                        <!--td><?php echo $i + 1 ?></td-->
                                                        <td><?php echo $emailformats[$i]['title']; ?></td>
                                                        <td><?php echo $emailformats[$i]['subject']; ?></td>
                                                        <td class="text-center">
                                                            <a href="<?php echo site_url('emailformat/edit/' . base64_encode($emailformats[$i]['id'])); ?>" title="Edit"><i class="glyphicon glyphicon-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tbody><?php echo "No record found" ?></tbody>
                                        <?php } ?>
                                    </table>
                                </div>
                                <div class="pull-left">
                                    Legend(s): &nbsp; 
                                    <i class="glyphicon glyphicon-edit"></i>&nbsp; Edit &nbsp;
                                </div>
                            </div>
                        </div></div>


                </div>
            </div>
        </div>
    </div>
</div>








<?php echo $footer; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.close').click(function () {
            $('.alert').hide();
        });
    });
</script>

