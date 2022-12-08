<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if(!$this->session->connected)
		{
			redirect('compte');
		}

		//======================================================
		$this->load->model('Crud');
        //==========================================================
        $this->load->view('layout/admin/head');
        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');
    }

    /**
     * Afficher la liste de toutes les paiement d'un candidat
    */
	public function index()
    {
        $candidat_id = $this->session->id;

        $paiement = $this->Crud->get_data_desc('paiement',['utilisateur_id'=>$candidat_id]);

        foreach($paiement  as $p)
        {
            $p->formation = $this->Crud->get_data('formation',['id'=>$p->formation_id])[0]->intitule;
        }
        
        $data['paiement'] = $paiement ;

        $this->load->view('paiement/index',$data);
        $this->load->view('layout/admin/js');
    }
    
    /**
    * Effectuer paiement
    */
    public function new_paiement()
    {
        if(count($_POST) <= 0)
        {
            $formation_id = $this->input->get('formation_id');
            $formation = $this->Crud->get_data('formation',['id'=>$formation_id])[0];
            $formation->branche = $this->Crud->get_data('branche',['id'=>$formation->branche_id])[0]->nom;

            $d['formation'] = $formation;

            $this->load->view('paiement/new_paiement',$d);
            $this->load->view('layout/admin/js');
        }else{

            $this->db->trans_start();

            $data = array(
                'date' => date("d-m-Y",time()),
                'montant' => $this->input->post('montant'),
                'formation_id' => $this->input->post('formation_id'),   
                'utilisateur_id' => $this->session->id,          
            );
            
            //insertion du paiement
            $this->Crud->add_data('paiement',$data);

            $detail_formation = [
                'formation_id' => $this->input->post('formation_id'),   
                'utilisateur_id' => $this->session->id, 
            ];

            $this->Crud->add_data('detail_formation',$detail_formation);

            //===--Fin transition--===
			$this->db->trans_commit();

            $this->session->set_flashdata(['paiement_saved'=>true]);
            redirect('payment/index');
        }
    }

    /**
    * visualiser paiement par financier
    */
    public function view_paiement()
    {
        if(!$this->session->type_compte == 'finance')
        {
            redirect('compte');
        }
        
        $paiement = $this->Crud->get_data_desc('paiement');
        $formation = $this->Crud->get_data('formation');

        foreach($paiement  as $p)
        {
            $p->formation = $this->Crud->get_data('formation',['id'=>$p->formation_id])[0]->intitule;
            $p->candidat = $this->Crud->get_data('utilisateur',['id'=>$p->utilisateur_id])[0]->nom_complet;
        }
        
        $data['paiement'] = $paiement ;
        $data['formation'] = $formation ;

        $this->load->view('paiement/view_paiement',$data);
        $this->load->view('layout/admin/js');
    }
}
