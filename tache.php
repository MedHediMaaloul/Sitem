<?php
include 'Gestion/header.php';
global $conn;
$id=$_GET['id_project'];
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4 fnt" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Projet
      <?php
      $query = "SELECT nom_projet FROM projet WHERE id_projet='$id'";
      $result = mysqli_query($conn, $query);
      while ($row = mysqli_fetch_assoc($result)) {
        $nomProject= $row['nom_projet'];
      }
      echo" $nomProject" ?></h3>
      <div class="row mt">
        
        <div class="col-md-12">
          <div class="content-panel">     
            <button type="button" title="Ajouter tâche" class="btn btn-success btn-xs" id="btn_openModel_addTache" ><i class="fa fa-plus-circle"></i></button>
                          
            <!-- Add tache Modal -->
              <div class="modal fade bd-example-modal-lg" id="modal_addTache" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout du tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="insert_tache_form" autocomplete="off" class="form-horizontal form-material">                
                           <div class="form-group">
                                <input type="hidden" name="id_Project" value="<?php echo $id; ?>">
                          </div>
                      
                          <div id="fiche_1row">                      
                            <div class="form-group">
                                <label class="col-md-12 p-0">Employées<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <select class="selectpicker form-control" id="employee_affect" name="employee_affect" style="margin-bottom:8px" >
                                        <option value="" disabled selected>Selectionner un employé</option>
                                        <?php
                                            $resultat = mysqli_query($conn,"SELECT * FROM user Where id_role='1' and etat_user='1' ORDER BY etat_user ASC");
                                            if ($resultat->num_rows > 0) {
                                                while ($row_employe = $resultat->fetch_assoc()) {
                                                  echo '<option value="' . $row_employe['id_user'] . '">' . $row_employe['nom_user'] . ' ' . $row_employe['prenom_user'] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select> 
                                    <p style=" color: #D8000C;" class="error" for="employee_affect" id="employee_affect_error"> </p>                      
                                </div>
                            </div>                          
                        
                        </div>                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Description<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <textarea class="form-control"  style="margin-bottom:8px"  name="description" id="description" placeholder="Description" rows="5" ></textarea>
                              <p style=" color: #D8000C;" class="error" for="description" id="description_error"> </p>
                            </div>
                          </div>
                                                                        
                        <div id="fiche_1row">
                            <div class="form-group">
                                <label class="col-md-12 p-0">Pièce jointe</label>
                                <div class="col-md-12 p-0">
                                    <input style=" width: 295px;" type="file" id="doc_tache" name="doc_tache" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de début<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="dateDebutTache" name="dateDebutTache">
                                    <p style=" color: #D8000C;" class="error" for="dateDebutTache" id="dateDebutTache_error"> </p>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de fin<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="dateFinTache" name="dateFinTache">
                                    <p style=" color: #D8000C;" class="error" for="dateFinTache" id="dateFinTache_error"> </p>
                                  </div>
                            </div>               
                        </div>                        
                        
                      </form>
                    </div>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class=" btn btn-success" id="btn_ajout_tache">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end add tache Model -->

              <!-- Model alert add tache succès -->
              <div class="modal fade" id="SuccessAddTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addTache_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add tache succès -->

              <!-- Model alert add tache echec -->
              <div class="modal fade" id="EchecAddTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="addTache_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add tache echec --> 

              <!-- delete tache model -->
              <div class="modal fade" id="delete_tache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous supprimer la tâche ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="supprimer_tache">Supprimer</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end delet tache modal -->

              <!-- Model alert delete tache succès -->
              <div class="modal fade" id="SuccessDeleteTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression du tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteTache_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete tache succès -->
              
              <!-- Model alert delete tache echec -->
              <div class="modal fade" id="EchecDeleteTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression du tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteTache_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete tache echec -->

              <!-- update etat tache model -->
              <div class="modal fade bd-example-modal-lg" id="update_etatTache"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier l'état du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="modal-body">
                        <form id="update_etatTache_form" autocomplete="off" class="form-horizontal form-material">
                          <div class="form-group mb-4">                            
                            <input type="hidden" id="up_id_tache_Etat">
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Etat du tâche<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <select id="up_etat_tache" name="up_etat_tache" class="form-control" required style="margin-bottom:8px">
                                <option value="Choisissez" selected disabled>Choisissez état</option>
                                <option value="1">En attente</option>
                                <option value="2">En cours</option>
                                <option value="3">Terminé</option>
                              </select>
                            </div>
                          </div>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button class="btn btn-success" id="btn_modifi_etat_tache">Modifier</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end update etat tache model -->
              
              <!-- Model alert update etat tache succès -->
              <div class="modal fade" id="SuccessUpdateEtatTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modification Etat du tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateEtatTache_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update etat tache succès -->
              
              <!-- Model alert update etat tache echec -->
              <div class="modal fade" id="EchecUpdateEtatTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modification Etat du tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateEtatTache_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update etat tache echec -->                    
              
              <!-- update tache Modal -->
              <div class="modal fade bd-example-modal-lg" id="update_tache_modal"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier la tâche</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="update_tache_form" autocomplete="off" class="form-horizontal form-material">
                          <div class="form-group">
                              <input type="hidden" id="idTache">
                          </div>
                         
                          <div id="fiche_1row">                      
                            <div class="form-group">
                                <label class="col-md-12 p-0">Employées<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <select class="selectpicker form-control" id="up_employee_affect" name="up_employee_affect" style="margin-bottom:8px" aria-label="select">
                                        <option value="" disabled>Selectionner un employé</option>
                                        <?php
                                            $resultat1 = mysqli_query($conn,"SELECT * FROM user Where id_role='1' and etat_user='1' ORDER BY etat_user ASC");  
                                            if ($resultat1->num_rows > 0) {
                                                while ($row1 = $resultat1->fetch_assoc()) {
                                                  echo '<option value="' . $row1['id_user'] . '">' . $row1['nom_user'] . ' ' . $row1['prenom_user'] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select> 
                                    <p style=" color: #D8000C;" class="error" for="up_employee_affect" id="up_employee_affect_error"> </p>                      
                                </div>
                            </div>                          
                        
                        </div>                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Description<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <textarea class="form-control"  style="margin-bottom:8px"  name="up_description" id="up_description" placeholder="Description" rows="5" ></textarea>
                              <p style=" color: #D8000C;" class="error" for="up_description" id="up_description_error"> </p>
                            </div>
                          </div>
                                                                        
                        <div id="fiche_1row">
                            <div class="form-group">
                                <label class="col-md-12 p-0">Pièce jointe</label>
                                <div class="col-md-12 p-0">
                                    <input style=" width: 295px;" type="file" id="up_doc_tache" name="up_doc_tache" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de début<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="up_dateDebutTache" name="up_dateDebutTache">
                                    <p style=" color: #D8000C;" class="error" for="up_dateDebutTache" id="up_dateDebutTache_error"> </p>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de fin<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="up_dateFinTache" name="up_dateFinTache">
                                    <p style=" color: #D8000C;" class="error" for="up_dateFinTache" id="up_dateFinTache_error"> </p>
                                  </div>
                            </div>               
                        </div> 
                            </form>                    
                          </div>
                          <div class="modal-body">
                            <div style="float: right;">
                              <button class=" btn btn-success" id="btn_updateTache">Modifier</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end update project Model -->

                    <!-- Model alert update project succès -->
                    <div class="modal fade" id="SuccessUpdateTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification du tâche</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-echec-succes">
                            <div class="circlechecked">
                              <i class="fas fa-check"></i>
                            </div>
                            <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                              <center id="UpdateTache_success"></center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end Model alert update project succès -->
                    
                    <!-- Model alert update tache echec -->
                    <div class="modal fade" id="EchecUpdateTache" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification du tâche</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-echec-succes">
                            <div class="circleerror">
                              <i class="fa fa-times"></i>
                            </div>
                            <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                              <center id="UpdateTache_echec"></center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end Model alert update tache echec -->
                    
                    <hr>                        
                    <div class="table-responsive-xxl" id="liste_tache">
                    <input type="hidden" name="id_Project" value="<?php echo $id; ?>">
                    
                    </div> 
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <?php
    include 'Gestion/footer.php'
    ?>
    
<script>

  //date
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear();
  if(dd<10){
    dd='0'+dd
  } 
  if(mm<10){
    mm='0'+mm
  } 
  
  today = yyyy+'-'+mm+'-'+dd;
  
  document.getElementById("up_dateDebutTache").setAttribute("min", today);
  document.getElementById("up_dateFinTache").setAttribute("min", today);

  document.getElementById("dateDebutTache").setAttribute("min", today);
  document.getElementById("dateFinTache").setAttribute("min", today);
  
</script>