
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <?php
//            if($user_type == 'A'){
//                $this->view('leave/admin_sidebar');
//            }
//            elseif($user_type == 'T'){
//                $this->view('leave/teacher_sidebar');
//            }
//            else{
//                $this->view('leave/teacher_sidebar');
//            }

            ?>
            
        </div>

        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Current Academic Details</strong>
                </div>
                <div class="panel-body">

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            
        </div>
        <div class="col-md-9">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <strong>Manage Academic Years</strong>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Name</th>
                            <th>Starts On</th>
                            <th>Ends on</th>
                            <th>Status</th>
                            <th>Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>AY2015</td>
                            <td>2015-01-01</td>
                            <td>2015-12-31</td>
                            <td><span class="label label-primary">Active</span></td>
                            <td>
                                <a href=""  class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-success btn-xs"><i class="fa fa-calendar"></i></a>
                            </td>
                          </tr>
                          <tr>
                            <td>AY2016</td>
                            <td>2016-01-01</td>
                            <td>2016-12-31</td>
                            <td><span class="label label-danger">Inactive</span></td>
                            <td>
                                <a href=""  class="btn btn-success btn-xs"><i class="fa fa-pencil-square-o"></i></a>
                                <a href="" class="btn btn-success btn-xs"><i class="fa fa-calendar"></i></a>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
    
</div>

