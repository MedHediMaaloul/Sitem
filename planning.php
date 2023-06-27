<?php
include 'Gestion/header.php';
$id=$_GET['id'];
if ($id==""){
    $id="1";
}
?>

<div class="page-wrapper">
    <div class="page-content">
        <div class="row">
            <br />
            <h2 class="mb-4" style="color:#05DD9A;"><i class="fa fa-angle-right"></i> Planning</h2>
            <br />
            <div id="fiche_1row">
                <div class="form-group">                            
                    <div class="col-md-12 p-0">
                        <select  id="selectedID" name="value" class="form-control" required style="margin-bottom:8px">
                            <option value="Choisissez" selected disabled>Choisissez</option>
                            <option value="1" >Réunion</option>
                            <option value="2">Evènement</option>
                            <option value="3">Projet</option>
                            <option value="4">Congé</option>
                        </select>
                    </div>
                </div>
                <input type="hidden" name="id_choice" value="<?php echo $id; ?>">
            </div>  
            <div class="row mt">
                <div class="col-md-12">
                    <div class="content-panel">
                        <!-- get data model event -->
                        <div class="modal fade bd-example-modal-lg" id="get_data_event"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <?php
                                            if ($id=="1"){
                                                $event="Réunion";
                                            }else if ($id=="2"){
                                                $event="Evènement";
                                            }else if ($id=="3"){
                                                $event="Projet";
                                            }else if ($id=="4"){
                                                $event="Congé";
                                            }
                                        ?>
                                        <h5 class="modal-title" id="exampleModalLabel">  <?php echo $event; ?> </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="btn-close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" id="idEvent">
                                            </div>
                                            <form id="update_etat_form" autocomplete="off" class="form-horizontal form-material">
                                                <div id="fiche_1row">

                                                    <div class="form-group">
                                                        <label class="col-md-12 p-0">Titre</label>
                                                        <div class="col-md-12 p-0">
                                                            <input style=" width: 295px;" type="text" id="titre" name="titre" class="form-control" disabled>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-md-12 p-0">Responsable de l'événnement</label>
                                                        <div class="col-md-12 p-0">
                                                            <input style=" width: 295px;" type="text" id="id_user" name="id_user" class="form-control" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php if ($id=="1"){ ?>
                                                    <div id="fiche_1row">

                                                        <div class="form-group">
                                                            <label class="col-md-12 p-0">Date de Réunion</label>
                                                            <div class="col-md-12 p-0">
                                                                <input style=" width: 295px;" type="text" id="dateDebutEvent" name="dateDebutEvent" class="form-control" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-12 p-0">Les invités</label>
                                                            <div class="col-md-12 p-0">
                                                                <input style=" width: 295px;" type="text" id="id_invitUser" name="id_invitUser" class="form-control" disabled>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }else{ ?>
                                                    <div id="fiche_1row">
                                                        
                                                        <div class="form-group">
                                                            <label class="col-md-12 p-0">Date de début</label>
                                                            <div class="col-md-12 p-0">
                                                                <input style=" width: 295px;" type="text" id="dateDebutEvent" name="dateDebutEvent" class="form-control" disabled>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-12 p-0">Date de fin</label>
                                                            <div class="col-md-12 p-0">
                                                                <input style=" width: 295px;" type="text" id="dateFinEvent" name="dateFinEvent" class="form-control" disabled>
                                                            </div>
                                                        </div>      
                                                    </div>          
                                                <?php } ?>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end get data model event -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


    
<?php
include 'Gestion/footer.php';
?>

<script>

$(document).ready(function() {
    var id_choice = $("input[name=id_choice]").val();
    if(id_choice == "") {
        $("#selectedID").val("1");
    } else {
        $("#selectedID").val($("input[name=id_choice]").val());
    }

    $('select').on('change', function (e) {
      var value = $(this).val();
      window.location.href = '?id=' + value;
    });

    var calendar = $('#calendar').fullCalendar({
        header:{
            left:'prev,next today',
            center:'title',
            right: 'year,month,agendaDay,listWeek'
        },
        height: "auto",
        defaultView: 'year',
        yearColumns: 3,
        events: {
            url: 'evennement/load.php',
            type: 'POST',
            data : {id_choice :$("input[name=id_choice]").val()},
            success : function(response){
            }
        },
        eventClick:function(event){
            var id = event.id;
            $.ajax({
              url:"evennement/detail.php",
              method: "post",
              data:{id:id,id_choice :$("input[name=id_choice]").val()},
              dataType: "JSON",
              success:function(data){
                  $("#idEvent").val(data[0]);
                  $("#titre").val(data[1]);
                  $("#dateDebutEvent").val(data[2]);
                  $("#dateFinEvent").val(data[3]);
                  $("#id_user").val(data[4]);
                  $("#id_invitUser").val(data[5]);

                  $("#get_data_event").modal("show");
              }
            })
        },
    });
});
</script>
  