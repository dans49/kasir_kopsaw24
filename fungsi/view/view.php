<?php
/*
* PROSES TAMPIL
*/
class view
{
    protected $db;
    public function __construct($db)
    {
        $this->db = $db;
    }

    public function member()
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function member_edit($id)
    {
        $sql = "select member.*, login.*
                from member inner join login on member.id_member = login.id_member
                where member.id_member= ?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function toko()
    {
        $sql = "select*from toko where id_toko='1'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }
    
    public function supplier()
    {
        $sql = "select*from supplier";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function satuan()
    {
        $sql = "select*from satuan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang()
    {
        $sql = "select barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan from barang inner join kategori on barang.id_kategori = kategori.id_kategori
        INNER JOIN satuan ON barang.id_satuan = satuan.id_satuan 
        ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

  


    public function pelanggan()
    {
        $sql = "select * from ksw_pelanggan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
        // tes
    }

    public function pelanggan_w() //NAMBAH
    {
        $sql = "select * from ksw_pelanggan WHERE id_pelanggan = ?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($_GET['idp']));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function pelanggan_id()
    {
        $sql = 'SELECT * FROM ksw_pelanggan ORDER BY id_pelanggan DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['id_pelanggan'], 2, 4);
        $tambah = (int) $urut + 1;
        $format = "PW".sprintf('%04d',$tambah);
        return $format;
    }

    public function member_id()
    {
        $sql = 'SELECT * FROM member ORDER BY id_member DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        if ($hasil) {
            $lastId = (int) $hasil['id_member'];
            $newId = $lastId + 1;
        } else {
            // Jika belum ada anggota, mulai dengan ID pertama
            $newId = 1;
        }
    
        return $newId;
    }

    public function barang_stok()
    {
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan from barang inner join kategori on barang.id_kategori = kategori.id_kategori 
        inner join satuan on barang.id_satuan = satuan.id_satuan
        where stok <= 3 
        ORDER BY id DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_edit($id)
    {
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan
        from barang inner join kategori on barang.id_kategori = kategori.id_kategori
        inner join satuan on barang.id_satuan = satuan.id_satuan
        where id_barang=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function barang_cari($cari)
    {
        $sql = "SELECT barang.*, kategori.id_kategori, kategori.nama_kategori, satuan.id_satuan, satuan.nama_satuan
        from barang inner join kategori on barang.id_kategori = kategori.id_kategori
        inner join satuan on barang.id_satuan = satuan.id_satuan
        where id_barang like '%$cari%' or nama_barang like '%$cari%' or merk like '%$cari%'";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function barang_id()
    {
        $sql = 'SELECT * FROM barang ORDER BY id DESC';
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();

        $urut = substr($hasil['id_barang'], 2, 3);
        $tambah = (int) $urut + 1;
        if (strlen($tambah) == 1) {
            $format = 'BR00'.$tambah.'';
        } elseif (strlen($tambah) == 2) {
            $format = 'BR0'.$tambah.'';
        } else {
            $ex = explode('BR', $hasil['id_barang']);
            $no = (int) $ex[1] + 1;
            $format = 'BR'.$no.'';
        }
        return $format;
    }

    public function kategori_edit($id)
    {
        $sql = "select*from kategori where id_kategori=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function kategori_row()
    {
        $sql = "select*from kategori";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function satuan_edit($id)
    {
        $sql = "select*from satuan where id_satuan=?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($id));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function satuan_row()
    {
        $sql = "select*from satuan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function barang_row()
    {
        $sql = "select*from barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> rowCount();
        return $hasil;
    }

    public function barang_stok_row()
    {
        $sql ="SELECT SUM(stok) as jml FROM barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function barang_beli_row()
    {
        $sql ="SELECT SUM(harga_beli) as beli FROM barang";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual_row()
    {
        $sql ="SELECT SUM(jumlah) as stok FROM nota";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jual()
    {
        $data[] = date('m');
        $data[] = date('Y');
        $sql ="SELECT nota.* , ksw_pelanggan.id_pelanggan, ksw_pelanggan.nm_pelanggan, ksw_pelanggan.       identitas, member.id_member,
        member.nm_member from nota 
        left join ksw_pelanggan on ksw_pelanggan.id_pelanggan=nota.id_pelanggan
        left join member on member.id_member=nota.id_member
        where month(nota.waktudata) = ?
        AND year(nota.waktudata) = ?
        ORDER BY id_nota DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array(date('m-Y')));
        $hasil = $row -> fetchAll();
        return $hasil;
    }
    
    public function nota_penjualan() // NAMBAH
    {
        $data[] = date('m');
        $data[] = date('Y');
        $sql ="SELECT nota.* , ksw_pelanggan.id_pelanggan, ksw_pelanggan.nm_pelanggan, ksw_pelanggan.identitas, member.id_member,
                member.nm_member from nota 
                left join ksw_pelanggan on ksw_pelanggan.id_pelanggan=nota.id_pelanggan
                left join member on member.id_member=nota.id_member
                where month(nota.waktudata) = ?
                AND year(nota.waktudata) = ?
                ORDER BY id_nota DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute($data);
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function rincian_nota($id) // NAMBAH
    {
        $data[] = $id;
        $sql ="SELECT rincian.*, penjualan.diskon, nota.id_nota,nota.bayar,barang.nama_barang from rincian 
                left join nota on nota.id_nota=rincian.id_nota
                left join barang on barang.id_barang=rincian.id_barang
                left join penjualan on penjualan.id_nota=rincian.id_nota
                where rincian.id_nota = ?
                
                ORDER BY id_rincian DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute($data);
        $hasil = $row -> fetchAll();
        return $hasil;
    }


   

    public function barang_jual() // NAMBAH
    {
        $data[] = date('m');
        $data[] = date('Y');
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member, sum(penjualan.jumlah) as terjual, sum(penjualan.total) as totalb,member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member 
                where month(penjualan.waktudata) = ?
                AND year(penjualan.waktudata) = ?
                GROUP BY penjualan.id_barang ORDER BY penjualan.waktudata ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute($data);
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function periode_penjual($periode) // NAMBAH
    {
        $cari = "%$periode%";
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,sum(penjualan.jumlah) as terjual, sum(penjualan.total) as totalb, member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member WHERE penjualan.waktudata like ? 
                GROUP BY penjualan.id_barang ORDER BY penjualan.waktudata ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($cari));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function periode_jual($periode)
    {
        $cari = "%$periode%";
        $sql ="SELECT nota.* , ksw_pelanggan.id_pelanggan, ksw_pelanggan.nm_pelanggan, ksw_pelanggan.identitas, member.id_member,
        member.nm_member from nota 
        left join ksw_pelanggan on ksw_pelanggan.id_pelanggan=nota.id_pelanggan
        left join member on member.id_member=nota.id_member WHERE nota.waktudata like ?
        ORDER BY id_nota ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($cari));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function hari_jual($hari)
    {
        $data[] = $hari . '%';
        $sql = "SELECT nota.*, ksw_pelanggan.id_pelanggan, ksw_pelanggan.nm_pelanggan, ksw_pelanggan.identitas, member.id_member, member.nm_member 
                FROM nota 
                LEFT JOIN ksw_pelanggan ON ksw_pelanggan.id_pelanggan = nota.id_pelanggan 
                LEFT JOIN member ON member.id_member = nota.id_member 
                WHERE DATE(nota.waktudata) LIKE ?
                ORDER BY id_nota ASC";
        $row = $this->db->prepare($sql);
        $row->execute($data);
        $hasil = $row->fetchAll();
        return $hasil;
    }

    

    public function hari_barang_jual($hari) // NAMBAH
    {
        $ex = explode('-', $hari);
        $monthNum  = $ex[1]; // ambil bulan
        $monthName = date('F', mktime(0, 0, 0, $monthNum, 10));
        if ($ex[2] > 9) {
            $tgl = $ex[2];
        } else {
            $tgl1 = explode('0', $ex[2]);
            $tgl = $tgl1[1];
        }

        $cek = $hari;
        $param[] = "%{$cek}%";
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,sum(penjualan.jumlah) as terjual, sum(penjualan.total) as totalb,member.nm_member from penjualan 
        left join barang on barang.id_barang=penjualan.id_barang 
        left join member on member.id_member=penjualan.id_member 
        where penjualan.waktudata like ? GROUP BY penjualan.id_barang ORDER BY penjualan.waktudata ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute($param);
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function penjualan()
    {
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.merk, barang.harga_jual, member.id_member,
                member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member
                ORDER BY id_penjualan";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function temp_penjualan()
    {
        $sql ="SELECT _temp_penjualan.* , barang.id_barang, barang.nama_barang, barang.merk, barang.harga_beli, member.id_member,
                member.nm_member from _temp_penjualan 
                left join barang on barang.id_barang=_temp_penjualan.id_barang 
                left join member on member.id_member=_temp_penjualan.id_member
                ORDER BY id_temp";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function temp_restok() // NAMBAH
    {
        $sql ="SELECT _temp_restok.* , barang.id_barang, barang.nama_barang, barang.harga_jual, member.id_member,
                member.nm_member from _temp_restok 
                left join barang on barang.id_barang=_temp_restok.id_barang 
                left join member on member.id_member=_temp_restok.id_member
                ORDER BY id_trestok";
        $row = $this-> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function penjualan_print($nota)
    {
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_jual, member.id_member,
                member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member
                WHERE penjualan.id_nota=?
                ORDER BY id_penjualan";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($nota));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function jumlah()
    {
        $sql ="SELECT SUM(total) as bayar FROM penjualan";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jumlah_nota()
    {
        $sql ="SELECT SUM(total) as bayar FROM nota";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jumlah_rincian()
    {
        $sql ="SELECT SUM(total) as bayar FROM rincian";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }


    public function nota_print($nota)
    {
        $sql ="SELECT * FROM nota WHERE id_nota = ?";
        $row = $this -> db -> prepare($sql);
        $row -> execute(array($nota));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function jml()
    {
        $sql ="SELECT SUM(harga_beli*stok) as byr FROM barang";
        $row = $this -> db -> prepare($sql);
        $row -> execute();
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function tahun_barang_jual($periode) // NAMBAH
    {
        $cari = "%$periode%";
        $sql ="SELECT penjualan.* , barang.id_barang, barang.nama_barang, barang.harga_beli, member.id_member,sum(penjualan.jumlah) as terjual, sum(penjualan.total) as totalb, member.nm_member from penjualan 
                left join barang on barang.id_barang=penjualan.id_barang 
                left join member on member.id_member=penjualan.id_member WHERE penjualan.waktudata like ? 
                GROUP BY penjualan.id_barang ORDER BY penjualan.waktudata ASC";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($cari));
        $hasil = $row -> fetchAll();
        return $hasil;
    }

    public function sumcash($idbarang,$par2,$par3)
    {
        $data[] = $idbarang;
        $data[] = $par2;
        $data[] = $par3;
        $sql_penj = "SELECT sum(total) as totc FROM penjualan WHERE jenis_bayar='cash' AND id_barang = ? AND month(penjualan.waktudata) = ? AND year(penjualan.waktudata) = ?";
        $row_penj = $this-> db ->prepare($sql_penj);
        $row_penj->execute($data);
        $hasil = $row_penj->fetch();
        return $hasil;
    }

    public function sumcashcari($idbarang,$periode) // NAMBAH
    {
        $cari = "%$periode%";
        $sql ="SELECT sum(total) as totc FROM penjualan WHERE jenis_bayar='cash' AND id_barang = ? AND waktudata like ?";
        $row = $this-> db -> prepare($sql);
        $row -> execute(array($idbarang,$cari));
        $hasil = $row -> fetch();
        return $hasil;
    }

    public function sumcredit($idbarang,$par2,$par3)
    {
        $data[] = $idbarang;
        $data[] = $par2;
        $data[] = $par3;
        $sql_cr = "SELECT sum(total) as totcr FROM penjualan WHERE jenis_bayar='credit' AND id_barang = ? AND month(penjualan.waktudata) = ? AND year(penjualan.waktudata) = ?";
        $row_cr = $this-> db ->prepare($sql_cr);
        $row_cr->execute($data);
        $hasil = $row_cr->fetch();
        return $hasil;
    }

    public function sumcreditcari($idbarang,$periode)
    {
        $cari = "%$periode%";
        $sql_cr = "SELECT sum(total) as totcr FROM penjualan WHERE jenis_bayar='credit' AND id_barang = ? AND waktudata like ?";
        $row_cr = $this-> db ->prepare($sql_cr);
        $row_cr->execute(array($idbarang,$cari));
        $hasil = $row_cr->fetch();
        return $hasil;
    }

    // === DATATABLE SERVERSIDE ===
    public function _getdatanota() // NAMBAH
    {
        $data[] = date('m');
        $data[] = date('Y');
        $sql ="SELECT nota.* , ksw_pelanggan.id_pelanggan, ksw_pelanggan.nm_pelanggan, ksw_pelanggan.identitas, member.id_member,
                member.nm_member from nota 
                left join ksw_pelanggan on ksw_pelanggan.id_pelanggan=nota.id_pelanggan
                left join member on member.id_member=nota.id_member
                where month(nota.waktudata) = ?
                AND year(nota.waktudata) = ?
                ORDER BY id_nota DESC";
        $row = $this-> db -> prepare($sql);
        $row -> execute($data);
        $hasil = $row -> fetchAll();
        return $hasil;
    }
}
