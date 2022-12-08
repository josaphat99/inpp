<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Candidat extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if(!$this->session->connected)
		// {
		// 	redirect('compte');
		// }

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/admin/head');
        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');
    }

    /**
     * Afficher la liste de tous les dons
    */
	public function index()
    {
        
        $this->load->view('candidat/index');
        $this->load->view('layout/admin/js');
    }

    public function contact()
    {
        
        $this->load->view('candidat/contact');
        $this->load->view('layout/admin/js');
    }
    
    /**
    * Enregistrer un nouveau don
    */
    public function new_don()
    {
        if(count($_POST) <= 0)
        {
            $d['groupe_sanguin'] = $this->Crud->get_data('groupe');
            $d['donneur'] = $this->Crud->get_data('person',['type'=>'donneur']);
            $d['produit_sanguin'] = $this->Crud->get_data('produit_sanguin');

            $this->load->view('don/new_don',$d);

            $this->load->view('layout/admin/js');
        }else{

            $this->db->trans_start();

            $data = array(
                'date' => date('d-m-Y H:i',time()),
                'donneur_id' => $this->input->post('donneur_id'),
                'groupe_id' => $this->input->post('groupe_id'),
                'produit_sanguin_id' => $this->input->post('produit_sanguin_id'),
                'quantite' => $this->input->post('quantite'),                
            );
            
            //insertion du don
            $this->Crud->add_data('don',$data);

            //===--Fin transition--===
			$this->db->trans_commit();

            $this->session->set_flashdata(['don_saved'=>true]);
            redirect('don/index');
        }
    }

    public function delete_don()
    {
        $don_id = $this->input->post('don_id');

        $this->Crud->delete_data('don',['id'=>$don_id]);

        $this->session->set_flashdata(['don_deleted'=>true]);
        redirect('don/index');
    }
}
