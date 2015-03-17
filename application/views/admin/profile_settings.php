<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                                </span>Personal Settings</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse in">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-user text-primary"></span><a href="#">Profile</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-cog text-warning"></span><a href="#">Account Settings</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-globe">
                                </span>Global Settings</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-wrench text-warning"></span><a href="#">System Settings</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-star text-warning"></span><a href="#">Create Admin Account</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="glyphicon glyphicon-list-alt text-warning"></span><a href="#">Manage Administrators</a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <ol class="breadcrumb">
                <li><a href="<?php echo base_url('index.php/dashboard'); ?>">Dashboard</a></li>
                <li><a href="<?php echo base_url('index.php/admin'); ?>">Admin</a></li>
                <li class="active">Profile Settings</li>
            </ol>
            <div class="panel panel-default">
                <div class="panel-heading">Profile Settings</div>
                <div class="panel-body">
                    <?php echo form_open(); ?>
                    <div class="fom-group img-submit">
                        <label for="profile-img">Profile image</label>
                        <br />
                        <img src="<?php echo base_url("/assets/img/profile_img.png"); ?>" id="profile-img" class="img-thumbnail profile-img">
                        <span class="btn btn-default btn-file">
                            Upload new picture<input type="file" name="profile_img" id="img-inp" onchange="readURL(this);">
                        </span>
                    </div>
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="form-control">
                        <p class="help-block"></p>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
<script>
function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#profile-img').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#imp-inp").change(function(){
        readURL(this);
    });
</script>