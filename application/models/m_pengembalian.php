<?php
class M_Pengembalian extends CI_Model{
    
    function cariTransaksi($no){
        $query=$this->db->query("select a.*,b.nama, DATEDIFF(NOW(),a.tanggal_kembali) as tgl_expired from transaksi a,
                                anggota b
                                where a.id_transaksi='$no' and a.status !='Y'
                                and a.nis=b.nis");
        return $query;
    }
    
    function tampilBuku($no){
        $query=$this->db->query("select a.*,b.judul,b.pengarang
                                from transaksi a,buku b
                                where a.id_transaksi='$no' and
                                a.status != 'Y'
                                and a.kode_buku=b.kode_buku");
        return $query;
    }
    
    function simpan($info){
        $this->db->insert("pengembalian",$info);
    }
    
    function update($no,$update){
        $this->db->where("id_transaksi",$no);
        $this->db->update("transaksi",$update);

        $sql = "UPDATE buku SET buku.status = 0, buku.counter = (buku.counter + 1) WHERE buku.kode_buku IN(SELECT kode_buku FROM transaksi WHERE transaksi.id_transaksi = $no)";
        $this->db->query($sql);
    }
    
    function cari_by_nis($nis){
        $query=$this->db->query("SELECT * FROM transaksi WHERE transaksi.status !='Y'
                                AND nis LIKE'%$nis%' GROUP BY nis");
        return $query;
    }
}