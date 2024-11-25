<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>| Mi pag web |</title>
    <link rel="stylesheet" href="C:\xampp\htdocs\Proyecto\public\css\style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php require_once("./config/conexion.php");?>
    <?php 
        require_once("./models/Usuario.php");
        $usuario = new Usuario();
        $usuarios = $usuario->getUsuarios();

        require_once("./models/Social_media.php");
        $social_media = new Socialmedia();
        $soc = $social->get_Socialmedia();
    ?>
    <?php 
        for($i=0;$i<sizeof($soc);$i++):
            ?>
            <a href="<?php echo $soc[$i]['url']; ?>">
                <i class='bx bxl-<?php echo $soc[$i]['nombre']; ?>'></a>
            <?php
        endfor;
    ?>

    <section id="home">
        <div class="contenido">
            <header>
                <a href="#" class="logo"><i class='bx bx-code-alt'></i>Logo</a>
                <nav class="navbar">
                    <a href="#home" class="active">HOME</a>
                    <a href="#about">ABOUT</a>
                    <a href="#services">SERVICES</a>
                    <a href="#skills">SKILLS</a>
                    <a href="#contactus">CONTACT US</a>
                </nav>
                <div class="icons">
                    <i class='#' id="#"></i>
                    <a href="#" class="bx  bxl-linkedin"></a>
                    <a href="#" class="bx bxl-github"></a>
                    <a href="#" class="bx bxl-whatsapp"></a>
                </div>
            </header>
            <div class="presentacion">
                <p class="mensaje">Bienvenidos</p>
                <h2>Soy <span>Jhon Terreros</span> Ingeniero de sistemas</h2>
                <p class="descripciom">Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti aliquid exercitationem, 
                    adipisci tempore assumenda atque, veritatis veniam animi facere quaerat quam quasi harum, eum voluptate repellendus 
                    tenetur ipsum officiis rem.</p>
                <a href="#services">Experiencia</a>    
            </div>
        </div>
    </section>
    <section id="about">
        <div class="foto">
            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBwgHBgkIBwgKCgkLDRYPDQwMDRsUFRAWIB0iIiAdHx8kKDQsJCYxJx8fLT0tMTU3Ojo6Iys/RD84QzQ5OjcBCgoKDQwNGg8PGjclHyU3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3Nzc3N//AABEIAJQAowMBIgACEQEDEQH/xAAaAAEAAgMBAAAAAAAAAAAAAAAAAwUCBAYB/8QALxABAAIBAgQEBQMFAQAAAAAAAAECAwQRBRIhMTJBUXEiUmGBkRRCwTM0YqHRE//EABYBAQEBAAAAAAAAAAAAAAAAAAABAv/EABYRAQEBAAAAAAAAAAAAAAAAAAARAf/aAAwDAQACEQMRAD8A70BpAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGVaXv4aWn2gGIktgy162x3iPaWAPAAAAAAAAAAAAAAAAEmHFfPfkpXefP2YREzaIiN5mdl/pMEafFyx4u9pKI9NoMWL4rRz3+vb8NuOkbR2BKr1Dm0+LNE/+lImZ847/lKFFJrNDbT/ABV+LH6+cNOHTzETG09YnyUWv0/6fNtHht1iSo1QFAAAAAAAAAAAHoNzhWPn1PNPakbrroquDePL7QtU0AEUAAafFMfPpZtHek7x/LcQaz+1zb/JIOfAaxAAAAAAAAAAAAG7wm8U1XLP742+66c1S00tFqztaJ3h0Glz11OKLx3849JQShuIoAA1OKX5NJaJ73nlhtz0jeVHxDU/qMu1Z+CvSPquDUAVAAAAAAAAAAAABLp899Pk58c+8eqISC90+txZ478lvls2Ynp06uZS0z5qeDLaPuRXRbo8mXHhjmyXisfWeqjtq9Rbvmv+UMzNp3tMzPrKQbut18545MUTXHPf1s0QaQAAAAAAAAAAAAB7WJtO1YmZ9IjqDxnjxZMs7Y6Tb2WOl4ZHj1HX/GP5WVKVpG1KxWPSEqqjHwzNafjtWv07p68Jp+7Lb7RCxCivnhOLyyX/ANIr8JtHXHlj7wtQFBm0efD1tTePWvVrun2auq0GHP1iOS3rBRRCbUafJp7bZI2jynylCqAAAAAAAAAAPa1m08tY3me0Qu9Do66eu9oick959GvwnTxtOe3tX/qzRQBAAAAAABjlx1y0muSvNEqLV6a2my7T1rPht6r9DqsNc+K2OfPtPpJRzwyvWaWmto2mJ2li0gAAAAAAyx0nJkrSO9p2Yt3hWOL6reY8NZmDRcY6RSla1jaIhkdfMZUAAAAAAAAeT3egKji+HlyVyxHS3SfdXrziVOfR5J72r8UKPzVABQAAAAWXBv6mX6RAGqtQGQAAAAAAAAABFniJwZIn5Zc7HaAVABQAB//Z" alt="foto de perfil">
        </div>
        <div class="info_sobreMi">
            <p class="titulo">Yo uien soy?</p>
            <h2>Soy, <span>Jhon Alexander Terreros Vargas</span></h2>
            <h3>Slogan</h3>
            <p>¡¡¡Do not be afraid!!!</p>
        </div>
    </section>
    <section id="services">
        <p class="titulo">Servicios</p>
        <div class="row">
            <div class="servicio">
                <span class="icon"><i class="bx bx-code-alt"></i></span>
                <h3>Desarrollo de software</h3>
                <ul>
                    <li>Desktop</li>
                    <li>Mobile</li>
                    <li>Web</li>
                </ul>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum debitis fugiat sequi commodi quos tempora 
                    consequuntur vero vel, quas at id exercitationem pariatur aliquam ipsum eos adipisci assumenda illum? Illum? </p>
            </div>
            <div class="servicio">
                <span class="icon"><i class="bx bx-code-alt"></i></span>
                <h3>Desarrollo de software</h3>
                <ul>
                    <li>Desktop</li>
                    <li>Mobile</li>
                    <li>Web</li>
                </ul>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum debitis fugiat sequi commodi quos tempora 
                    consequuntur vero vel, quas at id exercitationem pariatur aliquam ipsum eos adipisci assumenda illum? Illum? </p>
            </div>            <div class="servicio">
                <span class="icon"><i class="bx bx-code-alt"></i></span>
                <h3>Desarrollo de software</h3>
                <ul>
                    <li>Desktop</li>
                    <li>Mobile</li>
                    <li>Web</li>
                </ul>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Cum debitis fugiat sequi commodi quos tempora 
                    consequuntur vero vel, quas at id exercitationem pariatur aliquam ipsum eos adipisci assumenda illum? Illum? </p>
            </div>
        </div>
    </section>
    <section id="skills" class="contenedor-skills">
        <p class="titulo">FORTALEZAS</p>
        <div class="skill">
            <div class="info">
                <p><span class="lista"></span>HTML</p>
                <span class="porcentaje">60%</span>
            </div>
            <div class="barra">
                <div id="html" class="barra-progreso_html"></div>
            </div>
        </div>
        <div class="skill">
            <div class="info">
                <p><span class="lista"></span>CSS</p>
                <span class="porcentaje">50%</span>
            </div>
            <div class="barra">
                <div id="css" class="barra-progreso_css"></div>
            </div>
        </div>
        <div class="skill">
            <div class="info">
                <p><span class="lista"></span>JS</p>
                <span class="porcentaje">20%</span>
            </div>
            <div class="barra">
                <div id="js" class=""></div>
            </div>
        </div>
        <div class="skill">
            <div class="info">
                <p><span class="lista"></span>PYTHON</p>
                <span class="porcentaje">60%</span>
            </div>
            <div class="barra">
                <div id="python" class=""></div>
            </div>
        </div>
        <div class="skill">
            <div class="info">
                <p><span class="lista"></span>MySQL</p>
                <span class="porcentaje">60%</span>
            </div>
            <div class="barra">
                <div id="mysql" class=""></div>
            </div>
        </div>
    </section>
    <section id="contactus">
        <p class="titulo">CONTACTAME</p>
        <form action="">
            <div class="inputBox">
                <div class="input">
                    <span>NOMBRES Y APELLIDOS</span>
                    <input type="text" placeholder="Nombres y Apellidos">
                </div>
                <div class="input">
                    <span>NUMERO DE CONTACTO</span>
                    <input type="number" placeholder="(+57) 312 383 05 33">
                </div>
            </div>
            <div class="inputBox">
                <div class="input">
                    <span>ASUNTO DEL MENSAJE</span>
                    <input type="text" placeholder="Solicitud, Queja, Reclamos, Cumplidos">
                </div>
            </div>
            <div class="inputBox">
                <div class="input">
                    <span>COMENTARIOS</span>
                    <textarea name="" placeholder="Ingrese el comentario que desea transmitir" id="" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="action">
                <input type="submit" value="Enviar" class="btn">
            </div>
            
        </form>
        <div class="contact-container">
          
            <div class="contact-card">
                <i class='bx bx-envelope contact-card-icon'></i>
                <h3 class="contact-card-title">Email</h3>
                <span class="contact-card-data">alexander05jtv@gmail.com</span>
            </div>
            <div class="contact-card">
                <i class='bx bxl-whatsapp contact-card-icon'></i>
                <h3 class="contact-card-title">Whatsapp</h3>
                <span class="contact-card-data">(+57) 3123830533</span>
            </div>
            <div class="contact-card">
                <i class='bx bxs-phone-call contact-card-icon'></i>
                <h3 class="contact-card-title">Celular</h3>
                <span class="contact-card-data">(+57) 3123830533</span>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="footer-text">
            <p>Jhon Alexander terreros vargas</p>
        </div>
        <div class="footer_icon">
            <a href="#"><i class="bx bx-up-arrow-alt"></i></a>
        </div>
    </footer>
    <script src="js/main.js"></script>
</body>
</html> 