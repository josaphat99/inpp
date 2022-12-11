<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formation extends CI_Controller
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
     * Afficher la liste de toutes les formation
    */
	public function index()
    {
        $formation = $this->Crud->get_data_desc('formation');

        foreach($formation as $f)
        {
            $f->branche = $this->Crud->get_data('branche',['id'=>$f->branche_id])[0]->nom;
        }
        $data['formation'] = $formation;

        $this->load->view('formation/index',$data);
        $this->load->view('layout/admin/js');
    }
    
    /**
    * Enregistrer un nouvelle formation
    */
    public function new_formation()
    {
        if(count($_POST) <= 0)
        {
            $d['branche'] = $this->Crud->get_data('branche');

            $this->load->view('formation/new_formation',$d);
            $this->load->view('layout/admin/js');
        }else{

            $this->db->trans_start();

            $data = array(
                'intitule' => $this->input->post('intitule'),
                'duree' => $this->input->post('duree'),
                'tarif' => $this->input->post('tarif'),
                'branche_id' => $this->input->post('branche_id'),           
            );
            
            //insertion de la formation
            $this->Crud->add_data('formation',$data);

            //===--Fin transition--===
			$this->db->trans_commit();

            $this->session->set_flashdata(['formation_saved'=>true]);
            redirect('formation/index');
        }
    }

    public function delete_formation()
    {
        $formation_id = $this->input->post('formation_id');

        $this->Crud->delete_data('formation',['id'=>$formation_id]);

        $this->session->set_flashdata(['formation_deleted'=>true]);
        redirect('formation/index');
    }

    public function candidate_course()
    {
        $candidate_id = $this->session->id;

        $formation = $this->Crud->get_data_desc('detail_formation',['utilisateur_id'=>$candidate_id]);

        foreach($formation as $f)
        {
            $course = $this->Crud->get_data('formation',['id'=>$f->formation_id]);
            $f->intitule = $course[0]->intitule;
            $f->duree =  $course[0]->duree;
            $f->branche = $this->Crud->get_data('branche',['id'=> $course[0]->branche_id])[0]->nom;
            $f->etat = $f->etat == 'ongoing'? 'En cours' : 'Terminée';
        }

        $d = ['formation'=>$formation];

        $this->load->view('formation/candidate_course',$d);
        $this->load->view('layout/admin/js');
    }

    public function finish_course()
    {
        $formation_id = $this->input->get('formation_id');

        $this->Crud->update_data('detail_formation',['id'=>$formation_id],['etat'=>'finished']);

        redirect('formation/candidate_course');
    }
}
