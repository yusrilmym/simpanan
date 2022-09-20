<?php
$conn = mysqli_connect("localhost","root","","els");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>

<!-- pertama -->

<html lang="en">

<head>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>

<body>
  <br>

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
        <div class="copy hide">
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
            <button class="btn btn-danger remove" type="button"><i class="glyphicon glyphicon-remove"></i>
              Remove</button>
            <hr>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
  <!-- fungsi javascript untuk menampilkan form dinamis  -->
  <!-- penjelasan :
saat tombol add-more ditekan, maka akan memunculkan div dengan class copy -->
  <!--  -->
  <form method="post">
    <input type="submit" name="ans" value="Retrieve Data">
  </form>
  <?php
                                    if(isset($_POST['ans']))
                                    {
                                    $sql = "SELECT * FROM pembelian";
                                    $result = $conn->query($sql);
                                    if(mysqli_num_rows($result) > 0){
                                            echo "<table style='border: 1px dashed black;'>";
                                                echo "<tr>";
                                                    echo "<th>Kode Rekening : </th>";
                                                    echo "<th>Uraian :</th>";
                                                    echo "<th>Koefisien</th>";
                                                    echo "<th>Satuan</th>";
                                                    echo "<th>Harga</th>";
                                                    echo "<th>Jumlah</th>";
                                                echo "</tr>";
                                            while($row = mysqli_fetch_array($result)){
                                                echo "<tr>";
                                                    echo "<td>" . $row['LeaveType'] . "</td>";
                                                    echo "<td>" . $row['uraian'] . "</td>";
                                                    echo "<td>" . $row['koefisien'] . "</td>";
                                                    echo "<td>" . $row['satuan'] . "</td>";
                          
                                                    echo "<td>" . $row['harga'] . "</td>";
                                                    echo "<td>" . $row['res'] . "</td>";
                                                echo "</tr>";
                                            }
                                            echo "</table>";
                                            mysqli_free_result($result);
                                        } else{
                                            echo "No records matching your query were found.";
                                        }
                                    }
                                    ?>

<?php
$sql3 = mysqli_query($conn, "SELECT SUM(res)
FROM pembelian");
while($row = mysqli_fetch_array($sql3)) {
?>
<tr>
<td>Total Pembayaran:</td></a>
<td><?php echo "Rp." . number_format($row['SUM(res)']) ;?></td>
</tr>
<?php
}
?>


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