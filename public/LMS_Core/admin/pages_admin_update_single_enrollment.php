<?php
  session_start();
  include('dist/inc/config.php');
  include('dist/inc/checklogin.php');
  check_login();
  $a_id=$_SESSION['a_id'];

  //Enroll Student

  if(isset($_POST['enroll_Student']))
  {
      $en_id = $_GET['en_id'];
      $s_id = $_GET['s_id'];
      $s_name = $_POST['s_name'];
      $s_regno = $_POST['s_regno'];
      $s_unit_code = $_POST['s_unit_code'];
      $s_unit_name = $_POST['s_unit_name'];
      $i_name = (($_POST['i_name']));
      $cc_id = $_POST['cc_id'];
      $c_id = $_POST['c_id'];
      $i_id = $_POST['i_id'];
      $s_course = $_POST['s_course'];

      //sql to insert captured values
      $query="UPDATE  lms_enrollments SET  s_id=?, s_name=?, s_regno=?, s_unit_code=?, s_unit_name=?, i_name=?, cc_id=?, c_id=?, i_id=?, s_course=? WHERE en_id=? ";
      $stmt = $mysqli->prepare($query);
      $rc=$stmt->bind_param('ssssssssssi', $s_id, $s_name, $s_regno, $s_unit_code, $s_unit_name, $i_name, $cc_id, $c_id, $i_id, $s_course, $en_id);
      $stmt->execute();

      if($stmt)
      {
                $success = "Enroll Record Updated";
                
                //echo "<script>toastr.success('Have Fun')</script>";
      }
      else {
        $err = "Please Try Again Or Try Later";
      }
      
      
  }
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
                            $a_id = $_SESSION['a_id'];
                            $ret="SELECT  * FROM  lms_admin  WHERE a_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$a_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                                // time function to get day zones ie morning, noon, and night.
                                $t = date("H");

                                if ($t < "10")
                                 {
                                    $d_time = "Good Morning";

                                    }

                                     elseif ($t < "15")
                                      {

                                      $d_time =  "Good Afternoon";

                                     } 

                                        elseif ($t < "20")
                                        {

                                        $d_time =  "Good Evening";

                                        } 
                                        else {

                                            $d_time = "Good Night";
                                }
                        ?>
                        <h3 class="page-title text-truncate text-dark font-weight-medium mb-1"><?php echo $d_time;?> <?php echo $row->a_uname;?></h3>
                        <?php }?>

                        <?php
                            $en_id = $_GET['en_id'];
                            $ret="SELECT  * FROM  lms_enrollments  WHERE en_id=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$en_id);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                                ?>
                        <div class="d-flex align-items-center">
                            <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb m-0 p-0">
                                    <li class="breadcrumb-item"><a href="pages_admin_dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="">Enrollments</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="pages_admin_add_enrollment.php">Add</a>
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
                                <h4 class="card-title">Enroll <?php echo $row->s_name;?></h4>
                                <!--Add Student-->
                                <form method ="post" enctype="multipart/form-data">
                                    <div class="row">
                                        
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Name</label>
                                            <input type="text" readonly name="s_name" value="<?php echo $row->s_name;?>" required class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>
                                          
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1">Student Registration Number</label>
                                            <input type="text" readonly name="s_regno" value="<?php echo $row->s_regno;?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row"> 
                                         <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Code</label>
                                            <select name="s_unit_code" onChange="getUnit(this.value);" id="code" class="custom-select form-control bg-white custom-radius custom-shadow border-0">
                                              <option>Select Unit Code </option>
                                              <?php
                                                    //get all attributes of a certain unit given the students course.
                                                    $s_course = $_GET['s_course'];
                                                    $ret="SELECT  * FROM  lms_units_assaigns WHERE c_category = ? ";
                                                    $stmt= $mysqli->prepare($ret) ;
                                                    $stmt->bind_param('s',$s_course);
                                                    $stmt->execute() ;//ok
                                                    $res=$stmt->get_result();
                                                    $cnt=1;
                                                    while($row=$res->fetch_object())
                                                    {
                                                        //$mysqlDateTime = $row->en_date;//trim timestamp to DD/MM/YYYY formart
                                                        
                                                ?>
                                                <option value="<?php echo $row->c_code;?>"> <?php echo $row->c_code;?></option>

                                                <?php }?> 
                                            </select>
                                       
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Unit Name</label>
                                            <input type="text" name="s_unit_name" readonly  id="unit_name"  class="form-control"  aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="exampleInputEmail1">Instructor Name</label>
                                            <input type="text" name="i_name" readonly  id="unit_instructor_name"  class="form-control"  aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Course ID</label>
                                            <input type="text" name="cc_id" readonly  id="course_id"  class="form-control"  aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Unit ID</label>
                                            <input type="text" name="c_id" readonly  id="unit_id"  class="form-control"  aria-describedby="emailHelp">
                                        </div>

                                        <div class="form-group col-md-6" style="display:none">
                                            <label for="exampleInputEmail1">Instructor Id</label>
                                            <input type="text" name="i_id" readonly  id="unit_instructor_id"  class="form-control"  aria-describedby="emailHelp">
                                        </div>


                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1">Course</label>
                                            <input type="text" name="s_course" readonly  id="course_name"  class="form-control"  aria-describedby="emailHelp">
                                        </div>
                                       
                                        
                                    </div>
                                   
                                   <hr>

                                    <button type="submit" name="enroll_Student" class="btn btn-outline-primary">Update Enrollment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                            <?php }?>
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
    <script type = "text/javascript">
                            //On Screen Charts
                            $(function () {

                        // ==============================================================
                        // Campaign
                        // ==============================================================

                        var chart1 = c3.generate({
                            bindto: '#campaign-v2',
                            data: {
                                columns: [
                                    ['Direct Sales', 25],
                                    ['Referral Sales', 15],
                                    ['Afilliate Sales', 10],
                                    ['Indirect Sales', 15]
                                ],

                                type: 'donut',
                                tooltip: {
                                    show: true
                                }
                            },
                            donut: {
                                label: {
                                    show: false
                                },
                                title: 'Sales',
                                width: 18
                            },

                            legend: {
                                hide: true
                            },
                            color: {
                                pattern: [
                                    '#edf2f6',
                                    '#5f76e8',
                                    '#ff4f70',
                                    '#01caf1'
                                ]
                            }
                        });

                        d3.select('#campaign-v2 .c3-chart-arcs-title').style('font-family', 'Rubik');

                        // ============================================================== 
                        // income
                        // ============================================================== 
                        var data = {
                            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                            series: [
                                [5, 4, 3, 7, 5, 10]
                            ]
                        };

                        var options = {
                            axisX: {
                                showGrid: false
                            },
                            seriesBarDistance: 1,
                            chartPadding: {
                                top: 15,
                                right: 15,
                                bottom: 5,
                                left: 0
                            },
                            plugins: [
                                Chartist.plugins.tooltip()
                            ],
                            width: '100%'
                        };

                        var responsiveOptions = [
                            ['screen and (max-width: 640px)', {
                                seriesBarDistance: 5,
                                axisX: {
                                    labelInterpolationFnc: function (value) {
                                        return value[0];
                                    }
                                }
                            }]
                        ];
                        new Chartist.Bar('.net-income', data, options, responsiveOptions);

                        // ============================================================== 
                        // Visit By Location
                        // ==============================================================
                        jQuery('#visitbylocate').vectorMap({
                            map: 'world_mill_en',
                            backgroundColor: 'transparent',
                            borderColor: '#000',
                            borderOpacity: 0,
                            borderWidth: 0,
                            zoomOnScroll: false,
                            color: '#d5dce5',
                            regionStyle: {
                                initial: {
                                    fill: '#d5dce5',
                                    'stroke-width': 1,
                                    'stroke': 'rgba(255, 255, 255, 0.5)'
                                }
                            },
                            enableZoom: true,
                            hoverColor: '#bdc9d7',
                            hoverOpacity: null,
                            normalizeFunction: 'linear',
                            scaleColors: ['#d5dce5', '#d5dce5'],
                            selectedColor: '#bdc9d7',
                            selectedRegions: [],
                            showTooltip: true,
                            onRegionClick: function (element, code, region) {
                                var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
                                alert(message);
                            }
                        });

                        // ==============================================================
                        // Earning Stastics Chart
                        // ==============================================================
                        var chart = new Chartist.Line('.stats', {
                            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
                            series: [
                                [11, 10, 15, 21, 14, 23, 12]
                            ]
                        }, {
                            low: 0,
                            high: 28,
                            showArea: true,
                            fullWidth: true,
                            plugins: [
                                Chartist.plugins.tooltip()
                            ],
                            axisY: {
                                onlyInteger: true,
                                scaleMinSpace: 40,
                                offset: 20,
                                labelInterpolationFnc: function (value) {
                                    return (value / 1) + 'k';
                                }
                            },
                        });

                        // Offset x1 a tiny amount so that the straight stroke gets a bounding box
                        chart.on('draw', function (ctx) {
                            if (ctx.type === 'area') {
                                ctx.element.attr({
                                    x1: ctx.x1 + 0.001
                                });
                            }
                        });

                        // Create the gradient definition on created event (always after chart re-render)
                        chart.on('created', function (ctx) {
                            var defs = ctx.svg.elem('defs');
                            defs.elem('linearGradient', {
                                id: 'gradient',
                                x1: 0,
                                y1: 1,
                                x2: 0,
                                y2: 0
                            }).elem('stop', {
                                offset: 0,
                                'stop-color': 'rgba(255, 255, 255, 1)'
                            }).parent().elem('stop', {
                                offset: 1,
                                'stop-color': 'rgba(80, 153, 255, 1)'
                            });
                        });

                        $(window).on('resize', function () {
                            chart.update();
                        });
                        })
    </script>
    <!--This page plugins -->
    <script src="assets/extra-libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
</body>

</html>