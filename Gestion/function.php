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
				$_SESSION['Specialite']=$row['id_specialité'];
    			$_SESSION['email_user']=$row['email_user'];
				echo "<label class=\"myclass\">success</label>";

    		}else{
    			if ($status=='1') {
    				echo "<label class=\"myclass\">Mot de passe incorrecte !</label>";
    			}else{
    				echo "<label class=\"myclass\">Compte supprimé !</label>";
    			}
    		}		
    	}else{
    		echo "<label class=\"myclass\">Compte introuvable !</label>";
    	}
    }

	function AjoutUser(){
		global $conn ;
		$role=isset($_POST['role']) ? $_POST['role'] : null ;
		$specialite=isset($_POST['specialite']) ? $_POST['specialite'] : null ;
		$nom=isset($_POST['nom']) ? $_POST['nom'] : null ;
		$prenom=isset($_POST['prenom']) ? $_POST['prenom'] : null ;
		$address=isset($_POST['address']) ? $_POST['address'] : null ;
		$numCIN=isset($_POST['numCIN']) ? $_POST['numCIN'] : null ;
		$email=isset($_POST['email']) ? $_POST['email'] : null ;
		$numTel=isset($_POST['numTel']) ? $_POST['numTel'] : null ;
		$dateNaissance=isset($_POST['dateNaissance']) ? $_POST['dateNaissance'] : null ;
		$password=isset($_POST['password']) ? $_POST['password'] : null ;
		$doc_photoProfile=$_FILES["doc_photoProfile"];
	
		$unique_id = hash("sha256", strval(rand(100, 999999)) + strval(time()));
		$photoProfile_filname = $unique_id . "_docphotoProfile." . strtolower(pathinfo($doc_photoProfile["name"], PATHINFO_EXTENSION));
		move_uploaded_file($doc_photoProfile["tmp_name"], "uploads/".$photoProfile_filname);
	
		
    	$selectEmail = mysqli_query($conn, "SELECT * FROM user WHERE email_user = '".$_POST['email']."' ");
		$selectCIN = mysqli_query($conn, "SELECT * FROM user WHERE cin_user!='0' and cin_user = '".$_POST['numCIN']."'");
		
		if(mysqli_num_rows($selectEmail)) {
			exit('Cette email est déjà utilisée');
		}else if(mysqli_num_rows($selectCIN)) {
			exit('Ce numéro de CIN est déjà utilisé');
		}
		else {
			
			$query= "INSERT into user(nom_user,prenom_user,cin_user,numTel_user,email_user,password_user,date_naissance_user,id_role,id_specialité,adresse_user,photo_user,etat_user)
			values('$nom','$prenom','$numCIN','$numTel','$email','md5($password)','$dateNaissance','$role','$specialite','$address','$photoProfile_filname','1')";
			$result=mysqli_query($conn,$query);
	
		if ($result) {
			echo "Ajouté avec succès ";
				
		} else {
	
			echo "<div class='text-danger'> Veuillez vérifier votre requête</div> ";
		}
	}
    }
?>
		

