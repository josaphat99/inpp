<section class="content">
    <header class="content__title">
        <?php
            if($this->session->type_compte == 'admin')
            {
        ?>
                <h1 class="animated"><b>Inscrivez un nouveau candidat</b></h1>
                <small>Rassurez-vous d'avoir tous les documents requis pour cette operation</small>
        <?php
            }else{
        ?>
            <h1 class="animated"><b>Devenez candidat de l'INPP</b></h1>
        <?php
            }
        ?>
        
    </header>

          
    <form class="row" action="<?=site_url('compte/new_candidate')?>" method="post" enctype="multipart/form-data">
        <div class="col-md-6">
            <div class="card animated fadeIn" id="add_candidat">
                <div class="card-body">
                    <header class="content__title">
                        <p><b>Veuillez fournir les informations suivantes: </b></p>
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
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card animated fadeIn" id="add_candidat">
                <div class="card-body">
                    <header class="content__title">
                        <p><b></b></p>
                    </header>  
                    <div class="form-group form-group--float">
                        <label style="margin-top:-15px">Je suis un(e)</label>
                        <div class="select">
                            <select class="form-control" name="type_candidat" id="type_candidat" required>
                                <option value="" id="type_candidat_empty"></option> 
                                <option value="eleve">Elève d'une ecole de la place</option>   
                                <option value="etudiant">Etudiant(e) stagiaire d'une institution de la place</option>   
                                <option value="personel">Personel d'entreprise</option>   
                                <option value="particulier">Particulier</option>   
                            </select>
                            <i class="form-group__bar"></i>
                        </div>            
                        <i class="form-group__bar"></i>
                    </div> 
                                      
                    <!--docs-->
                    <h3 class="card-body__title"></h3>
                    <div class="form-group form-group--float upload-btn" hidden>
                        <input type="file" class="form-control" name="lettre" id="doc_lettre" hidden>
                        <button class="btn btn-success animated fadeIn" id="doc_btn">Lettre de demande de renforcement</button>
                        <span id="doc_file_chosen">Aucun fichier selectionné</span>
                        <span style="color:red">*</span>                             
                        <i class="form-group__bar"></i>
                    </div>
                    <p><span id="doc_Span"></span></p> 

                    <h3 class="card-body__title"></h3>
                    <div class="form-group form-group--float upload-btn" hidden>
                        <input type="file" class="form-control" name="identite" id="doc_identite" hidden>
                        <button class="btn btn-success animated fadeIn" id="doc_id_btn">Carte de service</button>
                        <span id="doc_file_chosen_id">Aucun fichier selectionné</span>
                        <span style="color:red">*</span>                             
                        <i class="form-group__bar"></i>
                    </div>
                    <p><span id="doc_Span"></span></p> 

                    <?php
                        if(!$this->session->type_compte == 'admini'){
                    ?>
                             <div class="form-group form-group--float">                        
                                <input type="text" class="form-control" name="username" required>
                                <label>Nom d'utilisateur</label>
                                <i class="form-group__bar"></i>
                            </div>

                            <div class="form-group form-group--float">                        
                                <input type="password" class="form-control" name="password" required>
                                <label>Mot de passe</label>
                                <i class="form-group__bar"></i>
                            </div> 
                    <?php
                        }
                    ?>
                   

                    <div class="row">
                        <div class="col-md-12 text-center">
                            <p id="error_message" class="text-red animated fadeInUp" hidden>Veuillez remplir tous le champs requis svp!!</p>
                            <button class="btn btn-outline-primary btn-lg" style="border-radius:5px;" id="submit" type="submit">S'inscrire</button>
                        </div>  
                    </div>
                </div>
            </div>
        </div>
    </form>       
    
</section>

<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script> 

<script>
      //letter upload
    $("#doc_btn").click(function(e)
    {
        e.preventDefault();

        $("#doc_lettre").click();
    })

    $("#doc_lettre").change(function(e)
    {
        e.preventDefault();

        $("#doc_file_chosen").html($("#doc_lettre").val());
    })

    //identity upload
    $("#doc_id_btn").click(function(e)
    {
        e.preventDefault();

        $("#doc_identite").click();
    })

    $("#doc_identite").change(function(e)
    {
        e.preventDefault();

        $("#doc_file_chosen_id").html($("#doc_identite").val());
    })


    //control doc to upload
    $("#type_candidat").change(function(e)
    {
        e.preventDefault();

        if($("#type_candidat").val() == 'eleve' || $("#type_candidat").val() == 'etudiant')
        {
            $("#doc_btn").html("Lettre de recommandation");
            $("#doc_id_btn").html("Carte d’identité");
        }else if($("#type_candidat").val() == 'particulier')
        {
            $("#doc_btn").html("Lettre de demande d’inscription");
            $("#doc_id_btn").html("Carte d’identité");
        }else{
            $("#doc_btn").html("Lettre de demande de renforcement");
            $("#doc_id_btn").html("Carte de service");
        }

        $("#doc_btn").removeAttr('hidden');
        $("#doc_id_btn").removeAttr('hidden');

        $(".upload-btn").removeAttr('hidden');
    })

    //display upload buttons
    $("#type_candidat").click(function(e)
    {
        $("#type_candidat_empty").attr('disabled',true);
    })
</script>