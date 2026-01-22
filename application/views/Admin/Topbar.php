<nav class="header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top navbar-semi-dark navbar-shadow">
    <div class="navbar-wrapper">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mobile-menu d-lg-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="fa-solid fa-sliders font-large-1"></i></a></li>
                <li class="nav-item mr-auto"><a class="navbar-brand" href="<?= base_url($this->data->controller);
			?>/Dashboard"><img class="brand-logo" alt="stack admin logo" src="<?= base_url($this->data->appTempletePath); ?>app-assets/images/logo/pcflogo.png">
					<h2 class="brand-text" style="font-family:verdana;">PCF</h2>
				</a></li>
                <li class="nav-item d-none d-lg-block nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="fa-solid fa-sliders font-medium-3 white" data-ticon="feather.icon-toggle-right"></i></a></li>
                <li class="nav-item d-lg-none"><a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="fa fa-ellipsis-v"></i></a></li>
			</ul>
		</div>
        <div class="navbar-container content">
            <div class="collapse navbar-collapse" id="navbar-mobile">
                <ul class="nav navbar-nav mr-auto float-left">
                    
                    <!--<li class="nav-item d-none d-md-block"><a class="nav-link nav-link-expand" href="#"><i class="ficon feather icon-maximize"></i></a></li>-->
					<span class="text-justify"><?= $this->data->appName; ?></span>
                    
				</ul>
                <ul class="nav navbar-nav float-right">
				
                    <li class="dropdown dropdown-user nav-item">
						<a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="avatar avatar-online"><img src="<?= base_url($this->data->appTempletePath); ?>app-assets/images/portrait/small/logo.png" alt="avatar"><i></i></div><span class="user-name"></span>
						</a>
                        <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="<?= base_url($this->data->controller); ?>/AccountSettings"><i class="fa fa-user"></i> My Profile</a><a class="dropdown-item" href="<?= base_url($this->data->controller); ?>/AccountSettings/ChangePassword"><i class="fa fa-key"></i> Change Password</a>
                            <div class="dropdown-divider"></div>
							<a class="dropdown-item" href="javascript:void(0);"data-toggle="modal" data-target="#logoutModal"><i class="fa fa-lock"></i> Logout</a>
							
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>