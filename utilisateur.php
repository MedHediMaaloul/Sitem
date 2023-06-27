<?php
include 'Gestion/header.php'
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Utilisateurs</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">                  
            <button type="button" title="Ajouter Utilisateur"class="btn btn-success btn-xs" id="btn_openModelAddUser" ><i class="fa fa-plus-circle"></i></button> 
              
            <!-- Add user Modal -->
              <div class="modal fade bd-example-modal-lg" id="modal_addUser"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Ajout Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="insert-user_form" autocomplete="off" class="form-horizontal form-material">
                      <input type="text" class="form-control" style="margin-bottom:8px" id="id_role_user" IdRoleusUr="<?php echo $idRole ?>" placeholder="Nom" hidden/>
                      <?php if ($idRole=="0"){?>
                        <div id="fiche_1row">
                          <div class="form-group">
                            <label class="col-md-12 p-0">Role<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <select id="role" name="role" class="form-control" required style="margin-bottom:8px">
                                <option value="Choisissez" selected disabled>Choisissez Role</option>
                                <?php
                                global $conn;
                                $resultat = mysqli_query($conn,"SELECT * FROM role");  
                                if ($resultat->num_rows > 0) {
                                  while ($row = $resultat->fetch_assoc()) {
                                    echo '<option value="' . $row['id_role'] . '">' . $row['label_role_user'] . '</option>';
                                  }
                                }
                                ?>
                              </select>
                              <p style=" color: #D8000C;" class="error" for="role" id="role_error"> </p>
                            </div>
                          </div>
                        </div>
                      <?php  } ?>
                        <div id="fiche_1row">
                          <div class="form-group" id="sh1" style="display:none;">
                            <label class="col-md-12 p-0">Spécialité<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <select class="selectpicker form-control" id="specialite" name="specialite" style="margin-bottom:8px" multiple aria-label="select">
                                <option value="" disabled>Selectionner votre spécialité</option>
                                <?php
                                  global $conn;
                                  $resultat = mysqli_query($conn,"SELECT * FROM specialite");  
                                  if ($resultat->num_rows > 0) {
                                    while ($row = $resultat->fetch_assoc()) {
                                      echo '<option value="' . $row['id_specialite'] . '">' . $row['nom_specialite'] . '</option>';
                                    }
                                  }
                                ?>
                              </select>
                              <p style=" color: #D8000C;" class="error" for="specialite" id="specialite_error"> </p>
                            </div>
                          </div>
                                 
                          <div class="form-group">
                            <label class="col-md-12 p-0">Nom<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text" class="form-control" style="margin-bottom:8px" name="nom" id="nom" placeholder="Nom"/>
                              <p style=" color: #D8000C;" class="error" for="nom" id="nom_error"> </p>

                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Prénom<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text" style="margin-bottom:8px" class="form-control" name="prenom" id="prenom" placeholder="Prénom"/>
                              <p style=" color: #D8000C;" class="error" for="prenom" id="prenom_error"> </p>
                            </div>
                          </div>
                        </div>
                        
                        <div id="fiche_1row">
                           <div class="form-group">
                            <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text" style="margin-bottom:8px" class="form-control" name="email" id="email" placeholder="Email"/>
                              <p style=" color: #D8000C;" class="error" for="email" id="email_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">N° CIN<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="number" style="margin-bottom:8px" class="form-control" name="numCIN" id="numCIN" placeholder="numCIN"/>
                              <p style=" color: #D8000C;" class="error" for="numCIN" id="numCIN_error"> </p>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Téléphone<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text" style="margin-bottom:8px" class="form-control" name="numTel" id="numTel" placeholder="Téléphone"/>
                              <p style=" color: #D8000C;" class="error" for="numTel" id="numTel_error"> </p>
                            </div>
                          </div>
                          
                        </div>
                        <div id="fiche_1row">
                        <div class="form-group">
                            <label class="col-md-12 p-0">Adresse<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text"  style="margin-bottom:8px" class="form-control" name="address" id="address" placeholder="Adresse"/>
                              <p style=" color: #D8000C;" class="error" for="address" id="address_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Date de naissance<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="date"  style="margin-bottom:8px" class="form-control" id="dateNaissance" name="dateNaissance">
                              <p style=" color: #D8000C;" class="error" for="dateNaissance" id="dateNaissance_error"> </p>
                            </div>
                          </div>
                         
                          <div class="form-group">
                            <label class="col-md-12 p-0">Photo de profil</label>
                            <div class="col-md-12 p-0">
                              <input style=" width: 295px;" type="file" id="doc_photoProfile" name="doc_photoProfile" class="form-control">
                            </div>
                          </div>
                        </div>
                        
                        <div id="fiche_1row">
                          <div class="form-group">
                            <label class="col-md-12 p-0">Mot de passe<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="password"  style="margin-bottom:8px" class="form-control" name="password" id="password" placeholder="Mot de passe"/>
                              <p style=" color: #D8000C;" class="error" for="password" id="password_error"> </p>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Confirmer le mot de passe<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                            <input type="password"  style="margin-bottom:8px" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Confirmer le mot de passe"/>
                                  <p style=" color: #D8000C;" class="error" for="confirmPassword" id="confirmPassword_error"> </p>
                            </div>
                          </div>
                          
                        </div>
                      </form>
                    </div>
                    <div class="modal-body">
                      <div style="float: right;">
                        <button class=" btn btn-success" id="btn_ajout_user" name="btn_ajout_user">Ajouter</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end add user Model -->

              <!-- Model alert add user succès -->
              <div class="modal fade" id="SuccessAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <center id="adduser_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add user succès -->

              <!-- Model alert add user echec -->
              <div class="modal fade" id="EchecAddUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="adduser_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add user echec --> 

              <!-- Model alert delete user succès -->
              <div class="modal fade" id="SuccessDeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteUser_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete user succès -->
              
              <!-- Model alert delete user echec -->
              <div class="modal fade" id="EchecDeleteUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Suppression Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="deleteUser_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert delete user echec -->
            
              <!-- delete User model -->
              <div class="modal fade" id="delete_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous supprimer l'utilisateur ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="supprimer_user">Supprimer</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end delet user modal -->

              <!-- disable User model -->
              <div class="modal fade" id="disable_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Désactiver Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous désactiver l'utilisateur ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="disableUser">Oui</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Non</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end disable user modal -->
              
              <!-- Model alert disable user succès -->
              <div class="modal fade" id="SuccessDisableUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Désactiver Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="disableUser_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert disable user succès -->

              <!-- Model alert disable user echec -->
              <div class="modal fade" id="EchecDisableUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Désactiver Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="disableUser_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert disable user echec -->


              <!-- activate User model -->
              <div class="modal fade" id="activate_user" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Activer Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p>Voulez-vous activer l'utilisateur ?</p>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class="btn btn-success" id="activateUser">Oui</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Non</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end activate user modal -->

              <!-- Model alert disable user succès -->
              <div class="modal fade" id="SuccessActivateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Activer Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="activateUser_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert disable user succès -->
              
              <!-- Model alert disable user echec -->
              <div class="modal fade" id="EchecActivateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Activer Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                        <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="activateUser_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert disable user echec -->
                           
              <!-- update user Modal -->
              <div class="modal fade bd-example-modal-lg" id="update_user_modal"  tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form id="update-user_form" autocomplete="off" class="form-horizontal form-material">
                        <div class="form-group">
                          <input type="hidden" id="idUser" UpIdRoleusUr="<?php echo $idRole ?>">
                        </div>
                        <div id="fiche_1row" >
                          <div class="form-group" <?php  ($idRole=="2")? print 'hidden':print ''?>>
                            <label class="col-md-12 p-0">Role<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <select id="up_role" name="up_role" class="form-control" required style="margin-bottom:8px">
                                <option value="Choisissez" selected disabled>Choisissez Role</option>
                                <?php
                                global $conn;
                                $resultat = mysqli_query($conn,"SELECT * FROM role");  
                                if ($resultat->num_rows > 0) {
                                  while ($row = $resultat->fetch_assoc()) {
                                    echo '<option value="' . $row['id_role'] . '">' . $row['label_role_user'] . '</option>';
                                  }
                                }
                                ?>
                              </select>
                              <p style=" color: #D8000C;" class="error" for="up_role" id="up_role_error"> </p>
                            </div>
                          </div>
                        </div>
                        <div id="fiche_1row">
                          <div class="form-group" id="sh2" style="display:none;">
                            <label class="col-md-12 p-0">Spécialité<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                            <select class="selectpicker form-control" id="up_specialite" name="up_specialite" style="margin-bottom:8px" multiple aria-label="select">
                                <option value="" disabled selected>Selectionner votre spécialité</option>
                                <?php
                                  global $conn;
                                  $resultat = mysqli_query($conn,"SELECT * FROM specialite");  
                                  if ($resultat->num_rows > 0) {
                                    while ($row = $resultat->fetch_assoc()) {
                                      echo '<option value="' . $row['id_specialite'] . '">' . $row['nom_specialite'] . '</option>';
                                    }
                                  }
                                ?>
                              </select>
                              <p style=" color: #D8000C;" class="error" for="up_specialite" id="up_specialite_error"> </p>                              
                            </div>
                          </div>
                              
                          <div class="form-group">
                            <label class="col-md-12 p-0">Nom<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text"   class="form-control" style="margin-bottom:8px" name="up_nom" id="up_nom" placeholder="Nom"/>
                              <p style=" color: #D8000C;" class="error" for="up_nom" id="up_nom_error"> </p>
                            </div>
                          </div>
                          <div class="form-group mb-4">
                            <label class="col-md-12 p-0">Prénom<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text"  style="margin-bottom:8px" class="form-control" name="up_prenom" id="up_prenom" placeholder="Prénom"/>
                              <p style=" color: #D8000C;" class="error" for="up_prenom" id="up_prenom_error"> </p>
                            </div>
                          </div>
                        </div>
                        
                        <div id="fiche_1row">
                           <div class="form-group">
                            <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text"  style="margin-bottom:8px" class="form-control" name="up_email" id="up_email" placeholder="Email"/>
                              <p style=" color: #D8000C;" class="error" for="up_email" id="up_email_error"> </p>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">N° CIN<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="number"  style="margin-bottom:8px" class="form-control" name="up_numCIN" id="up_numCIN" placeholder="numCIN"/>
                              <p style=" color: #D8000C;" class="error" for="up_numCIN" id="up_numCIN_error"> </p>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Téléphone<span class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="text"  style="margin-bottom:8px" class="form-control" name="up_numTel" id="up_numTel" placeholder="Téléphone"/>
                              <p style=" color: #D8000C;" class="error" for="up_numTel" id="up_numTel_error"> </p>
                            </div>
                          </div>
                        </div>
                        <div id="fiche_1row">
                          <div class="form-group">
                              <label class="col-md-12 p-0">Adresse<span class="text-danger">*</span></label>
                              <div class="col-md-12 p-0">
                                <input type="text"  style="margin-bottom:8px" class="form-control" name="up_address" id="up_address" placeholder="Adresse"/>
                                <p style=" color: #D8000C;" class="error" for="up_address" id="up_address_error"> </p>
                              </div>
                           </div>
                          <div class="form-group">
                            <label class="col-md-12 p-0">Date de naissance<span
                            class="text-danger">*</span></label>
                            <div class="col-md-12 p-0">
                              <input type="date"  style="margin-bottom:8px" class="form-control" id="up_dateNaissance" name="up_dateNaissance">
                              <p style=" color: #D8000C;" class="error" for="up_dateNaissance" id="up_dateNaissance_error"> </p>
                            </div>
                          </div>
                          
                          <div class="form-group">
                            <label class="col-md-12 p-0">Photo de profil</label>
                            <div class="col-md-12 p-0">
                              <input style=" width: 295px;" type="file" id="up_doc_photoProfile" name="up_doc_photoProfile" class="form-control">
                            </div>
                          </div>
                        </div>
                        <div class="form-group mb-4">
                          <div>
                            <label for="conducteur">Changer mot de passe</label>
                            <input type="checkbox" id="passwordupdate" name="passwordupdate" value="" onclick="showpasswordupdate(this)">
                          </div>
                        </div>
                        <div id="passwordchange_form" style="display:none">
                          <div id="fiche_1row">
                            <div class="form-group">
                              <label class="col-md-12 p-0">Mot de passe actuel</label>
                              <div class="col-md-12 p-0">
                                <input type="password"  style="margin-bottom:8px" class="form-control" name="up_password" id="up_password" placeholder="Mot de passe"/>
                                <p style=" color: #D8000C;" class="error" for="up_password" id="up_password_error"> </p>
                              </div>
                            </div>
                            
                            <div class="form-group">
                              <label class="col-md-12 p-0">Nouveau mot de passe</label>
                              <div class="col-md-12 p-0">
                                <input type="password"  style="margin-bottom:8px" class="form-control" name="newPassword" id="newPassword" placeholder="Confirmer le mot de passe"/>
                                <p style=" color: #D8000C;" class="error" for="newPassword" id="newPassword_error"> </p>
                                
                              </div>
                            </div>
                          </div>
                        </div>  
                      </form>                    
                    </div>
                      <div class="modal-body">
                        <div style="float: right;">
                          <button class=" btn btn-success" id="btn_update_user" name="btn_update_user">Modifier</button>
                          <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn-close">Fermer</button>
                        </div>
                      </div>
                    </div>
                  </div>
              </div>
              <!-- end update user Model -->

              <!-- Model alert update user succès -->
              <div class="modal fade" id="SuccessUpdateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateUser_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update user succès -->

              <!-- Model alert update user echec -->
              <div class="modal fade" id="EchecUpdateUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                      <i class="fa fa-times"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="UpdateUser_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update user echec -->

              <hr>
              <div class="table-responsive-xxl" id="liste_user"></div> 
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
  var idRole=<?php echo $idRole ?>;
  if (idRole=="0"){
  //specialite display where role= employee
  const Select_role = document.getElementById("role");
  Select_role.addEventListener("change", handleSelectChange);
  
  function handleSelectChange(event) {
    const id_role = event.target.value;
    document.getElementById('sh1').style.display = 'none';
    
    if (id_role=="1")
    {
      document.getElementById('sh1').style.display = 'block';
    }
  }
  }
  //date
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth()+1; //January is 0!
  var yyyy = today.getFullYear()-18;
  if(dd<10){
    dd='0'+dd
  } 
  if(mm<10){
    mm='0'+mm
  } 
  
  today = yyyy+'-'+mm+'-'+dd;
  
  document.getElementById("dateNaissance").setAttribute("max", today);
  document.getElementById("up_dateNaissance").setAttribute("max", today);

  
</script>