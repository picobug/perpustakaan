<?php
class Dashboard_nis extends CI_Controller{
    private $limit=20;
    
    function __construct(){
        parent::__construct();
        $this->load->model('m_petugas');
        $this->load->library(array('template','form_validation','pagination','upload','session'));
        
        if(!$this->session->userdata('usernis')){
            redirect('web');
        }
    }
    
    function index(){
        $data['title']="Home";
        $user = $this->session->userdata('usernis');
        $data['anggota'] = $this->db->query("SELECT * FROM anggota WHERE anggota.nis = $user")->row();
        
        $this->template->view('dashboard_nis/index',$data);
    }
    function lihat_buku($offset=0,$order_column='kode_buku',$order_type='asc') {
        $data['title']="Lihat Buku";
        $this->load->model('m_buku');
		$con = array();
		if($this->input->post('cari')){
			$con = array('judul' => $cari=$this->input->post('cari'), 'pengarang' => $cari=$this->input->post('cari'));
		}
        //load data
        $data['buku']=$this->m_buku->semua($this->limit,$offset,$order_column,$order_type,$con)->result();
        $config['base_url']=site_url('dashboard_nis/lihat_buku/');
        $config['total_rows']=$this->m_buku->jumlah();
        $config['per_page']=$this->limit;
        $config['uri_segment']=3;
		
        $this->pagination->initialize($config);
        $data['pagination']=$this->pagination->create_links();

        $this->template->view('dashboard_nis/lihat_buku',$data);
    }

    function pesan_buku() {
        $data['title']="Pesan Buku";
        $user = $this->session->userdata('usernis');
        if ($this->input->post('cari')) {
            $cari = $this->input->post('cari');
            // $data['buku'] = $this->db->query("SELECT kode_buku, judul FROM buku WHERE 1 = 1 AND ")->result();
            $data['buku'] = $this->db->like('kode_buku',$cari)->or_like('judul',$cari)->get('buku')->result();
            $this->load->view('dashboard_nis/pesan_buku',$data);
        } else {
            $this->template->view('dashboard_nis/pesan_buku',$data);
        }
    }

    function simpan_pesan() {
        $data = array(
            'kode_buku' => $this->input->post('kode_buku'),
            'nis' => $this->session->userdata('usernis')
        );
        $query = $this->db->get_where('pemesanan',$data);
        if (!$query->num_rows()) {
            $data['tgl_pesan'] = date('Y-m-d');
            if ($this->db->insert('pemesanan',$data)) {
                echo json_encode(array('status'=>true,'data'=>'<div class="alert alert-success">Pesanan Buku telah ditambahkan</div>'));
            }
        } else {
            echo json_encode(array('status'=>false,'data'=>'<div class="alert alert-success">Pesanan Buku telah ditambahkan sebelumnya</div>'));
        }
    }
    
    function logout(){
        $this->session->unset_userdata('usernis');
        redirect('web');
    }
}