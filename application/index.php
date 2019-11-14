<?php echo $header; ?>        
<section> 
    <div class="mainwrapper">
        <?php echo $sidebar; ?>
        <div class="mainpanel">
            <div class="pageheader">
                <div class="media">
                    <div class="pageicon pull-left">
                        <i class="fa fa-home"></i>
                    </div>
                    <div class="media-body">
                        <ul class="breadcrumb">
                            <li><a href=""><i class="glyphicon glyphicon-home"></i></a></li>
                            <li>Dashboard</li>
                        </ul>
                        <h4>Dashboard</h4>
                    </div>
                </div><!-- media -->
            </div><!-- pageheader -->                    
            <div class="contentpanel">
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
                <div class="contentpanel">

                    <div class="col-md-4 pointt" >
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><i class="fa fa-user"></i></div>
                                    <div class="media-body">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5 pull-left">User</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="<?php echo site_url('Users'); ?>"><h4 class="nomargin">Total users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_users; ?></h4>
                                    </div>

                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin">Total active users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_enable_user; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin">Total Inactive users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_disable_user; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <!--<a href="<?php //echo site_url('Users');   ?>">--><h4 class="nomargin">Payment verified users</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_verified; ?></h4>
                                    </div>
                                </div>
                                <!--<div class="clearfix">
                                   <div class="pull-left">
        <h5 class="md-title nomargin"></h5>
        <!--<a href="<?php //echo site_url('Users');   ?>"><h4 class="nomargin"></h4></a>
    </div>
    <div class="pull-right">
        <h5 class="md-title nomargin"></h5>
        <h4 class="nomargin"></h4>
    </div>
                                </div>-->

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/reward.png" class="bt-icon" /><!--<i class="fa fa-times"></i>--></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Reward</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('Rewards'); ?>"> <h4 class="nomargin">Total rewards</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Active Rewards</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards_enable; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Inactive Rewards</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards_disable; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Highest Reward Amount</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $highest_reward_amount; ?></h4>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/extra-pay.png" class="bt-icon" /><!--<i class="fa fa-dot-circle-o"></i>--></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Extra payouts</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('Rewards/payout'); ?>"><h4 class="nomargin">Total Extra Payouts</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards_extra ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Active Payouts</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards_enable_extra ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Inactive Payouts</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_rewards_disable_extra ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Highest Payout Amount</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $highest_reward_amount_extra ?></h4>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="clearfix"></div>
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/e-block.png" class="bt-icon" /><!--<i class="fa fa-cogs"></i>--></div>
                                    <div class="media-body pull-left">
                                        <!--<h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Regular</h3>

                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Active/Inactive</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn regularclass">
                                            <input  id="regular" data-toggle="toggle" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $this->data['regular_total_eblocks']; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Holding eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $regular_holding_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Pending eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $regular_pending_eblocks ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Paid eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $regular_paid_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Bonus eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $regular_bonus_eblocks; ?></h4>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/silver-coin.png" class="bt-icon" /><!--<i class="fa fa-envelope"></i>--></div>
                                    <div class="media-body pull-left">
                                        <h3 class="mt5">Silver</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>

                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Active/Inactive</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn silverclass">
                                            <input  id="silver" data-toggle="toggle" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $this->data['silver_total_eblocks']; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Holding eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $silver_holding_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Pending eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $silver_pending_eblocks ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Paid eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $silver_paid_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Bonus eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $silver_bonus_eblocks; ?></h4>
                                    </div>
                                </div>



                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/gold-coin.png" class="bt-icon" /><!--<i class="fa fa-book"></i>--></div>
                                    <div class="media-body pull-left">
                                        <h3 class="mt5">Gold</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Active/Inactive</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn goldclass">
                                            <input  id="gold" data-toggle="toggle" type="checkbox">
                                        </h4>
                                    </div>
                                </div>

                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $this->data['gold_total_eblocks']; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Holding eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $gold_holding_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Pending eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $gold_pending_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Paid eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $gold_paid_eblocks; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total Bonus eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $gold_bonus_eblocks; ?></h4>
                                    </div>
                                </div>

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>

                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
        <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/gift-card.png" class="bt-icon" /><!--<i class="fa fa-search-plus"></i>--></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Gift card</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <a href="<?php echo site_url('Giftcard_order'); ?>"><h4 class="nomargin">Total gift card</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_gift_orders; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total pending</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_gift_pending; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total confirmed</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_gift_confirmed; ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Total declined</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $total_gift_declined; ?></h4>
                                    </div>
                                </div>
                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>

                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><i class="fa fa-dot-circle-o"></i></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Affiliate</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="<?php echo site_url('Affiliate');?>"><h4 class="nomargin">Total affiliate</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $inactive_affiliate+$active_affiliate; ?> &nbsp;</h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">Total active affiliate</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $active_affiliate; ?> &nbsp;</h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">Total deactive affiliate</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $inactive_affiliate; ?> &nbsp;</h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="#"><h4 class="nomargin"></h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php //echo $btc_bal;   ?> &nbsp;<!--<i  class="glyphicon glyphicon-qrcode" data-toggle="modal" data-target="#btcwalletaddress"></i>--></h4>
                                    </div>
                                </div>

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/bitocin.png" class="bt-icon" /></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">BTC</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="#"><h4 class="nomargin">Available balance</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin"><?php echo $btc_bal; ?> &nbsp;<i  class="glyphicon glyphicon-qrcode" data-toggle="modal" data-target="#btcwalletaddress"></i></h4>
                                    </div>
                                </div>
                                


                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><img src="<?php echo base_url(); ?>../userdash/image/e-block.png" class="bt-icon" /></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5"><?php echo $this->config->item('coin_name');?></h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="<?php echo site_url('Adminwallet/ebcr');?>"><h4 class="nomargin">Balance</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5> 
                                        <h4 class="nomargin"><span id="ebcr_wallet_balance">0.00000000</span><?php //echo $btc_bal; ?> &nbsp;<i  class="glyphicon glyphicon-qrcode" data-toggle="modal" data-target="#ebcrwalletaddress"></i>&nbsp;<i  class="fa fa-paper-plane" data-toggle="modal" data-target="#ebcrwithdrawmodal"></i></h4>
                                    </div>
                                </div>
                                 


                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    <div class="clearfix"></div>
                    <!--<div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><i class="fa fa-list"></i></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                       <!-- <h3 class="mt5">Statges</h3>
                                    </div><!-- media-body -->
                             <!--   </div>
                                <hr>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">Total stages</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">25 &nbsp;</h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">Total tokens</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">60000000 &nbsp;</h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h5 class="md-title nomargin"></h5>
                                        <a href="#"><h4 class="nomargin">Available tokens</h4></a>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin">2500000 &nbsp;</h4>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="panel-body" id="icotime">
                                                <h4 class="m-b-30 m-t-0 text-center"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Buy IBO TIME </h4>
                                                <div id="clockdiv211" class="allclockdiv">
                                                    <div><span class="days"></span>
                                                        <div class="smalltext">Days</div>
                                                    </div>
                                                    <div><span class="hours"></span>
                                                        <div class="smalltext">Hr</div>
                                                    </div>
                                                    <div><span class="minutes"></span>
                                                        <div class="smalltext">Min</div>
                                                    </div>
                                                    <div><span class="seconds"></span>
                                                        <div class="smalltext">Sec</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <center><i class="fa fa-calendar"></i>&nbsp;<a href="#" onclick="date_modal()" style="color:#000">Change IBO Date</a></center>

                            </div><!-- panel-body -->
                      <!--  </div><!-- panel -->
                  <!--  </div>
                    -->
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><i class="fa fa-cogs"></i></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">General Settings</h3>
                                    </div><!-- media-body -->
                                </div>
                                <hr>
                                <br>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">BTC</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn btcclass">
                                            <input  id="btc" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">EBCR</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn ebcclass">
                                            <input  id="ebc" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">EBCR Conversion</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn ebcconversionclass">
                                            <input  id="ebc_conversion" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Allocate Eblocks</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn allocateeblocksclass">
                                            <input  id="allocate_eblocks" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Gift Cards</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn giftcardsclass">
                                            <input  id="giftcards" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>
                                
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h4 class="nomargin">Signup</h4>
                                    </div>
                                    <div class="pull-right">
                                        <h5 class="md-title nomargin"></h5>
                                        <h4 class="nomargin dash-tgbtn signupclass">
                                            <input  id="signup" data-toggle="toggle" data-on="Enabled" data-off="Disabled" type="checkbox">
                                        </h4>
                                    </div>
                                </div>


                            </div><!-- panel-body -->
                        </div><!-- panel -->
                    </div>
                    
                    <div class="col-md-4 pointt">
                        <div class="panel panel-success-alt noborder">
                            <div class="panel-heading noborder">
                                <div class="main-header">
                                    <div class="panel-icon pull-right"><i class="fa fa-list"></i></div>
                                    <div class="media-body pull-left">
                                        <!--                                            <h5 class="md-title nomargin">Admin</h5>-->
                                        <h3 class="mt5">Eblocks</h3>
                                    </div><!-- media-body -->
                               </div>
                                <hr>
                               
                                
                                
                                
                                <div class="panel-body" id="icotime">
                                                <h4 class="m-b-30 m-t-0 text-center"><i class="mdi mdi-album"></i>&nbsp;&nbsp;Buy Eblock TIME </h4>
                                                <div id="clockdiv211" class="allclockdiv">
                                                    <div><span class="days"></span>
                                                        <div class="smalltext">Days</div>
                                                    </div>
                                                    <div><span class="hours"></span>
                                                        <div class="smalltext">Hr</div>
                                                    </div>
                                                    <div><span class="minutes"></span>
                                                        <div class="smalltext">Min</div>
                                                    </div>
                                                    <div><span class="seconds"></span>
                                                        <div class="smalltext">Sec</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <center><i class="fa fa-calendar"></i>&nbsp;<a href="#" onclick="date_modal()" style="color:#000">Change Eblock Date</a></center>

                            </div><!-- panel-body -->
                        </div><!-- panel -->
                   </div>
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    






                </div><!-- contentpanel -->
            </div><!-- mainpanel -->
        </div><!-- mainwrapper -->
</section>

<div id="btcwalletaddress" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">BTC Wallet address</h4>
            </div>
            <div class="modal-body">
                <p><b><?php echo $btc_wallet_address; ?></b>
                    <br>Pending received balance: <?php echo $btc_pending_bal; ?>

                </p>
            </div>

        </div>

    </div>
</div> 


<div id="ebcrwithdrawmodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->config->item('coin_name'); ?> Withdraw</h4>
            </div>
            <div class="modal-body">
                <div class="text-left">
                                        <?php echo form_open('#', array('id' => 'withdrawform', 'class' => '')); ?>
                                        
                                        <div class="form-group m-b-30">
                                            <label>To Address</label>
                                            <input id="to_address" name="to_address" class="form-control" placeholder="To Address" type="text">
                                        </div>
                                        <div class="form-group m-b-30">
                                            <label>Amount Sent</label>
                                            <input id="amount" name="amount" class="form-control" required placeholder="Withdraw Amount" type="text">
                                            <span class="note">Transaction Fee : <?php echo $withdrawal_fee; ?> <?php echo $this->config->item('coin_name'); ?></span> </div>
                                        <div class="form-group m-b-30">
                                            <label>Total Amount</label>
                                            <input id="amount_sent" class="form-control" required placeholder="Amount" type="text" disabled="">
                                        </div>
                                        <!--<div class="form-group m-b-30">
                                            <label>Password</label>
                                            <input id="password" name="password" class="form-control" required placeholder="Wallet Password" type="password">
                                        </div>-->
                                        <div class="form-group m-b-20">
                                            <button id="ebcr-withdraw-btn" class="btn btn-primary waves-effect waves-light" type="button" onclick="withdraw()">Withdraw <?php echo $this->config->item('coin_name'); ?></button>
                                        </div>
                                        <?php echo form_close(); ?>

                                    </div>
                <div class="clearfix"></div>
            </div>

        </div>

    </div>
</div>
<div id="ebcrwalletaddress" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $this->config->item('coin_name'); ?> Wallet address</h4>
            </div>
            <div class="modal-body">
                <div class="panel text-center">
                                <div class="panel-body p-t-10 center-coin">
                                    <img src="https://chart.googleapis.com/chart?cht=qr&chl=<?php echo $admin_ebcr_wallet_address; ?>&chs=200x200&chld=L|0"
                                         class="qr-code img-thumbnail img-responsive">
                                </div>
                                              <!--<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d0/QR_code_for_mobile_English_Wikipedia.svg/220px-QR_code_for_mobile_English_Wikipedia.svg.png" class="img-responsive" />-->

                                <div class="col-xs-12">
                                    <div class="form-group m-b-30">
                                        <input id="ebcr_wallet_address" class="form-control" required="" placeholder="Copy Address" type="text" value="<?php echo $admin_ebcr_wallet_address; ?>" readonly >
                                        <span class="note pull-left">Send <?php echo $this->config->item('coin_name'); ?> on this cryptoaddress or scan QR-code with your mobile <?php echo $this->config->item('coin_name'); ?> Wallet</span>
                                    </div>
                                    <div class="form-group m-b-30">
                                        <a id="copyButton" class="btn btn-primary waves-effect waves-light pull-left" href="#">Copy Wallet Address</a>
                                    </div>
                                </div>
                                 </div>
                <div class="clearfix"></div>
            </div>

        </div>

    </div>
</div> 

<div id="datemodal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Change Eblock Purchase Date</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                        
                        <label for="usd">Eblock Date:</label>
                        <input type="text" required="" placeholder="YYYY-MM-DD HH:MM:SS" value="<?php echo $admininfo['eblock_date'];?>" id="ico_date" class="form-control">
                        
                    </div>
                <input type="button" value="Submit" class="btn btn-default" onclick="change_ico_date()">
            </div>
            <div class="modal-footer">
                    <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                </div>

        </div>

    </div>
</div> 

<?php echo $footer ?>
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

<script>
    $(document).ready(function () {
            $('#to_address').val('');
            $('#amount').val('');
            
            $('#amount_sent').val('');

            if ($('#amount').val() <= 0) {
                $('#amount_sent').val(0);

            }
            else {
                $('#amount_sent').val(parseFloat($('#amount').val()) + '<?php echo $withdrawal_fee; ?>');
            }
            $('#withdrawform').validate({
                rules: {
                    'to_address': {
                        required: true,
                    },
                    'amount': {
                        required: true,
                        number: true
                    },
                   
                },
                messages: {
                    'to_address': {
                        required: "Please enter wallet address!",
                    },
                    'amount': {
                        required: "Please enter amount!",
                    },
                    
                },
            });
        });
    
        $('#amount').keyup(function (event) {
            if ($('#amount').val() <= 0) {
                $('#amount_sent').val(0);
            }
            else {
                var feee=parseFloat('<?php echo $withdrawal_fee; ?>');
                
                var amt=(parseFloat($('#amount').val()) + feee ); 
                $('#amount_sent').val(amt.toFixed(8));
            }
        });

        $('#amount').keypress(function (event) {
            if (event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46)
                return true;

            else if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
                event.preventDefault();
        });
     function withdraw() {
            document.getElementById("ebcr-withdraw-btn").disabled = true;   
            $('#ajaxLoading1').css('display', 'block');
            if ($('#withdrawform').valid()) {

                $.ajax({
                    url: "<?php echo base_url() . 'Dashboard/withdrawequestebcr' ?>",
                    type: "POST",
                    dataType: "json",
                    data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',
                        to_address: $('#to_address').val(),
                        amount: $('#amount').val(),
                        to_address:$('#to_address').val(),
                               // password: $('#password').val(),
                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            $('#to_address').val('');
                            $('#amount').val('');
                            //$('#password').val('');
                            $('#amount_sent').val('');
                           // reload_ebctransaction_table();
                            flash_alert_msg(data.msg, 'success', 10000);
                        }
                        else {
                            flash_alert_msg(data.msg, 'error', 10000);
                        }
                        $('#ajaxLoading1').css('display', 'none');

                    }
                });
            }

        }
    
    function copyToClipboard(elem) {
            // create hidden text element, if it doesn't already exist
            var targetId = "_hiddenCopyText_";
            var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
            var origSelectionStart, origSelectionEnd;
            if (isInput) {
                // can just use the original source element for the selection and copy
                target = elem;
                origSelectionStart = elem.selectionStart;
                origSelectionEnd = elem.selectionEnd;
            } else {
                // must use a temporary form element for the selection and copy
                target = document.getElementById(targetId);
                if (!target) {
                    var target = document.createElement("textarea");
                    target.style.position = "absolute";
                    target.style.left = "-9999px";
                    target.style.top = "0";
                    target.id = targetId;
                    document.body.appendChild(target);
                }
                target.textContent = elem.textContent;
            }
            // select the content
            var currentFocus = document.activeElement;
            target.focus();
            target.setSelectionRange(0, target.value.length);

            // copy the selection
            var succeed;
            try {
                succeed = document.execCommand("copy");
            } catch (e) {
                succeed = false;
            }
            // restore original focus
            if (currentFocus && typeof currentFocus.focus === "function") {
                currentFocus.focus();
            }

            if (isInput) {
                // restore prior selection
                elem.setSelectionRange(origSelectionStart, origSelectionEnd);
            } else {
                // clear temporary content
                target.textContent = "";
            }
            return succeed;
        }
      document.getElementById("copyButton").addEventListener("click", function () {
            copyToClipboard(document.getElementById("ebcr_wallet_address"));
        });
    function get_ebcr_balance(){
              $('#ajaxLoading1').css('display', 'block');
           $.ajax({
                url: "<?php echo base_url() . 'Dashboard/get_ebcr_balance' ?>",
                type: "POST",
                dataType: "json",
                data: {'<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'},
                catch : false,
                success: function (data) {
                   // data = JSON.parse(data);
                    if (data.status == 'success') {
                        $('#ebcr_wallet_balance').html(data.data);
                      //  flash_alert_msg(data.msg, 'success', 10000);
                        
                    }
                    else{
                       // flash_alert_msg(data.msg, 'error', 10000);
                    }
                      $('#ajaxLoading1').css('display', 'none');
                    //closeLoading();
                }
            });
        }
$(document).ready(function () {
get_ebcr_balance();
 $('#ico_date').datetimepicker({
        format:'YYYY-MM-DD HH:mm:ss',
    });    
    
    var deadline = "<?php echo $eblock_date_timer; ?>";
    run_clock('clockdiv211', deadline);
/*var deadline = "<?php //echo $timer_deadline; ?>";
            if ('<?php //echo $stage_live; ?>' == 0) {
                run_clock('clockdiv211', deadline);

            }
            else if ('<?php //echo $stage_live; ?>' == 2) {
                $('#icotime').html('<center><h4>All IBO Rounds Completed</h4></center>');
            }
            else {

                $('#icotime').html('<center><h4>' + '<?php //echo $live_stage_name; ?>' + '</h4></center>');
            }*/

        });
        
        
function date_modal(){
$('#datemodal').modal();
}        
 function change_ico_date() {

 $.ajax({
            url: "<?php echo site_url('Dashboard/change_ico_date'); ?>",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>',ico_date:$('#ico_date').val()
            },
            type: "post",
            dataType: "json",
            success: function (data) {
               if (data.status == 'success') {
                   flash_alert_msg(data.msg, 'success', 5000);
                   $('#datemodal').modal('hide');
                    location.reload();
               }
               else {
                  flash_alert_msg(data.msg, 'error', 10000);
               }
            }
        });
 }      
    function initial_data() {

        $.ajax({
            url: "<?php echo site_url('Dashboard/get_settings'); ?>",
            data: {
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            type: "post",
            dataType: "json",
            success: function (data) {
                if (data.data.regular == 1) {
                    $('.regularclass .toggle').removeClass('off');
                    $('#regular').prop('checked', true);
                }
                else {
                    $('.regularclass .toggle').addClass('off');
                    $('#regular').prop('checked', false);
                }

                if (data.data.silver == 1) {
                    $('.silverclass .toggle').removeClass('off');
                    $('#silver').prop('checked', true);
                }
                else {
                    $('.silverclass .toggle').addClass('off');
                    $('#silver').prop('checked', false);
                }

                if (data.data.gold == 1) {
                    $('.goldclass .toggle').removeClass('off');
                    $('#gold').prop('checked', true);
                }
                else {
                    $('.goldclass .toggle').addClass('off');
                    $('#gold').prop('checked', false);
                }
                
                
                if (data.data.btc == 1) {
                    $('.btcclass .toggle').removeClass('off');
                    $('#btc').prop('checked', true);
                }
                else {
                    $('.btcclass .toggle').addClass('off');
                    $('#btc').prop('checked', false);
                }
                 if (data.data.ebc == 1) {
                    $('.ebcclass .toggle').removeClass('off');
                    $('#ebc').prop('checked', true);
                }
                else {
                    $('.ebcclass .toggle').addClass('off');
                    $('#ebc').prop('checked', false);
                }
                
                
                 if (data.data.ebc_conversion == 1) {
                    $('.ebcconversionclass .toggle').removeClass('off');
                    $('#ebc_conversion').prop('checked', true);
                }
                else {
                    $('.ebcconversionclass .toggle').addClass('off');
                    $('#ebc_conversion').prop('checked', false);
                }
                
                 if (data.data.allocate_eblocks == 1) {
                    $('.allocateeblocksclass .toggle').removeClass('off');
                    $('#allocate_eblocks').prop('checked', true);
                }
                else {
                    $('.allocateeblocksclass .toggle').addClass('off');
                    $('#allocate_eblocks').prop('checked', false);
                }
                if (data.data.giftcards == 1) {
                    $('.giftcardsclass .toggle').removeClass('off');
                    $('#giftcards').prop('checked', true);
                }
                else {
                    $('.giftcardsclass .toggle').addClass('off');
                    $('#giftcards').prop('checked', false);
                }
                
                if (data.data.signup == 1) {
                    $('.signupclass .toggle').removeClass('off');
                    $('#signup').prop('checked', true);
                }
                else {
                    $('.signupclass .toggle').addClass('off');
                    $('#signup').prop('checked', false);
                }
            }
        });
    }

    $(function () {
        initial_data();
        $('#regular').change(function () {

            if ($(this).prop('checked')) {
                var eblock = 'Yes';
            }
            else {
                var eblock = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_eblock_settings'); ?>",
                data: {eblock: eblock, block_type: 'regular',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Regular eblocks has been Activated', 'success', 3000);
                            $('.regularclass .toggle').removeClass('off');
                            $('#regular').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Regular eblocks has been Deactivated', 'success', 3000);
                            $('.regularclass .toggle').addClass('off');
                            $('#regular').prop('checked', false);
                        }

                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Regular eblocks has been Activated', 'success', 3000);
                            $('.regularclass .toggle').removeClass('off');
                            $('#regular').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Regular eblocks has been Deactivated', 'success', 3000);
                            $('.regularclass .toggle').addClass('off');
                            $('#regular').prop('checked', false);
                        }
                    }
                }
            });







        });

        $('#silver').change(function () {

            if ($(this).prop('checked')) {
                var eblock = 'Yes';
            }
            else {
                var eblock = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_eblock_settings'); ?>",
                data: {eblock: eblock, block_type: 'silver',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Silver eblocks has been Activated', 'success', 3000);
                            $('.silverclass .toggle').removeClass('off');
                            $('#silver').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Silver eblocks has been Deactivated', 'success', 3000);
                            $('.silverclass .toggle').addClass('off');
                            $('#silver').prop('checked', false);
                        }

                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Silver eblocks has been Activated', 'success', 3000);
                            $('.silverclass .toggle').removeClass('off');
                            $('#silver').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Silver eblocks has been Deactivated', 'success', 3000);
                            $('.silverclass .toggle').addClass('off');
                            $('#silver').prop('checked', false);
                        }
                    }
                }
            });







        });



        $('#gold').change(function () {

            if ($(this).prop('checked')) {
                var eblock = 'Yes';
            }
            else {
                var eblock = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_eblock_settings'); ?>",
                data: {eblock: eblock, block_type: 'gold',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Gold eblocks has been Activated', 'success', 3000);
                            $('.goldclass .toggle').removeClass('off');
                            $('#gold').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Gold eblocks has been Deactivated', 'success', 3000);
                            $('.goldclass .toggle').addClass('off');
                            $('#gold').prop('checked', false);
                        }

                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Gold eblocks has been Activated', 'success', 3000);
                            $('.goldclass .toggle').removeClass('off');
                            $('#gold').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Gold eblocks has been Deactivated', 'success', 3000);
                            $('.goldclass .toggle').addClass('off');
                            $('#gold').prop('checked', false);
                        }
                    }
                }
            });







        });
        
        
        
        $('#btc').change(function () {

            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_btc_ebc'); ?>",
                data: {checked: checked, currency: 'btc',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('BTC has been enabled', 'success', 3000);
                            $('.btcclass .toggle').removeClass('off');
                            $('#btc').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('BTC has been disabled', 'success', 3000);
                            $('.btcclass .toggle').addClass('off');
                            $('#btc').prop('checked', false);
                        }

                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('BTC has been enabled', 'success', 3000);
                            $('.btcclass .toggle').removeClass('off');
                            $('#btc').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('BTC has been disabled', 'success', 3000);
                            $('.btcclass .toggle').addClass('off');
                            $('#btc').prop('checked', false);
                        }
                    }
                }
            });







        });
        
        
        $('#ebc').change(function () {

            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_btc_ebc'); ?>",
                data: {checked: checked, currency: 'ebc',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('EBC has been enabled', 'success', 3000);
                            $('.ebcclass .toggle').removeClass('off');
                            $('#ebc').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('EBC has been disabled', 'success', 3000);
                            $('.ebcclass .toggle').addClass('off');
                            $('#ebc').prop('checked', false);
                        }

                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('EBC has been enabled', 'success', 3000);
                            $('.ebcclass .toggle').removeClass('off');
                            $('#ebc').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('EBC has been disabled', 'success', 3000);
                            $('.ebcclass .toggle').addClass('off');
                            $('#ebc').prop('checked', false);
                        }
                    }
                }
            });







        });
        
        
         $('#ebc_conversion').change(function () {
            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_settings'); ?>",
                data: {checked: checked, field: 'ebc_conversion',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('EBC conversion has been enabled', 'success', 3000);
                            $('.ebcconversionclass .toggle').removeClass('off');
                            $('#ebc_conversion').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('EBC conversion has been disabled', 'success', 3000);
                            $('.ebcconversionclass .toggle').addClass('off');
                            $('#ebc_conversion').prop('checked', false);
                        }
                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('EBC conversion has been enabled', 'success', 3000);
                            $('.ebcconversionclass .toggle').removeClass('off');
                            $('#ebc_conversion').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('EBC conversion has been disabled', 'success', 3000);
                            $('.ebcconversionclass .toggle').addClass('off');
                            $('#ebc_conversion').prop('checked', false);
                        }
                    }
                }
            });
        });
        
        
        
        $('#allocate_eblocks').change(function () {
            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_settings'); ?>",
                data: {checked: checked, field: 'allocate_eblocks',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Allocate eblocks has been enabled', 'success', 3000);
                            $('.allocateeblocksclass .toggle').removeClass('off');
                            $('#allocate_eblocks').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Allocate eblocks has been disabled', 'success', 3000);
                            $('.allocateeblocksclass .toggle').addClass('off');
                            $('#allocate_eblocks').prop('checked', false);
                        }
                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Allocate eblocks has been enabled', 'success', 3000);
                            $('.allocateeblocksclass .toggle').removeClass('off');
                            $('#allocate_eblocks').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Allocate eblocks has been disabled', 'success', 3000);
                            $('.allocateeblocksclass .toggle').addClass('off');
                            $('#allocate_eblocks').prop('checked', false);
                        }
                    }
                }
            });
        });
        
        
         $('#giftcards').change(function () {
            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_settings'); ?>",
                data: {checked: checked, field: 'giftcards',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Giftcards has been enabled', 'success', 3000);
                            $('.giftcardsclass .toggle').removeClass('off');
                            $('#giftcards').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Giftcards has been disabled', 'success', 3000);
                            $('.giftcardsclass .toggle').addClass('off');
                            $('#giftcards').prop('checked', false);
                        }
                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Giftcards has been enabled', 'success', 3000);
                            $('.giftcardsclass .toggle').removeClass('off');
                            $('#giftcards').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Giftcards has been disabled', 'success', 3000);
                            $('.giftcardsclass .toggle').addClass('off');
                            $('#giftcards').prop('checked', false);
                        }
                    }
                }
            });
        });
        
        
        $('#signup').change(function () {
            if ($(this).prop('checked')) {
                var checked = 'Yes';
            }
            else {
                var checked = 'No';
            }
            $.ajax({
                url: "<?php echo site_url('Dashboard/change_settings'); ?>",
                data: {checked: checked, field: 'signup',
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                },
                type: "post",
                dataType: "json",
                success: function (data) {
                    if (data.status == 'success') {
                        if (data.data == 'Yes') {
                            flash_alert_msg('Signup has been enabled', 'success', 3000);
                            $('.signupclass .toggle').removeClass('off');
                            $('#signup').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Signup has been disabled', 'success', 3000);
                            $('.signupclass .toggle').addClass('off');
                            $('#signup').prop('checked', false);
                        }
                    }
                    else {
                        flash_alert_msg(data.msg, 'error', 10000);
                        if (data.data == 'Yes') {
                            flash_alert_msg('Signup has been enabled', 'success', 3000);
                            $('.signupclass .toggle').removeClass('off');
                            $('#signup').prop('checked', true);
                        }
                        else {
                            flash_alert_msg('Signup has been disabled', 'success', 3000);
                            $('.signupclass .toggle').addClass('off');
                            $('#signup').prop('checked', false);
                        }
                    }
                }
            });
        });
    })
</script>
