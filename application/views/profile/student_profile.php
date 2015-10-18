<style>
    #details-table td{
        height: 50px;
        padding: 0px 30px;
    }

    .trheding{

        font-size: 13px;
        color: #FF4800;
        font-weight: bold;
        text-transform: uppercase;
        background:  rgb(243, 243, 243) none repeat scroll 0% 0%;


    }

    .subheadng{
        font-size: 13px;
        font-weight: bold;

    }

    .cntn{

        border: 1px solid rgba(128, 128, 128, 0.12);
        border-radius: 4px;
    }

    .profile-nav > li{
        border-radius: 0px !important;
    }
    .profile-nav > li> a{
        color: #595959;
        text-decoration: none;
        background: rgb(243, 243, 243) none repeat scroll 0% 0%;
    }

</style>
<div class="container cntn" >
    <div class="row">
        <div class="col-md-3"   style="background-color: rgba(210, 210, 210, 0.09);  min-height: 553px" >
            <div class="col-md-offset-1 col-md-10" ><h3 class="text-center"><?php echo $user_d->first_name . ' ' . $user_d->last_name; ?></h3></div>
            <div class="col-md-offset-1 col-md-10" style="padding-bottom: 25px; border-bottom: 1px solid #ddd; "><img src="<?php  if($user_d->profile_img){echo$user_d->profile_img;}else{echo'http://www.bathspa.ac.uk/media/WebProfilePictures/default_profile.jpg';}?>" alt="..." class="img-thumbnail"></div>
            <div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 10px;'><h3><span style="color:#FF4800;"><?php echo $user_d->username; ?></span></h3></div>
            <div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 0px;'><h4><span style="color:rgb(77, 80, 89);"><?php if($user_d->user_type=='A'){echo 'ADMIN';}if($user_d->user_type=='T'){echo 'TEACHER';}if($user_d->user_type=='S'){echo 'STUDENT';}?></span></h4></div>
            <?php if($edit){?>
            <div class="col-md-offset-1 col-md-10 center" ><a href="<?php echo base_url('index.php/profile/profile_settings'); ?>"><button class='btn btn-success col-md-12'>Edit Profile</button></a></div>
            <?php }?>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-9" style=" border-left: 1px solid #ddd; min-height: 553px">
            <!--            <div class="col-md-10"><h1>Student Profile</h1></div>-->
            <div class="col-md-12" style="margin-top: 10px;">
                <div class="bhoechie-tab-menu">
                    <ul class="nav nav-tabs profile-nav">
                        <li role="presentation" <?php if (($prof_navbar = 'profile_s') || ($prof_navbar = 'profile_t') || ($prof_navbar = 'profile_a')) { echo 'class="active"';} ?>><a href="#">Personal Details</a></li>
                        <li role="presentation"><a href="#">Guardian Details</a></li>
                        <li role="presentation"><a href="#">Academic Year</a></li>
                        <li role="presentation"><a href="#">Classes</a></li>

                    </ul>
                    </div>
                <div class="col-md-12 bhoechie-tab-content" style="padding: 0px;">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="details-table" style="margin-top: 10px; margin-bottom: 10px;">
                        <tbody>
                            <tr class="trheding">
                                <td id="dtr">General</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="subheadng">Admission No</td>
                                <td class="normal"><?=$personal->admission_no;?></td>
                                <td class="subheadng">Admission Date</td>
                                <td class="normal"><?=$personal->admission_date;?></td>
                            </tr>

                            <tr>
                                <td class="subheadng">Name with Initials</td>
                                <td class="normal"><?=$personal->name_with_initials;?></td>
                                <td class="subheadng">Birth Day</td>
                                <td class="normal"><?=$personal->dob;?></td>
                            </tr>
                            <tr>

                                <td class="subheadng">Medium</td>
                                <td class="normal"><?php if($personal->language=='s'){echo 'Sinhala';}if($personal->language=='e'){echo 'English';}if($personal->language=='t'){echo 'Tamil';}?></td>
                                <td class="subheadng">Religion</td>
                                <td class="normal"><?php if($personal->religion==1){echo 'Buddhism';}if($personal->religion==2){echo 'Hinduism';}if($personal->religion==3){echo 'Islam';}if($personal->religion==4){echo 'Catholicism';}if($personal->religion==5){echo 'Christianity';}if($personal->religion==6){echo 'Other';}?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">House</td>
                                <td class="normal"><?=$personal->house_id;?></td>
                                <td class="subheadng">Contact Number</td>
                                <td class="normal"><?=$personal->contact_home;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Address</td>
                                <td class="normal"><?=$personal->permanent_addr;?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>        
                            </tr>

                            

                        </tbody></table>
                    <br><br>
                    <div class="clearfix"></div>
                </div>
                <div class="bhoechie-tab-content hide">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%" id="details-table" style="margin-top: 10px; margin-bottom: 10px;">
                        <tbody>
                            <tr class="trheding">
                                <td id="dtr">Guardian Details</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                                <td id="dtr">&nbsp;</td>
                            </tr>

                            <tr>
                                <td class="subheadng">Name</td>
                                <td class="normal"><?=$guardian->name_with_initials;?></td>
                                <td class="subheadng">Relation</td>
                                <td class="normal"><?php if($guardian->relation=='f'){echo 'Father';}if($guardian->relation=='m'){echo 'Mother';}if($guardian->relation=='g'){echo 'Guardian';}?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Gender</td>
                                <td class="normal"><?php if($guardian->relation=='f'){echo 'Female';}if($guardian->relation=='m'){echo 'Male';}?></td>
                                <td class="subheadng">Past Pupil</td>
                                <td class="normal"><?php if($guardian->is_pastpupil==1){echo 'Yes';}if($guardian->is_pastpupil==0){echo 'No';}?></td>
                            </tr>
                             <tr>
                                <td class="subheadng">Contact Home</td>
                                <td class="normal"><?=$guardian->contact_home;?></td>
                                <td class="subheadng">Contact Mobile</td>
                                <td class="normal"><?=$guardian->contact_mobile;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Occupation</td>
                                <td class="normal"><?=$guardian->occupation;?></td>
                                <td class="subheadng">Address</td>
                                <td class="normal"><?=$guardian->addr;?></td>
                            </tr>
                            <tr>
                                <td class="subheadng">Birthday</td>
                                <td class="normal"><?=$guardian->dob;?></td>
                                <td class="subheadng">&nbsp;</td>
                                <td class="normal">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
</div>
<script>
   $(document).ready(function() {
    $("div.bhoechie-tab-menu>ul>li").click(function(e) {
        e.preventDefault();
        $(this).siblings('li.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-content").addClass("hide");
        $("div.bhoechie-tab-content").eq(index).removeClass("hide");
    });
}); 
</script>
