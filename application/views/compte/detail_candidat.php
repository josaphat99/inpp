<style>
    th{
        text-align: center;
    }
</style>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b></b></h1>
    </header>
    <div class="card animated fadeIn">
        <div class="card-body">
            <header class="content__title">
                <div class="row">
                    <div class="col-md-6">
                        <p>Details du candidat : <?=$nom_complet?></b></p>
                    </div>
                </div>
            </header>
            <div class="table-responsive">
                <table id="data-table" class="table">
                    <tr>
                        <th><span class="alert alert-info">Type de candidat : <?=$type_candidat?></span></th>
                    </tr>                  
                    <tr>
                        <th>
                            <?php
                                if($lettre != '')
                                {
                            ?>
                                 <a href="<?=site_url('assets/files/lettre/'.$lettre)?>" target="_blanc">
                                    <button class="btn btn-outline-success btn-lg"><?=$btn_letter?></button>  
                                </a>
                            <?php
                                }else{
                            ?>
                                <span class="text-danger"><?=$btn_letter?> non disponible</span> 
                            <?php
                                }
                            ?>                            
                        </th>
                    </tr>
                    <tr>
                        <th>
                        <?php
                                if($identite != '')
                                {
                            ?>
                                <a href="<?=site_url('assets/files/identite/'.$identite)?>" target="_blanc">
                                    <button class="btn btn-outline-danger btn-lg"><?=$btn_identite?></button>  
                                </a>
                            <?php
                                }else{
                            ?>
                                <span class="text-danger"><?=$btn_identite?> non disponible</span> 
                            <?php
                                }
                            ?>                           
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </div>


    <div class="card animated fadeIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Formations suivies par <?=$genre == 'male'?'Monsieur':'Madame'?> <?=$nom_complet?></b></p>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default alert alert-info">
                        <tr class="text-white">
                            <th style="width: 20px;">No</th>
                            <th>Intitule</th>    
                            <th>Branche</th> 
                            <th>Duree</th>     
                            <th>Etat</th>  
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            if(count($formation) >= 1)
                            {
                                $num = 0;
                                foreach($formation as $f)
                                { $num++?> 
                                    <tr>
                                        <td style="text-align: center;width: 20px;"><?=$num?></td>
                                        <td style="text-align: center;"><?=$f->intitule?></td>  
                                        <td style="text-align: center;"><?=$f->branch?></td>   
                                        <td style="text-align: center;"><?=$f->duree?></td>          
                                        <td style="text-align: center;"><?=$f->etat?></td>
                                    </tr>
                        <?php
                                }
                            }else{
                        ?>
                            <p class="alert alert-light text-dark">Ce candidat n'a encore suivi aucune formation!</p>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
