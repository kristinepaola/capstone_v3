<!DOCTYPE html>
<?php include ('Header.php');?>
    <br><br>
      <div class="text-center">
            <button href="admin_dashboard.php" type="submit" class="btn btn-default">Dashboard</button>
            <button type="submit" class="btn btn-default">Manage Accounts</button>
      </div>
    <br><br>
      <!-- End page header -->
      <div class="col-xs-1">
            <div class="welcome-estate ">
                <a href="lists_organizations.php"><img src="assets/img/icons/png/reunion-1.png" alt=""></a>
            </div>
      </div>
      <div class="search-form" style="visibility: visible; animation-name: pulse;">
      </div>
      <div class="panel panel-default">
          <div class="panel-heading">Lists of Organizations</div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                            <th>Edit</th>
                                            <th>Block</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>


        <?php include ('Footer.php');?>
    </body>
</html>
