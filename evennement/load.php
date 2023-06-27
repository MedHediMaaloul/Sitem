
<?php
    include('../Gestion/connect_db.php');
    global $conn;
    session_start();
    
    $data = array();
    $id=$_SESSION['id_user'];
    $idchoice=($_POST["id_choice"]);
    if($idchoice=="1") {
        $query = "SELECT * FROM reunion ORDER BY id_reunion";
      
    }else if($idchoice=="2") {
        $query = "SELECT * FROM evenement ORDER BY id_evenement";
            
    }else if ($idchoice=="3"){
        if($_SESSION['Role']!="1"){ 
            $query = "SELECT * FROM projet WHERE etat_projet!='0' ORDER BY id_projet";
        }else{
            $query = "SELECT * FROM projet WHERE chef_projet='$id' AND etat_projet!='0' ORDER BY id_projet";
        }

    }else if ($idchoice=="4"){
        if($_SESSION['Role']!="1"){ 
            $query = "SELECT * FROM conge WHERE etat_conge='2' ORDER BY id_conge";
        }else{
            $query = "SELECT * FROM conge WHERE id_user_conge='$id' and etat_conge='2' ORDER BY id_conge";
        }
    }
       
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_assoc($result))
    {        
        if($idchoice=="1" ) {
            if(($_SESSION['Role']!="1")||($row['id_reunion_user']=="$id")) {
                $data[] = array(
                    'id'   => $row["id_reunion"],
                    'title'   => $row["sujet_reunion"],
                    'start'   => $row["date_reunion"],
                    'end'   => date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($row["date_reunion"])))),
                    'color'=> "#C1FFEC",
                );
            }else{
                $row_invite_reunion=$row['invite_reunion'];
                $table_users = explode(",",$row_invite_reunion);
                if (in_array($id,$table_users)){
                    $data[] = array(
                        'id'   => $row["id_reunion"],
                        'title'   => $row["sujet_reunion"],
                        'start'   => $row["date_reunion"],
                        'end'   => date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($row["date_reunion"])))),
                        'color'=> "#C1FFEC",
                    );
                }
            }   
                                  
        }else if($idchoice=="2") {
            $data[] = array(
                'id'   => $row["id_evenement"],
                'title'   => $row["titre_evenement"],
                'start'   => $row["date_debut_evenement"],
                'end'   =>  date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($row["date_fin_evenement"])))),
                'color'=> "#C1FFEC",
               );
            
        }else if ($idchoice=="3"){
            $data[] = array(
                'id'   => $row["id_projet"],
                'title'   => $row["nom_projet"],
                'start'   => $row["date_debut_projet"],
                'end'   =>  date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($row["date_fin_projet"])))),
                'color'=> "#C1FFEC",
               );
               
        }else if ($idchoice=="4"){                   
            $data[] = array(
                'id'   => $row["id_conge"],
                'title'   =>'Congé',
                'start'   => $row["date_debut_conge"],
                'end'   =>  date('Y-m-d H:i:s',date(strtotime("+1 day", strtotime($row["date_fin_conge"])))),
                'color'=> "#C1FFEC",
               );
        }
    }        
    
    echo json_encode($data);
?>
