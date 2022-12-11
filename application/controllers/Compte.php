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
                $genre = $this->Crud->get_data('utilisateur',['id'=>$res[0]->utilisateur_id])[0]->genre;

                //creation de la session
                $session = [
                    "id"=>$res[0]->id,                    
                    "username"=>$res[0]->username,
                    "nomcomplet"=>$nom_complet,
                    "type_compte"=>$res[0]->type_compte,
                    "email"=>$email,
                    "genre"=>$genre,
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
                    redirect('compte/view_candidat'); 
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

            $name =  $this->input->post('nomcomplet');

            if($this->session->type_compte == 'admin')
            {
                $name_split = explode(' ',$name);
                $username = strtolower('@'.$name_split[0]);
                $password = $username.'2022';
            }else{
                $username = strtolower($this->input->post('username'));
                $password = $this->input->post('password');
            }           

            $utilisateur_data = array(
                'nom_complet' => $name,
                'adresse' => $this->input->post('adresse'),
                'phone' => $this->input->post('phone'),
                'email' => $this->input->post('email'),
                'genre' => $this->input->post('genre'),
                'type_candidat' => $this->input->post('type_candidat'),
                'created_at' => date('d-m-Y',time()),
            );
            
            //insertion de la personne
            $this->Crud->add_data('utilisateur',$utilisateur_data);

            //recuperation de son id
            $utilisateur_id = $this->Crud->get_data_desc('utilisateur')[0]->id;

            //creation du compte
            $account_data = array(
                'username' => $username,
                'password' => $password,
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

            if($this->session->type_compte == 'admin')
            {
                redirect('compte/view_candidat');
            }else{
                redirect('formation/index');
            }
            
        }
    }
   
    public function delete_compte()
    {       
        $compte_id = $this->input->post('compte_id');
        $compte = $this->Crud->get_data('compte',['id'=>$compte_id])[0];
        $utilisateur_id = $compte->utilisateur_id;
        $type = $this->Crud->get_data('compte',['id'=>$compte_id])[0]->type_compte;

        if($type == 'finance')
        {
            $this->Crud->delete_data('compte',['id'=> $compte_id]);
            $this->Crud->delete_data('utilisateur',['id'=> $utilisateur_id]);        

            $this->session->set_flashdata(['compte_deleted'=>true]);

            redirect('compte/view_financier');
        }else{
            $this->Crud->delete_data('document',['utilisateur_id'=> $utilisateur_id]);
            $this->Crud->delete_data('paiement',['utilisateur_id'=> $utilisateur_id]);
            $this->Crud->delete_data('detail_formation',['utilisateur_id'=> $utilisateur_id]);
            $this->Crud->delete_data('compte',['id'=> $compte_id]);
            $this->Crud->delete_data('utilisateur',['id'=> $utilisateur_id]);        

            $this->session->set_flashdata(['compte_deleted'=>true]);
            redirect('compte/view_candidat');
        } 
        
        

              
    }

    public function logout(){
        $this->session->sess_destroy();
		redirect("compte");
    }

  
    /**
     * Operation de l'admin sur les financiers
     * Visualiser les financiers
     * Ajouter des nouveaux financiers
     */

    public function view_financier()
    {
        if(!$this->session->connected)
		{
			redirect('compte');
		}

        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');

        $compte = $this->Crud->join_compte_user('finance');

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

            if(count($name_split) > 1)
            {
                $matricule = $dt.$name_split[0][0].$name_split[1][0].rand(100,500);
            }else{
                $matricule = $dt.$name_split[0][0].$name_split[0][0].rand(100,500);
            }
            

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

    /**
     * Management des candidats
     */

     public function view_candidat()
     {
        if(!$this->session->connected)
		{
			redirect('compte');
		}

        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');

        $compte = $this->Crud->join_compte_user('candidat');

        $d['compte'] = $compte;

        $this->load->view('compte/view_candidat',$d);
        $this->load->view('layout/admin/js');
     }

     public function detail_candidat()
     {
        if(!$this->session->connected)
		{
			redirect('compte');
		}

        $this->load->view('layout/admin/sidebar');
        $this->load->view('layout/admin/topbar');

        $utilisateur_id = $this->input->get('utilisateur_id');
        $utilisateur = $this->Crud->get_data('utilisateur',['id'=>$utilisateur_id])[0];

        $nom_complet = $utilisateur->nom_complet;
        $type_candidat = $utilisateur->type_candidat;
        $lettre = $this->Crud->get_data('document',['utilisateur_id'=>$utilisateur_id,'type'=>'lettre']);
        $identite = $this->Crud->get_data('document',['utilisateur_id'=>$utilisateur_id,'type'=>'identite']);     
        
        if(count($lettre) >= 1)
        {
            $lettre = $this->Crud->get_data('document',['utilisateur_id'=>$utilisateur_id,'type'=>'lettre'])[0]->nom_fichier;
        }else{$lettre = '';}
        if(count($identite) >= 1)
        {
          $identite = $this->Crud->get_data('document',['utilisateur_id'=>$utilisateur_id,'type'=>'identite'])[0]->nom_fichier;    
        }else{$identite = '';}
        
        $formation = $this->Crud->get_data('detail_formation',['utilisateur_id'=>$utilisateur_id]);

        foreach($formation as $f)
        {
            $f->intitule = $this->Crud->get_data('formation',['id'=>$f->formation_id])[0]->intitule;
            $f->duree = $this->Crud->get_data('formation',['id'=>$f->formation_id])[0]->duree;
            $branch_id = $this->Crud->get_data('formation',['id'=>$f->formation_id])[0]->branche_id;
            $f->branch = $this->Crud->get_data('branche',['id'=>$branch_id])[0]->nom;
            $f->etat = $f->etat == 'ongoing'? 'En cours' : 'Terminée';
        }

        $btn_letter = '';
        $btn_identite = '';

        if($type_candidat == 'eleve')
        {
            $type_candidat = "Elève d'une ecole de la place";
            $btn_letter = 'Lettre de recommandation';
            $btn_identite = 'Carte d’identité';
        }elseif($type_candidat == 'etudiant'){
            $type_candidat = "Etudiant(e) stagiaire d'une institution de la place";
            $btn_letter = 'Lettre de recommandation';
            $btn_identite = 'Carte d’identité';
        }elseif($type_candidat == 'personel'){
            $type_candidat = "Personel d'entreprise";
            $btn_letter = 'Lettre de demande de renforcement';
            $btn_identite = 'Carte de service';
        }else{
            $type_candidat = "Particulier";
            $btn_letter = 'Lettre de demande d’inscription';
            $btn_identite = 'Carte d’identité';
        }

        $d = [
            'nom_complet' => $nom_complet,
            'type_candidat' => $type_candidat,
            'lettre' => $lettre,
            'identite' => $identite,
            'formation' => $formation,
            'btn_letter' => $btn_letter,
            'btn_identite' => $btn_identite,
            'genre' => $utilisateur->genre
        ];

        $this->load->view('compte/detail_candidat',$d);
        $this->load->view('layout/admin/js');
     }
}
