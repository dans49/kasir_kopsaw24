<?php

session_start();
if (!empty($_SESSION['admin'])) {
    require '../../config.php';
    if (!empty(htmlentities($_GET['kategori']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM kategori WHERE id_kategori=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=kategori&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['satuan']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM satuan WHERE id_satuan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=satuan&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['barang']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM barang WHERE id_barang=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=barang&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['pelanggan']))) {
        $id= htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM ksw_pelanggan WHERE id_pelanggan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=pelanggan&&remove=hapus-data"</script>';
    }

    if (!empty(htmlentities($_GET['jual']))) {
        $dataI[] = htmlentities($_GET['brg']);
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        $id = htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM _temp_penjualan WHERE id_temp=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['jual_barang']))) {
        $dataI[] = htmlentities($_GET['brg']);
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        /*$jml = htmlentities($_GET['jml']) + $hasil['stok'];

        $dataU[] = $jml;
        $dataU[] = htmlentities($_GET['brg']);
        $sqlU = 'UPDATE barang SET stok =? where id_barang=?';
        $rowU = $config -> prepare($sqlU);
        $rowU -> execute($dataU);*/

        $id = htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM penjualan WHERE id_penjualan=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['penjualan']))) {
        $sql = 'DELETE FROM penjualan';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['penjualan_jual']))) {
        $sql = 'DELETE FROM _temp_penjualan';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=jual"</script>';
    }

    if (!empty(htmlentities($_GET['restok_barang']))) {
        $sql = 'DELETE FROM _temp_restok';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=restok"</script>';
    }

    if (!empty(htmlentities($_GET['beli_restok']))) {
         $dataI[] = htmlentities($_GET['brg']);
        $sqlI = 'select*from barang where id_barang=?';
        $rowI = $config -> prepare($sqlI);
        $rowI -> execute($dataI);
        $hasil = $rowI -> fetch();

        $id = htmlentities($_GET['id']);
        $data[] = $id;
        $sql = 'DELETE FROM _temp_restok WHERE id_trestok=?';
        $row = $config -> prepare($sql);
        $row -> execute($data);
        echo '<script>window.location="../../index.php?page=restok"</script>';

    }
    
    if (!empty(htmlentities($_GET['laporan']))) {
        $sql = 'DELETE FROM nota';
        $row = $config -> prepare($sql);
        $row -> execute();
        echo '<script>window.location="../../index.php?page=laporan&remove=hapus"</script>';
    }

    if (!empty(htmlentities($_GET['supplier']))) {
        $id = $_GET['id'];
        $sql = 'DELETE FROM supplier WHERE id_supplier=?';
        $row = $config -> prepare($sql);
        $row -> execute(array($id));
        echo '<script>window.location="../../index.php?page=supplier&remove=hapus"</script>';
    }
}
