<?php class Laporan extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->library(array('template'));
        $this->load->model('m_laporan');
        
        if(!$this->session->userdata('username')){
            redirect('web');
        }
    }
    
    function anggota(){
        $data['title']="Data Anggota";
        $data['anggota']=$this->m_laporan->semuaAnggota()->result();
        $this->template->display('laporan/anggota',$data);
    }
    
    function buku(){
        $data['title']="Data Buku";
        $data['buku']=$this->m_laporan->semuaBuku()->result();
        $this->template->display('laporan/buku',$data);
    }
    
    function peminjaman(){
        $data['title']="Laporan Peminjaman";
        $this->template->display('laporan/peminjaman',$data);
    }
    
    function cari_pinjaman(){
        $data['title']="Detail Peminjaman";
        $tanggal1=$this->input->post('tanggal1');
        $tanggal2=$this->input->post('tanggal2');
        $data['lap']=$this->m_laporan->detailpeminjaman($tanggal1,$tanggal2)->result();
        $this->load->view('laporan/cari_pinjaman',$data);
    }
    
    function detail_pinjam($id){
        $data['title']=$id;
        $data['pinjam']=$this->m_laporan->detail_pinjam($id)->row_array();
        $data['detail']=$this->m_laporan->detail_pinjam($id)->result();
        $this->template->display('laporan/detail_pinjam',$data);
    }
    
    function pengembalian(){
        $data['title']="Data Pengembalian";
        $this->template->display('laporan/pengembalian',$data);
    }
    
    function cari_pengembalian(){
        $data['title']="Detail Pengembalian";
        $tanggal1=$this->input->post('tanggal1');
        $tanggal2=$this->input->post('tanggal2');
        $data['lap']=$this->m_laporan->detailpengembalian($tanggal1,$tanggal2)->result();
        $this->load->view('laporan/cari_pengembalian',$data);
    }
    function buku_terlaris($value='') {
        $data['title'] = 'Detail Buku Sering Dipinjam';
        $buku_terlaris = $this->db->query("SELECT * FROM buku WHERE buku.counter > 0 ORDER BY buku.counter DESC")->result();
        $data['buku_terlaris'] = $buku_terlaris;
        $this->template->display('laporan/buku_terlaris',$data);
    }
    function pemesan_buku($value='') {
        if ($value=='sukses') {
            $data['message']="<div class='alert alert-success'>Data berhasil dihapus</div>";
        }
        $data['title'] = 'Detail Pemesan Buku';
        $pemesan_buku = $this->db->select('pemesanan.id, pemesanan.tgl_pesan, buku.judul, buku.pengarang, buku.image AS buku_img, anggota.nama, anggota.kelas, anggota.nis')->from('pemesanan')->join('buku','buku.kode_buku = pemesanan.kode_buku','left')->join('anggota','anggota.nis = pemesanan.nis','left')->order_by('pemesanan.id','ASC')->get()->result();
        $data['pemesan_buku'] = $pemesan_buku;
        $this->template->display('laporan/pemesan_buku',$data);
    }
    function anggota_aktif($value='') {
        $data['title'] = 'Detail Keaktifan Anggota';
        $anggota_aktif = $this->db->query("SELECT * FROM anggota WHERE anggota.counter > 0 ORDER BY anggota.counter DESC")->result();
        $data['anggota_aktif'] = $anggota_aktif;
        $this->template->display('laporan/anggota_aktif',$data);
    }
    function denda_terlambat($value='') {
        $data['title'] = 'Detail Denda Keterlambatan';
        if ($this->input->post('tanggal1') && $this->input->post('tanggal2')) {
            $tanggal1=$this->input->post('tanggal1');
            $tanggal2=$this->input->post('tanggal2');
            $denda_terlambat = $this->db->query("SELECT * FROM transaksi WHERE transaksi.denda = 'terlambat' AND transaksi.nominal > 0 AND transaksi.tanggal_kembali BETWEEN '$tanggal1' and '$tanggal2'")->result();
            $data['denda_terlambat'] = $denda_terlambat;
            $this->load->view('laporan/denda_terlambat',$data);
        } else {
            $this->template->display('laporan/denda_terlambat',$data);
        }
    }
    function denda_rusak($value='') {
        $data['title'] = 'Detail Denda Hilang / Rusak';
        if ($this->input->post('tanggal1') && $this->input->post('tanggal2')) {
            $tanggal1=$this->input->post('tanggal1');
            $tanggal2=$this->input->post('tanggal2');
            $denda_rusak = $this->db->query("SELECT * FROM transaksi WHERE transaksi.denda = 'rusak' AND transaksi.tanggal_kembali BETWEEN '$tanggal1' and '$tanggal2'")->result();
            $data['denda_rusak'] = $denda_rusak;
            $this->load->view('laporan/denda_rusak',$data);
        } else {
            $this->template->display('laporan/denda_rusak',$data);
        }
    }
	function buku_rusak($value='') {
        $data['title'] = 'Detail Buku Hilang / Rusak';
		$buku_rusak = $this->db->query("SELECT buku.kode_buku, buku.judul, buku.pengarang FROM buku JOIN transaksi ON transaksi.kode_buku = buku.kode_buku WHERE transaksi.denda = 'rusak' AND buku.status='rusak'")->result();
		$data['buku_rusak'] = $buku_rusak;
		$this->template->display('laporan/buku_rusak',$data);
        
    }
}