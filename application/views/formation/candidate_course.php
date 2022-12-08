<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->doc_upload_failed))
    {
?>
        <script>
            Swal.fire({            
            icon: 'warning',
            title: 'Vos fichier n\'ont pas été enregistrés!! veuillez ressayer de les fournir en cliquant sur ~Gerer mon profile~',
            showConfirmButton: true,
            timer: 30000
            })
        </script>
<?php
    } 
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Vos formations</b></h1>
    </header>

    <div class="card animated fadeIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-9">
                    <p><b>Voici la liste de toutes les formations auxquelles vous vous etes inscrit</b></p>
                </div>             
            </div>
        </header>

        <div class="table-responsive">
            <table id="data-table" class="table table-bordered table-hover">
                <thead class="thead-default">
                    <tr class="alert alert-info">
                        <th style="width: 20px;">No</th>
                        <th>Intitulé</th>                         
                        <th>Branche</th>
                        <th>Durée</th>
                        <th>Etat</th>
                    </tr>
                </thead>                    
                <tbody id="t-body">
                    <?php
                        $num = 0;
                        foreach($formation as $f)
                        {
                            ++$num;
                    ?>                                
                            <tr>
                                <td style="text-align: center;"><?=$num?></td>
                                <td style="text-align: center;"><?=$f->intitule?></td>                  
                                <td style="text-align: center;"><?=$f->branche?></td>
                                <td style="text-align: center;"><?=$f->duree?></td>      
                                <td style="text-align: center;"><?=$f->etat?></td>                                                  
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

