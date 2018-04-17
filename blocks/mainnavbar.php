<ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Cattle Manager">
    <a class="nav-link" href="/cattlemanager">
        <i class="fa fa-fw fa-dashboard"></i>
        <span class="nav-link-text">Cattle Manager</span>
    </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Pasture Manager">
    <a class="nav-link" href="/pasturemanager">
        <i class="fa fa-fw fa-map"></i>
        <span class="nav-link-text">Pasture Manager</span>
    </a>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Reports">
    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
        <i class="fa fa-fw fa-sitemap"></i>
        <span class="nav-link-text">Reports</span>
    </a>
    <ul class="sidenav-second-level collapse" id="collapseComponents">
		
		<!-- Available reports -->
		<?php 
		// get php object and create the nav menu
		$robj = json_decode($report);
		foreach ($robj as $rline) { ?>
			<li>
				<form method="POST" style=" margin-top: 1em;
											margin-bottom: 1em;
											border-width: 0px;
											margin-left: 2.75em;
											background-color: rgba(0,0,0,0);
											padding: 0px;
											
											"action="/reports<?php echo "$rline->reportUrl" ?>">
					<input type="hidden" name="reportId" id="reportId" value="<?php echo "$rline->reportId"; ?>"/>
				    <input type="submit" style="border-width: 0px;
				    							color: #868e96;
				    							color:hover: #adb5bd;
												background: rgba(0,0,0,0);
												padding-left: 0px;
												padding-top: .5em;
												padding-bottom: .5em;
				    							" value="<?php echo "$rline->reportName"; ?>" />
				</form>
			</li>
		<?php } ?>
		
    </ul>
    </li>
    <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Settings">
    <a class="nav-link" href="../settings">
        <i class="fa fa-fw fa-wrench"></i>
        <span class="nav-link-text">Settings</span>
    </a>
    </li>
</ul>
<ul class="navbar-nav sidenav-toggler">
    <li class="nav-item">
    <a class="nav-link text-center" id="sidenavToggler">
        <i class="fa fa-fw fa-angle-left"></i>
    </a>
    </li>
</ul>