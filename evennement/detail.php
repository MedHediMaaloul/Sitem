<?php

    include('../Gestion/connect_db.php');
    session_start();
    
    
    global $conn;
    $id_user=$_SESSION['id_user'];
    $id = $_POST['id'];
    $idchoice=($_POST["id_choice"]);
    if($idchoice=="2") {        
        $query = "SELECT * FROM evenement as E
        left join user as U on E.id_user_evenement =U.id_user WHERE E.id_evenement='$id'";
            
    }else if ($idchoice=="3"){
            $query = "SELECT * FROM projet as P
        left join user as U on P.chef_projet =U.id_user WHERE P.id_projet='$id' ORDER BY id_projet";
    
    }else if ($idchoice=="4"){
        $query = "SELECT * FROM conge as C
        left join user as U on C.id_user_conge=U.id_user WHERE C.id_conge='$id'  ORDER BY id_conge";

    }else{
        $query = "SELECT * FROM reunion as R
        left join user as U on R.id_reunion_user=U.id_user WHERE R.id_reunion='$id' ORDER BY id_reunion";
    }
    
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result)) {
        if($idchoice=="2") {
        
            $evennement= [];
            $evennement[0] = $id;
            $evennement[1] = $row['titre_evenement'];
            $evennement[2] = $row['date_debut_evenement'];
            $evennement[3] = $row['date_fin_evenement'];
            $evennement[4] = $row['prenom_user']." ".$row['nom_user'];
                
        }else if ($idchoice=="3"){
            $evennement= [];
            $evennement[0] = $id;
            $evennement[1] = $row['nom_projet'];
            $evennement[2] = $row['date_debut_projet'];
            $evennement[3] = $row['date_fin_projet'];
            $evennement[4] = $row['prenom_user']." ".$row['nom_user'];
        
        }else if ($idchoice=="4"){
            $evennement= [];
            $evennement[0] = $id;
            $evennement[1] = 'Congé';
            $evennement[2] = $row['date_debut_conge'];
            $evennement[3] = $row['date_fin_conge'];
            $evennement[4] = $row['prenom_user']." ".$row['nom_user'];
        }else{
    
            $query_user = "SELECT * FROM user";
            $result_user = mysqli_query($conn, $query_user);
            $table =explode(",",$row['invite_reunion']);
            $user_data="";
            while ($row_user = mysqli_fetch_assoc($result_user)) {
                if (in_array( $row_user['id_user'],  $table )){
                    $user_data=$user_data.' '.$row_user['nom_user'].' '.$row_user['prenom_user'].' /';
                }
            }   
            if( substr($user_data, -1)=="/"){
                $user_data =substr($user_data, 0, -1);   
            }
            
            $evennement= [];
            $evennement[0] = $id;
            $evennement[1] = $row['sujet_reunion'];
            $evennement[2] = $row['date_reunion'];
            $evennement[4] = $row['prenom_user']." ".$row['nom_user'];
            $evennement[5] = $user_data;
        }
    }
    echo json_encode($evennement);
?>

