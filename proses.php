<?php
    //membuat koneksi
    $con = mysqli_connect("localhost", "root", "", "els");

    
    //memasukkan data ke array
        $LeaveType         = $_POST['LeaveType'];
        $uraian         = $_POST['uraian'];
        $koefisien     = $_POST['koefisien'];
        $satuan    = $_POST['satuan'];
        $harga    = $_POST['harga'];
        $res = (int)$koefisien*(int)$harga;

        $total = count($LeaveType);

    //melakukan perulangan input
    for($i=0; $i<$total; $i++){

        mysqli_query($con, "insert into pembelian set
        LeaveType    = '$LeaveType[$i]',
            uraian      = '$uraian[$i]',
            koefisien  = '$koefisien[$i]',
            satuan  = '$satuan[$i]',
            harga  = '$harga[$i]',
            res = $koefisien[$i]*$harga[$i];
        ");
    }

    //kembali ke halaman sebelumnya
    header("location: anggaran.php");

?>