<div class="container">

    <div class="row">

        <div class="col-md-3">
            <?php
            if ($user_type == 'A') {
                $this->view('event/admin_sidebar_nav');
            } elseif ($user_type == 'P') {
                $this->view('event/sidebar_nav');
            } else {
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
                    <strong>Create New Event</strong>
                </div>
                <div class="panel-body">
                    <?php
// Change the css classes to suit your needs    

                    $attributes = array('class' => 'form-horizontal', 'id' => '');
                    echo form_open('event/create_event', $attributes);
                    ?>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Name</label>
                        <div class="col-sm-5">
                            <input id="event_name" type="text" name="event_name"  value="<?php
                            if (isset($succ_message)) {
                                echo '';
                            } else {
                                echo set_value('event_name');
                            }
                            ?>" type="text" class="form-control" id="event_name" placeholder="Event Name">
<?php echo form_error('event_name'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Event Type</label>
                        <div class="col-sm-5">
                            <?php
                            echo "<select id='event_type' name='event_type' class='form-control'>";

                            foreach ($result as $row) {
                                //echo "<option value='" . $row->event_type . "'>" . $row->event_type . "</option>";
                                echo "<option value='$row->event_type'>$row->event_type</option>";
                            }
                            echo "</select>";
                            ?>
                            <lable ><span class="label label-info" > Tip !</span><small><i> " you can create new <b><a href="event/create_event_type">event type</a></b> here! "</i> </small> </lable>                        
<?php echo form_error('event_type'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-5">

                            <textarea id="description" type="text" name="description"  value=""  type="text" class="form-control" id="description" placeholder=""><?php
                                if (isset($succ_message)) {
                                    echo '';
                                } else {
                                    echo set_value('description');
                                }
                                ?></textarea>
<?php echo form_error('description'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">In Charge ID</label>
                        <div class="col-sm-5">
                            <input id="in_charge" type="text" name="in_charge"  value="<?php echo $nic; ?>" type="text" readonly class="form-control" id="in_charge" placeholder="eg : xxxxxxxxxV">
<?php echo form_error('in_charge'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Budget(Rs.)</label>
                        <div class="col-sm-5">
                            <input id="budget" type="text" name="budget"  value="<?php
                                   if (isset($succ_message)) {
                                       echo '';
                                   } else {
                                       echo set_value('budget');
                                   }
                                   ?>" type="text" class="form-control" id="budget" placeholder="Budget Rs.">
<?php echo form_error('budget'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Date</label>
                        <div class="col-sm-5">

                            <input id="start_date" type="date" name="start_date"  value="<?php
if (isset($succ_message)) {
    echo '';
} else {
    echo set_value('start_date');
}
?>"  type="date" class="form-control" id="start_date" placeholder="">
                            <?php echo form_error('start_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Start Time</label>
                        <div class="col-sm-5">

                            <input id="start_time" type="time" name="start_time"  value="<?php
                            if (isset($succ_message)) {
                                echo '';
                            } else {
                                echo set_value('start_time');
                            }
                            ?>" type="time" class="form-control" id="start_time" placeholder="">
                            <?php echo form_error('start_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Date</label>
                        <div class="col-sm-5">

                            <input id="end_date" type="date" name="end_date"  value="<?php
                            if (isset($succ_message)) {
                                echo '';
                            } else {
                                echo set_value('end_date');
                            }
                            ?>" type="date" class="form-control" id="end_date" placeholder="">
                                   <?php echo form_error('end_date'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">End Time</label>
                        <div class="col-sm-5">

                            <input id="end_time" type="time" name="end_time"  value="<?php
                                   if (isset($succ_message)) {
                                       echo '';
                                   } else {
                                       echo set_value('end_time');
                                   }
                                   ?>" type="time" class="form-control" id="end_time" placeholder="">
<?php echo form_error('end_time'); ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <input type="submit" class="btn btn-success" value="Submit">
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                    </div>

                </div>
            </div>
            <a name="eventrequest"></a>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Event Request Status</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Event Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Actions</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php foreach ($details as $row) { ?>


                                <tr>
                                    <td><?php echo $row->title; ?></td>
                                    <td><?php echo $row->start_date; ?></td>
                                    <td><?php echo $row->end_date; ?></td>
                                <?php
                                if ($row->status == "pending") {
                                    echo "<td><span class='label label-primary'>" . $row->status . "</span></td>" . PHP_EOL;
                                } else if ($row->status == "approved") {
                                    echo "<td><span class='label label-success'>" . $row->status . "</span></td>" . PHP_EOL;
                                    ?>
                                        <td><a href="<?php echo base_url("index.php/event/edit_approved_event") . "/" . $row->id; ?>"<span class="glyphicon glyphicon-edit" aria-hidden="true"></span> EDIT</a></td>
        <?php
    } else {
        echo "<td><span class='label label-danger'>" . $row->status . "</span></td>" . PHP_EOL;
    }
    ?> 

                                </tr>
<?php } ?>
                            <tr>
                                <td>No More records</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>


                </div>
            </div>
        </div>

    </div>

</div>
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div id='wrap'>

                <div id='external-events'>
                    <h4>Dragable Events</h4>
                    <div class='fc-event'>My Event 1</div>
                    <div class='fc-event'>My Event 2</div>
                    <div class='fc-event'>My Event 3</div>
                    <div class='fc-event'>My Event 4</div>
                    <div class='fc-event'>My Event 5</div>
                    <p>
                        <input type='checkbox' id='drop-remove' />
                        <label for='drop-remove'>remove after drop</label>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-9"> 
            <div id='calendar'></div>
        </div>
        <div style='clear:both'></div>

    </div>
</div>

<script>
    $(function () { // document ready

        $('#calendar').fullCalendar({
            resourceAreaWidth: 230,
            now: '<?php echo date('Y-m-d'); ?>',
            editable: true,
            aspectRatio: 1.5,
            scrollTime: '00:00',
            header: {
                left: 'promptResource today prev,next',
                center: 'title',
                right: 'timelineDay,timelineThreeDays,agendaWeek,month'
            },
            customButtons: {
                promptResource: {
                    text: '+ room',
                    click: function () {
                        var title = prompt('Room name');
                        if (title) {
                            $('#calendar').fullCalendar(
                                    'addResource',
                                    {title: title},
                            true // scroll to the new resource?
                                    );
                        }
                    }
                }
            },
            defaultView: 'timelineDay',
            views: {
                timelineThreeDays: {
                    type: 'timeline',
                    duration: {days: 3}
                }
            },
            resourceLabelText: 'Rooms',
            resources: [
                {id: 'a', title: 'Auditorium A'},
                {id: 'b', title: 'Auditorium B', eventColor: 'green'},
                {id: 'c', title: 'Auditorium C', eventColor: 'orange'},
                {id: 'd', title: 'Auditorium D', children: [
                        {id: 'd1', title: 'Room D1'},
                        {id: 'd2', title: 'Room D2'}
                    ]},
                {id: 'e', title: 'Auditorium E'},
                {id: 'f', title: 'Auditorium F', eventColor: 'red'},
                {id: 'g', title: 'Auditorium G'},
                {id: 'h', title: 'Auditorium H'},
                {id: 'i', title: 'Auditorium I'},
                {id: 'j', title: 'Auditorium J'},
                {id: 'k', title: 'Auditorium K'},
                {id: 'l', title: 'Auditorium L'},
                {id: 'm', title: 'Auditorium M'},
                {id: 'n', title: 'Auditorium N'},
                {id: 'o', title: 'Auditorium O'},
                {id: 'p', title: 'Auditorium P'},
                {id: 'q', title: 'Auditorium Q'},
                {id: 'r', title: 'Auditorium R'},
                {id: 's', title: 'Auditorium S'},
                {id: 't', title: 'Auditorium T'},
                {id: 'u', title: 'Auditorium U'},
                {id: 'v', title: 'Auditorium V'},
                {id: 'w', title: 'Auditorium W'},
                {id: 'x', title: 'Auditorium X'},
                {id: 'y', title: 'Auditorium Y'},
                {id: 'z', title: 'Auditorium Z'}
            ],
            events: [
                {id: '1', resourceId: 'b', start: '2015-08-07T02:00:00', end: '2015-08-07T07:00:00', title: 'event 1'},
                {id: '2', resourceId: 'c', start: '2015-08-07T05:00:00', end: '2015-08-07T22:00:00', title: 'event 2'},
                {id: '3', resourceId: 'd', start: '2015-08-06', end: '2015-08-08', title: 'event 3'},
                {id: '4', resourceId: 'e', start: '2015-08-07T03:00:00', end: '2015-08-07T08:00:00', title: 'event 4'},
                {id: '5', resourceId: 'f', start: '2015-08-07T00:30:00', end: '2015-08-07T02:30:00', title: 'event 5'}
            ]
        });

    });


</script>
<script>

	$(document).ready(function() {


		/* initialize the external events
		-----------------------------------------------------------------*/

		$('#external-events .fc-event').each(function() {

			// store data so the calendar knows to render an event upon drop
			$(this).data('event', {
				title: $.trim($(this).text()), // use the element's text as the event title
				stick: true // maintain when user navigates (see docs on the renderEvent method)
			});

			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});

		});


		/* initialize the calendar
		-----------------------------------------------------------------*/

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			editable: true,
			droppable: true, // this allows things to be dropped onto the calendar
			drop: function() {
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
			}
		});


	});

</script>
