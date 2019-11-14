<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">
        <div id="sidebar-menu">
            <ul>
                <li class="<?php echo ($this->uri->segment(1)=='Dashboard')?'active':'';?>"> <a href="<?php echo site_url('Dashboard/index'); ?>" class="waves-effect <?php echo ($this->uri->segment(1)=='Dashboard')?'active':'';?>"><i class="mdi mdi-home"></i><span> Dashboard </span></a></li>
		<!--<li> <a title="admin wallet" href="<?php echo site_url('Wallet'); ?>" class="waves-effect"><i class="fa fa-briefcase"></i><span>  Wallet Transaction</span></a></li>
                 <li> <a title="admin Rewards" href="<?php echo site_url('Wallet/rewards'); ?>" class="waves-effect"><i class="fa fa-neuter"></i><span>  Rewards Transaction</span></a></li>-->
		<li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-gears"></i> <span>Settings</span> 			<span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Userkyc'); ?>">KYC</a></li>

                    </ul>
                </li>
               <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-credit-card"></i> <span> Transactions </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <!--<li><a href="<?php echo site_url('Wallet'); ?>">Wallet Transaction</a></li>-->
			<li><a href="<?php echo site_url('Wallet_to_wallet'); ?>">Wallet to Wallet Transaction</a></li>
                        <li><a href="<?php echo site_url('Wallet/rewards'); ?>">Rewards Transaction</a></li>
<li><a href="<?php echo site_url('Registrationpayment'); ?>">Registration Transaction</a></li>
                    </ul>
                </li>
		<li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-google-wallet"></i> <span> Accounts </span> <span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Wallet'); ?>">Wallet</a></li>
			<li><a href="<?php echo site_url('Companywallet'); ?>">Company Wallet</a></li>
                        
                    </ul>
                </li>
		<li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-users"></i> <span> Network </span> 			<span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Network'); ?>">My Network</a></li>
<!--                        <li><a href="<?php echo site_url('Wallet/rewards'); ?>">Rewards Transaction</a></li>
                        <li><a href="<?php echo site_url('Registrationpayment'); ?>">Registration Transaction</a></li>-->
                    </ul>
                </li>
		 <li class="<?php echo ($this->uri->segment(1)=='BusinessAccount')?'active':'';?>"> <a href="<?php echo site_url('BusinessAccount'); ?>" class="waves-effect <?php echo ($this->uri->segment(1)=='BusinessAccount')?'active':'';?>"><i class="fa fa-briefcase"></i><span> Business </span></a></li>
		<li class="<?php echo ($this->uri->segment(1)=='Support')?'active':'';?>"> <a href="<?php echo site_url('Support/index'); ?>" class="waves-effect <?php echo ($this->uri->segment(1)=='Support')?'active':'';?>"><i class="fa fa-question-circle"></i><span> Support Ticket </span></a></li>
		 <li> <a href="<?php echo site_url('ServiceFinder'); ?>" class="waves-effect"><i class="fa fa-search"></i><span>Find Services</span></a></li>

<!--           <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"> <i class="fa fa-briefcase"></i> <span> Wallet</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                     <!-- <li><a href="<?php echo site_url('Wallet/index'); ?>">Deposits & Withdrawals</a></li>
                      <li><a href="<?php echo site_url('Wallet/history'); ?>">History</a></li>-->
                       <!-- <li><a href="<?php echo site_url('Wallet/EBC'); ?>">EBC</a></li>
                        <!--<li><a href="<?php echo site_url('Wallet/ETH'); ?>">ETH</a></li>-->
                       <!-- <li><a href="<?php echo site_url('Wallet/BTC'); ?>">BTC</a></li>
                    </ul>
                </li>
                <li> <a href="<?php echo site_url('Exchange/index'); ?>" class="waves-effect"><i class="fa fa-exchange"></i> <span> Exchanges</span></a></li>
                
                <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-credit-card"></i> <span> Transaction</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Transaction/index'); ?>">Eblock Transaction</a></li>
                        <li><a href="<?php echo site_url('Transaction/usd'); ?>">USD Transaction</a></li>
                        <li><a href="<?php echo site_url('Transaction/ebc'); ?>">EBC Transaction</a></li>
                        <!--<li><a href="<?php echo site_url('Transaction/giftcard'); ?>">GiftCard Transaction</a></li>-->
                  <!--  </ul>
                </li>
                
               <!-- <li> <a href="<?php echo site_url('Transaction/index'); ?>" class="waves-effect"><i class="fa fa-credit-card"></i> <span> Transaction</span></a></li>-->
               <!-- <li> <a href="<?php echo site_url('Eblock/index'); ?>" class="waves-effect"><i class="fa fa-tree"></i> <span>My Eblocks</span></a></li>
                
                <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-gift"></i> <span> Gift Cards</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Egiftcards/index'); ?>">My Gift Card</a></li>
                        <li><a href="<?php echo site_url('Transaction/giftcard'); ?>">My GiftCard Orders</a></li>
                    </ul>
                </li>
                
                
                <!--<li> <a href="<?php echo site_url('Egiftcards/index'); ?>" class="waves-effect"><i class="fa fa-gift gold"></i> <span> Gift Cards</span></a></li>-->
               <!-- <li> <a href="<?php echo site_url('Gblock/index'); ?>" class="waves-effect"><i class="fa fa-credit-card gold"></i> <span> GBlock</span></a></li>
                <li> <a href="<?php echo site_url('Sblock/index'); ?>" class="waves-effect"><i class="fa fa-credit-card silver"></i> <span> SBlock</span></a></li>
                <li class="has_sub"> <a class="waves-effect" href="javascript:void(0);"><i class="fa fa-cog"></i> <span> Settings</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled" style="display:none">
                        <li><a href="<?php echo site_url('Profile/index'); ?>">My Profile</a></li>
                        <li><a href="<?php echo site_url('Profile/change_password'); ?>">Change Password</a></li>
                    </ul>
                </li>
                <li> <a href="<?php echo site_url('Affiliate/index'); ?>" class="waves-effect"><i class="mdi mdi-album"></i> <span> Affilate</span></a></li>-->
                <li> <a href="<?php echo site_url('Security/index'); ?>" class="waves-effect"><i class="fa fa-key"></i> <span>2FA Authenticator</span></a></li>

<li> <a href="<?php echo site_url('Dashboard/logout'); ?>" class="waves-effect"><i class="fa fa-sign-out"></i> <span>Logout</span></a></li>
                <!--<li> <a href="<?php echo site_url('support/index'); ?>" class="waves-effect"><i class="fa fa-headphones"></i> <span> Support and Ticket</span></a></li>
                <li> <a href="<?php echo site_url('News/index'); ?>" class="waves-effect"><i class="fa fa-book"></i> <span>News</span></a></li>
                <li> <a href="<?php echo site_url('Bounty/index'); ?>" class="waves-effect"><i class="fa fa-crosshairs"></i> <span> Bounty Campaign</span></a></li>
                -->
            </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>

