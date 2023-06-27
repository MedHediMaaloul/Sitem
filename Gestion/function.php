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
    			$_SESSION['id_user']=$row['id_user'];
    			$_SESSION['nom_user']=$row['nom_user'];
        		$_SESSION['Role']=$row['id_role'];
    			$_SESSION['Specialite']=$row['id_specialite'];
        		$_SESSION['email_user']=$row['email_user'];
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
    //User
    function viewUser(){
        global $conn;
        $value = '
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Nom </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Prénom </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-address-card"></i> Cin </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-phone"></i> Téléphone</th>
                    <th style="text-align: center;" class="border-top-0" class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-calendar-alt"></i> Date de Naissance </th>
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
                    <td style="text-align: center;">' . $user_data. '</td>
                    <td style="text-align: center;"><a '.(($row["photo_user"]!="")?"href='uploads/user/{$row["photo_user"]}'":"").'" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
                    <td style="text-align: center;">
                        <div class="btn-group">';
                            if($row['etat_user'] == '1'){
                                $value .= '<button type="button" title="Désactiver Utilisateur" style="margin-right: 3px;" class="btn btn-success" id="btn_desactiver_user" data-id2=' . $row['id_user'] . '><i class="fas fa-check"></i></button>'; 
                            }
                            if($row['etat_user'] == '2'){
                                $value .= '<button type="button" title="Activer Utilisateur" style="margin-right: 3px;" class="btn btn-outline-success" id="btn_activer_user" data-id3=' . $row['id_user'] . '><i class="fas fa-check"></i></button>'; 
                            }
                            $value .= '<button type="button" style="margin-right: 3px;" title="Modifier Utilisateur" class="btn btn-primary" id="btn_modifier_user" data-id=' . $row['id_user'] . '><i class="fa fa-pen fa-1x"></i></button> 
                            <button type="button" class="btn btn-danger" title="Supprimer Utilisateur" id="btn_supprimer_user" data-id1=' . $row['id_user'] . '><i class="fa fa-trash fa-1x"></i></button> 
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
    
    	if ($doc_photoProfile != ""){
    		$photoProfile_filname = $numCIN . "." . strtolower(pathinfo($doc_photoProfile["name"], PATHINFO_EXTENSION));
    		move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/user/".$photoProfile_filname);
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
    		$query= "INSERT into user(nom_user,prenom_user,cin_user,numTel_user,email_user,password_user,date_naissance_user,id_role,id_specialite,adresse_user,photo_user)
    		values('$nom','$prenom','$numCIN','$numTel','$email','$password','$dateNaissance','$role','$specialite','$address','$photoProfile_filname')";
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
			move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/user/".$photoProfile_filname);
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

    //Profile
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
    
    //Project
    function viewProject(){
        global $conn;
        $value = '
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Client </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-pen"></i> Nom du projet</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Chef de projet </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-bookmark"></i> Description </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-calendar-alt"></i> Date de début</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-calendar-alt"></i> Date de fin</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-check"></i> Confirmation</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-history"></i> Etat</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-tasks"></i> Tâche</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-upload"></i> Pièce jointe</th>
                    <th style="text-align: center;" class="border-top-0">Actions</th>
                </tr>            
            </thead>';
            $id_user = $_SESSION['id_user'];
            if($_SESSION['Role']==1){ 
                $query = "SELECT * 
                FROM projet as P
                LEFT JOIN user as U ON U.id_user =P.chef_projet
                LEFT JOIN client AS C ON C.id_client = P.nom_client_projet
                where etat_projet !='0' and U.id_user =$id_user
                ORDER BY date_created_projet ASC";
            }else{
                $query = "SELECT * 
                FROM projet as P
                LEFT JOIN user as U ON U.id_user =P.chef_projet
                LEFT JOIN client AS C ON C.id_client = P.nom_client_projet
                where etat_projet !='0' 
                ORDER BY date_created_projet ASC";
            }   
        
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            if($row['etat_projet'] != "0" && $row['etat_projet'] != "3"){
                    $value .= '<tbody>
                        <tr>
                            <td style="text-align: center;">' . $row['nom_client_projet'] . '</td>
                            <td style="text-align: center;">' . $row['nom_projet'] . '</td>
                            <td style="text-align: center;">' . $row['nom_user'] . ' ' . $row['prenom_user'] . '</td>
                            <td style="text-align: center;">' . $row['description_projet'] . '</td>
                            <td style="text-align: center;">' . $row['date_debut_projet'] . '</td>
                            <td style="text-align: center;">' . $row['date_fin_projet'] . '</td>';
                                                       
                            if($row['confirmation_projet'] == "1"){
                                $value .= ' <td style="text-align: center;">Confirmé</td>';
                            }else{
                                $value .= ' <td style="text-align: center;">Non Confirmé</td>';
                            } 
                            if($row['etat_projet'] == "1"){
                                $value .= ' <td style="text-align: center;background-color:#C1FFEC;" width="100px">En attente</td>';
                            }else if($row['etat_projet'] == "2"){
                                $value .= ' <td style="text-align: center; background-color:#7DFFD6;" width="100px">En cours</td>';
                            }
                            $value .= '
                            <td style="text-align: center;"><a href="tache.php?id_project=' . $row['id_projet'] . '" >Consulter les tâches </a></td>
                            <td style="text-align: center;"><a '.(($row["piece_joint_projet"]!="")?"href='uploads/projet/{$row["piece_joint_projet"]}'":"").'" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
                            ';
                            
                            if (($_SESSION['Role']) != "1") {
                                $value .= ' 
                                <td style="text-align: center;">
                                    <div class="btn-group">
                                        <button type="button" title="Modifier Projet" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifier_projet" data-id=' . $row['id_projet'] . '><i class="fa fa-pen fa-1x"></i></button> 
                                        <button type="button" title="Supprimer Projet" class="btn btn-danger" id="btn_supprimer_projet" data-id1=' . $row['id_projet'] . '><i class="fa fa-trash fa-1x"></i></button> 
                                    </div>
                                </td>';
                            } else {
                                $value .= '
                                <td>
                                    <button type="button" title="Modifier Etat Projet" class="btn btn-primary" id="btn_modifier_Etatprojet" data-id2=' . $row['id_projet'] . '><i class="fa fa-pen fa-1x"></i></button> 
                                </td>';
                            }
                        $value .= ' </tr>';
            }
        }
        $value .= '</tbody></table>';
        echo json_encode(['status' => 'success', 'html' => $value]);
    }
            

    function deleteProject(){
  
		global $conn;
		$id_project = $_POST['DeleteID'];
		$date = date('Y-m-d H:i:s');
		$query = "UPDATE projet SET etat_projet ='0',date_updated_projet='$date' WHERE id_projet='$id_project'";
		$result=mysqli_query($conn,$query);
		if ($result) {
			echo "<div class='text-success'>Le projet est supprimé avec succès</div>";
		} else {
			echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
		}
	}

    function addProject(){
    	global $conn ;

    	$nom_projet= isset($_POST['nom_projet']) ? $_POST['nom_projet'] : null ;
    	$client = isset($_POST['client']) ? $_POST['client'] : null ;
    	$chef_projet = isset($_POST['chef_projet']) ? $_POST['chef_projet'] : null ;
    	$description = isset($_POST['description']) ? $_POST['description'] : null ;
    	$dateDebutprojet = isset($_POST['dateDebutprojet']) ? $_POST['dateDebutprojet'] : null ;
    	$dateFinprojet = isset($_POST['dateFinprojet']) ? $_POST['dateFinprojet'] : null ;
        $confirmationProjet=$_POST['confirmationProjet'];
    	$doc_projet=isset($_FILES["doc_projet"]) ? $_FILES['doc_projet'] : "" ;

    	$doc_projet_filname = "";
    
    	if ($doc_projet != ""){
    		$doc_projet_filname = $nom_projet . "." . strtolower(pathinfo($doc_projet["name"], PATHINFO_EXTENSION));
    		move_uploaded_file($doc_projet["tmp_name"], "uploads/projet/".$doc_projet_filname);
    	}
        $query= "INSERT into projet(nom_projet,date_debut_projet,date_fin_projet,description_projet,chef_projet,nom_client_projet,piece_joint_projet, confirmation_projet)
        values('$nom_projet','$dateDebutprojet','$dateFinprojet','$description','$chef_projet','$client','$doc_projet_filname','$confirmationProjet')";
    
    	$result=mysqli_query($conn,$query);
    	if ($result) {
    		echo "<div class='text-success'>Le projet est ajouté avec succès</div>";
    	} else {
    		echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    	}
    	
    }

    function get_dataEtat()
	{
		global $conn;
		$idProject = $_POST['update_ID'];
	
		$query = "SELECT etat_projet FROM projet WHERE id_projet='$idProject'";
	
	
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $etat_data = [];
            $etat_data[0] = $idProject;
            $etat_data[1] = $row['etat_projet'];            
        }
        echo json_encode($etat_data);
	}

    function update_etatProject(){
        global $conn;
        $date = date('Y-m-d H:i:s');
        $etat = $_POST['etat'];
        $id_projet = $_POST['id_projet'];
    
    
        $query = "UPDATE projet SET etat_projet='$etat',date_updated_projet='$date' WHERE id_projet='$id_projet'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "L'etat est modifie avec succès ";
        } else {
            echo "<div class='text-danger'> Veuillez vérifier votre requête</div> ";
        }
    }
    
    function get_dataProject()
	{
		global $conn;
		$idProject = $_POST['update_ID'];
	
		$query = "SELECT * FROM projet WHERE id_projet='$idProject'";
	
		$result = mysqli_query($conn, $query);
	
		while ($row = mysqli_fetch_assoc($result)) {
			$update_project= [];
			$update_project[0] = $idProject;
			$update_project[1] = $row['nom_projet'];
			$update_project[2] = $row['date_debut_projet'];
			$update_project[3] = $row['date_fin_projet'];
			$update_project[4] = $row['description_projet'];
			$update_project[5] = $row['chef_projet'];
			$update_project[6] = $row['nom_client_projet'];
			$update_project[7] = $row['confirmation_projet'];
			
		}
		echo json_encode($update_project);
	}
    
	
    function updateProject(){
		global $conn ;
		$date = date('Y-m-d H:i:s');
        $idProject = $_POST['update_ID'];
        $nom_projet= $_POST['nom_projet'];
        $client = $_POST['client'];
        $chef_projet = $_POST['chef_projet'];
        $description = $_POST['description'];
        $dateDebutprojet = $_POST['dateDebutprojet'];
        $dateFinprojet = $_POST['dateFinprojet'];
        $confirmationProjet=$_POST['confirmationProjet'];
	    $doc_projet=isset($_FILES["doc_projet"]) ? $_FILES['doc_projet'] : "" ;

	    $doc_projet_filname = "";

        if ($doc_projet != ""){
            $doc_projet_filname = $nom_projet . "." . strtolower(pathinfo($doc_projet["name"], PATHINFO_EXTENSION));
            move_uploaded_file($doc_projet["tmp_name"], "uploads/projet/".$doc_projet_filname);
        }
    	$query = "UPDATE projet SET nom_projet='$nom_projet',date_debut_projet='$dateDebutprojet',date_fin_projet='$dateFinprojet',description_projet='$description',chef_projet='$chef_projet',nom_client_projet='$client',piece_joint_projet='$doc_projet_filname',confirmation_projet='$confirmationProjet',date_updated_projet='$date' WHERE id_projet='$idProject'";

        $result=mysqli_query($conn,$query);
        
	    if ($result) {
            echo "<div class='text-success'>Les informations sont mises à jour avec succès</div>";					    		
	    } else {
            echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
	    }
        
	}
    
    function viewTache(){
        global $conn;
		$id_project = $_POST['id_project'];
        $query="select * from user as U
        left join projet as P on P.chef_projet =U.id_user where P.id_projet ='$id_project'";
    
        $result_chef_projet = mysqli_query($conn, $query);
        while ($row1 = mysqli_fetch_assoc($result_chef_projet)) {
            $chef_projet= $row1['chef_projet'];
            $chefName=$row1['nom_user'] . ' ' . $row1['prenom_user'];
            $nomProject= $row1['nom_projet'];
        }
        
        $value = '
        <table class="table table-striped align-middle">
            <thead>
                <tr>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-list"></i> Id tâche</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-bookmark"></i> Description </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Chef de projet </th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-calendar-alt"></i> Date de début du tâche</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fas fa-calendar-alt"></i> Date de fin du tâche</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-history"></i> Etat</th>
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-upload"></i> Pièce jointe</th>';
                    if($chef_projet==$_SESSION['id_user']){
                        $value .= ' 
                    <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Employées </th>';
                    }
                    $value .= ' <th style="text-align: center;" class="border-top-0">Actions</th>
                </tr>            
            </thead>';
        
           
            if($chef_projet==$_SESSION['id_user']){
                $query1 = "SELECT * FROM tache where id_projet='$id_project' and etat_tache !='0'";

            }else {
                $query1 = "SELECT * FROM tache ";

            }
        $i=1;
        $result = mysqli_query($conn, $query1);
        while ($row = mysqli_fetch_assoc($result)) {

            $query_sepcialite = "SELECT * FROM user";
            $result_sepcialite = mysqli_query($conn, $query_sepcialite);
            $table_specialite =explode(",",$row['id_users']);
            $user_data="";
            while ($row_specialite = mysqli_fetch_assoc($result_sepcialite)) {
                if (in_array( $row_specialite['id_user'],  $table_specialite )){
                    $user_data=$user_data.' '.$row_specialite['nom_user'].' '.$row_specialite['prenom_user'].' /';
                }
            }   
            if( substr($user_data, -1)=="/"){
                $user_data =substr($user_data, 0, -1);   
            }
    

                    $value .= '<tbody>
                        <tr>
                            <td style="text-align: center;">' . $i++ . '</td>
                            <td style="text-align: center;">' . $row['description_tache'] . '</td>
                            <td style="text-align: center;">' . $chefName . '</td>
                            <td style="text-align: center;">' . $row['date_debut_tache'] . '</td>
                            <td style="text-align: center;">' . $row['date_fin_tache'] . '</td>';                                                       
                           
                            if($row['etat_tache'] == "1"){
                                $value .= ' <td style="text-align: center;background-color:#C1FFEC;" width="100px">En attente</td>';
                            }else if($row['etat_tache'] == "2"){
                                $value .= ' <td style="text-align: center; background-color:#7DFFD6;" width="100px">En cours</td>';
                            }else if($row['etat_tache'] == "3") {
                                $value .= ' <td style="text-align: center;background-color:#05DD9A; " width="100px">Terminé</td>';
                            }
                            $value .= '
                            <td style="text-align: center;"><a '.(($row["piece_joint_tache"]!="")?"href='uploads/projet/tache/{$row["piece_joint_tache"]}'":"").'" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
                            ';
                            
                            if($chef_projet==$_SESSION['id_user']){
                                $value .= ' 
                                <td style="text-align: center;">' .$user_data. '</td>
                                <td style="text-align: center;">
                                    <div class="btn-group">
                                        <button type="button" title="Modifier tâche" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifierTache" data-id=' . $row['id_tache'] . '><i class="fa fa-pen fa-1x"></i></button> 
                                        <button type="button" title="Supprimer tâche" class="btn btn-danger" id="btn_supprimerTache" data-id1=' . $row['id_tache'] . '><i class="fa fa-trash fa-1x"></i></button> 
                                    </div>
                                </td>';
                            } else {
                                $value .= '
                                <td>
                                    <button type="button" title="Modifier etat tâche" class="btn btn-primary" id="btn_modifier_EtatTache" data-id2=' . $row['id_tache'] . '><i class="fa fa-pen fa-1x"></i></button> 
                                </td>';
                            }
                        $value .= ' </tr>';
            }
        
        $value .= '</tbody></table>';
        echo json_encode(['status' => 'success', 'html' => $value]);
    }

    
    function addTache(){
    	global $conn ;
    	$id_project = isset($_POST['id_project']) ? $_POST['id_project'] : null ;
    	$description = isset($_POST['description']) ? $_POST['description'] : null ;
    	$dateDebutTache = isset($_POST['dateDebutTache']) ? $_POST['dateDebutTache'] : null ;
    	$dateFinTache = isset($_POST['dateFinTache']) ? $_POST['dateFinTache'] : null ;
    	$employee=isset($_POST['employee']) ? $_POST['employee'] : null ;
    	$doc_tache=isset($_FILES["doc_tache"]) ? $_FILES['doc_tache'] : "" ;
    	$doc_tache_filname = "";
    
    	if ($doc_tache != ""){
    		$doc_tache_filname = "tache" . "." . strtolower(pathinfo($doc_tache["name"], PATHINFO_EXTENSION));
    		move_uploaded_file($doc_tache["tmp_name"], "uploads/projet/tache/".$doc_tache_filname);
    	}
        $query= "INSERT INTO tache(description_tache, id_projet, date_debut_tache, date_fin_tache, piece_joint_tache, id_users) 
        VALUES ('$description','$id_project','$dateDebutTache','$dateFinTache','$doc_tache_filname','$employee')";
    
    	$result=mysqli_query($conn,$query);
    	if ($result) {
    		echo "<div class='text-success'>La tâche du projet est ajouté avec succès</div>";
    	} else {
    		echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    	}
    	
    }

    
	function deleteTache(){
  
		global $conn;
		$id_tache = $_POST['DeleteID'];
		$date = date('Y-m-d H:i:s');
		$query = "UPDATE tache SET etat_tache ='0',date_updated_tache='$date' WHERE id_tache='$id_tache'";
		$result=mysqli_query($conn,$query);
		if ($result) {
			echo "<div class='text-success'>La tâche est supprimé avec succès</div>";
		} else {
			echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
		}
	}

   

    function get_dataEtatTache()
	{
		global $conn;
		$id_tache = $_POST['update_ID'];
	
		$query = "SELECT etat_tache FROM tache WHERE id_tache='$id_tache'";
	
	
        $result = mysqli_query($conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $etat_data = [];
            $etat_data[0] = $id_tache;
            $etat_data[1] = $row['etat_tache'];            
        }
        echo json_encode($etat_data);
	}
    
	
    function update_etatTache(){
        global $conn;
        $date = date('Y-m-d H:i:s');
        $etat = $_POST['etat'];
        $id_tache = $_POST['id_tache'];
    
    
        $query = "UPDATE tache SET etat_tache='$etat',date_updated_tache='$date' WHERE id_tache='$id_tache'";
        $result = mysqli_query($conn, $query);
        if ($result) {
            echo "L'etat du tâche est modifie avec succès ";
        } else {
            echo "<div class='text-danger'> Veuillez vérifier votre requête</div> ";
        }
    }

    
    function get_dataTache()
	{
		global $conn;
		$id_tache = $_POST['update_ID'];
	
        $query = "SELECT * FROM tache WHERE id_tache='$id_tache'";

		$result = mysqli_query($conn, $query);
	
		while ($row = mysqli_fetch_assoc($result)) {
			$update_tache= [];
			$update_tache[0] = $id_tache;
			$update_tache[1] = $row['description_tache'];
			$update_tache[2] = $row['date_debut_tache'];
			$update_tache[3] = $row['date_fin_tache'];
			$update_tache[4] = $row['id_users'];
           
		}
		echo json_encode($update_tache);
	}
    
	
    function updateTache(){
		global $conn ;
        $date = date('Y-m-d H:i:s');
		$idTache = $_POST['update_ID'] ;
    	$description = $_POST['description'];
    	$dateDebutTache = $_POST['dateDebutTache'] ;
    	$dateFinTache = $_POST['dateFinTache'];
    	$employee=$_POST['employee'];
        $doc_tache=isset($_FILES["doc_tache"]) ? $_FILES['doc_tache'] : "" ;
    	$doc_tache_filname = "";
    
    	if ($doc_tache != ""){
    		$doc_tache_filname = "tache" . "." . strtolower(pathinfo($doc_tache["name"], PATHINFO_EXTENSION));
    		move_uploaded_file($doc_tache["tmp_name"], "uploads/projet/tache/".$doc_tache_filname);
    	}
        $query = "UPDATE tache SET description_tache='$description',date_debut_tache='$dateDebutTache',date_fin_tache='$dateFinTache',piece_joint_tache='$doc_tache_filname',id_users='$employee',date_updated_tache='$date' WHERE id_tache='$idTache'";
    
    	$result=mysqli_query($conn,$query);
    	if ($result) {
    		echo "<div class='text-success'>Les informations du tâche mises à jour avec succès</div>";
    	} else {
    		echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    	}


	}
    
function add_client(){
    global $conn ;
    	$nom_entreprise_client= $_POST['nom_entreprise_client'];
    	$email_client = $_POST['email_client'];
        $addresse_client = $_POST['addresse_client'];
        $numtel_client = $_POST['numtel_client'];
        $commentaire_client = $_POST['commentaire_client'];

        $selectEmail = mysqli_query($conn, "SELECT * FROM client WHERE email_client = '".$_POST['email_client']."' ");

    	if(mysqli_num_rows($selectEmail)) {
    		echo "<div class='text-echec'>L'email est déjà utilisée</div>";
        }else{    
        $query= "INSERT into client(nom_client_projet,email_client,numTel_client,adresse_client,commentaire_client) 
        VALUES('$nom_entreprise_client','$email_client','$numtel_client','$addresse_client','$commentaire_client')";
        $result=mysqli_query($conn,$query);
        if ($result) {
            echo "<div class='text-success'>le client  est ajouté avec succès</div>";
        } else {
            echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
        }
        }      
}

function viewclient(){
    global $conn;
    $value ='<table class="table table-striped align-middle">
        <thead>
            <tr>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Nom entreprise </th>
                <th style="text-align: center;" class="border-top-0" class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                <th style="text-align: center;" class="border-top-0"><i class="fa fa-phone"></i> Téléphone</th>
                <th style="text-align: center;" class="border-top-0"><i class=" fa fas fa-map-marker-alt"></i> Adresse</th>
                <th style="text-align: center;" class="border-top-0"><i class="fas fa-graduation-cap"></i>Commentaire</th>
                <th style="text-align: center;" class="border-top-0">Actions</th>
            </tr>            
        </thead>';
        $query = "SELECT * FROM client WHERE etat_client= '1' ORDER BY nom_client_projet ASC";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
        $value .= '<tbody>
                <tr>
                    <td style="text-align: center;">' . $row['nom_client_projet'] . '</td>
                    <td style="text-align: center;">' . $row['email_client'] . '</td>
                    <td style="text-align: center;">' . $row['numTel_client'] . '</td>
                    <td style="text-align: center;">' . $row['adresse_client'] . '</td>
                    <td style="text-align: center;">' . $row['commentaire_client'] . '</td>
                    <td style="text-align: center;">
                        <div class="btn-group">';
                            $value .= '<button type="button" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifier_client" data-id=' . $row['id_client'] . '><i class="fa fa-pen fa-1x"></i></button> 
                            <button type="button" class="btn btn-danger" title="Supprimer client" id="btn_supprimer_client" data-id1=' . $row['id_client'] . '><i class="fa fa-trash fa-1x"></i></button> 
                        </div>
                    </td>

                </tr>';
        }
        $value .= '</tbody></table>';
        echo json_encode(['status' => 'success', 'html' => $value]);
}
   
function deleteClient(){

            global $conn;
            $id_client = $_POST['DeleteID'];
            $date = date('Y-m-d H:i:s');
            $query = "UPDATE client SET etat_client='0', date_updated_client='$date' WHERE id_client='$id_client'";
                $result=mysqli_query($conn,$query);
            if ($result) {
                echo "<div class='text-success'>le client est supprimé avec succès</div>";
            } else {
                echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
            }
        }

        function get_data_client()
        {
            global $conn;
            $idclient = $_POST['update_ID'];
        
            $query = "SELECT * FROM client WHERE id_client='$idclient'";
        
            $result = mysqli_query($conn, $query);
        
            while ($row = mysqli_fetch_assoc($result)) {
                    $update_client= [];
                $update_client[0] = $idclient;
                $update_client[1] = $row['nom_client_projet'];
                $update_client[2] = $row['email_client'];
                $update_client[3] = $row['numTel_client'];
                $update_client[4] = $row['adresse_client'];
                $update_client[5] = $row['commentaire_client'];
       
            }
            echo json_encode($update_client);
        }   
        
        
        function updateClient(){
            global $conn ;
            $idclient= $_POST['idclient'];
                $nom_entreprise_client= $_POST['nom_entreprise_client'];
                $email_client = $_POST['email_client'];
                $addresse_client = $_POST['addresse_client'];
                $numtel_client = $_POST['numtel_client'];
                $commentaire_client = $_POST['commentaire_client'];
$selectEmail = mysqli_query($conn, "SELECT * FROM client WHERE email_client='$email_client' and  id_client!='$idclient'and etat_client='1'");
         if(mysqli_num_rows($selectEmail)) {
             echo "<div class='text-echec'>L'email est déjà utilisée</div> ";
             }else{
            $query = "UPDATE client SET nom_client_projet='$nom_entreprise_client',email_client='$email_client',adresse_client='$addresse_client',numTel_client='$numtel_client',commentaire_client='$commentaire_client' WHERE id_client='$idclient'";
               
        $result=mysqli_query($conn,$query);
    
        if ($result) {
            echo "<div class='text-success'>Les informations sont mises à jour avec succès</div>";
        } else {
            echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
        }
         }            
     
        }

        function addAgence(){
            global $conn ;
                $nom_agence= $_POST['nom_agence'];
                $email_agence = $_POST['email_agence'];
                $numtel_agence = $_POST['numtel_agence'];
        
                $selectEmail = mysqli_query($conn, "SELECT * FROM agence WHERE email_agence='$email_agence' ");
        
                if(mysqli_num_rows($selectEmail)) {
                    echo "<div class='text-echec'>L'email est déjà utilisée</div>";
                }else{    
                $query= "INSERT into agence (nom_agence,email_agence,tel_agence) 
                VALUES('$nom_agence','$email_agence','$numtel_agence')";
                $result=mysqli_query($conn,$query);
                
                if ($result) {
                    echo "<div class='text-success'>l'agence est ajoutée avec succès</div>";
                } else {
                    echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
                }
                }      
        }
        

        function viewAgence (){
            global $conn;
            $value ='<table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th style="text-align: center;" class="border-top-0"><i class="fa fa-user"></i> Nom agence </th>
                        <th style="text-align: center;" class="border-top-0" class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                        <th style="text-align: center;" class="border-top-0"><i class="fa fa-phone"></i> Téléphone</th>
                        <th style="text-align: center;" class="border-top-0">Actions</th>
                    </tr>            
                </thead>';
                $query = "SELECT * FROM agence WHERE action_agence= '1' ORDER BY nom_agence ASC";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                $value .= '<tbody>
                        <tr>
                            <td style="text-align: center;">' . $row['nom_agence'] . '</td>
                            <td style="text-align: center;">' . $row['email_agence'] . '</td>
                            <td style="text-align: center;">' . $row['tel_agence'] . '</td>
                            <td style="text-align: center;">
                                <div class="btn-group">';
                                    $value .= '<button type="button" style="margin-right: 3px;" class="btn btn-primary" id="btn_modifier_agence" data-id='.$row['id_agence'].'><i class="fa fa-pen fa-1x"></i></button> 
                                    <button type="button" class="btn btn-danger" title="Supprimer agence" id="btn_supprimer_agence" data-id1='.$row['id_agence'].'><i class="fa fa-trash fa-1x"></i></button> 
                                </div>
                            </td>
        
                        </tr>';
                }
                $value .= '</tbody></table>';
                echo json_encode(['status' => 'success', 'html' => $value]);
                
        
              
        }   
        
        function get_dataAgence()
        {
            global $conn;
            $idAgence = $_POST['update_ID'];
        
            $query = "SELECT * FROM agence WHERE id_agence ='$idAgence'";
        
            $result = mysqli_query($conn, $query);
        
            while ($row = mysqli_fetch_assoc($result)) {
                $update_agence= [];
                $update_agence[0] = $idAgence;
                $update_agence[1] = $row['nom_agence'];
                $update_agence[2] = $row['email_agence'];
                $update_agence[3] = $row['tel_agence'];
            }
            echo json_encode($update_agence);
        } 
        
        
        function updateAgence(){
             global $conn ;
             $idagence= $_POST['idagence'];
                 $nom_agence= $_POST['nom_agence'];
                 $email_agence = $_POST['email_agence'];
                 $numtel_agence = $_POST['numtel_agence'];
                 $selectEmail = mysqli_query($conn, "SELECT * FROM agence WHERE email_agence='$email_agence' and  id_agence!='$idagence'");

          if(mysqli_num_rows($selectEmail)) {
              echo "<div class='text-echec'>L'email est déjà utilisée</div> ";
            }else{
             $query = "UPDATE agence SET nom_agence='$nom_agence',email_agence='$email_agence',tel_agence='$numtel_agence' WHERE id_agence='$idagence'";
               $result=mysqli_query($conn,$query);
    
         if ($result) {
             echo "<div class='text-success'>Les informations sont mises à jour avec succès</div>";
         } else {
             echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
         }
        }   
     
        
         }
         function deleteAgence(){

            global $conn;
            $id_agence = $_POST['DeleteID'];
            $date = date('Y-m-d H:i:s');
            $query = "UPDATE agence SET action_agence='0', date_updated_agence='$date' WHERE id_agence='$id_agence'";
                $result=mysqli_query($conn,$query);
            if ($result) {
                echo "<div class='text-success'>l'agence est supprimée avec succès</div>";
            } else {
                echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
            }
        }
