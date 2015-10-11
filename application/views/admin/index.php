<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <h3 style="margin-top: 0;">General Settings</h3>
            <div class="admin-btn">
                <i class="fa fa-globe"></i>
                <a href="#">
                    <span class="main">Global Settings</span>
                    <span class="sub">School name, Logo...</span>
                </a>
            </div>
            <div class="admin-btn">
                <i class="fa fa-calendar"></i>
                <a href="<?php echo base_url('index.php/year'); ?>">
                    <span class="main">Year Planner</span>
                    <span class="sub">Setup, Manage Holidays...</span>
                </a>
            </div>
            <div class="admin-btn">
                <i class="fa fa-users"></i>
                <a href="<?php echo base_url('index.php/admin/manage_admins'); ?>">
                    <span class="main">Administrators</span>
                    <span class="sub">Add, Update, Delete...</span>
                </a>
            </div>
            <div class="admin-btn">
                <i class="fa fa-university"></i>
                <a href="<?php echo base_url('index.php/classes'); ?>">
                    <span class="main">Classes</span>
                    <span class="sub">Manage Classes...</span>
                </a>
            </div>

        </div>
    </div>
</div>