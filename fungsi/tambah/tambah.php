<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    require '../../fungsi/helper.php';
    if (!empty($_GET['kategori'])) {
        $nama= htmlentities(htmlentities($_POST['kategori']));
        $data[] = $nama;
        $sql = 'INSERT INTO kategori (nama_kategori,statusdata) VALUES(?,"AKTIF")';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&success=tambah-data"</script>';
    }

    if (!empty($_GET['barang'])) {
        $id = htmlentities($_POST['id']);
        $kategori = htmlentities($_POST['kategori']);
        $nama = htmlentities($_POST['nama']);
        $merk = htmlentities($_POST['merk']);
        $beli = htmlentities($_POST['beli']);
        $jual = htmlentities($_POST['jual']);
        $satuan = htmlentities($_POST['satuan']);
        $stok = htmlentities($_POST['stok']);
        $tgl = htmlentities($_POST['tgl']);

        $data[] = $id;
        $data[] = $kategori;
        $data[] = $nama;
        $data[] = $merk;
        $data[] = $beli;
        $data[] = $jual;
        $data[] = $satuan;
        $data[] = $stok;
        $data[] = $tgl;
        $sql = 'INSERT INTO barang (id_barang,id_kategori,nama_barang,merk,harga_beli,harga_jual,satuan_barang,stok,tgl_input) 
			    VALUES (?,?,?,?,?,?,?,?,?) ';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=barang&success=tambah-data"</script>';
    }
    
    if (!empty($_GET['jual'])) {
        $id = $_GET['id'];

        // get tabel barang id_barang
        $sql = 'SELECT * FROM barang WHERE id_barang = ?';
        $row = $config->prepare($sql);
        $row->execute(array($id));
        $hsl = $row->fetch();

        if ($hsl['stok'] > 0) {
            $sqlb = 'SELECT count(*) FROM _temp_penjualan WHERE id_barang = ?';
            $rowb = $config->prepare($sqlb);
            $rowb->execute(array($id));
            $hslb = $rowb->fetchColumn();

            $id_temp = temp_id($config);
            $kasir =  $_GET['id_kasir'];
            $jumlah = 1;
            $total = $hsl['harga_jual'];

            $data1[] = $id_temp;
            $data1[] = $id;
            $data1[] = $kasir;
            $data1[] = $jumlah;
            $data1[] = $total;

            // if($hslb == 0) {
                $sql1 = 'INSERT INTO _temp_penjualan (id_temp,id_barang,id_member,jumlah,total) VALUES (?,?,?,?,?)';
                $row1 = $config -> prepare($sql1);
                $row1 -> execute($data1);
            // } 
            // elseif($hslb > 0) {
            //     $data2[] = $id;
            //     $data2[] = $jumlah+$hslb;
            //     $sql1 = 'UPDATE _temp_penjualan SET jumlah=? WHERE id_barang=?';
            //     $row1 = $config -> prepare($sql1);
            //     $row1 -> execute($data2);
            // }

            echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
        } else {
            echo '<script>alert("Stok Barang Anda Telah Habis !");
					window.location="../../index.php?page=jual#keranjang"</script>';
        }
    }

    if (!empty($_GET['pelanggan_jual'])) {
        $id = htmlentities($_POST['id']);
        $nama = htmlentities($_POST['nama']);
        $telpon = htmlentities($_POST['telepon']);
        $mail = htmlentities($_POST['mail']);

        $data[] = $id;
        $data[] = $nama;
        $data[] = $telpon;
        $data[] = $mail;
       
        $sql = 'INSERT INTO ksw_pelanggan (id_pelanggan,nm_pelanggan,telepon,email,statusdata) 
                VALUES (?,?,?,?,"AKTIF") ';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=jual&success=tambah-data"</script>';
    }

    if (!empty($_GET['pelanggan'])) {
        $id = htmlentities($_POST['id']);
        $nm_pelanggan= htmlentities(htmlentities(ucwords($_POST['nm_pelanggan'])));
        $identitas= htmlentities (strtoupper($_POST['identitas']));
        $telepon= htmlentities ($_POST['telepon']);
        $statusdata= htmlentities ($_POST['statusdata']);
     

        $data[] = $id;
        $data[] = $nm_pelanggan;
        $data[] = $identitas;
        $data[] = $telepon;
        $data[] = $statusdata;
     
       
        $sql = 'INSERT INTO ksw_pelanggan (id_pelanggan,nm_pelanggan,identitas,telepon,statusdata) VALUES(?,?,?,?,?)';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=pelanggan&&success=tambah-data"</script>';
    }
	
	if (!empty($_GET['supplier'])) {
        $id = bin2hex(random_bytes(20));
        $nama_supplier= htmlentities(htmlentities(ucwords($_POST['nama_supplier'])));
        $telepon= htmlentities ($_POST['telepon']);
        $alamat= htmlentities ($_POST['alamat']);
        $status= htmlentities ($_POST['status']);
     

        $data[] = $id;
        $data[] = $nama_supplier;
        $data[] = $telepon;
        $data[] = $alamat;
        $data[] = $status;
     
       
        $sql = 'INSERT INTO supplier (id_supplier,nama_supplier,telepon,alamat,status) VALUES(?,?,?,?,?)';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=supplier&&success=tambah-data"</script>';
    }
}
