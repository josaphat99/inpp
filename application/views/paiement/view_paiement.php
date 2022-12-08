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
                    <div class="col-md-4 offset-md-4">
                        <div class="form-group form-group--float">
                            <label style="margin-top:-15px">Filtrer par formations &nbsp;&nbsp; <i style="font-size:20px" class="zmdi zmdi-filter-list zmdi-hc-fw"></i></label>
                            <div class="select">
                                <select class="form-control" name="type_candidat" id="filtre" required>
                                    <option value="" id="type_candidat_empty"></option> 
                                    <?php
                                        foreach($formation as $f)
                                        {
                                    ?>
                                            <option value="<?=$f->id?>"><?=$f->intitule?></option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <i class="form-group__bar"></i>
                            </div>            
                            <i class="form-group__bar"></i>
                        </div>                   
                    </div>               
                </div>
            </header>
            
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr>
                            <th style="width: 20px;">No</th>
                            <th>Date</th>      
                            <th>Candidat</th>                        
                            <th>Formation</th>
                            <th>Montant</th>
                            <!-- <th style="width: 180px;">Actions</th> -->
                        </tr>
                    </thead>                    
                    <tbody id="payment_area">
                        <?php
                            $num = 0;
                            foreach($paiement as $p)
                            { 
                                $num++;
                            ?> 
                                <tr>
                                    <td style="text-align: center;"><?=$num?></td>
                                    <td style="text-align: center;"><?=$p->date?></td>  
                                    <td style="text-align: center;"><?=$p->candidat?></td>                
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

<script src=<?=base_url('assets/vendors/jquery/jquery.min.js')?>></script>

<script>
    $(function(){
        
        $("#filtre").change(function(e){
            e.preventDefault();

            var filter = $("#filtre").val();

            $.post('<?=site_url("ajax/filtre_formation")?>',{filtre:filter},function(data)
            {
                $("#payment_area").html(data);
                console.log(data);
            })
        })
    })
</script>