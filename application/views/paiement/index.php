<style>
    th{
        text-align: center;
    }
</style>

<?php
    if(($this->session->paiement_saved))
    {
?>
        <script>
            Swal.fire({            
            icon: 'success',
            title: 'Paiement effetuée avec succès!',
            showConfirmButton: false,
            timer: 3000
            })
        </script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Paiements</b></h1>
    </header>

    <div class="card animated fadeIn">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-6">
                    <h6><b></b></h6>
                </div>
                <div class="col-md-3 offset-md-3">
                    <a href="<?=site_url('formation/index')?>" class="btn btn-secondary"><i class="zmdi zmdi-plus zmdi-hc-fw"></i> Nouveau paiement</a>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Date</th>                         
                            <th>Formation</th>
                            <th>Montant</th>
                            <!-- <th style="width: 180px;">Actions</th> -->
                        </tr>
                    </thead>                    
                    <tbody id="t-body">
                        <?php
                            $num = 0;
                            foreach($paiement as $p)
                            { 
                                $num++;
                            ?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$p->date?></td>                  
                                    <td style="text-align: center;"><?=$p->formation?></td>
                                    <td style="text-align: center;"><?=$p->montant?> $</td>                                  
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