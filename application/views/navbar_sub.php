<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li <?php if($navbar == 'dashboard'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/dashboard'); ?>"><i class="glyphicon glyphicon-home"></i><span>Dashboard</span> </a> </li>
      	<li <?php if($navbar == 'teacher'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/teacher'); ?>"><i class="glyphicon glyphicon-user"></i><span>Teachers</span> </a> </li>
        <li <?php if($navbar == 'leave'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/leave'); ?>"><i class="glyphicon glyphicon-bed"></i><span>Leave</span> </a> </li>
         <?php if($this->session->userdata['user_type'] == 'A') {?><li <?php if($navbar == 'attendance'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/attendance'); ?>"><i class="glyphicon glyphicon-list-alt"></i><span>Attendance</span> </a> </li><?php } ?>
        <?php if($this->session->userdata['user_type'] == 'A') {?><li <?php if($navbar == 'timetable') { echo "class='active'";} ?>><a href="<?php echo base_url('index.php/timetable'); ?>"><i class="glyphicon glyphicon-time"></i><span>Timetable</span> </a> </li><?php } ?>
      	<li><a href="<?php echo base_url('index.php/student'); ?>"><i class="glyphicon glyphicon-education"></i><span>Students</span> </a> </li>
      	<!-- <li><a href="#"><i class="glyphicon glyphicon-knight"></i><span>Sports</span> </a> </li> -->
      	<li><a href="<?php echo base_url('index.php/event'); ?>"><i class="glyphicon glyphicon-bullhorn"></i><span>Events</span> </a> </li>
        <?php if($this->session->userdata['user_type'] == 'A') {?><li <?php if($navbar == 'admin'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/admin'); ?>"><i class="glyphicon glyphicon-cog"></i><span>Admin</span> </a> </li><?php } ?>
        <?php if($this->session->userdata['user_type'] == 'A') {?><li <?php if($navbar == 'news'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/news/get_news'); ?>"><i class="glyphicon glyphicon-comment"></i><span>News</span> </a> </li><?php } ?>
        <?php if($this->session->userdata['user_type'] == 'A') {?><li <?php if($navbar == 'history'){ echo "class='active'";} ?> ><a href="<?php echo base_url('index.php/news'); ?>"><i class="glyphicon glyphicon-repeat"></i><span>History</span> </a> </li><?php } ?>
<!--  <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-download-alt"></i><span>Other</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
            <li><a href="#">Test</a></li>
          </ul>
        </li> -->
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>