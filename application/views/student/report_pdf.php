<img src="<?php echo base_url('assets/img/dslogo.jpg'); ?>" width="128px" height="128px" style="margin-left: 19em">
<h3 style="margin-bottom: 0; margin-left: 14em"><?php echo $school_name; ?></h3>
<h5 style="margin-top: 0; margin-left: 14em">Report - 
    <?php
    if ($report == 1) {
            echo 'GRADE 1';
        } else if ($report == 2) {
            echo 'GRADE 2';
        } else if ($report == 3) {
            echo 'GRADE 3';
        } else if ($report == 4) {
            echo 'GRADE 4';
        } else if ($report == 5) {
            echo 'GRADE 5';
        } else if ($report == 6) {
            echo 'GRADE 6';
        } else if ($report == 7) {
            echo 'GRADE 7';
        } else if ($report == 8) {
            echo 'GRADE 8';
        } else if ($report == 9) {
            echo 'GRADE 9';
        } else if ($report == 10) {
            echo 'GRADE 10';
        } else if ($report == 11) {
            echo 'GRADE 11';
        } else if ($report == 12) {
            echo 'GRADE 12';
        } else if ($report == 13) {
            echo 'GRADE 13';
    } else {
            echo '';
    }
    ?> Student List</h5>

<div class="row" style="margin-left: 5em">
    <table class="table table-hover">
        <thead>
            <tr>
                <th align="left" width="150px">Signature No</th>
                <th align="left" width="150px">Name</th>
                <th align="left" width="150px">NIC</th>
                <th align="left" width="150px">Registered Date</th>
            </tr>
        </thead>
        <tbody>
     
            <?php  if ($result) {
            foreach ($result as $row) {?>
                <tr>
                    <td><?php echo $row->admission_no; ?></td>
                    <td><?php echo $row->name_with_initials; ?></td>
                    <td><?php echo $row->permanent_addr; ?></td>
                    <td><?php echo $row->contact_home; ?></td>
                </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>
