<?php
include 'Gestion/header.php'
?>

<div class="page-wrapper">
  <div class="page-content">
    <div class="row">                
      <h3 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Contact</h3>
      <div class="row mt">
        <div class="col-md-12">
          <div class="content-panel">                  
            <form id="form_contact" autocomplete="off" class="form-horizontal form-material">
                      <div id="fiche_1row"> 
                        <div class="form-group">
                          <label class="col-md-12 p-0">Sujet<span class="text-danger">*</span></label>
                          <div class="col-md-12 p-0">
                            <input type="text" style="margin-bottom:8px" class="form-control" name="sujet_contact" id="sujet_contact" placeholder="Sujet"/>
                            <p style=" color: #D8000C;" class="error" for="sujet_contact" id="sujet_contact_error"> </p>
                          </div>
                        </div>
                          
                        <div class="form-group">
                              <label class="col-md-12 p-0">Pièce jointe</label>
                              <div class="col-md-12 p-0">
                                  <input style=" width: 295px;" type="file" id="doc_contact" name="doc_contact" class="form-control">
                                  <p style=" color: #D8000C;" class="error" for="doc_contact" id="doc_contact_error"> </p>
                              </div>
                        </div>
                      </div>
                          
                      <div class="form-group">
                        <label class="col-md-12 p-0">Détails<span class="text-danger">*</span></label>
                        <div class="col-md-12 p-0">
                          <textarea style="margin-bottom:8px" class="form-control" name="details_contact" id="details_contact" placeholder="Détails" rows="5"></textarea>
                          <p style=" color: #D8000C;" class="error" for="details_contact" id="details_contact_error"> </p>
                        </div>
                      </div>
            </form>
           <div style="float: right;">
           <button class=" btn btn-success" id="btn_envoyer_contact" name="btn_envoyer_contact">Ajouter</button>
           </div>
            </div>
            <!-- Model alert Envoi Email succès -->
            <div class="modal fade" id="SuccessEnvoiEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Envoi Email</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-echec-succes">
                      <div class="circlechecked">
                        <i class="fas fa-check"></i>
                      </div>
                      <div style="color:#05DD9A; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="Envoi_Email_success"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert Envoi Email succès -->
              <!-- Model alert add contact echec -->
              <div class="modal fade" id="EchecEnvoiEmail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Envoi Email</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                        <i class="fa fa-times"
                    <div class="modal-echec-succes">
                      <div class="circleerror">></i>
                      </div>
                      <div style="color:#FF0000; font-size:20px; margin-top:109px; margin-bottom:10px;">
                        <center id="Envoi_Email_echec"></center>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end Model alert add contact echec -->
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  <?php
    include 'Gestion/footer.php'
  ?>
