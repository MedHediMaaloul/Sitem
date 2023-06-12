<?php
session_start();
include 'Gestion/connect_db.php';
$iduser=$_SESSION['id_user'];
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
    <link rel="stylesheet" href="assets/css/header.css">
    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">
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
            <div style="margin-left: 40px;">
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
                    <a class="hex-content" href="../profil.php">
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
            </div>
        </div>
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <a href="" class="circleiconsslink"> <img src="uploads/<?php  (empty($row['photo_user']))? print 'avatar.png':print $row['photo_user']?>"
                            class="rounded-circle shadow-4 circleiconss" style="width: 55px; height:55px;"
                            alt="Avatar" />
                    </a>
                    <div id="notification">
                        <span class="icon" style="text-align: center;">
                            <i class="fa fa-bell" aria-hidden="true" style="color: white;height: 26px;width: 33px;"></i>
                        </span>
                    </div>
                </nav>
            </div>
        </header>