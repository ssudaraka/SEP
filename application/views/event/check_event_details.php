<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if($user_type == 'A'){
                $this->view('event/admin_sidebar_nav');
            }
            elseif($user_type == 'P'){
                $this->view('event/sidebar_nav');
            }
            else{
                $this->view('event/sidebar_nav_teacher');
            }

            ?>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>PENDING EVENTS</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60%">Event Name</th>
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
                                <td><a href="<?php echo base_url("index.php/event/load_selected_pending_event") . "/" . $row->id; ?>" class="btn btn-primary btn-xs" aria-hidden="true"><i class="fa fa-eye"></i></a></td>
                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>CANCELED EVENTS </strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="60%">Event Name</th>
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
                                <td><a href="<?php echo base_url("index.php/event/view_upcoming_event_details") . "/" . $row->id; ?>" class="btn btn-primary btn-xs" aria-hidden="true"><i class="fa fa-eye"></i></a></td>                                
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>


                </div>
            </div>
        </div>

    </div>

</div>


