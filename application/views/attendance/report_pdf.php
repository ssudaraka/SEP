<img src="<?php echo base_url('assets/img/dslogo.jpg'); ?>" width="128px" height="128px">
<h3 style="margin-bottom: 0;"><?php echo $school_name; ?></h3>
<h5 style="margin-top: 0;">Daily Attendance Report <small><?php echo $date; ?> Present List</small></h5>

<table>
    <thead>
        <tr>
            <th>#</th>
            <th>Signature No</th>
            <th>Name</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($result as $row) { ?>
            <tr>
                <td><?php echo $row->id; ?></td>
                <td><?php echo $row->signature_no; ?></td>
                <td><?php echo $row->name_with_initials; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
