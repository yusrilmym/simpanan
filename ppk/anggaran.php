<?php
    session_start();
    error_reporting(0);
    include('../includes/dbconn.php');
    if(strlen($_SESSION['alogin'])==0){   
    header('location:index.php');
    } else {

    //Inactive  Employee    
    if(isset($_GET['inid']))
    {
    $id=$_GET['inid'];
    $status=0;
    $sql = "UPDATE tblemployees set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
    header('location:anggaran.php');
    }

    //Activated Employee
    if(isset($_GET['id'])){
    $id=$_GET['id'];
    $status=1;
    $sql = "UPDATE tblemployees set Status=:status  WHERE id=:id";
    $query = $dbh->prepare($sql);
    $query -> bindParam(':id',$id, PDO::PARAM_STR);
    $query -> bindParam(':status',$status, PDO::PARAM_STR);
    $query -> execute();
    header('location:anggaran.php');
    }

    //post
    if(isset($_POST['masuk'])){ 
        $LeaveType=$_POST['LeaveType'];
        $uraian=$_POST['uraian'];  
        $koefisien=$_POST['koefisien'];
        $satuan=$_POST['satuan'];  
        $harga=$_POST['harga'];
        $res=$koefisien*$harga;
        echo "";  
        // $jumlah=$_POST['jumlah']; 
    
        $sql="INSERT INTO pembelian(LeaveType,uraian, koefisien, satuan, harga,res) VALUES(:LeaveType,:uraian,:koefisien,:satuan,:harga,:res)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':LeaveType',$LeaveType,PDO::PARAM_STR);
        $query->bindParam(':uraian',$uraian,PDO::PARAM_STR);
        $query->bindParam(':koefisien',$koefisien,PDO::PARAM_STR);
        $query->bindParam(':satuan',$satuan,PDO::PARAM_STR);
        $query->bindParam(':harga',$harga,PDO::PARAM_STR);
        $query->bindParam(':res',$res,PDO::PARAM_STR);
        $query->execute();
        $msg="Ajuan sudah masuk Successfully";
    }
    
 ?>


<?php
$conn = mysqli_connect("localhost","root","","els");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
<?php
if(isset($_POST['sub']))
{
	$txt1=$_POST['n1'];
	$txt2=$_POST['n2'];
    $res=$txt1*$txt2;
	echo "";
	$sql = "INSERT INTO `valuescal` (`id`, `number1`, `number2`, `result`) VALUES (NULL, '$txt1', '$txt2', '$res' ) ";
	if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
    } 
	else {
    echo "Error: " . $sql . "<br>" . $conn->error;
		}
}
?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Admin Panel - SIMPANAN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/png" href="../assets/images/icon/favicon.ico">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/metisMenu.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.min.css">
    <!-- amchart css -->
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css"
        media="all" />
    <!-- Start datatable css -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.jqueryui.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
</head>

<body>
    <!-- preloader area start -->
    <div id="preloader">
        <div class="loader"></div>
    </div>
    <!-- preloader area end -->

    <div class="page-container">
        <!-- sidebar menu area start -->
        <div class="sidebar-menu">
            <div class="sidebar-header">
                <div class="logo">
                    <a href="dashboard.php"><img src="../assets/images/icon/logo.jpg" alt="logo"></a>
                </div>
            </div>
            <div class="main-menu">
                <div class="menu-inner">
                    <?php
                        $page='anggaran';
                        include 'ppk-sidebar.php';
                    ?>
                </div>
            </div>
        </div>
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        <div class="main-content">
            <!-- header area start -->
            <div class="header-area">
                <div class="row align-items-center">
                    <!-- nav and search button -->
                    <div class="col-md-6 col-sm-8 clearfix">
                        <div class="nav-btn pull-left">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>

                    </div>
                    <!-- profile info & task notification -->
                    <div class="col-md-6 col-sm-4 clearfix">
                        <ul class="notification-area pull-right">
                            <li id="full-view"><i class="ti-fullscreen"></i></li>
                            <li id="full-view-exit"><i class="ti-zoom-out"></i></li>

                            <!-- Notification bell -->
                            <?php include '../includes/admin-notification.php'?>

                        </ul>
                    </div>
                </div>
            </div>
            <!-- header area end -->
            <!-- page title area start -->
            <div class="page-title-area">
                <div class="row align-items-center">
                    <div class="col-sm-6">
                        <div class="breadcrumbs-area clearfix">
                            <h4 class="page-title pull-left">Anggaran</h4>
                            <ul class="breadcrumbs pull-left">
                                <li><a href="dashboard.php">Home</a></li>
                                <li><span>Inputan Anggaran</span></li>

                            </ul>
                        </div>
                    </div>

                    <div class="col-sm-6 clearfix">
                        <div class="user-profile pull-right">
                            <img class="avatar user-thumb" src="../assets/images/admin.png" alt="avatar">
                            <h4 class="user-name dropdown-toggle" data-toggle="dropdown">ADMIN <i
                                    class="fa fa-angle-down"></i></h4>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="logout.php">Log Out</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- page title area end -->
            <div class="main-content-inner">


                <!-- row area start -->
                <div class="row">
                    <!-- Dark table start -->
                    <div class="col-12 mt-5">

                        <div class="card">


                            <?php if($error){?><div class="alert alert-danger alert-dismissible fade show"><strong>Info:
                                </strong><?php echo htmlentities($error); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>

                            </div><?php } 
                                 else if($msg){?><div class="alert alert-success alert-dismissible fade show">
                                <strong>Info: </strong><?php echo htmlentities($msg); ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div><?php }?>
                        </div>

                        <!-- <button type="button" class="btn btn-success" data-toggle="modal"
                            data-target="#exampleModal">MASUKAN ANGGARAN</button> -->
                        <!-- tes -->
                        <div class="container">
                            <div class="panel panel-default">
                                <div class="panel-heading">Form Tambah Data </div>
                                <div class="panel-body">
                                    <!-- membuat form  -->
                                    <!-- gunakan tanda [] untuk menampung array  -->
                                    <form action="proses.php" method="POST">
                                        <div class="control-group after-add-more">
                                            <label>kode Rekening</label>
                                            <input type="text" name="LeaveType[]" size="10">
                                            <!-- <input type="text" name="LeaveType[]" class="form-control"> -->
                                            <label>Uraian</label>
                                            <input type="text" name="uraian[]" size="10">
                                            <label>Koefisien</label>
                                            <input type="text" name="koefisien[]" size="10">
                                            <label>Satuan</label>
                                            <input type="text" name="satuan[]" size="10">
                                            <label>Harga</label>
                                            <input type="text" name="harga[]" size="10">
                                            <!-- <label>jumlah</label>
            <input type="text" class="form-control" value="<?php echo isset($res)?$res:""; ?>"> -->
                                            <!-- <label>satuan</label> -->
                                            <!-- <select class="form-control" name="jurusan[]">
                <option>Sistem Informasi</option>
                <option>Informatika</option>
                <option>Akuntansi</option>
                <option>DKV</option>
              </select> -->
                                            <button class="btn btn-success add-more" type="button">
                                                <i class="glyphicon glyphicon-plus"></i> Add
                                            </button>
                                            <hr>
                                        </div>
                                        <button class="btn btn-success" type="submit" name="sub">Submit</button>
                                    </form>

                                    <!-- class hide membuat form disembunyikan  -->
                                    <!-- hide adalah fungsi bootstrap 3, klo bootstrap 4 pake invisible  -->
                                    <div class="copy invisible">
                                        <div class="control-group">
                                            <label>kode Rekening</label>
                                            <input type="text" name="LeaveType[]" size="10">
                                            <label>Uraian</label>
                                            <input type="text" name="uraian[]" size="10">
                                            <label>Koefisien</label>
                                            <input type="text" name="koefisien[]" size="10">
                                            <label>Satuan</label>
                                            <input type="text" name="satuan[]" size="10">
                                            <label>Harga</label>
                                            <input type="text" name="harga[]" size="10">
                                            <!-- <label>jumlah</label>
            <input type="text" name="jumlah[]" size="10"> -->
                                            <button class="btn btn-danger remove" type="button"><i
                                                    class="glyphicon glyphicon-remove"></i>
                                                Remove</button>
                                            <hr>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tes -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">MASUKAN ANGGARAN</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <form method="POST" name="adminaction">
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label class="col-form-label">Jenis Pengajuan Anda</label>
                                            <select class="custom-select" name="LeaveType" autocomplete="off">
                                                <option value="">Pilih jenis pengajuan ...</option>

                                                <?php $sql = "SELECT LeaveType, Description from tblleavetype";
                                                    $query = $dbh -> prepare($sql);
                                                    $query->execute();
                                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                    $cnt=1;
                                                    if($query->rowCount() > 0) {
                                                        foreach($results as $result)
                                                {   ?>
                                                <option value="<?php echo htmlentities($result->LeaveType);?>">
                                                    <?php echo htmlentities($result->LeaveType)?>
                                                    <?php echo htmlentities($result->Description)?></option>
                                                <?php }
                                                } ?>
                                            </select>
                                        </div>

                                        <p><textarea id="textarea1" name="uraian" class="form-control" name="uraian"
                                                placeholder="Uraian" row="5" maxlength="500" required></textarea>
                                        </p>
                                        <p><textarea id="textarea1" name="koefisien" class="form-control"
                                                name="koefisien" placeholder="Koefisien" row="5" maxlength="500"
                                                required></textarea></p>
                                        <select class="custom-select" name="satuan" required="">
                                            <option value="">Satuan</option>
                                            <option value="kg">Kg</option>
                                            <option value="cm">Cm</option>
                                        </select></p>
                                        <p><textarea id="textarea1" name="harga" class="form-control" name="harga"
                                                placeholder="harga" row="5" maxlength="500" required></textarea></p>
                                        <!-- <p><textarea id="textarea1" name="jumlah" class="form-control" name="jumlah"
                                                    placeholder="Jumlah" row="5" maxlength="500" required></textarea>
                                            </p> -->

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger"
                                                data-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-success" name="masuk">Apply</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>

                <!-- satu -->
                <div class="card-body">
                    <!-- <h4 class="header-title"></h4> -->
                    <div class="single-table">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped table-bordered progress-table text-center">
                                <thead class="text-uppercase">

                                    <tr>
                                        <td>S.N</td>

                                        <td>Uraian</td>
                                        <td>Koefisien</td>
                                        <td>Satuan</td>
                                        <td>Harga</td>
                                        <td>Jumlah</td>
                                        <!-- <td>PPTK</td> -->
                                        <!-- <td></td> -->
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php 
                                            $status=1;
                                            $sql = "SELECT * FROM pembelian";
                                            $query = $dbh -> prepare($sql);
                                            // $query->bindParam(':status',$status,PDO::PARAM_STR);
                                            $query->execute();
                                            $results=$query->fetchAll(PDO::FETCH_OBJ);
                                            $cnt=1;

                                            if($query->rowCount() > 0){
                                            foreach($results as $result)
                                            {         
                                        ?>

                                    <tr>
                                        <td> <b><?php echo htmlentities($cnt);?></b></td>
                                        <!-- <td><?php echo htmlentities($result->LeaveType);?></td> -->
                                        <td><?php echo htmlentities($result->uraian);?></td>
                                        <td><?php echo htmlentities($result->koefisien);?></td>
                                        <td><?php echo htmlentities($result->satuan);?></td>
                                        <td><?php echo number_format($result->harga);?></td>
                                        <td><?php echo number_format($result->res);?></td>
                                    </tr>
                                    <?php $cnt++;} }?>


                                    <?php
                                $sql3 = mysqli_query($conn, "SELECT SUM(res)
                                FROM pembelian");
                                while($row = mysqli_fetch_array($sql3)) {
                                ?>
                            <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                <td>Total Anggaran:</td></a>
                                <td><?php echo "Rp." . number_format($row['SUM(res)']) ;?></td>
                            </tr>
                            <?php
                            }
                            ?>
                                </tbody>
                            </table>

                            

                        </div>
                    </div>
                </div>
                <!-- satu -->

            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Dark table end -->

    </div>
    <!-- row area end -->

    </div>
    <!-- row area start-->
    </div>
    <?php include '../includes/footer.php' ?>
    </div>
    <!-- main content area end -->


    <!-- footer area end-->
    </div>
    <!-- jquery latest version -->
    <script src="../assets/js/vendor/jquery-2.2.4.min.js"></script>
    <!-- bootstrap 4 js -->
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/metisMenu.min.js"></script>
    <script src="../assets/js/jquery.slimscroll.min.js"></script>
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- start chart js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
    <!-- start highcharts js -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <!-- start zingchart js -->
    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>
    <script>
        zingchart.MODULESDIR = "https://cdn.zingchart.com/modules/";
        ZC.LICENSE = ["569d52cefae586f634c54f86dc99e6a9", "ee6b7db5b51705a13dc2339db3edaf6d"];
    </script>
    <!-- all line chart activation -->
    <script src="assets/js/line-chart.js"></script>
    <!-- all pie chart -->
    <script src="assets/js/pie-chart.js"></script>

    <!-- Start datatable js -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

    <!-- others plugins -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/scripts.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".add-more").click(function () {
                var html = $(".copy").html();
                $(".after-add-more").after(html);
            });

            // saat tombol remove dklik control group akan dihapus 
            $("body").on("click", ".remove", function () {
                $(this).parents(".control-group").remove();
            });
        });
    </script>

</body>

</html>

<?php } ?>