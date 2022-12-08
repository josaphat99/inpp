<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	
	public function filtre_formation()
	{
        $this->load->model('Crud');

		$formation_id = $this->input->post('filtre');

        $payment = $this->Crud->get_data_desc('paiement',['formation_id'=>$formation_id]);

        foreach($payment  as $p)
        {
            $p->formation = $this->Crud->get_data('formation',['id'=>$p->formation_id])[0]->intitule;
            $p->candidat = $this->Crud->get_data('utilisateur',['id'=>$p->utilisateur_id])[0]->nom_complet;
        }

        $html = '';

        $num = 0;
        
        foreach($payment as $p)
        {
            $num++;

            $html .= '
                <tr>
                    <td style="text-align: center;">'.$num.'</td>
                    <td style="text-align: center;">'.$p->date.'</td>  
                    <td style="text-align: center;">'.$p->candidat.'</td>                
                    <td style="text-align: center;">'.$p->formation.'</td>
                    <td style="text-align: center;">'.$p->montant.' $</td>  
                </tr>
            ';
        }

        echo $html;
	}
}
