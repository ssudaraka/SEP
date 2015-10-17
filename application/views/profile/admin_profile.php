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
            <div class="col-md-offset-1 col-md-10" style="padding-bottom: 25px; border-bottom: 1px solid #ddd; "><img src="<?php echo $user_d->profile_img;?>" alt="..." class="img-thumbnail"></div>
            <div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 10px;'><h3><span style="color:#FF4800;"><?php echo $user_d->username; ?></span></h3></div>
            <!--<div class="col-md-offset-1 col-md-10 text-center" style='padding-top: 0px;'><h4><span style="color:rgb(77, 80, 89);"><?php if($user_d->user_type=='A'){echo 'ADMIN';}if($user_d->user_type=='T'){echo 'TEACHER';}if($user_d->user_type=='S'){echo 'STUDENT';}?></span></h4></div>-->
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
                        <li role="presentation" class="active"><a href="#">Profile</a></li>
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
                                <td class="subheadng">Name</td>
                                <td class="normal"><?=$user_d->first_name . ' ' . $user_d->last_name;?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>   
                            </tr>

                            <tr>
                                <td class="subheadng">User Name</td>
                                <td class="normal"><?=$user_d->username;?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>   
                            </tr>
                            <tr>

                                <td class="subheadng">User Role</td>
                                <td class="normal">System Administrator</td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>   
                            </tr>
                            <tr>
                                <td class="subheadng">Email</td>
                                <td class="normal"><?=$user_d->email;?></td>
                                <td class="subheadng">&nbsp;  </td>
                                <td class="normal">&nbsp; </td>   
                            </tr>
                            

                            

                        </tbody></table>
                    <br><br>
                    <div class="clearfix"></div>
                </div>
                <div class="bhoechie-tab-content hide">
                    
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
