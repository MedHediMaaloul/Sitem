<?php
include('connect_db.php');
session_start();

function Login(){
    global $conn ;
    $email=isset($_POST['email']) ? $_POST['email'] : null ;
    $password=isset($_POST['password']) ? $_POST['password'] : null ;

    //select email
    $selectEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$_POST['email']."' ");

    // select si le compte exist et actif
    $query=mysqli_query($conn,"select * from user as U
    left join role as R on R.id_role =U.id_role
    where password_user='$password' && email_user='$email' && etat_user='1'");

    if(mysqli_num_rows($selectEmail)>0) {
        $num_row = mysqli_num_rows($query);
    	$row= mysqli_fetch_array($selectEmail);
    	$status= $row['etat_user'];
        if ($num_row > 0) {
            $_SESSION['id_user'] = $row['id_user'];
            $_SESSION['nom_user'] = $row['nom_user'];
            $_SESSION['Role'] = $row['id_role'];
            $_SESSION['Specialite'] = $row['id_specialite'];
            $_SESSION['email_user'] = $row['email_user'];
            echo "<label class=\"myclass\">success</label>";
    	}else{
    		if ($status=='1') {
                echo "<label class=\"myclass\">Mot de passe incorrecte !</label>";
    		}else if ($status=='2') {
                echo "<label class=\"myclass\">Compte désactivé !</label>";
    		}else {
                echo "<label class=\"myclass\">Compte supprimé !</label>";
            }
        }
    }else{
        echo "<label class=\"myclass\">Compte introuvable !</label>";
    }
}

function viewUser(){
    global $conn;
    $value = '
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Nom </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Prénom </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-pen"></i> Cin </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-phone"></i> Téléphone</th>
                <th style="text-align: center;" class="border-top-0" class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Date de Naissance </th>
                <th style="text-align: center;" class="border-top-0"><i class=" fa fas fa-map-marker-alt"></i> Adresse</th>
                <th style="text-align: center;" class="border-top-0"><i class="fas fa-graduation-cap"></i> Specialité</th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-image"></i> Photo</th>
                <th style="text-align: center;" class="border-top-0">Actions</th>
            </tr>
        </thead>';

    $query = "SELECT * FROM user WHERE etat_user != '0' ORDER BY etat_user ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $query_sepcialite = "SELECT * FROM specialite";
        $result_sepcialite = mysqli_query($conn, $query_sepcialite);
        $table_specialite =explode(",",$row['id_specialite']);
        $user_data="";
        while ($row_specialite = mysqli_fetch_assoc($result_sepcialite)) {
            if (in_array( $row_specialite['id_specialite'],  $table_specialite )){
                $user_data=$user_data.' '.$row_specialite['nom_specialite'].' /';
            }
        }
        if( substr($user_data, -1)=="/"){
            $user_data =substr($user_data, 0, -1);   
        }

        $value .= '<tbody>
            <tr>
                <td style="text-align: center;">' . $row['nom_user'] . '</td>
                <td style="text-align: center;">' . $row['prenom_user'] . '</td>
                <td style="text-align: center;">' . $row['cin_user'] . '</td>
                <td style="text-align: center;">' . $row['numTel_user'] . '</td>
                <td style="text-align: center;">' . $row['email_user'] . '</td>
                <td style="text-align: center;">' . $row['date_naissance_user'] . '</td>
                <td style="text-align: center;">' . $row['adresse_user'] . '</td>
                <td style="text-align: center;">' . $user_data . '</td>
                <td style="text-align: center;"><a ' . (($row["photo_user"] != "") ? "href='uploads/user/{$row["photo_user"]}'" : "") . '" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
                <td style="text-align: center;">
                    <div class="btn-group">';
                        if($row['etat_user'] == '1'){
            $value .= '<button type="button" style="margin-right: 3px;" class="btn btn-success" id="btn_desactiver_user" data-id2=' . $row['id_user'] . '><i class="fas fa-check"></i></button>';
        }
                        if($row['etat_user'] == '2'){
            $value .= '<button type="button" style="margin-right: 3px;" class="btn btn-outline-success" id="btn_activer_user" data-id3=' . $row['id_user'] . '><i class="fas fa-check"></i></button>';
        }
        $value .= '<button type="button" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifier_user" data-id=' . $row['id_user'] . '><i class="fa fa-pen fa-1x"></i></button>
                        <button type="button" class="btn btn-danger" id="btn_supprimer_user" data-id1=' . $row['id_user'] . '><i class="fa fa-trash fa-1x"></i></button>
                    </div>
                </td>
            </tr>';
    }
    $value .= '</tbody></table>';
    echo json_encode(['status' => 'success', 'html' => $value]);
}

    	
function addUser(){
	global $conn ;
	$role= $_POST['role'];
	$specialite=isset($_POST['specialite']) ? $_POST['specialite'] : null ;
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $address = $_POST['address'];
    $numCIN = $_POST['numCIN'];
    $email = $_POST['email'];
    $numTel = $_POST['numTel'];
    $dateNaissance = $_POST['dateNaissance'];
    $password = $_POST['password'];
	$doc_photoProfile=isset($_FILES["doc_photoProfile"]) ? $_FILES['doc_photoProfile'] : "" ;
    $photoProfile_filname = "";

    if ($doc_photoProfile != "") {
        $photoProfile_filname = $numCIN . "." . strtolower(pathinfo($doc_photoProfile["name"], PATHINFO_EXTENSION));
        move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/user/" . $photoProfile_filname);
    }

    $selectEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$_POST['email']."' ");
	$row= mysqli_fetch_array($selectEmail);
    while ($row = mysqli_fetch_assoc($selectEmail)) {
		$status= $row['etat_user'];
    }
	$selectCIN = mysqli_query($conn, "SELECT * FROM user WHERE cin_user!='0' and cin_user = '".$_POST['numCIN']."'");

	if(mysqli_num_rows($selectEmail)) {
		if ($status!="0"){
            echo "<div class='text-echec'>L'email est déjà utilisée</div> ";
		}else{
            echo "<div class='text-echec'>L'email est supprimé, contactez votre administrateur.</div> ";
        }
	}else if(mysqli_num_rows($selectCIN)) {
        echo "<div class='text-echec'>Ce numéro de CIN est déjà utilisé</div> ";
	}else {
		$query= "INSERT into user(nom_user,prenom_user,cin_user,numTel_user,email_user,password_user,date_naissance_user,id_role,id_specialite,adresse_user,photo_user,etat_user)
		values('$nom','$prenom','$numCIN','$numTel','$email','$password','$dateNaissance','$role','$specialite','$address','$photoProfile_filname','1')";
		$result=mysqli_query($conn,$query);
        if ($result) {
            echo "<div class='text-success'>L'utilisateur est ajouté avec succès</div>";
        } else {
            echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
        }
    }
}


    function disableAccount(){

    global $conn;
    $id_user = $_POST['user_ID'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE user SET etat_user='2',date_updated_user='$date' WHERE id_user='$id_user'";
    	$result=mysqli_query($conn,$query);
    if ($result) {
        echo "<div class='text-success'>Le compte est désactivé avec succès</div>";
    } else {
        echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    }
}

	function activateAccount(){

    global $conn;
    $id_user = $_POST['user_ID'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE user SET etat_user='1',date_updated_user='$date' WHERE id_user='$id_user'";
    	$result=mysqli_query($conn,$query);
    if ($result) {
        echo "<div class='text-success'>Le compte est activé avec succès</div>";
    } else {
        echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    }
}

	function deleteUser(){

    global $conn;
    $id_user = $_POST['DeleteID'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE user SET etat_user='0', date_updated_user='$date' WHERE id_user='$id_user'";
		$result=mysqli_query($conn,$query);
    if ($result) {
        echo "<div class='text-success'>L'utilisateur est supprimé avec succès</div>";
    } else {
        echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    }
}


function get_dataUser()
{
    global $conn;
    $idUser = $_POST['update_ID'];

    $query = "SELECT * FROM user WHERE id_user='$idUser'";

    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
			$update_user= [];
        $update_user[0] = $idUser;
        $update_user[1] = $row['id_role'];
        $update_user[2] = $row['id_specialite'];
        $update_user[3] = $row['nom_user'];
        $update_user[4] = $row['prenom_user'];
        $update_user[5] = $row['email_user'];
        $update_user[6] = $row['cin_user'];
        $update_user[7] = $row['numTel_user'];
        $update_user[8] = $row['adresse_user'];
        $update_user[9] = $row['date_naissance_user'];

		
			
    }
    echo json_encode($update_user);
}

	function updateUser(){
		global $conn ;
    $date = date('Y-m-d H:i:s');
		$idUser= $_POST['idUser'];
		$role=$_POST['role'];
		$specialite=$_POST['specialite'];
		$nom=$_POST['nom'];
		$prenom=$_POST['prenom'];
		$address=$_POST['address'];
		$numCIN=$_POST['numCIN'];
		$email=$_POST['email'];
		$numTel=$_POST['numTel'];
		$dateNaissance=$_POST['dateNaissance'];
		$password=$_POST['password'];
		$newPassword=$_POST['newPassword'];

	    $doc_photoProfile=isset($_FILES["doc_photoProfile"]) ? $_FILES['doc_photoProfile'] : "" ;
    $photoProfile_filname = "";

		if ($doc_photoProfile != ""){
        $photoProfile_filname = $numCIN . "." . strtolower(pathinfo($doc_photoProfile["name"], PATHINFO_EXTENSION));
        move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/user/" . $photoProfile_filname);
    }

    $selectEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user='$email' and  id_user!='$idUser'");
    // $row= mysqli_fetch_array($selectEmail);
    while ($row = mysqli_fetch_assoc($selectEmail)) {

		$status= $row['etat_user'];
    }
    $selectCIN = mysqli_query($conn, "SELECT * FROM user WHERE cin_user='$numCIN' and  id_user!='$idUser'");
    $resultSelectUser = mysqli_query($conn, "SELECT * FROM user WHERE id_user='$idUser'");

    while ($row = mysqli_fetch_assoc($resultSelectUser)) {

			if($password==$row['password_user'] && $newPassword!=""){
				$password=$newPassword;
			}else {				
				$password=$row['password_user'];
        }

			if($doc_photoProfile == "")
			{      
				$photoProfile_filname=$row['photo_user'];
        }
    }

		if(mysqli_num_rows($selectEmail)) {
			if ($status!="0"){
            echo "<div class='text-echec'>L'email est déjà utilisée</div> ";
			}else{
            echo "<div class='text-echec'>L'email est supprimé, contactez votre administrateur.</div> ";
        }
		}else if(mysqli_num_rows($selectCIN)) {
        echo "<div class='text-echec'>Ce numéro de CIN est déjà utilisé</div> ";
		}else {

        $query = "UPDATE user SET nom_user='$nom',prenom_user='$prenom',cin_user='$numCIN',numTel_user='$numTel',email_user='$email',password_user='$password',date_naissance_user='$dateNaissance',id_role='$role',id_specialite='$specialite',adresse_user='$address',photo_user='$photoProfile_filname', date_updated_user='$date' WHERE id_user='$idUser'";

			$result=mysqli_query($conn,$query);

        if ($result) {
            echo "<div class='text-success'>Les informations sont mises à jour avec succès</div>";
        } else {
            echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
        }
    }

}

	function getProfilRecord(){
		global $conn ;
		$iduser= $_SESSION['id_user'];
    $query = "SELECT * FROM user
                  WHERE id_user= '$iduser' AND etat_user='1'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_data = [];
    $user_data[0] = $row['id_user'];
    $user_data[1] = $row['nom_user'];
    $user_data[2] = $row['prenom_user'];
    $user_data[3] = $row['cin_user'];
    $user_data[4] = $row['numTel_user'];
    $user_data[5] = $row['email_user'];
    $user_data[6] = $row['password_user'];
    $user_data[7] = $row['date_naissance_user'];
    $user_data[8] = $row['id_role'];
    $user_data[9] = $row['id_specialite'];
    $user_data[10] = $row['adresse_user'];
    $user_data[11] = $row['photo_user'];
    $table_specialite = explode(",", $user_data[9]);
            $user_data[12]="";
    $query_sepcialite = "SELECT * FROM specialite";
    $result_sepcialite = mysqli_query($conn, $query_sepcialite);
    while ($row_specialite = mysqli_fetch_assoc($result_sepcialite)) {
        if (in_array($row_specialite['id_specialite'], $table_specialite)) {
            $user_data[12] = $user_data[12] . ' ' . $row_specialite['nom_specialite'] . ' /';
        }
    }
    if (substr($user_data[12], -1) == "/") {
        $user_data[12] = substr($user_data[12], 0, -1);
    }
    echo json_encode($user_data);
}

function updateProfilRecord()
{
    global $conn;
    $date = date('Y-m-d H:i:s');
    $up_idprofil = $_POST["up_idprofil"];
    $up_profilNom = $_POST['up_profilNom'];
    $up_profilPrenom = $_POST['up_profilPrenom'];
    $up_profilDateNaissance = $_POST['up_profilDateNaissance'];
    $up_profilPhone = $_POST['up_profilPhone'];
    $up_profilAdresse = $_POST['up_profilAdresse'];
    $selectedspecialite = $_POST['selectedspecialite'];
    $up_profilPhoto = isset($_FILES['up_profilPhoto']) ? $_FILES['up_profilPhoto'] : "";
    $up_profilactuelpassword = $_POST['up_profilactuelpassword'];
    $up_profilnouveaupassword = $_POST['up_profilnouveaupassword'];

    $querypassword = "SELECT * FROM user
                WHERE id_user= '$up_idprofil' ";
    $result_password = mysqli_query($conn, $querypassword);
    $row_profil = mysqli_fetch_assoc($result_password);

    if ($up_profilPhoto != "") {
        $Namefile_photo_profil = $row_profil['cin_user'];
        $emplacement_photoProfil = "uploads/user/";
        $file_photo_profil = $emplacement_photoProfil . basename($_FILES["up_profilPhoto"]["name"]);
        $uploadOk_photo_profil = 1;
        $type_passport = strtolower(pathinfo($file_photo_profil, PATHINFO_EXTENSION));
        if ($type_passport != "jpg" && $type_passport != "png" && $type_passport != "jpeg" && $type_passport != "gif") {
            echo "<div class='text-echec-photo'>les formats autorisés sont JPG, JPEG, PNG et GIF.</div>";
            $uploadOk_photo_profil = 0;
            return;
        }
        if ($uploadOk_photo_profil != 0) {
            move_uploaded_file($_FILES["up_profilPhoto"]["tmp_name"], $emplacement_photoProfil . $Namefile_photo_profil . "." . $type_passport);
            $up_profilPhoto = $Namefile_photo_profil . "." . $type_passport;
        }
    } else {
        $up_profilPhoto = $row_profil['photo_user'];
    }
    if ($up_profilactuelpassword != "") {
        if ($row_profil['password_user'] != $up_profilactuelpassword) {
            echo "<div class='text-echec-password'>SVP verifier le passe actuelle !</div>";
            return;
        }
    } else {
        $up_profilnouveaupassword = $row_profil['password_user'];
    }
    $query_update_profil = "UPDATE `user` SET
        `nom_user`='$up_profilNom',
        `prenom_user`='$up_profilPrenom',
        `numTel_user`=' $up_profilPhone',
        `password_user`= '$up_profilnouveaupassword',
        `date_naissance_user`='$up_profilDateNaissance',
        `id_specialite`='$selectedspecialite',
        `adresse_user`=' $up_profilAdresse',
        `photo_user`= '$up_profilPhoto',
        `date_updated_user`='$date'
        WHERE id_user='$up_idprofil'";
    $result_update_profil = mysqli_query($conn, $query_update_profil);
    if (!$result_update_profil) {
        echo "<div class='text-echec-update'>Vous avez rencontré un problème lors de la mise à jour du profil !</div>";
        return;
    } else {
        echo "<div class='text-checked'>Le profil a été mis à jour avec succès ! </div>";
        return;
    }
}

/* Materiel */

function addMateriel()
{
    global $conn;
    $facture = isset($_FILES['facture']) ? $_FILES['facture'] : "";
    $nom = $_POST['nom'];
    $prix = $_POST['prix'];
    $EmplyeeID = $_POST['EmplyeeID'];
    $dateAchat = $_POST['dateAchat'];
    $querymateriel = "INSERT into materiel(nom_materiel,prix_materiel,date_achat_materiel,id_user_materiel)
		values('$nom','$prix','$dateAchat','$EmplyeeID')";
    $result = mysqli_query($conn, $querymateriel);
    $lastId = mysqli_insert_id($conn);
    if ($facture != "") {
        $Namefile_facture = $lastId;
        $emplacement_facture = "uploads/materiel/" . $lastId;
        $file_facture = $emplacement_facture . basename($_FILES["facture"]["name"]);
        $type_facture = strtolower(pathinfo($file_facture, PATHINFO_EXTENSION));
        $emplacement_facture = $emplacement_facture . "." . $type_facture;
        move_uploaded_file($_FILES["facture"]["tmp_name"], $emplacement_facture);
        $facture = $Namefile_facture . "." . $type_facture;
    }

    $queryFacture = "UPDATE `materiel` SET `piece_joint_materiel`='$facture' WHERE id_materiel='$lastId'";
    $result = mysqli_query($conn, $queryFacture);
    if ($querymateriel && $queryFacture) {
        echo "<div class='text-success'>Le materiel est ajouté avec succès</div>";
    } else {
        echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    }
}

function viewMateriel()
{
    global $conn;
    $IdRole = $_SESSION['Role'];
    $IdUser=$_SESSION['id_user'] ;
    $value = '
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Nom du matériel</th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Prix de matériel </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-pen"></i> Date d\'achat </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-phone"></i> Nom d\'utilisateur </th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Facture </th>
                <th style="text-align: center;" class="border-top-0">Actions</th>
            </tr>
        </thead>';
    
        $query = "SELECT * FROM materiel AS M
             LEFT JOIN user AS U ON U.id_user = M.id_user_materiel
              WHERE M.etat_materiel = '1'
              ORDER BY U.id_user ASC";
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        $value .= '<tbody>
            <tr>
                <td style="text-align: center;">' . $row['nom_materiel'] . '</td>
                <td style="text-align: center;">' . $row['prix_materiel'] . '</td>
                <td style="text-align: center;">' . $row['date_achat_materiel'] . '</td>
                <td style="text-align: center;">' . $row['prenom_user'] . " " . $row['nom_user'] . '</td>
                <td style="text-align: center;"><a ' . (($row["piece_joint_materiel"] != "") ? "href='uploads/materiel/{$row["piece_joint_materiel"]}'" : "") . '" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
                <td style="text-align: center;">
                    <div class="btn-group">
                <button type="button" title="Modifier Materiel" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifier_materiel" data-id=' . $row['id_materiel'] . '><i class="fa fa-pen fa-1x"></i></button>
                        <button type="button" title="Supprimer Materiel"  class="btn btn-danger" id="btn_supprimer_materiel" data-id1=' . $row['id_materiel'] . '><i class="fa fa-trash fa-1x"></i></button>
                    </div>
                </td>
            </tr>';
    }
    $value .= '</tbody></table>';
    echo json_encode(['status' => 'success', 'html' => $value]);
}

function getMaterielRecord(){
    global $conn;
    $IDMateriel = $_POST['IDMateriel'];
    $query = "SELECT * FROM materiel AS M
    LEFT JOIN user AS U ON U.id_user = M.id_user_materiel
     WHERE M.id_materiel = '$IDMateriel'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $user_data = [];
    $user_data[0] = $row['id_materiel'];
    $user_data[1] = $row['nom_materiel'];
    $user_data[2] = $row['prix_materiel'];
    $user_data[3] = $row['date_achat_materiel'];
    $user_data[4] = $row['id_user_materiel'];
        echo json_encode($user_data);
}

function updateMaterielRecord(){
    global $conn;
    $date = date('Y-m-d H:i:s');
    $up_idMateriel = $_POST["up_idMateriel"];
    $up_nom_materiel = $_POST['up_nom_materiel'];
    $up_prix_materiel = $_POST['up_prix_materiel'];
    $up_date_acha_materiel = $_POST['up_date_acha_materiel'];
    $up_facture_materiel = isset($_FILES['up_facture_materiel']) ? $_FILES['up_facture_materiel'] : "";

    if ($up_facture_materiel != "") {
        $Namefile_photo_materiel = $up_idMateriel;
        $emplacement_photoMateriel = "uploads/materiel/";
        $file_photo_materiel = $emplacement_photoMateriel . basename($_FILES["up_facture_materiel"]["name"]);
        $type_materiel = strtolower(pathinfo($file_photo_materiel, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["up_facture_materiel"]["tmp_name"], $emplacement_photoMateriel . $Namefile_photo_materiel . "." . $type_materiel);
            $up_facture_materiel = $Namefile_photo_materiel . "." . $type_materiel;
    }
    $query_update_materiel = "UPDATE `materiel` SET
    `nom_materiel`='$up_nom_materiel',
    `prix_materiel`='$up_prix_materiel',
    `date_achat_materiel`='$up_date_acha_materiel',
    `piece_joint_materiel` = CASE WHEN '$up_facture_materiel' != '' THEN '$up_facture_materiel' ELSE `piece_joint_materiel` END,
    `date_updated_materiel`='$date'
    WHERE id_materiel ='$up_idMateriel'";
    $result_update_materiel = mysqli_query($conn, $query_update_materiel);
    if (!$result_update_materiel) {
        echo "<div class='text-echec'>Vous avez rencontré un problème lors de la mise à jour du materiel !</div>";
        return;
    } else {
        echo "<div class='text-checked'>Le materiel a été mis à jour avec succès ! </div>";
        return;
    } 
}

function deleteMateriel()
{

    global $conn;
    $id_materiel = $_POST['id_materiel'];
    $date = date('Y-m-d H:i:s');
    $query = "UPDATE materiel SET etat_materiel='0', date_updated_materiel='$date' WHERE id_materiel ='$id_materiel'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "<div class='text-success'>Le materiel est supprimé avec succès</div>";
    } else {
        echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    }
}
