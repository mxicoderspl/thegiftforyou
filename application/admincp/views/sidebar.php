<div class="left side-menu">
    <div class="sidebar-inner slimscrollleft">

        <div id="sidebar-menu">
            <ul>
                <li> <a title="Dashboard " href="<?php echo site_url('Dashboard'); ?>" class="waves-effect"><i class="mdi mdi-home"></i><span> Dashboard</span></a></li>
		<li title="Users" class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-users"></i><span> Users</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul>
                        <li><a title="Enable Users" href="<?php echo site_url('Users'); ?>">Enable Users</a></li>
 			<li><a title="Disable User" href="<?php echo site_url('Users/disableuser'); ?>">Disable Users</a></li>
                       <!-- <li><a title="Add users" href="<?php echo site_url('Users/add'); ?>">Add Users</a></li>-->
			 <li><a title="Transaction" href="<?php echo site_url('Transaction'); ?>">Transaction</a></li>
                    </ul>
                </li>
                
                <li> <a title="Pages" href="<?php echo site_url('Pages'); ?>" class="waves-effect"><i class="fa fa-book"></i><span> Pages</span></a></li>
                
                <li class="has_sub" title="Setting"> <a href="javascript:void(0);" class="waves-effect"><i class="mdi mdi-google-pages"></i><span> Setting </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <li><a title="General Setting" href="<?php echo site_url('Setting'); ?>">General Setting</a></li>
                        <li><a title="SEM Setting" href="<?php echo site_url('sem'); ?>">SEM Setting</a></li>
                        <li><a title="Seo Setting" href="<?php echo site_url('seo'); ?>">SEO Setting</a></li>
			 <li><a title="Bank Info" href="<?php echo site_url('Bankinfo'); ?>">Bank Info</a></li>
                         <li><a title="Registration fee" href="<?php echo site_url('Fixpayment'); ?>">Registration fee</a></li>
               
                    </ul>
                </li>
              
                <li class="has_sub" title="Email"> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-envelope"></i><span> Email </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                         <li><a title="Frontend" href="<?php echo site_url('emailformat'); ?>">Frontend</a></li>
                         <li><a title="Backend" href="<?php echo site_url('emailformat/backend'); ?>">Backend</a></li>
                       
                    </ul>
                </li>
                  <li> <a title="Rewards" href="<?php echo site_url('Rewards'); ?>" class="waves-effect"><i class="fa fa-trophy"></i><span> Rewards</span></a></li>
                  <li> <a title="Payments" href="<?php echo site_url('Payment'); ?>" class="waves-effect"><i class="fa fa-bank"></i><span> Payments</span></a></li>
 		
                 <li title="Banner" class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-sliders"></i><span> Banner </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul>
                        <li><a title="Banner" href="<?php echo site_url('Slider'); ?>">View Banner</a></li>
                        <li><a title="Add Banner" href="<?php echo site_url('Slider/add'); ?>">Add Banner</a></li>
                    </ul>
                </li>
                <li class="has_sub" title="Admin Transaction"> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-briefcase"></i></i><span> Admin transaction </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <!--<li><a title="admin wallet" href="<?php echo site_url('Adminwallet'); ?>">Wallet Transaction</a></li>-->
                        <li><a title="admin Rewards" href="<?php echo site_url('Adminwallet/rewards'); ?>"> Rewards Transaction</a></li>
                        
                    </ul>
                </li>

		<!--<li> <a title="admin wallet" href="<?php echo site_url('Adminwallet'); ?>" class="waves-effect"><i class="fa fa-briefcase"></i><span> Admin Wallet</span></a></li>
                 <li> <a title="admin Rewards" href="<?php echo site_url('Adminwallet/rewards'); ?>" class="waves-effect"><i class="fa fa-neuter"></i><span> Admin Rewards</span></a></li>-->
		
                

               
		
		<li title="Transaction" class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-exchange"></i><span> Transaction</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul>
                       <!-- <li> <a title="Transaction" href="<?php echo site_url('Transaction'); ?>" class="waves-effect"><span>Wallet Transaction</span></a></li>-->
		<li> <a title="Registration Transaction" href="<?php echo site_url('Fixpayment/registerpayment'); ?>" class="waves-effect"><span> Registration Transaction</span></a></li>
		<li> <a title="Company Wallet Transaction" href="<?php echo site_url('Wallettransaction'); ?>" class="waves-effect"><span> Company Wallet Transaction</span></a></li>		
		<li> <a title=" Wallet to Wallet Transaction" href="<?php echo site_url('Wallet'); ?>" class="waves-effect"><span> Wallet to Wallet Transaction</span></a></li>
                    </ul>
                </li>
<li> <a title="KYC Users	" href="<?php echo site_url('Userkyc'); ?>" class="waves-effect"><i class="fa fa-google-wallet"></i><span> KYC Users</span></a></li>
		<li> <a title="Business Plan" href="<?php echo site_url('Business'); ?>" class="waves-effect"><i class="fa fa-trophy"></i><span>Business Plan</span></a></li>
 		<li> <a title="Tax" href="<?php echo site_url('Tax'); ?>" class="waves-effect"><i class="fa fa-percent"></i><span> Tax</span></a></li>
		<li class="has_sub" title="Business Service"> <a href="javascript:void(0);" class="waves-effect"><i class=" fa fa-asl-interpreting"></i></i><span> Business Service </span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul class="list-unstyled">
                        <!--<li><a title="Country" href="<?php echo site_url('Country'); ?>">Country</a></li>-->
			<li><a title="States" href="<?php echo site_url('States'); ?>">States</a></li>
			<li><a title="Business type" href="<?php echo site_url('BusinessType'); ?>">Business Type</a></li>
			<li><a title="service" href="<?php echo site_url('service'); ?>">Business service list</a></li>
                       
               
                    </ul>
                </li>
		<li> <a title="Suports Ticket" href="<?php echo site_url('support'); ?>" class="waves-effect"><i class="fa fa-question-circle"></i><span> support Ticket</span></a></li>
		<li class="has_sub"><a href="javascript:void(0);" class="waves-effect"><i class="fa fa-comments-o"></i><span>Testimonial</span><span class="pull-right"><i class="mdi mdi-plus"></i></span></a>
                    <ul>
                        <li><a title="Testmonial" href="<?php echo site_url('Testimonial'); ?>">Testimonial</a></li>
                        <li><a title="Add new" href="<?php echo site_url('Testimonial/addnew'); ?>">Add New </a></li>
                    </ul>
                </li>
		
		<!--<li> <a title="Registration fee" href="<?php echo site_url('Fixpayment'); ?>" class="waves-effect"><i class="fa fa-money"></i><span> Registration fee</span></a></li>
 		
		<li> <a title="Rewards" href="<?php echo site_url('Rewards'); ?>" class="waves-effect"><i class="fa fa-trophy"></i><span> Rewards</span></a></li>
 		
		
 		<!--<li> <a title="Security" href="<?php echo site_url('Security'); ?>" class="waves-effect"><i class="mdi mdi-key"></i><span> 2FA Authenticator</span></a></li>-->
	
		
           
             </ul>
        </div>
        <div class="clearfix"></div>
    </div>
</div>


