<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->candidat_saved))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Candidat ajouté',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
    if(($this->session->doc_upload_failed))
    {
?>
        <script>
            Swal.fire({            
            icon: 'warning',
            title: 'Les documents fournis n\'ont pas été enregistrés!!',
            showConfirmButton: true,
            timer: 30000
            })
        </script>
<?php
    }
    if(($this->session->compte_delted))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Candidat Supprimé',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Candidats</b></h1>
    </header>

    <div class="card animated fadeIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Liste des candidats inscripts aux formations</b></p>
                </div>
                <div class="col-md-3 offset-md-3">
                    <a href="<?=site_url('compte/new_candidate')?>" class="btn btn-secondary"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Nouveau Candidat</a>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default alert alert-info">
                        <tr class="text-white">
                            <th style="width: 20px;">No</th>
                            <th>Date d'inscription</th>    
                            <th>Nom complet</th> 
                            <th>Email</th>     
                            <th>Tel</th>                      
                            <th>Adresse</th>
                            <th>Genre</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($compte as $c)
                            { $num++?> 
                                <tr>
                                    <td style="text-align: center;width: 20px;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$c->created_at?></td>  
                                    <td style="text-align: center;"><?=$c->nom_complet?></td>   
                                    <td style="text-align: center;"><?=$c->email?></td>          
                                    <td style="text-align: center;"><?=$c->phone?></td>         
                                    <td style="text-align: center;"><?=$c->adresse?></td>
                                    <td style="text-align: center;"><?=$c->genre == 'male'? 'Homme':'Femme'?></td>
                                    <td>
                                        <a href="<?=site_url('compte/detail_candidat?candidat_compte_id='.$c->id.'&utilisateur_id='.$c->utilisateur_id)?>"><button class="btn btn-outline-success btn--raised"><i class="zmdi zmdi-eye zmdi-hc-fw"></i></button></a>
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?=site_url("compte/delete_compte")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$c->id?>" name="compte_id">
                                            <button id="delete" class="btn btn-outline-danger btn--raised" title="Supprimer">
                                                <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                            </button>
                                        </form>                                                                                 
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    var del = document.getElementById('delete');
    var form = document.getElementById('form-delete');

    del.addEventListener('click',function(e){
        e.preventDefault();
        form.click();
    }); 

    function confirmation(anchor)
    {
        Swal.fire({
        title: 'Voulez-vous vraiment supprimer ce Candidat?',
        text: "Vous ne serez plus capable de le recuperer!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Supprimer',
        cancelButtonText: 'Annuler',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Supprimé!',
                'Candidat supprimé.',
                'success'
                )
                anchor.submit();
            }
        })
    }  

    $(function()
    {
        // var sec = 0;
        // function pad ( val ) { return val > 9 ? val : "0" + val; }

        // setInterval( function(){
        //     // $("#seconds").html(10%3);
        //     var s = ++sec;
        //     $("#seconds").html(pad(s%60));
        //     $("#minutes").html(pad(parseInt(sec/60,10)));   
        //     if(s%60 == 5)
        //     {
        //         console.log("vous avez epuisé tout votre temps!!!");                
        //     }
        // }, 1000);
    })
</script>