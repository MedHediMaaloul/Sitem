<?php
include 'Gestion/header.php'
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Clients</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">                  
            <button type="button" title="Ajouter client"class="btn btn-success btn-xs" id="btn_openModelAddclient" ><i class="fa fa-plus-circle"></i></button>  
            <!-- Add client Modal -->
            <div class="modal fade bd-example-modal-lg" id="modal_addclient"  tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ajout Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="insert-client_form" autocomplete="off" class="form-horizontal form-material">
                    
                      <div class="form-group">
                        <label class="col-md-12 p-0">Nom de l'entreprise<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control" style="margin-bottom:8px" name="nom_entreprise_client" id="nom_entreprise_client" placeholder="Nom"/>
                          <p style=" color: #D8000C;" class="error" for="nom_entreprise_client" id="nom_error"> </p>
                        </div>
                      </div>

                      <div id="fiche_1row"> 
                        <div class="form-group">
                          <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="email_client" id="email_client" placeholder="Email"/>
                            <p style=" color: #D8000C;" class="error" for="email_client" id="email_error"> </p>
                          </div>
                        </div>

                        <div class="form-group">
                          <label class="col-md-12 p-0">Addresse<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="addresse_client" id="addresse_client" placeholder="Addresse"/>
                            <p style=" color: #D8000C;" class="error" for="addresse_client" id="addresse_client_error"> </p>
                          </div>
                        </div>
                          
                        <div class="form-group">
                          <label class="col-md-12 p-0"> Téléphone<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="numtel_client" id="numtel_client" placeholder="Téléphone"/>
                            <p style=" color: #D8000C;" class="error" for="numtel_client" id="numtel_error"> </p>
                          </div>
                        </div>
                      </div>
                          
                      <div class="form-group">
                        <label class="col-md-12 p-0">Commentaire</label>
                        <div class="col-md-12 p-0">
                          <textarea style="margin-bottom:8px" class="form-control" name="commentaire_client" id="commentaire_client" placeholder="commentaire" rows="5"></textarea>
                          <p style=" color: #D8000C;" class="error" for="commentaire_client" id="commentaire_client_error"> </p>
                        </div>
                      </div>
                    </form>
                  </div>

                  <div class="modal-body">
                    <div style="float: right;">
                      <button class=" btn btn-success" id="btn_ajout_client" name="btn_ajout_client">Ajouter</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end add client Model-->

            <!-- Model alert add client succès -->
            <div class="modal fade" id="SuccessAddclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout Client</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addclient_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add client succès -->

              <!-- Model alert add client echec -->
              <div class="modal fade" id="EchecAddclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout client</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addclient_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add client echec --> 
            <!-- delete client model -->
            <div class="modal fade" id="delete_client" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <p>Voulez-vous supprimer ce client ?</p>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class="btn btn-success" id="supprimer_client">Supprimer</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end delet client modal -->


            <!-- Model alert delete client succès -->
            <div class="modal fade" id="SuccessDeleteclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Suppression client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-echec-succes">
                    <div class="circlechecked">
                      <i class="fas fa-check"></i>
                    </div>
                    <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                      <center id="deleteclient_success"></center>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- end Model alert delete client succès -->

            <!-- Model alert delete client echec -->
            <div class="modal fade" id="EchecDeleteclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression client</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteclient_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete client echec -->
            <!--  Model update client -->
            <div class="modal fade bd-example-modal-lg" id="update_client_modal"  tabindex="-1" role="dialog"
              aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-lg">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modifier Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                      <form id="update-client_form" autocomplete="off" class="form-horizontal form-material">
                        <div class="form-group">
                          <input type="hidden" id="idclient">
                        </div>                                
                      <div class="form-group">
                        <label class="col-md-12 p-0">Nom de l'entreprise<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" class="form-control" style="margin-bottom:8px" name="up_nom_entreprise_client" id="up_nom_entreprise_client" placeholder="nom"/>
                          <p style=" color: #D8000C;" class="error" for="up_nom_entreprise_client" id="up_nom_error"> </p>
                        </div>
                      </div>
                      <div id="fiche_1row">
                       <div class="form-group">
                        <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" style="margin-bottom:8px" class="form-control" name="up_email_client" id="up_email_client" placeholder="Email"/>
                          <p style=" color: #D8000C;" class="error" for="up_email_client" id="up_email_error"> </p>
                        </div>
                       </div>
                       <div class="form-group">
                        <label class="col-md-12 p-0">Addresse<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" style="margin-bottom:8px" class="form-control" name="up_addresse_client" id="up_addresse_client" placeholder="Addresse"/>
                          <p style=" color: #D8000C;" class="error" for="addresse_client" id="up_addresse_client_error"> </p>
                        </div>
                       </div>
                       <div class="form-group">
                        <label class="col-md-12 p-0">Téléphone<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <input type="text" style="margin-bottom:8px" class="form-control" name="up_numtel_client" id="up_numtel_client" placeholder="Téléphone"/>
                          <p style=" color: #D8000C;" class="error" for="up_numtel_client" id="up_numtel_error"> </p>
                        </div>
                       </div>
                      </div>


                      <div class="form-group">
                        <label class="col-md-12 p-0">Commentaire</label>
                        <div class="col-md-12 p-0">
                          <textarea style="margin-bottom:8px" class="form-control" name="up_commentaire_client" id="up_commentaire_client" placeholder="Commentaire" rows="5"></textarea>
                          <p style=" color: #D8000C;" class="error" for="up_commentaire_client" id="up_commentaire_client_error"> </p>
                        </div>
                      </div>

                    </form>
                  </div>
                  <div class="modal-body">
                    <div style="float: right;">
                      <button class=" btn btn-success" id="btn_update_client" name="btn_modifier_client">modifier</button>
                      <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- Model alert update client succès -->
            <div class="modal fade" id="SuccessUpdateclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier client</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="Updateclient_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update client succès -->
              
              <!-- Model alert update client echec -->
              <div class="modal fade" id="EchecUpdateclient" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Client</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                      <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="Updateclient_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update client echec -->

            <hr>
            <div class="table-responsive-xxl" id="liste_client"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
    include 'Gestion/footer.php'
  ?>
