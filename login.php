
<html lang="en">
    <head>
        <title>authentification</title>
        <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- Main css -->
        <link rel="stylesheet" href="assets/css/style.css">
         <!-- Font Icon -->
    <link rel="stylesheet" href="assets/fonts/material-icon/css/material-design-iconic-font.min.css">

    <link href="https://fonts.cdnfonts.com/css/bambino-2" rel="stylesheet">
    </head>
  
    <body>
        <div class="main">
            <section class="signup">
                <div class="container">
                    <div class="signup-content">
                        <form class="signup-form" onsubmit="return false">
                            <center><img src="assets/images/logo_sitem_noir.png" width="150px" style=" margin-top:25px;margin-bottom:50px;" /></center></a>
                            <div class="form-group">
                                <input type="text" style="margin-bottom:8px" class="form-input" name="email" id="email" placeholder="Email"/>
                                <label style=" color: #D8000C;text-align: center;" class="error" for="email" id="email_error"> </label>
                            </div>
                            <div class="form-group" >
                                <input  type="password"  class="form-input" name="password" id="password" placeholder="Mot de passe"/>
                                <i id="togglePassword"> <span toggle="password" class="zmdi zmdi-eye field-icon toggle-password" ></span></i>
                                <div style="margin-top:8px">
                                    <label style=" color: #D8000C;text-align: center;" class="error" for="password" id="password_error"> </label>
                                </div>
                            </div>
                            <div class="button-panel">
                                <input type="submit" class="form-submit" title="Log In" name="btn_login" id="btn_login" value="Connexion"></input>
                            </div>
                        </form>
                        <div style=" color: #D8000C;text-align: right;"  class="button-panel" id="messageError"></div>

                        <br>
                        <p class="loginhere">
                            <a href="#" class="loginhere-link">Mot de passe oublié ?</a>
                        </p>
                    </div>
                </div>
            </section>
        </div>
        <!-- JS -->
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/main.js"></script>
        <script>
        const togglePassword = document.querySelector("#togglePassword"); 
        const password = document.querySelector("#password"); 
        togglePassword.addEventListener("click", function () { 
            // toggle the type attribute 
            const type = password.getAttribute("type") === "password" ? "text" : "password"; 
            password.setAttribute("type", type); 
            // toggle the icon 
            this.classList.toggle("bi-eye"); });
        </script>
    </body>
</html>
    