<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Contacter un candidat</b></h1>
    </header>

    <div class="card animated fadeIn" id="add_agent">
        <div class="card-body">
            <header class="content__title">
                <h1></h1>
            </header>            
            <form class="row" action="<?=site_url('don/new_don')?>" method="post">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="nomcomplet" required>
                        <label>Adresse email du candidat</label>
                        <i class="form-group__bar"></i>
                    </div> 

                    <div class="form-group">
                        <textarea style="border: 1px solid cyan;" class="form-control" placeholder="Message..." rows="7"></textarea>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p id="error_connexion" class="text-red animated fadeInUp" hidden>Veuillez remplir tous les champs svp!</p>
                            <button class="btn btn-outline-primary btn-lg" style="border-radius:5px;" id="submit" type="submit">Envoyer</button>
                        </div>  
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>