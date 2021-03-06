<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $s_id = $_SESSION['s_id'];
  
  
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<!--Head-->
<?php include("dist/inc/head.php");?>
<!-- ./Head -->

<body onload=display_ct();>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-theme="light" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
            <?php include("dist/inc/header.php");?>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
            <?php include("dist/inc/sidebar.php");?>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <?php
                            include("dist/inc/time_API.php");
                            $c_id = $_GET['c_id'];
                            $ret="SELECT  * FROM  lms_questions WHERE c_id = ?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$c_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            $cnt=1;
                            while($row=$res->fetch_object())
                            {
                                //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                
                        ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_ins_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Questions</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_admin_view_testquizzes.php">View</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href=""><?php echo $row->c_name;?> Questions.</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="col-5 align-self-center">
                        <div class="customize-input float-right">
                            <select class="custom-select custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
                                <option selected id="ct"></option>
                                
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            
            <div class="container-fluid">
                <div class="row">

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $row->c_name;?> Questions </h4>
                                <div class="table-responsive">
                                    <table id="multi_col_order" class="table table-striped table-bordered display "
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Unit Code</th>
                                                <th>Unit Name</th>
                                                <th>Question Code</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        <?php
                                            $c_id = $_GET['c_id'];
                                            $ret="SELECT  * FROM  lms_questions WHERE c_id = ?  ";
                                            $stmt= $mysqli->prepare($ret) ;
                                            $stmt->bind_param('i',$c_id);
                                            $stmt->execute() ;//ok
                                            $res=$stmt->get_result();
                                            $cnt=1;
                                            while($row=$res->fetch_object())
                                            {
                                        ?>

                                            <tr>
                                                <td><?php echo $cnt;?></td>
                                                <td><?php echo $row->c_code;?></td>
                                                <td><?php echo $row->c_name;?></td>
                                                <td><?php echo $row->q_code;?></td>
                                                <td>
                                                    
                                                    <a class="badge badge-success" href="pages_std_view_specific_quizzes.php?q_id=<?php echo $row->q_id;?>">
                                                     <i class="fas fa-eye"></i><i class="icon  icon-doc "></i> View Quizzes
                                                    </a>
                                                   
                                                </td>
                                            </tr>

                                            <?php $cnt = $cnt +1; }}?>

                                        </tbody>
                                    </table>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                </div>
            
                <!-- *************************************************************** -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
                 <?php include("dist/inc/footer.php");?>
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- apps -->
    <!-- apps -->
    <script src="dist/js/app-style-switcher.js"></script>
    <script src="dist/js/feather.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <!--This page JavaScript -->
    <script src="assets/extra-libs/c3/d3.min.js"></script>
    <script src="assets/extra-libs/c3/c3.min.js"></script>
    <script src="assets/libs/chartist/dist/chartist.min.js"></script>
    <script src="assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js"></script>
    <script src="dist/js/pages/dashboards/dashboard1.min.js"></script>
    
    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>