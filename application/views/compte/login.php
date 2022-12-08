<?php
    if(($this->session->account_created))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Compte creé avec succés',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<style>
    #subtn_login{
        padding : 15px 15px 15px 15px;
        border:0px;
        color: white;
    }
</style>

<section class="content">
    <div class="content__inner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5 offset-md-2">
                    <form action=<?=site_url("compte/login")?> method="post" id="form_login"> 

                        <div class="card animated zoomIn">        
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card animated zoomIn">
                                            <div class="card-body">
                                                <div class="col-md-6 col-sm-3 col-xs-3 offset-md-3 offset-sm-4">
                                                    <img src=<?=base_url("assets/demo/img/inpp.jpg")?> class="img-fluid" alt="" loading="lazy"/> 
                                                </div>   
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h1 class="card-title text-center">Veuillez vous authentifier</h1>             
                                <div class="row">                                
                                
                                    <!--Premiere colonne-->
                                    <div class="form-group form-group--float form-group--centered col-md-12">
                                        <input type="text" class="form-control" name="username" placeholder="Nom d'utilisateur" id ="username">
                                        <i class="form-group__bar"></i>
                                        <span class="animated fadeIn" style="color:red" id="username_error" hidden>
                                            Veuillez saisir votre nom d'utilisateur!!
                                        </span>  
                                    </div>

                                    <div class="form-group form-group--float form-group--centered col-md-12">
                                        <input type="password" class="form-control" name="password" placeholder="Mot de passe" id ="password">
                                        <i class="form-group__bar"></i>     

                                        <span class="animated fadeIn" style="color:red" id="password_error" hidden>
                                            Veuillez saisir votre mot de passe!!
                                        </span>                                   
                                    </div>
                                    
                                </div>
                               
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <p id="error_connexion" class="text-red animated fadeInUp" hidden>Please give all the informations needed!!</p>                                        
                                        <p style="color:red"><?=$this->session->error_login?></p>
                                        <button class="btn btn-success btn-lg" id="subtnlogin">Se connecter</button>
                                    </div>  
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script> 

<script>
    $(function()
    {
        $("#subtnlogin").click(function(e)
        {
            e.preventDefault();
            
            if($("#username").val() == ""|| $("#password").val() == "")
            {
                $("#error_connexion").removeAttr('hidden')
            }
            else
            {
                $("#form_login").submit();
            }           
        })

        $("#username").blur(function(e){
            if($("#username").val() == '')
            {
                $("#username_error").removeAttr('hidden');
            }else{
                $("#username_error").attr('hidden',true);
            }
        });

        $("#password").blur(function(e){
            if($("#password").val() == '')
            {
                $("#password_error").removeAttr('hidden');
            }else{
                $("#password_error").attr('hidden',true);
            }
        });
    })
</script>

