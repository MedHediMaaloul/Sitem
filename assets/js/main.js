$(document).ready(function () {
  login();
  view_user();
  add_user();
  delete_user();
  update_user();
  get_data_user();
  disable_account();
  activate_account();
});

//close modal
$(document).on("click", "#btn-close", function () {
  location.reload(true);

});

//validate phone
function validatePhoneNumber(input_str) {
  var re = /^\(?\d{2}\)?[- ]?(\d{3})[- ]?(\d{3})$/;

  return re.test(input_str);
}

//validate CIN
function validateCIN_Number(input_str) {
  var re = /^\(?(\d{8})$/;

  return re.test(input_str);
}

//validate email
function IsValidEmail(email) {
  //Check minimum valid length of an Email.
  if (email.length <= 2) {
    return false;
  }
  //If whether email has @ character.
  if (email.indexOf("@") == -1) {
    return false;
  }
  var parts = email.split("@");
  var dot = parts[1].indexOf(".");
  var dotSplits = parts[1].split(".");
  var dotCount = dotSplits.length - 1;
  //Check whether Dot is present, and that too minimum 1 character after @.
  if (dot == -1 || dot < 2 || dotCount > 2) {
    return false;
  }
  //Check whether Dot is not the last character and dots are not repeated.
  for (var i = 0; i < dotSplits.length; i++) {
    if (dotSplits[i].length == 0) {
      return false;
    }
  }

  return true;
};

function login() {

  $(document).on("click", "#btn_login", function () {
    var email = $("#email").val();
    var password = $("#password").val();
    $("#email_error").html("");
    $("#password_error").html("");
    $("#messageError").html("");


    if (email == "") {
      $("#email_error").html("Saisir votre email s'il vous plait.");
      $("#email").focus();
    } else if (!IsValidEmail(email)) {
      $("#email_error").html("Adresse email invalide");
      $("#email").focus();
    } else if (password == "") {
      $("#password_error").html("Saisir votre mot de passe s'il vous plait.");
      $("#password").focus();
    } else {
      $.ajax({
        url: "login_fn.php",
        method: "post",
        data: {
          password: password,
          email: email

        }, success: function (data) {
          if (data.includes("success")) {
            location.href = "accueil.php";

          } else {
            $("#messageError").html(data);
          }
        },
      });
    }

  });
}

//User
function view_user() {
  $.ajax({
    url: "view_user.php",
    method: "post",
    success: function (data) {
      try {
        data = $.parseJSON(data);
        if (data.status == "success") {
          $("#liste_user").html(data.html);
        }
      } catch (e) {
        console.error("Invalid Response!");
      }
    },
  });
}


function add_user() {
  $(document).on("click", "#btn_openModel", function () {
    $("#insert-user_form").trigger("reset");
    var paragraphs = $("#insert-user_form").find("p");
    paragraphs.each(function () {
      $(this).html('');
    });
    $("#modal_add").modal("show");
    $(document).on("click", "#btn_ajout_user", function () {
      var role = $("#role").val();
      var nom = $("#nom").val();
      var prenom = $("#prenom").val();
      var address = $("#address").val();
      var numCIN = $("#numCIN").val();
      var email = $("#email").val();
      var numTel = $("#numTel").val();
      var doc_photoProfile = $("#doc_photoProfile").prop("files")[0];
      var dateNaissance = $("#dateNaissance").val();
      var password = $("#password").val();
      var confirmPassword = $("#confirmPassword").val();

      var specialite = $("#specialite option:selected").map(function () {
        return $(this).val();
      }).get();

      if (doc_photoProfile == undefined) {
        doc_photoProfile = "";
      }

      if (specialite == null && role != "1") {
        specialite == "";
      }
      if (role == null) {
        $("#role_error").html("Choisir le role.");
        $("#role").focus();
      } else if (specialite == null && role == "1") {
        $("#specialite_error").html("Choisir la specialité.");
        $("#specialite").focus();
      } else if (nom == "") {
        $("#nom_error").html("Saisir votre nom s'il vous plait.");
        $("#nom").focus();
      } else if (prenom == "") {
        $("#prenom_error").html("Saisir votre prénom s'il vous plait.");
        $("#prenom").focus();
      } else if (email == "") {
        $("#email_error").html("Saisir votre email s'il vous plait.");
        $("#email").focus();
      } else if (!IsValidEmail(email)) {
        $("#email_error").html("Adresse email invalide");
        $("#email").focus();
      } else if (numCIN == "") {
        $("#numCIN_error").html("Saisir votre CIN s'il vous plait.");
        $("#numCIN").focus();
      } else if (!validateCIN_Number(numCIN)) {
        $("#numCIN_error").html("Numéro CIN invalide.");
        $("#numCIN").focus();
      } else if (numTel == "") {
        $("#numTel_error").html("Saisir votre Téléphone s'il vous plait.");
        $("#numTel").focus();
      } else if (!validatePhoneNumber(numTel)) {
        $("#numTel_error").html("Numéro téléphone invalide");
        $("#numTel").focus();
      } else if (address == "") {
        $("#address_error").html("Saisir votre adresse s'il vous plait.");
        $("#address").focus();
      } else if (dateNaissance == "") {
        $("#dateNaissance_error").html("Saisir votre date de Naissance s'il vous plait.");
        $("#dateNaissance").focus();
      } else if (password == "") {
        $("#password_error").html("Saisir votre mot de passe s'il vous plait.");
        $("#password").focus();
      } else if (confirmPassword == "" || password != confirmPassword) {
        $("#confirmPassword_error").html("Confirmer votre  Mot de Passe s'il vous plait.");
        $("#confirmPassword").focus();
      } else {
        var form_data = new FormData();
        form_data.append("role", role);
        form_data.append("specialite", specialite);
        form_data.append("nom", nom);
        form_data.append("prenom", prenom);
        form_data.append("address", address);
        form_data.append("numCIN", numCIN);
        form_data.append("email", email);
        form_data.append("numTel", numTel);
        form_data.append("doc_photoProfile", doc_photoProfile);
        form_data.append("dateNaissance", dateNaissance);
        form_data.append("password", password);
        $.ajax({
          url: "add_user.php",
          method: "post",
          processData: false,
          contentType: false,
          data: form_data,
          success: function (data) {
            view_user();
            if (data.includes('text-echec')) {
              $("#modal_add").modal("hide");
              $("#adduser_echec").removeClass("text-checked").addClass("text-echec").html(data);
              $("#EchecAddUser").modal("show");
              setTimeout(function () {
                if ($("#EchecAddUser").length > 0) {
                  $("#EchecAddUser").modal("hide");
                }
              }, 2000);
            } else {
              $("#modal_add").modal("hide");
              $("#adduser_success").addClass("text-checked").html(data);
              $("#SuccessAddUser").modal("show");
              $("#adduser_success").removeClass("text-echec").addClass("text-checked");
              setTimeout(function () {
                if ($("#SuccessAddUser").length > 0) {
                  $("#SuccessAddUser").modal("hide");
                }
              }, 2000);
            }
          },
        });
      }
    });
  });
}


function disable_account() {
  $(document).on("click", "#btn_desactiver_user", function () {
    var user_ID = $(this).attr("data-id2");
    $("#disable_user").modal("show");
    $(document).on("click", "#disableUser", function () {
      $.ajax({
        url: "disable_account.php",
        method: "post",
        data: {
          user_ID: user_ID
        },
        success: function (data) {
          view_user();
          if (data.includes('text-echec')) {
            $("#disable_user").modal("hide");
            $("#disableUser_echec").removeClass("text-checked").addClass("text-echec").html(data);
            $("#EchecDisableUser").modal("show");
            setTimeout(function () {
              if ($("#EchecDisableUser").length > 0) {
                $("#EchecDisableUser").modal("hide");
              }
            }, 2000);
          } else {
            $("#disable_user").modal("hide");
            $("#disableUser_success").addClass("text-checked").html(data);
            $("#SuccessDisableUser").modal("show");
            $("#disableUser_success").removeClass("text-echec").addClass("text-checked");
            setTimeout(function () {
              if ($("#SuccessDisableUser").length > 0) {
                $("#SuccessDisableUser").modal("hide");
              }
            }, 2000);
          }
        },
      });
    });
  });

}

function activate_account() {
  $(document).on("click", "#btn_activer_user", function () {
    var user_ID = $(this).attr("data-id3");
    $("#activate_user").modal("show");
    $(document).on("click", "#activateUser", function () {
      $.ajax({
        url: "activate_account.php",
        method: "post",
        data: {
          user_ID: user_ID
        },
        success: function (data) {
          view_user();
          if (data.includes('text-echec')) {
            $("#activate_user").modal("hide");
            $("#activateUser_echec").removeClass("text-checked").addClass("text-echec").html(data);
            $("#EchecActivateUser").modal("show");
            setTimeout(function () {
              if ($("#EchecActivateUser").length > 0) {
                $("#EchecActivateUser").modal("hide");
              }
            }, 2000);
          } else {
            $("#activate_user").modal("hide");
            $("#activateUser_success").addClass("text-checked").html(data);
            $("#SuccessActivateUser").modal("show");
            $("#activateUser_success").removeClass("text-echec").addClass("text-checked");
            setTimeout(function () {
              if ($("#SuccessActivateUser").length > 0) {
                $("#SuccessActivateUser").modal("hide");
              }
            }, 2000);
          }
        },
      });
    });
  });
}

function delete_user() {
  $(document).on("click", "#btn_supprimer_user", function () {
    var Delete_ID = $(this).attr("data-id1");
    $("#delete_user").modal("show");
    $(document).on("click", "#supprimer_user", function () {
      $.ajax({
        url: "delete_user.php",
        method: "post",
        data: {
          DeleteID: Delete_ID
        },
        success: function (data) {
          view_user();
          if (data.includes('text-echec')) {
            $("#delete_user").modal("hide");
            $("#deleteUser_echec").removeClass("text-checked").addClass("text-echec").html(data);
            $("#EchecDeleteUser").modal("show");
            setTimeout(function () {
              if ($("#EchecDeleteUser").length > 0) {
                $("#EchecDeleteUser").modal("hide");
              }
            }, 2000);
          } else {
            $("#delete_user").modal("hide");
            $("#deleteUser_success").addClass("text-checked").html(data);
            $("#SuccessDeleteUser").modal("show");
            $("#deleteUser_success").removeClass("text-echec").addClass("text-checked");
            setTimeout(function () {
              if ($("#SuccessDeleteUser").length > 0) {
                $("#SuccessDeleteUser").modal("hide");
              }
            }, 2000);
          }
        },
      });
    });
    $(document).on('hide.bs.modal', '#delete_user', function () {
      Delete_ID = "";
    });
  });
}


function get_data_user() {
  $(document).on("click", "#btn_modifier_user", function () {
    $("#passwordupdate").prop("checked", false);
    $("#passwordchange_form ").css("display", "none");
    $("#update-user_form").trigger("reset");
    var paragraphs = $("#update-user_form").find("p");
    paragraphs.each(function () {
      $(this).html('');
    });
    var updateID = $(this).attr("data-id");
    $.ajax({
      url: "get_data_user.php",
      method: "post",
      data: {
        update_ID: updateID
      },
      dataType: "JSON",
      success: function (data) {
        $("#idUser").val(data[0]);
        $("#up_role").val(data[1]);
        var specialite = data[2].split(",");
        $("#up_specialite").val(specialite);
        $("#up_nom").val(data[3]);
        $("#up_prenom").val(data[4]);
        $("#up_email").val(data[5]);
        $("#up_numCIN").val(data[6]);
        $("#up_numTel").val(data[7]);
        $("#up_address").val(data[8]);
        $("#up_dateNaissance").val(data[9]);

        $("#update_user_modal").modal("show");
        view_user();
        if ($("#up_role").val() == "1") {
          document.getElementById('sh2').style.display = 'block';
        }

        const id_up_role = document.getElementById("up_role");
        id_up_role.addEventListener("change", handleSelectChange);
        function handleSelectChange(event) {
          const id_role = event.target.value;
          document.getElementById('sh2').style.display = 'none';
          if (id_role == "1") {
            document.getElementById('sh2').style.display = 'block';
          }
        }

      },
    });
  });

}


function update_user() {
  $(document).on("click", "#btn_update_user", function () {
    $("#update_user_modal").scrollTop(0);
    var idUser = $("#idUser").val();
    var role = $("#up_role").val();
    var nom = $("#up_nom").val();
    var prenom = $("#up_prenom").val();
    var address = $("#up_address").val();
    var numCIN = $("#up_numCIN").val();
    var email = $("#up_email").val();
    var numTel = $("#up_numTel").val();
    var doc_photoProfile = $("#up_doc_photoProfile").prop("files")[0];
    var dateNaissance = $("#up_dateNaissance").val();
    var password = $("#up_password").val();
    var newPassword = $("#newPassword").val();
    var specialite = $("#up_specialite option:selected")
      .map(function () {
        return $(this).val();
      })
      .get();

    $("#up_role_error").html("");
    $("#up_specialite_error").html("");
    $("#up_nom_error").html("");
    $("#up_prenom_error").html("");
    $("#up_address_error").html("");
    $("#up_numCIN_error").html("");
    $("#up_email_error").html("");
    $("#up_numTel_error").html("");
    $("#up_dateNaissance_error").html("");
    $("#up_password_error").html("");

    if (doc_photoProfile == undefined) {
      doc_photoProfile = "";
    }

    if (specialite == null && role != "1") {
      specialite == "";
    }

    if (role == null) {
      $("#up_role_error").html("Choisir le role.");
      $("#up_role").focus();
    } else if (specialite == null && role == "1") {
      $("#up_specialite_error").html("Choisir la specialité.");
      $("#up_specialite").focus();
    } else if (nom == "") {
      $("#up_nom_error").html("Saisir votre nom s'il vous plait.");
      $("#up_nom").focus();
    } else if (prenom == "") {
      $("#up_prenom_error").html("Saisir votre prénom s'il vous plait.");
      $("#up_prenom").focus();
    } else if (email == "") {
      $("#up_email_error").html("Saisir votre email s'il vous plait.");
      $("#up_email").focus();
    } else if (!IsValidEmail(email)) {
      $("#up_email_error").html("Adresse email invalide");
      $("#up_email").focus();
    } else if (numCIN == "") {
      $("#up_numCIN_error").html("Saisir votre CIN s'il vous plait.");
      $("#up_numCIN").focus();
    } else if (!validateCIN_Number(numCIN)) {
      $("#up_numCIN_error").html("Numéro CIN invalide.");
      $("#up_numCIN").focus();
    } else if (numTel == "") {
      $("#up_numTel_error").html("Saisir votre Téléphone s'il vous plait.");
      $("#up_numTel").focus();
    } else if (!validatePhoneNumber(numTel)) {
      $("#up_numTel_error").html("Numéro téléphone invalide");
      $("#up_numTel").focus();
    } else if (address == "") {
      $("#up_address_error").html("Saisir votre adresse s'il vous plait.");
      $("#up_address").focus();
    } else if (dateNaissance == "") {
      $("#up_dateNaissance_error").html("Saisir votre date de Naissance s'il vous plait.");
      $("#up_dateNaissance").focus();
    } else if (document.getElementById("passwordupdate").checked == true && password == "") {
      $("#up_password_error").html("Saisir votre mot de passe actuel s'il vous plait.");
      $("#up_password").focus();
    } else if (document.getElementById("passwordupdate").checked == true && newPassword == "") {
      $("#newPassword_error").html("Saisir le nouveau mot de passe s'il vous plait.");
      $("#newPassword").focus();
    } else {
      var form_data = new FormData();
      form_data.append("idUser", idUser);
      form_data.append("role", role);
      form_data.append("specialite", specialite);
      form_data.append("nom", nom);
      form_data.append("prenom", prenom);
      form_data.append("address", address);
      form_data.append("numCIN", numCIN);
      form_data.append("email", email);
      form_data.append("numTel", numTel);
      form_data.append("doc_photoProfile", doc_photoProfile);
      form_data.append("dateNaissance", dateNaissance);
      form_data.append("password", password);
      form_data.append("newPassword", newPassword);

      $.ajax({
        url: "update_user.php",
        method: "post",
        processData: false,
        contentType: false,
        data: form_data,
        success: function (data) {
          view_user();
          if (data.includes('text-echec')) {
            $("#update_user_modal").modal("hide");
            $("#UpdateUser_echec").removeClass("text-checked").addClass("text-echec").html(data);
            $("#EchecUpdateUser").modal("show");
            setTimeout(function () {
              if ($("#EchecUpdateUser").length > 0) {
                $("#EchecUpdateUser").modal("hide");
              }
            }, 2000);
          } else {
            $("#update_user_modal").modal("hide");
            $("#UpdateUser_success").addClass("text-checked").html(data);
            $("#SuccessUpdateUser").modal("show");
            $("#UpdateUser_success").removeClass("text-echec").addClass("text-checked");
            setTimeout(function () {
              if ($("#SuccessUpdateUser").length > 0) {
                $("#SuccessUpdateUser").modal("hide");
              }
            }, 2000);
          }
        }

      });
    }
  });
}


