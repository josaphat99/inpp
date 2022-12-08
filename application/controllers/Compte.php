<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compte extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

	
		//======================================================
		$this->load->model('Crud');
		//======================================================
		$this->load->view('layout/admin/head');
	}

    public function index()
    {
      $this->login();
    }

    public function login()
    {
        if(count($_POST)<=0)
        {
            $this->session->sess_destroy();

            $this->load->view('layout/admin/sidebar');
            $this->load->view('layout/admin/topbar');
            $this->load->view('compte/login');
            $this->load->view('layout/admin/js');
        }else{

            $data = array(
                "username" => strtolower(trim($this->input->post("username"))),
                "password" => $this->input->post("password")
            );

            $res = $this->Crud->get_data('compte',$data);
    
            if(count($res) > 0)
            {
                $nom_complet = $this->Crud->get_data('utilisateur',['id'=>$res[0]->utilisateur_id])[0]->nom_complet;
                $email = $this->Crud->get_data('utilisateur',['id'=>$res[0]->utilisateur_id])[0]->email;

                //creation de la session
                $session = [
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "nomcomplet"=>$nom_complet,
                    "type_compte"=>$res[0]->type_compte,
                    "email"=>$email,
                    "connected"=>true,                    
                ];
    
                $this->session->set_userdata($session);
    
                //gestion des interfaces selon les differents utilisateurs
                if(trim($res[0]->type_compte) == trim("candidat"))
                {
                    redirect('formation/index');                    
                }               
                else if(trim($res[0]->type_compte) == trim("admin"))
                {
                    redirect('compte/view_financier'); 
                }
                else if(trim($res[0]->type_compte) == trim("finance"))
                {
                    redirect('payment/view_paiement'); 
                }
                else{				
                    $login_error = array("error_login" => "Données incorrectes!!");
                    $this->session->set_flashdata($login_error);
                    redirect('compte'); 
                }
            }
            else{
                $login_error = array("error_login" => "Données incorrectes!!");
                $this->session->set_flashdata($login_error);
                redirect("compte");
            }
        }        
    }


    public function new_candidate()
    {
        if(count($_POST) <= 0)
        {
            $this->load->view('layout/admin/sidebar');
            $this->load->view('layout/admin/topbar');

            $this->load->view('compte/new_candidate');

            $this->load->view('layout/admin/js');
        }else{

            $this->db->trans_start();

            $utilisateur_data = array(
                'nom_complet' => $this->input->post('nomcomplet'),
                'adresse' => $this->input->post('adresse'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'genre' => $this->input->post('genre'),
                'type_candidat' => $this->input->post('type_candidat'),
            );
            
            //insertion de la personne
            $this->Crud->add_data('utilisateur',$utilisateur_data);

            //recuperation de son id
            $utilisateur_id = $this->Crud->get_data_desc('utilisateur')[0]->id;

            //creation du compte
            $account_data = array(
                'username' => strtolower(trim($this->input->post('username'))),
                'password' => $this->input->post('password'),
                'type_compte' => 'candidat',
                'utilisateur_id' => $utilisateur_id
            );
            
            $this->Crud->add_data('compte',$account_data);

            //insertion du document

            if($_FILES['identite']['name'] != null && $_FILES['lettre']['name'] != null)
            {
                $lettre_file_name = str_replace(' ','_',$_FILES['lettre']['name']);
                $lettre = 'fichier'.md5(time())."_".$lettre_file_name;
                $identite_file_name = str_replace(' ','_',$_FILES['identite']['name']);
                $identite = 'fichier'.md5(time())."_".$identite_file_name;

                $lettre_uploaded = move_uploaded_file($_FILES['lettre']['tmp_name'], './assets/files/lettre/'.$lettre);	
                $identite_uploaded = move_uploaded_file($_FILES['identite']['tmp_name'], './assets/files/identite/'.$identite);	

                if($lettre_uploaded  && $identite_uploaded)
                {
                    $this->Crud->add_data('document',[
                        'nom_fichier' => $lettre,
                        'type' => 'lettre',
                        'utilisateur_id' => $utilisateur_id
                    ]);

                    $this->Crud->add_data('document',[
                        'nom_fichier' => $identite,
                        'type' => 'identite',
                        'utilisateur_id' => $utilisateur_id
                    ]);
                }else{
                    $this->session->set_flashdata(['doc_upload_failed'=>true]);
                }
            }else{
                $this->session->set_flashdata(['doc_upload_failed'=>true]);
            }         

         
            //===--Fin transition--===
			$this->db->trans_commit();

            $this->session->set_flashdata(['candidate_saved'=>true]);
            redirect('compte/index');
        }
    }
   
    public function delete_compte()
    {
        $utilisateur_id = $this->input->post('utilisateur_id');
        $compte_id = $this->input->post('compte_id');

        $type = $this->Crud->get_data('compte',['id'=>$compte_id])[0]->type_compte;

        $this->Crud->delete_data('utilisateur',['id'=> $utilisateur_id]);
        $this->Crud->delete_data('compte',['id'=> $compte_id]);

        $this->session->set_flashdata(['compte_deleted'=>true]);

        if($type == 'financier')
        {
            redirect('compte/view_financier');
        }else{
            redirect('compte/view_candidat');
        }
        
    }

    public function logout(){
        $this->session->sess_destroy();
		redirect("compte");
    }

    public function view_financier()
    {
        if(!$this->session->connected)
		{
			redirect('compte');
		}

        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');

        $compte = $this->Crud->join_compte_user();

        $d['compte'] = $compte;

        $this->load->view('compte/view_financier',$d);
        $this->load->view('layout/admin/js');
    }

    public function  new_financier()
    {
        if(!$this->session->connected)
		{
			redirect('compte');
		}
        
        if(count($_POST) <= 0)
        {
            $this->load->view('layout/admin/sidebar');
            $this->load->view('layout/admin/topbar');

            $this->load->view('compte/new_financier');

            $this->load->view('layout/admin/js');
        }else{
            $this->db->trans_start();

            $name =  $this->input->post('nomcomplet');
            $name_split = explode(' ',$name);
            $username = strtolower('@'.$name_split[0]);
            $password = $username.'2022';

            //matricule
            $dt = date('Y',time());
            $dt = $dt[2].$dt[3];
            $matricule = $dt.$name_split[0][0].$name_split[1][0].rand(100,500);

            $utilisateur_data = array(
                'matricule' => $matricule,
                'nom_complet' => $name,
                'adresse' => $this->input->post('adresse'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'genre' => $this->input->post('genre'),
                'poste' => 'Financier',
            );
            
            //insertion de la personne
            $this->Crud->add_data('utilisateur',$utilisateur_data);

            //recuperation de son id
            $utilisateur_id = $this->Crud->get_data_desc('utilisateur')[0]->id;

            //creation du compte
            $account_data = array(
                'username' => $username,
                'password' => $password,
                'type_compte' => 'finance',
                'utilisateur_id' => $utilisateur_id
            );
            
            $this->Crud->add_data('compte',$account_data);
         
            //===--Fin transition--===
			$this->db->trans_commit();

            $this->session->set_flashdata(['financier_saved'=>true]);
            redirect('compte/view_financier');
        }
    }
}
