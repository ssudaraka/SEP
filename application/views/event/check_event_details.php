<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if($user_type == 'T'){
                $this->view('event/sidebar_nav');
            }
            elseif($user_type == 'A'){
                $this->view('event/admin_sidebar_nav');
            }
            else{
                $this->view('event/sidebar_nav_teacher');
            }

            ?>
        </div>

        <div class="col-md-9">
            <?php if (isset($succ_message)) { ?>
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $succ_message; ?>
            </div>
            <?php } ?>
            <?php if (isset($err_message)) { ?>
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <?php echo $err_message; ?>
            </div>
            <?php } ?>   

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Pending Events</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($details as $row) { ?>


                            <tr>
                                <td><?php echo $row->title; ?></td>
                                <td><?php echo $row->start_date; ?></td>
                                <td><?php echo $row->end_date; ?></td>
                                <td><a href="<?php echo base_url("index.php/event/load_selected_pending_event") . "/" . $row->id; ?>" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Cancelled Events </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Event Name</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cancel as $row) { ?>


                            <tr>
                                <td><?php echo $row->title; ?></td>
                                <td><?php echo $row->start_date; ?></td>
                                <td><?php echo $row->end_date; ?></td>
                                <td><a href="<?php echo base_url("index.php/event/view_upcoming_event_details") . "/" . $row->id; ?>" ><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span></a></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                </div>
            </div>
        </div>

    </div>

</div>


