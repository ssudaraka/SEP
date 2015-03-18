<div class="container">
    <div class="row">
        <div class="col-md-3">
            Side bar
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>PENIDING LEAVES</strong>
                </div>
                <div class="panel-body">
                        <div class="comments-list">
                            <?php
                            foreach ($admin_pending_list as $row) {
                                echo "<div class='media' style='background-color: #FFF59D;'>". PHP_EOL;
                                echo "<p class='pull-right'>".$row->applied_date."</p>". PHP_EOL; ?>
                                    <a class='media-left s' href='<?php echo base_url('index.php/leave/get_leave_details/'.$row->id); ?>'>
                                    <img class='thumbnail'  height='60' width='60' src='<?php echo base_url("assets/img/teacher_icon.png"); ?>'>
                            <?php
                                echo "</a>". PHP_EOL;
                                echo "<div class='media-body'>". PHP_EOL; ?>
                                    <a class='media-left s' href='<?php echo base_url('index.php/leave/get_leave_details/'.$row->id); ?>'>
                            <?php
                                echo "<h3 class='media-heading user_name'>".$row->full_name."</h3></a>". PHP_EOL;
                                echo $row->reason. PHP_EOL;
                                echo "<p><b>Start Date - </b>".$row->start_date." "."<b>End Date - </b>".$row->end_date."</p>". PHP_EOL;
                                echo "</div>". PHP_EOL;
                                echo "</div>". PHP_EOL;
                            }
                            ?>
                            </div>
                        </div>

                </div>
            </div>
        </div>
</div>