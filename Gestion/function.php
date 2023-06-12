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
                $_SESSION['Specialite']=$row['id_specialité'];
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

	function getClientRecord(){
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
         if (in_array( $row_specialite['id_specialite'],  $table_specialite )){
            $user_data[12]=$user_data[12].' '.$row_specialite['nom_specialite'].' /';
        }
    }
    if( substr($user_data[12], -1)=="/")
    {
        $user_data[12] =substr($user_data[12], 0, -1);   
     }
        echo json_encode($user_data);
	}



    function updateProfilRecord(){
        global $conn ;
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

        if($up_profilPhoto != "") {
            $Namefile_photo_profil=$row_profil['cin_user'];
            $emplacement_photoProfil = "uploads/";
            $file_photo_profil = $emplacement_photoProfil . basename($_FILES["up_profilPhoto"]["name"]);
            $uploadOk_photo_profil = 1;
            $type_passport = strtolower(pathinfo($file_photo_profil,PATHINFO_EXTENSION));
            if($type_passport != "jpg" && $type_passport != "png" && $type_passport != "jpeg" && $type_passport != "gif" ) {
                echo "<div class='text-echec-photo'>les formats autorisés sont JPG, JPEG, PNG et GIF.</div>"; 
                $uploadOk_photo_profil = 0;
                return;
            }  
            if ($uploadOk_photo_profil != 0) {
                move_uploaded_file($_FILES["up_profilPhoto"]["tmp_name"], $emplacement_photoProfil .$Namefile_photo_profil.".".$type_passport);
                $up_profilPhoto = $Namefile_photo_profil.".".$type_passport;
            }
        }
        else{
            $up_profilPhoto=$row_profil['photo_user'];
        }
        if($up_profilactuelpassword != "") {
            if ($row_profil['password_user']!=$up_profilactuelpassword){
                echo "<div class='text-echec-password'>SVP verifier le passe actuelle !</div>"; 
                return;
            }
        }
        else{
            $up_profilnouveaupassword=  $row_profil['password_user'];
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
        `date-updated_user`='$date'
        WHERE id_user='$up_idprofil'";
        $result_update_profil = mysqli_query($conn, $query_update_profil);
        if (!$result_update_profil) {
            echo "<div class='text-echec-update'>Vous avez rencontré un problème lors de la mise à jour du profil !</div>";
            return;
        } else{
            echo "<div class='text-checked'>Le profil a été mis à jour avec succès ! </div>";
            return;
        }
    }
?>