<?php
session_start();
include 'Gestion/connect_db.php';
$iduser=$_SESSION['id_user'];
$idRole=$_SESSION['Role'];
$query = "SELECT * FROM user     
WHERE id_user= '$iduser'";
 $result = mysqli_query($conn, $query);
 $row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Sitem</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/icons.css">
    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.14.0-beta2/css/bootstrap-select.min.css" integrity="sha512-mR/b5Y7FRsKqrYZou7uysnOdCIJib/7r5QeJMFvLNHNhtye3xJp1TdJVPLtetkukFn227nKpXD9OjUc09lx97Q==" crossorigin="anonymous"
  referrerpolicy="no-referrer" />
<!-- fullcalendar -->
  <link rel="stylesheet" href="evennement/fullcalendar.css" />
</head>
<style>
.svgicon {
    height: 160px !important;
    width: 174px !important;
    top: -8px !important;
}
</style>
<body>
    <div class="wrapper">
        <div class="sidebar-wrapper" data-simplebar="true">
            <img src="assets/images/logo_sitem_noir.png" style="width: 170px;margin-top: 10px; margin-left: 34px;">
            <div id="hexagon_content" style="margin-left: 40px; margin-top:34px;">
                <div class="hexagon-item">
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="profil.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-user" aria-hidden="true"></i>
                            </span>
                            <span class="title">Profil</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item" <?php ($idRole == "1") ? print "hidden" :""  ?> >
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="utilisateur.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-users" aria-hidden="true"></i>
                            </span>
                            <span class="title">Utilisateurs</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item" <?php ($idRole == "1") ? print "hidden" :""  ?> >
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="client.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                            <i class="fa fa-university" aria-hidden="true"></i>
                            </span>
                            <span class="title">Client</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item">
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="projet.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-tasks" aria-hidden="true"></i>
                            </span>
                            <span class="title">Projets</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item">
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="planning.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-calendar" aria-hidden="true"></i>
                            </span>
                            <span class="title">Planning</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item" <?php ($idRole == "1") ? print "hidden" :""  ?>>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="materiel.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-laptop" aria-hidden="true"></i>
                            </span>
                            <span class="title">Matériels</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item" <?php ($idRole == "1") ? print "hidden" :""  ?>>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="../profil.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </span>
                            <span class="title">Stock</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item">
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="../profil.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                                <i class="fa fa-envelope-open" aria-hidden="true"></i>
                            </span>
                            <span class="title">Contact</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
                <div class="hexagon-item">
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <div class="hex-item">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                    <a class="hex-content" href="../profil.php">
                        <span class="hex-content-inner">
                            <span class="icon">
                            <i class="fas fa-building"></i>
                            </span>
                            <span class="title">Agence</span>
                        </span>
                        <svg viewBox="0 0 173.20508075688772 200" class="svgicon" version="1.1"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                fill="#1e2530"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <a href="" class="circleiconsslink"> <img src="uploads/user/<?php  (empty($row['photo_user']))? print 'avatar.png':print $row['photo_user']?>"
                            class="rounded-circle shadow-4 circleiconss" style="width: 55px; height:55px;"
                            alt="Avatar" />
                    </a>
                    <div id="notification" class='topbar-btn'>
                        <span class="icon" style="text-align: center;">
                            <i class="fa fa-bell" aria-hidden="true" style="color: white;height: 29px;width: 33px;"></i>
                        </span>
                    </div>
                </nav>
                <a href="logout.php">
                <div id="decoonexion" class='topbar-btn m-3'>
                        <span class="icon" style="text-align: center;">
                            <i class="fa fa-power-off" aria-hidden="true" style="color: white;height: 29px;width: 33px;"></i>
                        </span>
                    </div>
                    </a>
            </div>
        </header>