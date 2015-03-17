<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php $this->view('admin/sidebar_nav'); ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Profile Settings</div>
                <div class="panel-body">
                    <div class="col-md-6">
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
                            
                            <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>">
                            <p class="help-block"></p>
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" id="last_name" class="form-control" value="<?php echo $last_name; ?>">
                            <p class="help-block"></p>
                        </div>
                        <input type="submit" class="btn btn-success" value=" Submit ">
                        <?php echo form_close(); ?>
                    </div>
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

    $("#imp-inp").change(function () {
        readURL(this);
    });
</script>