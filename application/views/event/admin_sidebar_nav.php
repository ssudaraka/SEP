<div class="panel-group" id="accordion">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-folder-close">
                    </span>Events</a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse in">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-asterisk text-primary"></span><a href="<?php echo base_url('index.php/event/create_event_type'); ?>">Add Event Type</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-inbox text-primary"></span><a href="<?php echo base_url('index.php/event/check_event_details'); ?>">Check events</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-bookmark"></span><a href="<?php echo base_url('index.php/event/view_all_events'); ?>">View All events</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon glyphicon-book text-warning"></span><a href="<?php echo base_url('index.php/event/event_calendar'); ?>">Event Calendar</a>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>