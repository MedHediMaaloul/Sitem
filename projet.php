<?php
include 'Gestion/header.php'
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4 fnt" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Projet</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">       
      
            <?php 
              if($_SESSION['Role']!="1"){
              echo '<button type="button" title="Ajouter projet" class="btn btn-success btn-xs" id="btn_openModel_addProject" ><i class="fa fa-plus-circle"></i></button>';
              }
            ?>          
              
            <!-- Add Project Modal -->
              <div class="modal fade bd-example-modal-lg" id="modal_addProject"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="insert_projet_form" autocomplete="off" class="form-horizontal form-material">                
                       
                          <div id="fiche_1row">
                            <div class="form-group">
                                <label class="col-md-12 p-0">Nom du projet<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="text" class="form-control" style="margin-bottom:8px" name="nom_projet" id="nom_projet" placeholder="Nom"/>
                                    <p style=" color: #D8000C;" class="error" for="nom_projet" id="nom_projet_error"> </p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Client<span
                                class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                  <select class="selectpicker form-control" id="client" name="client" style="margin-bottom:8px" >
                                    <option value="" disabled selected>Selectionner un client</option>
                                    <?php
                                        global $conn;
                                        $resultat = mysqli_query($conn,"SELECT * FROM client");  
                                        if ($resultat->num_rows > 0) {
                                            while ($row = $resultat->fetch_assoc()) {
                                              echo '<option value="' . $row['id_client'] . '">' . $row['nom_client_projet'] . '</option>';
                                            }
                                        }
                                    ?>
                                  </select> 
                                  <p style=" color: #D8000C;" class="error" for="client" id="client_error"> </p>                
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Chef de projet<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <select class="selectpicker form-control" id="chef_projet" name="chef_projet" style="margin-bottom:8px">
                                        <option value="" disabled selected>Selectionner chef de projet</option>
                                        <?php
                                            global $conn;
                                            $resultat = mysqli_query($conn,"SELECT * FROM user Where id_role='1'");  
                                            if ($resultat->num_rows > 0) {
                                                while ($row = $resultat->fetch_assoc()) {
                                                  echo '<option value="' . $row['id_user'] . '">' . $row['nom_user'] . ' ' . $row['prenom_user'] . '</option>';
                                                }
                                            }
                                        ?>
                                    </select> 
                                    <p style=" color: #D8000C;" class="error" for="chef_projet" id="chef_projet_error"> </p>                      
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
                                    <input style=" width: 295px;" type="file" id="doc_projet" name="doc_projet" class="form-control">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de début<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="dateDebutprojet" name="dateDebutprojet">
                                    <p style=" color: #D8000C;" class="error" for="dateDebutprojet" id="dateDebutprojet_error"> </p>
                                  </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-12 p-0">Date de fin<span class="text-danger">*</span></label>
                                <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="dateFinprojet" name="dateFinprojet">
                                    <p style=" color: #D8000C;" class="error" for="dateFinprojet" id="dateFinprojet_error"> </p>
                                  </div>
                            </div>               
                        </div>                        
                        
                        <div id="fiche_1row">
                            <div class="form-group">
                                <label >Confirmation du projet</label>
                                <input type="checkbox" name="confirmationProjet" id="confirmationProjet" checked />
                            </div>
                        </div>

                      </form>
                    </div>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class=" btn btn-success" id="btn_ajout_project" name="btn_ajout_project">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end add Project Model -->

              <!-- Model alert add Project succès -->
              <div class="modal fade" id="SuccessAddProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <center id="addProject_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add Project succès -->

              <!-- Model alert add Project echec -->
              <div class="modal fade" id="EchecAddProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <center id="addProject_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add Project echec --> 

              <!-- delete project model -->
              <div class="modal fade" id="delete_project" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous supprimer le projet ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="supprimer_projet">Supprimer</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end delet project modal -->

              <!-- Model alert delete project succès -->
              <div class="modal fade" id="SuccessDeleteProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteProject_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete project succès -->
              
              <!-- Model alert delete project echec -->
              <div class="modal fade" id="EchecDeleteProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteProject_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete project echec -->

              <!-- update etat projet model -->
              <div class="modal fade bd-example-modal-lg" id="update_etat_projet"  tabindex="-1" role="dialog"
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
                        <form id="update_etat_form" autocomplete="off" class="form-horizontal form-material">
                          <div class="form-group mb-4">                            
                            <input type="hidden" id="up_id_projet_Etat">
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Etat du projet<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <select id="up_etat_projet" name="up_etat_projet" class="form-control" required style="margin-bottom:8px">
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
                        <button class="btn btn-success" id="btn_modifi_etat_projet">Modifier</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end update etat projet model -->
              
              <!-- Model alert update etat project succès -->
              <div class="modal fade" id="SuccessUpdateEtatProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modification Etat du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateEtatProject_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update etat project succès -->
              
              <!-- Model alert update etat project echec -->
              <div class="modal fade" id="EchecUpdateEtatProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modification Etat du projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateEtatProject_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update etat project echec -->
                    
              
              <!-- update project Modal -->
              <div class="modal fade bd-example-modal-lg" id="update_project_modal"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier le projet</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="update_project_form" autocomplete="off" class="form-horizontal form-material">
                          <div class="form-group">
                              <input type="hidden" id="idProject">
                          </div>
                          <div id="fiche_1row">
                            <div class="form-group">
                              <label class="col-md-12 p-0">Nom du projet<span class="text-danger">*</span></label>
                              <div class="col-md-12 p-0">
                                <input type="text" class="form-control" style="margin-bottom:8px" name="up_nom_projet" id="up_nom_projet" placeholder="Nom"/>
                                <p style=" color: #D8000C;" class="error" for="up_nom_projet" id="up_nom_projet_error"> </p>
                              </div>
                            </div>
                            <div class="form-group">
                              <label class="col-md-12 p-0">Client<span
                              class="text-danger">*</span></label>
                              <div class="col-md-12 p-0">
                                <select class="selectpicker form-control" id="up_client" name="up_client" style="margin-bottom:8px" >
                                  <option value="" disabled >Selectionner un client</option>
                                  <?php
                                            global $conn;
                                            $resultat = mysqli_query($conn,"SELECT * FROM client");  
                                            if ($resultat->num_rows > 0) {
                                              while ($row = $resultat->fetch_assoc()) {
                                                echo '<option value="' . $row['id_client'] . '">' . $row['nom_client_projet'] . '</option>';
                                              }
                                            }
                                            ?>
                                      </select> 
                                      <p style=" color: #D8000C;" class="error" for="up_client" id="up_client_error"> </p>                
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="col-md-12 p-0">Chef de projet<span class="text-danger">*</span></label>
                                    <div class="col-md-12 p-0">
                                        <select class="selectpicker form-control" id="up_chef_projet" name="up_chef_projet" style="margin-bottom:8px">
                                          <option value="" disabled >Selectionner chef de projet</option>
                                          <?php
                                                global $conn;
                                                $resultat = mysqli_query($conn,"SELECT * FROM user Where id_role='1'");  
                                                if ($resultat->num_rows > 0) {
                                                  while ($row = $resultat->fetch_assoc()) {
                                                    echo '<option value="' . $row['id_user'] . '">' . $row['nom_user'] . ' ' . $row['prenom_user'] . '</option>';
                                                  }
                                                }
                                                ?>
                                        </select> 
                                        <p style=" color: #D8000C;" class="error" for="up_chef_projet" id="up_chef_projet_error"> </p>                      
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
                                    <input style=" width: 295px;" type="file" id="up_doc_projet" name="up_doc_projet" class="form-control">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-12 p-0">Date de début<span class="text-danger">*</span></label>
                                  <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="up_dateDebutprojet" name="up_dateDebutprojet">
                                    <p style=" color: #D8000C;" class="error" for="up_dateDebutprojet" id="up_dateDebutprojet_error"> </p>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-md-12 p-0">Date de fin<span class="text-danger">*</span></label>
                                  <div class="col-md-12 p-0">
                                    <input type="date"  style="margin-bottom:8px" class="form-control" id="up_dateFinprojet" name="up_dateFinprojet">
                                    <p style=" color: #D8000C;" class="error" for="up_dateFinprojet" id="up_dateFinprojet_error"> </p>
                                  </div>
                                </div>               
                              </div>                        
                              
                              <div id="fiche_1row">
                                <div class="form-group">
                                  <label >Confirmation du projet</label>
                                  <input type="checkbox" name="up_confirmationProjet" id="up_confirmationProjet" />
                                </div>
                              </div>
                            </form>                    
                          </div>
                          <div class="modal-body">
                            <div style="float: right;">
                              <button class=" btn btn-success" id="btn_updateProject" name="btn_updateProject">Modifier</button>
                              <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end update project Model -->

                    <!-- Model alert update project succès -->
                    <div class="modal fade" id="SuccessUpdateProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification du projet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-echec-succes">
                            <div class="circlechecked">
                              <i class="fas fa-check"></i>
                            </div>
                            <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                              <center id="UpdateProject_success"></center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end Model alert update project succès -->
                    
                    <!-- Model alert update project echec -->
                    <div class="modal fade" id="EchecUpdateProject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modification du projet</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-echec-succes">
                            <div class="circleerror">
                              <i class="fa fa-times"></i>
                            </div>
                            <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                              <center id="UpdateProject_echec"></center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- end Model alert update project echec -->
                    
                    <hr>
                    <div class="table-responsive-xxl" id="liste_project"></div> 
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
  
  document.getElementById("up_dateDebutprojet").setAttribute("min", today);
  document.getElementById("up_dateFinprojet").setAttribute("min", today);

  document.getElementById("dateDebutprojet").setAttribute("min", today);
  document.getElementById("dateFinprojet").setAttribute("min", today);
  
</script>