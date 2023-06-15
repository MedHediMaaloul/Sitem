<?php
session_start();
$idRole=$_SESSION['Role'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - menu with awesome hover </title>

    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css'>
    <link rel="stylesheet" href="./style.css">
    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/accueil.css">

</head>

<body>
    <!-- partial:index.partial.html -->
    <main>
        <div class="pt-table desktop-768">

            <div class="pt-tablecell page-home ">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-6 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">
                            <div class="page-title  home text-center">
                                <img src="assets/images/logo_sitem.png" width="300px" alt="">
                            </div>
                            <div class="hexagon-menu">
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
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                                fill="#1e2530"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="hexagon-item" id="utilisateur">
                                    <div class="hex-item" >
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a class="hex-content" id="utilisateurlink" href="utilisateur.php">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-users" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Utilisateurs</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                                fill="#1e2530"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="hexagon-item" id="client">
                                    <div class="hex-item" >
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <div class="hex-item">
                                        <div></div>
                                        <div></div>
                                        <div></div>
                                    </div>
                                    <a class="hex-content" id="clientlink" href="client.php">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                            <i class="fa fa-university" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Client</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
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
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
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
                                    <a class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Planning</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                                fill="#1e2530"></path>
                                        </svg>
                                    </a>
                                </div>
                                <div class="hexagon-item" id="materiel">
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
                                    <a class="hex-content" id="materiellink" href="materiel.php">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-laptop" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Matériels</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
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
                                    <a class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-database" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Stock</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
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
                                    <a class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                                <i class="fa fa-envelope-open" aria-hidden="true"></i>
                                            </span>
                                            <span class="title">Contact</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
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
                                    <a class="hex-content">
                                        <span class="hex-content-inner">
                                            <span class="icon">
                                            <i class="fas fa-building"></i>
                                            </span>
                                            <span class="title">Agence</span>
                                        </span>
                                        <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z"
                                                fill="#1e2530"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- partial -->
    </script>
        <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css'></script>
    <script>
            var IdRole='<?php echo $idRole;?>';
            document.addEventListener("DOMContentLoaded", function() {
            if(IdRole=='1'){
                $('#utilisateur').css('pointer-events','none');
                $('#materiel').css('pointer-events','none');
                $('#utilisateurlink').addClass('btn disabled');
                $('#materiellink').addClass('btn disabled');
            }
});
</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</body>

</html>