<aside class="sidebar">
    <div class="scrollbar-inner">
        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src="<?=base_url('assets/demo/img/inpp.jpg')?>" alt="">
                <div>
                    <div class="user__name"><h4>I.N.P.P</h4></div>
                </div>
            </div>
        </div>
       
        <ul class="navigation">
            <?php
                if($this->session->type_compte == 'candidat'){
            ?>
                <li><a href="<?=site_url('formation/index')?>"><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i> Formations</a></li>
                <li><a href="<?=site_url('payment/index')?>"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Paiements</a></li> 
                <li><a href="<?=site_url('formation/candidate_course')?>"><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i> Mes cours</a></li> 
            <?php
                }elseif($this->session->type_compte == 'finance'){
            ?>
                <li><a href="<?=site_url('payment/view_paiement')?>"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Paiements</a></li> 
            <?php
                }elseif($this->session->type_compte == 'admin'){
            ?>
                <li><a href="<?=site_url('candidat/view_candidat')?>"><i class="zmdi zmdi-account zmdi-hc-fw"></i> Candidats</a></li> 
                <li><a href="<?=site_url('compte/view_financier')?>"><i class="zmdi zmdi-money-box zmdi-hc-fw"></i> Financier</a></li>
            <?php
                }else{
            ?>
                <li><a href="<?=site_url('formation/index')?>"><i class="zmdi zmdi-collection-bookmark zmdi-hc-fw"></i> Formations</a></li>

                <li><a href="<?=site_url('compte/new_candidate')?>"><i class="zmdi zmdi-account-add zmdi-hc-fw"></i> S'inscrire</a></li>

                <li><a href="<?=site_url('compte/login')?>"><i class="zmdi zmdi-account zmdi-hc-fw"></i> S'authentifier</a></li> 

            <?php
                }
            ?>          
        </ul>
    </div>
</aside>