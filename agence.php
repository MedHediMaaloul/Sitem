<?php
include 'Gestion/header.php'
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Agence</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">                  
            <button type="button" title="Ajouter agence"class="btn btn-success btn-xs" id="btn_openModelAddagence" ><i class="fa fa-plus-circle"></i></button>  
            <!-- Add agence Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_addAgence"  tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="insert-agence_form" autocomplete="off" class="form-horizontal form-material">
                    
                      <div class="form-group">
                        <label class="col-md-12 p-0">Nom de l'agence<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control" style="margin-bottom:8px" name="nom_agence" id="nom_agence" placeholder="nom"/>
                          <p style=" color: #D8000C;" class="error" for="nom_agence" id="nom_error"> </p>
                        </div>
                      </div>

                      <div id="fiche_1row"> 
                        <div class="form-group">
                          <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="email_agence" id="email_agence" placeholder="Email"/>
                            <p style=" color: #D8000C;" class="error" for="email_agence" id="email_error"> </p>
                          </div>
                        </div>  
                        <div class="form-group">
                          <label class="col-md-12 p-0"> Téléphone<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="numtel_agence" id="numtel_agence" placeholder="téléphone"/>
                            <p style=" color: #D8000C;" class="error" for="numtel_agence" id="numtel_error"> </p>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="modal-body">
                    <div style="float: right;">
                      <button class=" btn btn-success" id="btn_ajout_agence" name="btn_ajout_agence">Ajouter</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end add agence Model-->
            <!-- Model alert add agence succès -->
            <div class="modal fade" id="SuccessAddAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-echec-succes">
                    <div class="circlechecked">
                      <i class="fas fa-check"></i>
                    </div>
                    <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                      <center id="addAgence_success"></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Model alert add agence succès -->
              <!-- Model alert add agence echec -->
            <div class="modal fade" id="EchecAddAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-echec-succes">
                    <div class="circleerror">
                      <i class="fa fa-times"></i>
                    </div>
                    <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                      <center id="addAgence_echec"></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Model alert add agence echec --> 
            <!--  Model update agence -->
            <div class="modal fade bd-example-modal-lg" id="update_agence_modal"  tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="update-agence_form" autocomplete="off" class="form-horizontal form-material">
                      <div class="form-group">
                        <input type="hidden" id="idAgence">
                      </div>                                
                      <div class="form-group">
                        <label class="col-md-12 p-0">Non agence<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control" style="margin-bottom:8px" name="up_nom_agence" id="up_nom_agence" placeholder="nom"/>
                          <p style=" color: #D8000C;" class="error" for="up_nom_agence" id="up_nom_error"> </p>
                        </div>
                      </div>
                      <div id="fiche_1row">
                        <div class="form-group">
                          <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="up_email_agence" id="up_email_agence" placeholder="Email"/>
                            <p style=" color: #D8000C;" class="error" for="up_email_agence" id="up_email_error"> </p>
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-md-12 p-0">Téléphone<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="up_numtel_agence" id="up_numtel_agence" placeholder="Téléphone"/>
                            <p style=" color: #D8000C;" class="error" for="up_numtel_agence" id="up_numtel_error"> </p>
                          </div>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="modal-body">
                    <div style="float: right;">
                      <button class=" btn btn-success" id="btn_modifierAgence" name="btn_modifierAgence">modifier</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--  end Model update agence -->

            <!-- Model alert update agence succès -->
            <div class="modal fade" id="SuccessUpdateAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier agence</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateAgence_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update  succès -->
              
              <!-- Model alert update agence echec -->
              <div class="modal fade" id="EchecUpdateAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier agence</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                      <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateAgence_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update agence echec -->


              <!-- delete agence model -->
            <div class="modal fade" id="delete_agence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Voulez-vous supprimer cette agence ?</p>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class="btn btn-success" id="supprimer_agence">Supprimer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end delet agence modal -->


            <!-- Model alert delete agence succès -->
            <div class="modal fade" id="SuccessDeleteAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression Agence</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-echec-succes">
                    <div class="circlechecked">
                      <i class="fas fa-check"></i>
                    </div>
                    <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                      <center id="deleteAgence_success"></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Model alert delete agence succès -->

            <!-- Model alert delete agence echec -->
            <div class="modal fade" id="EchecDeleteAgence" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression agence</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteAgence_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete agence echec -->
            

        
        
              

            <hr>
            <div class="table-responsive-xxl" id="liste_agence"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
    include 'Gestion/footer.php'
  ?>