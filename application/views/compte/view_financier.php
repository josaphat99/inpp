<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->agent_saved))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Agent ajouté',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
    if(($this->session->agent_deleted))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Agent Supprimé',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Financier</b></h1>
    </header>

    <div class="card animated zoomIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-6">
                    <p><b>Liste des financiers</b></p>
                </div>
                <div class="col-md-3 offset-md-3">
                    <a href="<?=site_url('compte/new_financier')?>" class="btn btn-secondary"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Nouveau financier</a>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Matricule</th>    
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
                                    <td style="text-align: center;"><?=$c->matricule?></td>  
                                    <td style="text-align: center;"><?=$c->nom_complet?></td>   
                                    <td style="text-align: center;"><?=$c->email?></td>          
                                    <td style="text-align: center;"><?=$c->phone?></td>         
                                    <td style="text-align: center;"><?=$c->adresse?></td>
                                    <td style="text-align: center;"><?=$c->genre == 'male'? 'Homme':'Femme'?></td>
                                    <td>
                                        <button class="btn btn-success btn--raised"><i class="zmdi zmdi-edit zmdi-hc-fw"></i></button>
                                        <form id="form-delete" onclick='javascript:confirmation($(this));return false;'action="<?=site_url("compte/delete_compte")?>" method="post" style="float:right;">                                
                                            <input type="hidden" value="<?=$c->id?>" name="agent_account_id">
                                            <button id="delete" class="btn btn-danger btn--raised" title="Delete">
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
        title: 'Do you realy want to delete this test?',
        text: "You won't be able to undo this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.value) {
                Swal.fire(
                'Deleted!',
                'Test deleted.',
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