<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Ajouter un nouvel agent financier</b></h1>
    </header>

          
    <form class="row" action="<?=site_url('compte/new_financier')?>" method="post" enctype="multipart/form-data">
        <div class="col-md-8 offset-md-2">
            <div class="card animated fadeIn" id="add_candidat">
                <div class="card-body">
                    <header class="content__title">
                        <small><b>Le matricule, nom d'utilisateur et mot de passe de cet agent seront genérés et lui seront envoyés automatiquement par mail</b></small>
                    </header>  

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="nomcomplet" required>
                        <label>Nom complet</label>
                        <i class="form-group__bar"></i>
                    </div>    

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="adresse" required>
                        <label>Adresse</label>
                        <i class="form-group__bar"></i>
                    </div> 

                    <div class="form-group form-group--float">                        
                        <input type="email" class="form-control" name="email">
                        <label>Email</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" name="phone" required>
                        <label>Numero de telephone</label>
                        <i class="form-group__bar"></i>
                    </div>

                    <div class="form-group form-group--float">
                        <label style="margin-top:-9px">Sex</label>
                        <div class="select">
                            <select class="form-control" name="genre" id="genre" required>
                                <option value=""></option> 
                                <option value="male">M</option>   
                                <option value="female">F</option>   
                            </select>
                            <i class="form-group__bar"></i>
                        </div>            
                        <i class="form-group__bar"></i>
                    </div>    
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p id="error_message" class="text-red animated fadeInUp" hidden>Veuillez remplir tous le champs requis svp!!</p>
                            <button class="btn btn-primary btn-lg" style="border-radius:5px;" id="submit" type="submit">Ajouter</button>
                        </div>  
                    </div>             
                </div>
            </div>
        </div>
    </form>       
    
</section>

<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script> 

