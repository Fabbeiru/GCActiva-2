<?php

include_once 'business.class.php';

class View {

    public static function start() {
        $html = 
        "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            
            <!-- Caracteres especiales -->
            <meta charset='UTF-8'>
            
            <!-- ViewPort -->
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            
            <!-- Titulo pestana -->
            <title>GCActiva</title>
            
            <!-- Favicon -->
            <link rel='shortcut icon' href='imagenes/favicon.png' type='image/x-icon'>
            
            <!-- Enlace FontAwesome -->
            <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.7.0/css/all.css'>
            
            <!-- Google Fonts -->
            <link href='https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap' rel='stylesheet'>
            <link href='https://fonts.googleapis.com/css2?family=Forum&display=swap' rel='stylesheet'>
            
            <!-- Enlaces CSS -->
            <link rel='stylesheet' href='/assets/css/base.css'>
            <link rel='stylesheet' href='/assets/css/xs-sm.css'>
            <link rel='stylesheet' href='/assets/css/md-lg.css'>
            
            <!-- Enlaces Javascript -->
            <script src='assets/js/jquery.min.js'></script>
            <script src='assets/js/javascript.js'></script>
        </head>
        <body>
        ";
        echo $html;
    }

    public static function header() {

        $user = User::getLoggedUser();

        $html = 
        "
        <!-- header -->
        <header>
            <div class='logo'>
                <img src='/imagenes/logo.png' alt ='GCActiva Logo'>
            </div>
            <div class='menu'>
                <div class='burger' data-toggler='#navbar_sup'>
                    <i class='fas fa-bars' onclick='burguer_navbar_sup()'></i>
                </div>
                <ul class='navbar' id='navbar_sup'>
                    <li class='nav-item nav-item-1'><a class='nav-link active' href='/index.php'>Home</a></li>
                    <li class='nav-item'><a class='nav-link' href='/activities.php'>Actividades</a></li>
                    <li class='nav-item'><a class='nav-link' href='/contact.php'>Contacto</a></li>"

                    .

                    (
                        $user != false ? 
                        '<li class="nav-item d-md-none"><a class="nav-link" href="/perfil.php">' . $user['nombre'] . '</a></li>
                        <li class="nav-item d-md-none"><a class="nav-link" href="/logout.php">Salir</a></li>' : 
                        
                        '<li class="nav-item d-md-none"><a class="nav-link" href="/login.php">Login</a></li>
                        <li class="nav-item d-md-none"><a class="nav-link" href="/register.php">Registrarse</a></li>'
                    )

                    .

                "</ul>
            </div>";
        
        $html_login = "
            <div class='login'>
                <a href='/login.php'>Login</a>
                <a href='/register.php'>Resgistrarse</a>";
                
        $html_final = "
            </div>
        </header>
        ";
        
        if ($user != false){ //Si está logueado
            $nombreUser = $user['nombre'];
            $html_nombre = "<div class='login'>
                <a href='/perfil.php'>$nombreUser</a>
                <a href='/logout.php'>Salir</a>";

            echo $html . $html_nombre . $html_final;
        } else{
            echo $html . $html_login . $html_final;
        }
    }
    
    public static function footer() {
        $html = 
        "
        <!-- Footer -->
        <footer>
            <div class='name'>GCActiva</div>
            <div class='copyright'>@Copyright <b>Alexander Alvarez</b> - <b>Isidro Bermúdez</b> - <b>Fabián Beirutti</b></div>
        </footer>
        
        </body>
        </html>
        ";
        
        echo $html;
    }

    public static function imgtobase64($img) {
        
        $b64 = base64_encode($img);
        $signature = substr($b64, 0, 3);

        if ( $signature == '/9j') {
            $mime = 'data:image/jpeg;base64,';
        } else if ( $signature == 'iVB') {
            $mime = 'data:image/png;base64,';
        }
        
        return $mime . $b64;
    }
}
