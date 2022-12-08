<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Effectuez votre Paiement</b></h1>
    </header>

    <div class="card animated fadeIn col-md-6 offset-md-3" id="add_agent">
        <div class="card-body">
            <header class="content__title">
                <p class="text-center"><b>Vous vous etes inscrit au cours de:</b></p>
            </header>  
            <div>
                <h2 class="text-center text-red"><?=$formation->intitule?></h2>
                <div class="col-md-12 offset-md-2">
                    <small><b>Duree</b> : <?=$formation->duree?></small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <small><b>Tarif</b> :  <?=$formation->tarif?> $</small>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <small><b>Branche</b> :  <?=$formation->branche?></small>
                </div>  
            </div>
        </div>
    </div>

    <div class="card animated fadeIn" id="add_agent">
        <div class="card-body">
            <header class="content__title">
                <h1><b>Paiement par carte de Credit <span><i class="zmdi zmdi-card zmdi-hc-fw"></i></span></b></h1>
            </header>            
            <form class="row" action="<?=site_url('payment/new_paiement')?>" method="post">
                <div class="col-md-6 offset-md-3">                     

                    <div class="form-group form-group--float">
                        <div class="input-group">                            
                            <input type="number" class="form-control" name="montant" id="montant" placeholder="Montant à payer" required>                                             
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>                               
                            </div>
                        </div>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">
                        <div class="input-group">                            
                            <input type="text" class="form-control" name="card" id="card" placeholder="Numero de la carte" required>                                             
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="zmdi zmdi-card zmdi-hc-fw"></i></span>                               
                            </div>
                        </div>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="row" style="margin-top:-30px">
                        <div class="col-md-6">
                            <div class="form-group form-group--float">                        
                                <input type="text" class="form-control" name="expiration" placeholder="00/00" required>
                                <label></label>
                                <i class="form-group__bar"></i>
                            </div>  
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-group--float">                        
                                <input type="text" class="form-control" name="cvv" placeholder="CVV" required>
                                <label></label>
                                <i class="form-group__bar"></i>
                            </div>  
                        </div>
                    </div>
                    <br>
                    <input type="hidden" value="<?=$formation->id?>" name="formation_id" hidden>
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p id="error_connexion" class="text-red animated fadeInUp" hidden>Veuillez remplir tous les champs svp!</p>
                            <button class="btn btn-outline-primary btn-lg" style="border-radius:5px;" id="submit" type="submit">Valider</button>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>