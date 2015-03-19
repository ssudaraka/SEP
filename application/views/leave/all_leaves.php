<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
            if($user_type == 'A'){
                $this->view('leave/admin_sidebar');
            }
            elseif($user_type == 'T'){
                $this->view('leave/teacher_sidebar');
            }
            else{
                $this->view('leave/teacher_sidebar');
            }

            ?>
        </div>
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>ALL LEAVES</strong>
                </div>
                <div class="panel-body">

                    <?php
                    foreach($query->result() as $row){

                        echo $row->id;
                    }
                    echo $pages;
                    ?>
                </div>

            </div>
        </div>
    </div>
</div>