
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <img class="logo" src="img/logo.png">
            <!-- <i class="fas fa-laugh-wink"></i> -->
        </div>
        <div class="sidebar-brand-text mx-3">Driv'n Cook</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li id="m1" class="nav-item"> <!-- add active dans class if page here -->
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <?php if ($d['role'] == 1) { ?>
    <!-- Nav Item - Pages Collapse Menu -->
    <li id="m2" class="nav-item"> <!-- add active dans class if page here -->
        <a id="m21" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo"> <!-- remove collapsed dans class -->
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar"> <!-- add show dans class -->
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a id="m23" class="collapse-item" href="buttons.php">Buttons</a> <!-- add active dans class if page here -->
                <a id="m24" class="collapse-item" href="cards.php">Cards</a> <!-- add active dans class if page here -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li id="m3" class="nav-item"> <!-- add active dans class if page here -->
        <a id="m31" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities"> <!-- remove collapsed dans class -->
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar"> <!-- add show dans class -->
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a id="m33" class="collapse-item" href="utilities-color.php">Colors</a> <!-- add active dans class if page here -->
                <a id="m34" class="collapse-item" href="utilities-border.php">Borders</a> <!-- add active dans class if page here -->
                <a id="m35" class="collapse-item" href="utilities-animation.php">Animations</a> <!-- add active dans class if page here -->
                <a id="m36" class="collapse-item" href="utilities-other.php">Other</a> <!-- add active dans class if page here -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li id="m4" class="nav-item"> <!-- add active dans class if page here -->
        <a class="nav-link" href="charts.php">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li id="m5" class="nav-item"> <!-- add active dans class if page here -->
        <a class="nav-link" href="tables.php">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php } ?>

    <!-- Heading -->
    <div class="sidebar-heading">
        Pages
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li id="m6" class="nav-item"> <!-- add active dans class if page here -->
        <a id="m61" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages"> <!-- remove collapsed dans class -->
            <i class="fas fa-fw fa-folder"></i>
            <span>Other Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar"> <!-- add show dans class -->
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Other Pages:</h6>
                <a id="m63" class="collapse-item" href="404.php"><i class="fas fa-times-circle"></i> 404 Page</a> <!-- add active dans class if page here -->
                <a id="m64" class="collapse-item" href="blank.php">Blank Page</a> <!-- add active dans class if page here -->
            </div>
        </div>
    </li>

    <!-- Nav Item - Profile Pages Collapse Menu -->

    <li id="m7" class="nav-item"> <!-- add active dans class if page here -->
        <a id="m71" class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseProfile" aria-expanded="true" aria-controls="collapseProfile"> <!-- remove collapsed dans class -->
            <i class="fas fa-fw fa-folder"></i>
            <span>Profile Pages</span>
        </a>
        <div id="collapseProfile" class="collapse" aria-labelledby="headingProfile" data-parent="#accordionSidebar"> <!-- add show dans class -->
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Profile:</h6>
                <a id="m73" class="collapse-item" href="profile.php"><i class="fas fa-fw fa-user"></i> Profile</a> <!-- add active dans class if page here -->
                <a id="m74" class="collapse-item" href="modifProfile.php"><i class="fas fa-fw fa-users-cog"></i> Modify Profile</a> <!-- add active dans class if page here -->
                <?php if ($d['role'] == 1) { ?>
                <a id="m75" class="collapse-item" href="memberList.php"><i class="fas fa-fw fa-users"></i> Member List</a> <!-- add active dans class if page here -->
                <a class="collapse-item" href="register.php"><i class="fas fa-fw fa-user-plus"></i> Register</a>
                <?php } ?>
            </div>
        </div>
    </li>

    <?php if ($d['role'] == 1 || $d['role'] == 4) { ?>
    <!-- Nav Item -Gestion Camion Pages Collapse Menu -->
    <li id="m8" class="nav-item"> <!-- add active dans class if page here -->
        <a class="nav-link" href="gestionCamion.php">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Gestion Camion</span></a>
    </li>
    <?php } ?>
    <?php if ($d['role'] == 1 || $d['role'] == 2) { ?>
    <!-- Nav Item -Gestion Camion Pages Collapse Menu -->
    <li id="m9" class="nav-item"> <!-- add active dans class if page here -->
        <a class="nav-link" href="gestionStocksAppros.php">
            <i class="fas fa-fw fa-cogs"></i>
            <span>Gestion Stock & Approvisionnement</span></a>
    </li>
    <?php } ?>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->
