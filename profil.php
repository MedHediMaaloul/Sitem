<?php
include 'Gestion/header.php';
include 'Gestion/connect_db.php';
?>
<div class="page-wrapper">
    <style>
    #userpaasword:focus {
        outline: none;
        border: none;
        -webkit-text-security: square !important;
    }

    #userpaasword {
        -webkit-text-security: square !important;
        border: none;
        outline: none;
    }

    input[type=checkbox] {
        width: 17px;
        height: 17px;
        margin-left: 15px;
        accent-color: #05dd9a;
    }

    .progress-bar {
        background: black;
    }


    #fiche_1row {
        display: grid !important;
        grid-template-rows: repeat(1, auto);
        grid-template-columns: repeat(3, auto);
        gap: 25px;
    }

    #fiche_2row {
        display: grid !important;
        grid-template-rows: repeat(1, auto);
        grid-template-columns: repeat(2, auto);
        gap: 25px;
    }
    .page-wrapper {
    margin-top: 40px;
    }
    </style>
    <div class="page-content">
        <div class="row">
            <section >
                <div class="py-5">
                    <div class="row">
                        <h1 class="mb-4 fnt" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Profil</h1>
                        <div class="col-lg-4">
                            <div class="card mb-4">
                                <div class="card-body text-center">
                                    <img id="profilphoto" src="assets/images/profil.png" style="width: 160px;"
                                        class="rounded-circle img-fluid">
                                    <h5 class="my-3" id="nameuser"></h5>
                                    <?php 
                                    if ($idRole=="1"){
                                   echo" <p class='text-muted' id='userspecialité'></p>";
                                    }
                                    ?>
                                    <div class="d-flex justify-content-center mb-2">
                                        <button id="up_profil_btn" type="button"
                                            class="btn btn-outline-success ms-1">Modifier</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Nom et prénom</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="username"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Email</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="useremail"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Date de naissance</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="userdataenaissance"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">N° Téléphone</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="usertel"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Adresse</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0" id="useradresse"></p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mot de passe</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <input type="text" class="text-muted mb-0" id="userpaasword"
                                                readonly="readonly"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <p class="mb-4"><span class="font-italic me-1"
                                                    style="color:#05dd9a">statistiques</span>
                                                Project Status
                                            </p>
                                            <p class="mb-1">Web Design</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Website Markup</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 72%"
                                                    aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">One Page</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 89%"
                                                    aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Mobile Template</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 55%"
                                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Backend API</p>
                                            <div class="progress rounded mb-2" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 66%"
                                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card mb-4 mb-md-0">
                                        <div class="card-body">
                                            <p class="mb-4"><span class="text font-italic me-1"
                                                    style="color:#05dd9a">statistiques</span>
                                                Taches Status </p>
                                            <p class="mb-1">Web Design</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 80%"
                                                    aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Website Markup</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 72%"
                                                    aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">One Page</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 89%"
                                                    aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Mobile Template</p>
                                            <div class="progress rounded" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 55%"
                                                    aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <p class="mt-4 mb-1">Backend API</p>
                                            <div class="progress rounded mb-2" style="height: 5px;">
                                                <div class="progress-bar" role="progressbar" style="width: 66%"
                                                    aria-valuenow="66" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Model modification profil -->
            <div class="modal fade bd-example-modal-lg" id="up_profil_modal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content" style="width: fit-content;">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modifier profil</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                        </div>
                        <div class="modal-body">
                            <form id="up-profilForm" autocomplete="off" class="form-horizontal form-material">
                                <div id="fiche_1row">
                                    <div hidden>
                                        <input type="text" id="up_idProfil" id_role="<?php echo $idRole ?>"  class="form-control">
                                    </div>
                                    <div>
                                        <label class="col-md-12 p-0">Nom<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input type="text" id="up_profilNom" class="form-control">
                                        </div>
                                        <p for="up_profilNom" class="error msgError mt-2" id="UpNomMessageErreur"></p>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Prénom<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input type="text" id="up_profilPrenom" class="form-control">
                                        </div>
                                        <p for="up_profilPrenom" class="error msgError mt-2" id="UpPrenomMessageErreur"></p>

                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Date de naissance<span
                                                class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input type="date" id="up_profilDateNaissance" class="form-control">
                                        </div>
                                        <p for="up_profilDateNaissance" class="error msgError mt-2" id="UpNaissanceMessageErreur"></p>
                                    </div>
                                </div>
                                <div id="fiche_1row">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">N° CIN<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input id="up_profilNumCin" "
                                                class=" form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Email<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input type="email" id="up_profilEmail" class="form-control" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Téléphone<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input id="up_profilPhone" "
                                                class=" form-control">
                                        </div>
                                        <p for="up_profilPhone" class="error msgError mt-2" id="UpPhoneMessageErreur"></p>
                                    </div>
                                </div>
                                <div id="fiche_1row">
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Adresse<span class="text-danger">*</span></label>
                                        <div class="col-md-12 p-0">
                                            <input type="text" id="up_profilAdresse" class="form-control" style="width:250px">
                                        </div>
                                        <p for="up_profilAdresse" class="error msgError mt-2" id="UpAdresseMessageErreur"></p>
                                    </div>
                                    <?php   if ($idRole=="1"){  ?>
                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Spécialité<span
                                                class="text-danger">*</span></label>
                                        <?php
                                    $query = "SELECT * FROM specialite ORDER BY id_specialite ASC";
                                    $result = mysqli_query($conn, $query);
                                        ?>
                                        <div class="col-md-12 p-0">
                                        <select class="selectpicker form-control" id="up_profilspecialite" data-none-selected-text="Sélectionner spécialité" name="up_specialitename" style="margin-bottom:8px" multiple aria-label="select">
                                 <?php
                                        if ($result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                            echo '<option value="' . $row['id_specialite'] . '">' . $row['nom_specialite'] . ' </option>';
                                            }
                                        }
                                 ?>
                                            </select>
                                        </div>
                                        <p for="up_profilspecialite" class="error msgError mt-2" id="upSpecialiteError"></p>  
                                    </div>
                                    <?php }?>

                                    <div class="form-group mb-4">
                                        <label class="col-md-12 p-0">Photo de profil</label>
                                        <div class="col-md-12 p-0">
                                            <input style=" width: 295px;" type="file" id="up_profilPhoto"
                                                class="form-control">
                                        </div>
                                        <p for="up_profilPhoto" class="error msgError" id="UpPhotoMessageErreur"></p>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <div>
                                        <label for="conducteur">Changer mot de passe</label>
                                        <input type="checkbox" id="passwordupdate" onclick="showpasswordupdate(this)"
                                            name="passwordupdate" value="">
                                    </div>
                                </div>
                                <div id="passwordchange_form" style="display:none">
                                    <div id="fiche_2row">
                                        <div class="form-group">
                                            <label class="col-md-12 p-0">Mot de passe actuel<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-12 p-0">
                                                <input style=" width: 70%;" type="text" id="actuelpasswordprofil"
                                                    class="form-control">
                                            </div>
                                            <p style="text-align: inherit;" for="actuelpasswordprofil" class="error msgError mt-2" id="UpPassMessageErreur"></p>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12 p-0">Nouveau mot de passe<span
                                                    class="text-danger">*</span></label>
                                            <div class="col-md-12 p-0">
                                                <input style=" width: 70%;" type="text" id="newpasswordprofil"
                                                    class="form-control">
                                            </div>
                                            <p style="text-align: inherit;"  for="newpasswordprofil" class="error msgError mt-2" id="UpNewPassMessageErreur"></p>

                                        </div>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer" style="border-top: none;">
                            <div style="float: right;">
                                <button class="btn btn-success" id="btn_update_profil_user">Modifier</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal"
                                    id="btn-close">Annuler</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end Model modification profil -->

                <!-- Model alert update profil succès -->
                <div class="modal fade" id="SuccessUpProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="upprtofil_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update profil succès -->

                <!-- Model alert update profil echec -->
                <div class="modal fade" id="EchecUpProfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modifier Utilisateur</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>                    </div>
                    <div class="modal-echec-succes">
                      <div class="circleerror">
                      <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="upprofil_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert update profil echec -->

        </div>
    </div>
</div>
<?php
include 'Gestion/footer.php'
?>