<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->transfusion_saved))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Transfusion ajouté',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
    if(($this->session->transfusion_deleted))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Transfusion Supprimé',
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

    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-6">
                    <h6><b>Liste de candidats inscrits</b></h6>
                </div>
                <!-- <div class="col-md-3 offset-md-3">
                    <a href="<site_url('transfusion/new_transfusion')?>" class="btn btn-secondary"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Nouvelle transfusion</a>
                </div> -->
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered table-hover">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Nom complet</th>                         
                            <th>Email</th>
                            <th>Sex</th>
                            <th>Type de candidat</th>
                            <th style="width: 180px;">Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <tr>
                            <td style="text-align: center;">1</td>
                            <td style="text-align: center;">Kavund Lungu John</td>                  
                            <td style="text-align: center;">lungu@gmail.com</td>
                            <td style="text-align: center;">M</td>
                            <td style="text-align: center;">Personel d'entreprise</td>
                            <td class="text-center">
                            <button class="btn btn-success btn--raised"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                            <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?=site_url("person/delete_benef")?>" method="post" style="float:right;">                                
                                <input type="hidden" value="" name="benef_id">
                                <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                    <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                </button>
                            </form>                                                                                                             
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">2</td>
                            <td style="text-align: center;">Kazadi Patrick</td>                  
                            <td style="text-align: center;">lungu@gmail.com</td>
                            <td style="text-align: center;">M</td>
                            <td style="text-align: center;">Particulier</td>
                            <td class="text-center">
                            <button class="btn btn-success btn--raised"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                            <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?=site_url("person/delete_benef")?>" method="post" style="float:right;">                                
                                <input type="hidden" value="" name="benef_id">
                                <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                    <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                </button>
                            </form>                                                                                                             
                            </td>
                        </tr>
                        <tr>
                            <td style="text-align: center;">3</td>
                            <td style="text-align: center;">Marie paul Lwamba</td>                  
                            <td style="text-align: center;">marie@gmail.com</td>
                            <td style="text-align: center;">F</td>
                            <td style="text-align: center;">Etudiante stagiaire</td>
                            <td class="text-center">
                            <button class="btn btn-success btn--raised"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                            <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?=site_url("person/delete_benef")?>" method="post" style="float:right;">                                
                                <input type="hidden" value="" name="benef_id">
                                <button id="delete" class="btn btn-danger btn--raised" title="Delete">
                                    <i class="zmdi zmdi-delete zmdi-hc-fw"></i>
                                </button>
                            </form>                                                                                                             
                            </td>
                        </tr>
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
        title: 'Voulez-vous vraiment supprimer cette transfusion?',
        text: "Vous serez plus capable d'annuler cette action!",
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
                'Transfusion supprimé.',
                'success'
                )
                anchor.submit();
            }
        })
    }
</script>