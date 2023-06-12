$(document).ready(function () {
  login();
  get_profil_record();
  update_profil_record();
});

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
}

function isValidDate(date) {
  var datePattern = /^([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/;
  // Check if the date string format is a match
  var matchArray = date.match(datePattern);
  if (matchArray == null) {
    return false;
  }
  // Remove any non digit characters
  var dateString = date.replace(/\D/g, "");
  // Parse integer values from the date string
  var year = parseInt(dateString.substr(0, 4));
  var month = parseInt(dateString.substr(4, 2));
  var day = parseInt(dateString.substr(6, 2));

  // Define the number of days per month
  var daysInMonth = [31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31];
  // Leap years
  if (year % 400 == 0 || (year % 100 != 0 && year % 4 == 0)) {
    daysInMonth[1] = 29;
  }
  if (month < 1 || month > 12 || day < 1 || day > daysInMonth[month - 1]) {
    return false;
  }
  return true;
}

function showpasswordupdate(idpassword) {
  var idcheck = idpassword.id;
  var passwordDiv = $("#" + idcheck + "")
    .parent()
    .parent()
    .next()
    .attr("id");
  $("#" + idcheck + "").change(function () {
    if (this.checked) {
      $("#" + passwordDiv + "").css("display", "block");
    } else {
      $("#" + passwordDiv + "").css("display", "none");
    }
  });
}

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
      $("#email_error").html("Adresse email invalid");
    } else if (password == "") {
      $("#password_error").html("Saisir votre mot de passe s'il vous plait.");
      $("#password").focus();
    } else {
      $.ajax({
        url: "login_fn.php",
        method: "post",
        data: {
          password: password,
          email: email,
        },
        success: function (data) {
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

function get_profil_record() {
  $.ajax({
    url: "get_client_record.php",
    method: "post",
    dataType: "JSON",
    success: function (data) {
      $("#userid").html(data[0]);
      $("#username").html(data[2] + " " + data[1]);
      $("#nameuser").html(data[2] + " " + data[1]);
      $("#useremail").html(data[5]);
      var userDateNaiss = data[7].split("-");
      var reversedUserDateNaiss =
        userDateNaiss[2] + "-" + userDateNaiss[1] + "-" + userDateNaiss[0];
      $("#userdataenaissance").html(reversedUserDateNaiss);
      $("#usertel").html(data[4]);
      $("#useradresse").html(data[10]);
      $("#userpaasword").val(data[6]);
      $("#userspecialité").html(data[12]);
      if (data[11] != "") {
        $("#profilphoto").attr("src", "uploads/" + data[11]);
      }
    },
  });
  $(document).on("click", "#up_profil_btn", function () {
    $("#passwordupdate").prop("checked", false);
    $("#passwordchange_form ").css("display", "none");

    var paragraphs = $("#up-profilForm").find("p");
    paragraphs.each(function() {
    $(this).html('');
    });
    $.ajax({
      url: "get_client_record.php",
      method: "post",
      dataType: "JSON",
      success: function (data) {
        $("#up_idProfil").val(data[0]);
        $("#up_profilNom").val(data[1]);
        $("#up_profilPrenom").val(data[2]);
        $("#up_profilDateNaissance").val(data[7]);
        $("#up_profilNumCin").val(data[3]);
        $("#up_profilEmail").val(data[5]);
        $("#up_profilPhone").val(data[4]);
        $("#up_profilAdresse").val(data[10]);
        var specialites = data[9].split(",");
        $("#up_profilspecialite").val(specialites);
        $("#up_profil_modal").modal("show");
      },
    });
  });
}
function update_profil_record() {
  $(document).on("click", "#btn_update_profil_user", function () {
    $("#up_profil_modal").scrollTop(0);
        var up_idprofil = $("#up_idProfil").val();
    var up_profilNom = $("#up_profilNom").val();
    var up_profilPrenom = $("#up_profilPrenom").val();
    var up_profilDateNaissance = $("#up_profilDateNaissance").val();
    var up_profilPhone = $("#up_profilPhone").val();
    var up_profilAdresse = $("#up_profilAdresse").val();
    var up_profilPhoto = $("#up_profilPhoto").prop("files")[0];
    var selectedspecialite = $("#up_profilspecialite option:selected")
      .map(function () {
        return $(this).val();
      })
      .get();
    up_profilactuelpassword = "";
    up_profilnouveaupassword = "";
    var isChecked = $("#passwordupdate").prop("checked");
    if (isChecked) {
      var up_profilactuelpassword = $("#actuelpasswordprofil").val();
      var up_profilnouveaupassword = $("#newpasswordprofil").val();
    }
    switch (true) {
      case up_profilNom == "":
        $(" #UpNomMessageErreur").html("Saisir votre nom s'il vous plaît");
        $(" #up_profilNom").focus();
        break;
      case up_profilPrenom == "":
        $(" #UpPrenomMessageErreur").html("Saisir votre prénom s'il vous plaît");
        $(" #up_profilPrenom").focus();
        break;
      case up_profilDateNaissance == "":
        $(" #UpNaissanceMessageErreur").html("Saisir votre date de naissance s'il vous plaît");
        $(" #up_profilDateNaissance").focus();
        break;
      case up_profilPhone == "":
        $(" #UpPhoneMessageErreur").html("Saisir votre numéro de téléphone s'il vous plaît");
        $(" #up_profilPhone").focus();
        break;
      case up_profilAdresse == "":
        $(" #UpAdresseMessageErreur").html("Saisir votre adresse s'il vous plaît");
        $(" #up_profilAdresse").focus();
        break;
      case isChecked && up_profilactuelpassword == "":
        $(" #UpPassMessageErreur").html("Saisir votre mot de passe actuel s'il vous plaît");
        $(" #actuelpasswordprofil").focus();
        $(" #actuelpasswordprofil").focus();
        break;
      case isChecked && up_profilnouveaupassword == "":
        $(" #UpNewPassMessageErreur").html("Saisir votre nouveau mot de passe actuel s'il vous plaît");
        $(" #newpasswordprofil").focus();
        break;
      default:
        var form_data = new FormData();
        form_data.append("up_idprofil", up_idprofil);
        form_data.append("up_profilNom", up_profilNom);
        form_data.append("up_profilPrenom", up_profilPrenom);
        form_data.append("up_profilDateNaissance", up_profilDateNaissance);
        form_data.append("up_profilPhone", up_profilPhone);
        form_data.append("up_profilAdresse", up_profilAdresse);
        form_data.append("up_profilPhoto", up_profilPhoto);
        form_data.append("selectedspecialite", selectedspecialite);
        form_data.append("up_profilactuelpassword", up_profilactuelpassword);
        form_data.append("up_profilnouveaupassword", up_profilnouveaupassword);
        $.ajax({
          url: "update_profil_record.php",
          method: "POST",
          processData: false,
          contentType: false,
          data: form_data,
          success: function (data) {
            if (data.includes("text-echec-update")) {
              $("#up_profil_modal").modal("hide");
              $("#upprofil_echec")
                .removeClass("text-checked")
                .addClass("text-echec")
                .html(data);
              $("#EchecUpProfil").modal("show");
              setTimeout(function () {
                $("#EchecUpProfil").modal("hide");
                location.reload();
              }, 3000);
            } else if (data.includes("text-echec-password")) {
              $("#UpPassMessageErreur").html(data);
              $(" #actuelpasswordprofil").focus();
            } else if (data.includes("text-echec-photo")) {
              $(" #UpPhotoMessageErreur").html(data);
              $(" #up_profilPhoto").focus();
            } else {
              $("#up_profil_modal").modal("hide");
              $("#upprtofil_success")
                .removeClass("text-echec")
                .addClass("text-checked")
                .html(data);
              $("#SuccessUpProfil").modal("show");

              setTimeout(function () {
                $("#SuccessUpProfil").modal("hide");
              }, 3000);
            }
          },
        });   
      }
  });
}
