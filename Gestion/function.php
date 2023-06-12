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

function viewUser(){
    global $conn;
    $value = '
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th class="border-top-0"><i class="fa fa-user"></i> Nom </th>
                <th class="border-top-0"><i class="fa fa-user"></i> Prénom </th>
                <th class="border-top-0"><i class="fa fa-pen"></i> Cin </th>
                <th class="border-top-0"><i class="fa fa-phone"></i> Téléphone</th>
                <th class="border-top-0" class="hidden-phone"><i class="fa fa-envelope"></i> Email</th>
                <th class="border-top-0"><i class="fa fa-user"></i> Date de Naissance </th>
                <th class="border-top-0"><i class=" fa fas fa-map-marker-alt"></i> Adresse</th>
				<th class="border-top-0"><i class="fas fa-graduation-cap"></i> Specialité</th>
                <th class="border-top-0"><i class="fa fa-image"></i> Photo</th>
				<th class="border-top-0">Actions</th>
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
    		    <td>' . $row['nom_user'] . '</td>
    		    <td>' . $row['prenom_user'] . '</td>
    		    <td>' . $row['cin_user'] . '</td>
    		    <td>' . $row['numTel_user'] . '</td>
    		    <td>' . $row['email_user'] . '</td>
    		    <td>' . $row['date_naissance_user'] . '</td>
    		    <td>' . $row['adresse_user'] . '</td>
				<td>' . $user_data. '</td>
    			<td><a '.(($row["photo_user"]!="")?"href='uploads/{$row["photo_user"]}'":"").'" target="_blank"><i class="fa fa-image fa-2x"></i></a></td>
				<td>
				<div class="btn-group">';
				    if($row['etat_user'] == '1'){
				    	$value .= '<button type="button" style="margin-right: 3px;" class="btn btn-primary" id="btn_desactiver_user" data-id2=' . $row['id_user'] . '><i class="fas fa-check"></i></button>'; 
				    }
					if($row['etat_user'] == '2'){
						$value .= '<button type="button" style="margin-right: 3px;" class="btn btn-outline-primary" id="btn_activer_user" data-id3=' . $row['id_user'] . '><i class="fas fa-check"></i></button>'; 
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

	if ($doc_photoProfile != ""){
		$photoProfile_filname = $numCIN . "." . strtolower(pathinfo($doc_photoProfile["name"], PATHINFO_EXTENSION));
		move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/".$photoProfile_filname);
	}
	    
    $selectEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$_POST['email']."' ");
	$row= mysqli_fetch_array($selectEmail);
	$status= $row['etat_user'];

	$selectCIN = mysqli_query($conn, "SELECT * FROM user WHERE cin_user!='0' and cin_user = '".$_POST['numCIN']."'");

	if(mysqli_num_rows($selectEmail)) {
		if ($status!="0"){
			echo "<div class='text-echec'>L\'email est déjà utilisée</div> ";
		}else{
			echo "<div class='text-echec'>L\'email est supprimé, contactez votre administrateur.</div> ";
		}
	}else if(mysqli_num_rows($selectCIN)) {
		echo "<div class='text-echec'>Ce numéro de CIN est déjà utilisé</div> ";
	}else {
		$query= "INSERT into user(nom_user,prenom_user,cin_user,numTel_user,email_user,password_user,date_naissance_user,id_role,id_specialite,adresse_user,photo_user,etat_user)
		values('$nom','$prenom','$numCIN','$numTel','$email','$password','$dateNaissance','$role','$specialite','$address','$photoProfile_filname','1')";
		$result=mysqli_query($conn,$query);
		if ($result) {
			echo "<div class='text-success'>L\'utilisateur est ajouté avec succès</div>";
		} else {
			echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
		}
	}
}
	

    function disableAccount(){
      
    	global $conn;
    	$id_user = $_POST['user_ID'];
    
    	$query = "UPDATE user SET etat_user='2' WHERE id_user='$id_user'";
    
    	$result=mysqli_query($conn,$query);
    
    	if ($result) {
    		echo "<div class='text-success'>le compte est désactivé avec succès</div>";
    	} else {
    		echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    	}
    }

	function activateAccount(){
      
    	global $conn;
    	$id_user = $_POST['user_ID'];
    
    	$query = "UPDATE user SET etat_user='1' WHERE id_user='$id_user'";
    
    	$result=mysqli_query($conn,$query);
    
    	if ($result) {
    		echo "<div class='text-success'>le compte est activé avec succès</div>";
    	} else {
    		echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
    	}
    }
	
	function deleteUser(){
  
		global $conn;
		$id_user = $_POST['DeleteID'];
	
		$query = "UPDATE user SET etat_user='0' WHERE id_user='$id_user'";
	
		$result=mysqli_query($conn,$query);
	
		if ($result) {
			echo "<div class='text-success'>Supprimé avec succès</div>";
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
			move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/".$photoProfile_filname);
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
				echo "<div class='text-echec'>L\'email est déjà utilisée</div> ";
			}else{
				echo "<div class='text-echec'>L\'email est supprimé, contactez votre administrateur.</div> ";
			}
		}else if(mysqli_num_rows($selectCIN)) {
			echo "<div class='text-echec'>Ce numéro de CIN est déjà utilisé</div> ";
		}else {
	    	
			$query = "UPDATE user SET nom_user='$nom',prenom_user='$prenom',cin_user='$numCIN',numTel_user='$numTel',email_user='$email',password_user='$password',date_naissance_user='$dateNaissance',id_role='$role',id_specialite='$specialite',adresse_user='$address',photo_user='$photoProfile_filname' WHERE id_user='$idUser'";

			$result=mysqli_query($conn,$query);
	
	    if ($result) {
			echo "<div class='text-success'>Les informations sont mises à jour avec succès</div>";					    		
	    } else {
	    	echo "<div class='text-echec'>Veuillez vérifier votre requête</div> ";
	    }
	    }
		

	}
?>
		

