<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Nouvelle formation</b></h1>
    </header>

    <div class="card animated fadeIn">
        <div class="card-body">
            <header class="content__title">
                <h1><b>Enregistrer une nouvelle formation</b></h1>
            </header>            
            <form class="row" action="<?=site_url('formation/new_formation')?>" method="post">
                <div class="col-md-6 offset-md-3">
                    
                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="intitule" id="intitule" required>
                        <label>Intitule</label>
                        <i class="form-group__bar"></i>
                    </div> 

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="duree" id="duree" required>
                        <label>Durée</label>
                        <i class="form-group__bar"></i>
                    </div> 
                    
                    <div class="form-group form-group--float">
                        <div class="input-group">                            
                            <input type="number" class="form-control" name="tarif" id="tarif" placeholder="Tarif" required>                                             
                            <div class="input-group-append">
                                <span class="input-group-text">$</span>                               
                            </div>
                        </div>
                        <i class="form-group__bar"></i>
                    </div>
                    
                    <div class="form-group form-group--float">
                        <label style="margin-top:-9px">Branches</label>
                        <div class="select">
                            <select class="form-control" name="branche_id" id="branche" required>
                                <option value=""></option> 
                                <?php
                                    foreach($branche as $b)
                                    {
                                ?>
                                    <option value="<?=$b->id?>"><?=$b->nom?></option>
                                <?php
                                    }
                                ?> 
                            </select>
                            <i class="form-group__bar"></i>
                        </div>            
                        <i class="form-group__bar"></i>
                    </div>                                             
                    
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p id="error_connexion" class="text-red animated fadeInUp" hidden>Veuillez remplir tous les champs svp!</p>
                            <button class="btn btn-outline-primary btn-lg" style="border-radius:5px;" id="subtn" type="submit">Ajouter</button>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>