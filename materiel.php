<?php
include 'Gestion/header.php'
?>
<style>
  #fiche_1row {
  grid-template-columns: repeat(2, auto) !important;
  gap:0px
  }
</style>
<div class="page-wrapper">
  <div class="page-content">
    <div class="row">
      <h3 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Materiels</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">
          <?php if($idRole!='2'){
           echo'    <button type="button" class="btn btn-success btn-xs" title="Insert Materiel" id="btn_InsertMateriel" ><i class="fa fa-plus-circle"></i></button>';
          }
          ?>
            <!-- Add materiel Modal -->
              <div class="modal fade bd-example-modal-lg" id="modal_addMateriel"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout Materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="insert_materiel_form" autocomplete="off" class="form-horizontal form-material">
                        <div id="fiche_1row">
                          <div class="form-group">
                            <label class="col-md-12 p-0">Nom materiel&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="text" class="form-control" style="margin-bottom:8px" name="nom_materiel" id="nom_materiel" >
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="nom_materiel" id="nom_materiel_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Prix (DT)&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="number" style="margin-bottom:8px" class="form-control" name="prix_materiel" id="prix_materiel" placeholder="40"/>
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="prix_materiel" id="prix_materiel_materiel"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Date achat&nbsp;<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="date"  style="margin-bottom:8px" class="form-control" id="date_acha_materiel" name="date_acha_materiel">
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="date_acha_materiel" id="date_acha_materiel_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Facture</label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input style=" width: 311px;" type="file" id="facture_materiel" name="facture_materiel" class="form-control">
                            </div>
                          </div>
                          </div>
                          <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Employée<span
                                                class="text-danger">*</span></label>
                                <?php
                                 $query = "SELECT * FROM user WHERE id_role!=0 AND id_role!=2 AND id_user!='$iduser'";
                                 $result = mysqli_query($conn, $query);
                                ?>
                             <div style="width: 310px;" class="col-md-12 p-0">
                              <select class="selectpicker form-control" id="liste_materiel_employee" name="liste_materiel_employee"  aria-label="select">
                                <option selected="selected" value="" disabled>Selectionner un employée</option>
                                <?php
                                    if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id_user'] . '">' . $row['prenom_user'] . ' ' . $row['nom_user'] . ' </option>';
                                    }
                                    }
                                ?>
                              </select>
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="liste_materiel_employee" id="liste_materiel_employee_error"> </p>

                             </div>
                                    </div>
                      </form>
                    </div>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class=" btn btn-success" id="btn_ajout_materiel" name="btn_ajout_materiel">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end add materiel Model -->

              <!-- Model alert add materiel succès -->
              <div class="modal fade" id="SuccessAddMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addMateriel_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add materiel succès -->

              <!-- Model alert add materiel echec -->
              <div class="modal fade" id="EchecAddMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addMateriel_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add materiel echec -->

                <!-- delete materiel model -->
                <div class="modal fade" id="delete_materiel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous supprimer le materiel ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="supprimer_materiel">Supprimer</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end delet materiel modal -->

              <!-- Model alert delete materiel succès -->
              <div class="modal fade" id="SuccessDeleteMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Supprimer materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteMateriel_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete materiel succès -->

              <!-- Model alert delete materiel echec -->
              <div class="modal fade" id="EchecDeleteMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Supprimer materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteMateriel_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete materiel echec -->

              <!-- update materiel Modal -->
              <div class="modal fade bd-example-modal-lg" id="modal_updateMateriel"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="update_materiel_form" autocomplete="off" class="form-horizontal form-material">
                        <div hidden>
                              <input type="text" id="up_idMateriel" class="form-control">
                        </div>
                        <div id="fiche_1row">
                          <div class="form-group">
                            <label class="col-md-12 p-0">Nom materiel&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="text" class="form-control" style="margin-bottom:8px" name="up_nom_materiel" id="up_nom_materiel" >
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="up_nom_materiel" id="up_nom_materiel_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Prix (DT)&nbsp;<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="number" style="margin-bottom:8px" class="form-control" name="up_prix_materiel" id="up_prix_materiel" placeholder="40"/>
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="up_prix_materiel" id="up_prix_materiel_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Date achat&nbsp;<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input type="date"  style="margin-bottom:8px" class="form-control" id="up_date_acha_materiel" name="up_date_acha_materiel">
                              <p style=" color: #D8000C;" class="error msgError mt-2" for="up_date_acha_materiel" id="up_date_acha_materiel_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Facture</label>
                            <div class="col-md-12 p-0" style="width:310px">
                              <input style=" width: 311px;" type="file" id="up_facture_materiel" name="up_facture_materiel" class="form-control">
                            </div>
                          </div>
                          </div>
                          <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Employée<span
                                                class="text-danger">*</span></label>
                                <?php
$query = "SELECT * FROM user";
$result = mysqli_query($conn, $query);
?>
                                        <div style="width: 310px;" class="col-md-12 p-0" >
                                        <select class="selectpicker form-control" id="up_liste_materiel_employee" name="up_liste_materiel_employee"  aria-label="select" >
                                <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . $row['id_user'] . '">' . $row['prenom_user'] . ' ' . $row['nom_user'] . ' </option>';
    }
}
?>
                                        </select>
                                        </div>
                                        <p style=" color: #D8000C;" class="error msgError mt-2" for="up_liste_materiel_employee" id="up_liste_materiel_employee_error"> </p>
                                    </div>
                      </form>
                    </div>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class=" btn btn-success" id="btn_up_materiel" name="btn_up_materiel">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end update materiel Model -->

              <!-- Model alert update materiel succès -->
              <div class="modal fade" id="SuccessUpdateMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateMateriel_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update materiel succès -->

              <!-- Model alert update materiel echec -->
              <div class="modal fade" id="EchecUpdateMateriel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Materiel</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                      <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateMateriel_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update materiel echec -->

              <hr>
              <div class="table-responsive-xxl" id="liste_materiel"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
include 'Gestion/footer.php'
?>