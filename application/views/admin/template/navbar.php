  <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
            <li class="nav-item d-none d-sm-inline-block">
                <a href="#" class="nav-link"></a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url('app/profile') ?>" role="button">
                    <i class="fas fa-cog"></i>
                </a>
            </li>
            <li class="user-panel">
                <img src="<?php echo image_user_helper($this->session->userdata("id")) ?>" class="img-circle" alt="User Image">
            </li>
            
        </ul>

    </nav>
<!-- /.navbar -->