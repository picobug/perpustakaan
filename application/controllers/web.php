<?php
class Web extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model(array('m_buku','m_anggota','m_petugas'));
        if($this->session->userdata('username')){
            redirect('dashboard');
        } elseif ($this->session->userdata('usernis')) {
            redirect('dashboard_nis');
        }
    }
    
    function index(){
        $this->load->view('web/index');
    }
    
    function cari_buku(){
        $cari=$this->input->post('cari');
        $data['hasil']=$this->m_buku->cari($cari)->result();
        $data['title']="Pencarian Buku";
        $this->load->view('web/cari_buku',$data);
    }
    
    function anggota(){
        $data['title']="Data Anggota";
        $data['anggota']=$this->m_anggota->semua()->result();
        $this->load->view('web/anggota',$data);
    }
    
    function cari_anggota(){
        $cari=$this->input->post('cari');
        $data['title']="Data Anggota";
        $data['anggota']=$this->m_anggota->cari($cari)->result();
        $this->load->view('web/anggota',$data);
    }
    
    function login(){
        $this->load->view('web/login');
    }
    
    function proses(){
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','required|trim|xss_clean');
        $this->form_validation->set_rules('password','password','required|trim|xss_clean');
        
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Username dan password harus diisi');
            redirect('web');
        }else{
            $username=$this->input->post('username');
            $password=$this->input->post('password');
            $cek=$this->m_petugas->cek($username,md5($password));
            if($cek->num_rows()>0){
                //login berhasil, buat session
                $this->session->set_userdata('username',$username);
                redirect('dashboard');
                
            }else{
                //login gagal
                $this->session->set_flashdata('message','Username atau password salah');
                redirect('web');
            }
        }
    }
    function proses_anggota() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username','Username','required|trim|xss_clean');
        if($this->form_validation->run()==false){
            $this->session->set_flashdata('message','Nis Anggota harus diisi');
            redirect('web');
        } else {
            $username=$this->input->post('username');
            $cek = $this->db->query("SELECT * FROM anggota WHERE anggota.nis = $username");
            if ($cek->num_rows()>0) {
                $this->db->query("UPDATE anggota SET anggota.counter = (anggota.counter+1) WHERE anggota.nis = $username");
                $this->session->set_userdata('usernis',$username);
                $book = $this->db->select('*')->from('pemesanan')->join('buku','buku.kode_buku = pemesanan.kode_buku')->where(array('buku.status'=>'tersedia','pemesanan.nis'=>$username))->get()->result_array();
                $this->session->set_flashdata('message',json_encode($book));
                redirect('dashboard_nis');
            } else {
                $this->session->set_flashdata('message','NIS Anggota salah');
                redirect('web');
            }
        }
    }
}