<?php ?>
<!DOCTYPE html>
<html>
    <head>
        <title>KIA Vibrant</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="{{ URL::asset('libs/jquery/jquery-3.1.1.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('libs/gsap/TweenMax.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('libs/gsap/TimelineMax.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('libs/video-js/video.min.js') }}"></script>
        <link rel="stylesheet" href="{{ URL::asset('styles/principal.css') }}"/>
        <link rel="stylesheet" href="{{ URL::asset('libs/video-js/video-js.min.css') }}"/>
    </head>
    <body>
        <script>
// This is called with the results from from FB.getLoginStatus().
function fb_login() {
    FB.login(function (response) {

        if (response.authResponse) {
            console.log('Welcome!  Fetching your information.... ');
            //console.log(response); // dump complete info
            access_token = response.authResponse.accessToken; //get access token
            user_id = response.authResponse.userID; //get FB UID

            FB.api('/me', function (response) {
                user_email = response.email; //get user email
                // you can store this data into your database             
            });

        } else {
            //user hit cancel button
            console.log('User cancelled login or did not fully authorize.');

        }
    }, {
        scope: 'publish_stream,email'
    });
}

window.fbAsyncInit = function () {
    FB.init({
        appId: '587349288131053',
        cookie: true, // enable cookies to allow the server to access 
        // the session
        xfbml: true, // parse social plugins on this page
        version: 'v2.8' // use graph api version 2.8
    });

    // Now that we've initialized the JavaScript SDK, we call 
    // FB.getLoginStatus().  This function gets the state of the
    // person visiting this page and can return one of three states to
    // the callback you provide.  They can be:
    //
    // 1. Logged into your app ('connected')
    // 2. Logged into Facebook, but not your app ('not_authorized')
    // 3. Not logged into Facebook and can't tell if they are logged into
    //    your app or not.
    //
   

};

// Load the SDK asynchronously
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
        </script>
        <!DOCTYPE html>
    <!--author: @maph65-->

    <!-- home section -->
    <div id="home" class="section">
        <div id="kia-logo-1" class="logo-kia">
            <img src="{{ URL::asset('media/pleca-kia.png') }}" alt="KIA" class="pleca-kia" />
        </div>
        <div id="home-container" class="section-container">
            <img src="{{ URL::asset('media/nuevoRio.png') }}" alt="Nuevo Rio" id="logo-nuevo-rio" class="nuevorio" />
            <div id="home-text" class="principal-text">
                <h1>&iquest;ESTAS LISTO PARA VIVIR UNA GRAN AVENTURA?</h1>
                <p>Lleg&oacute; el momento de recuperar el Vibrant</p>
            </div>

            <div id="home-social-btns">
                <p id="iniciar-con">INICIAR CON:</p>
                <div id="fb-button" class="btn">
                    <a href="#" onclick="fb_login();"><img src="{{ URL::asset('media/social/fb.png') }}" alt="Ingresar con Facebook" class="btn-img"></a>
                </div>
                <div id="tw-button" class="btn">
                    <img src="{{ URL::asset('media/social/tw.png') }}" alt="Ingresar con Twitter" class="btn-img">
                </div>
            </div>
            <div id="home-next-btn-container">
                <div id="sin-registro-btn" class="btn">
                    <p>Continuar sin registro</p>
                </div>
            </div>

        </div>
    </div><!-- /home section -->
    <!-- device section -->
    <div id="device" class="section">
        <div id="kia-logo-2" class="logo-kia">
            <img src="{{ URL::asset('media/pleca-kia.png') }}" alt="KIA" class="pleca-kia" />
        </div>
        <div id="device-container" class="section-container">
            <div id="device-text" class="principal-text">
                <h1>Instrucciones:</h1>
                <p>El vibrant ha sido robado. Toma las decisiones correctas<br/>y ayudanos a recuperarlo.</p>
            </div>
            <div id="device-btns">
                <div id="mobile-button" class="btn">
                    <p>Jugar con el celular</p>
                </div>
                <div id="desktop-button" class="btn">
                    <p>Jugar desde mi PC</p>
                </div>
            </div>
        </div>
    </div><!-- / device section -->
    <!-- device section -->
    <div id="mobile-steps" class="section">
        <div id="kia-logo-3" class="logo-kia">
            <img src="{{ URL::asset('media/pleca-kia.png') }}" alt="KIA" class="pleca-kia" />
        </div>
        <div id="mobile-steps-container" class="section-container">
            <div id="mobile-step-1" class="principal-text mobile-step-text">
                <h1>PASO 1</h1>
                <p>Entra en tu dispositivo a la siguiente URL.</p>
            </div>
            <div id="mobile-step-2" class="principal-text mobile-step-text">
                <h1>PASO 2</h1>
                <p>Ingresa el siguiente código: <br> XXXXX</p>
            </div>
            <div id="mobile-step-3" class="principal-text mobile-step-text">
                <h1>PASO 3</h1>
                <p>Comienza el juego desde tu dispositivo.</p>
            </div>
            <div class="main-button">
                <div id="regresar-mobile-btn" class="btn">
                    <p>Regresar</p>
                </div>
            </div>
        </div>
    </div><!-- / device section -->
    <!-- device section -->
    <div id="video" class="section">
        <div id="kia-logo-3" class="logo-kia">
            <img src="{{ URL::asset('media/pleca-kia.png') }}" alt="KIA" class="pleca-kia" />
        </div>
        <div id="video-container" class="section-container">
            <div id="paused-cover" class="paused-cover" style="display:none;">
                <div class="paused-container">
                    <h1>&iquest;Ya lo est&aacute;s pensando?</h1>
                    <p>Hasta el momento &eacute;ste es tu progreso en la b&uacute;squeda por recuperar el Vibrant.</p>
                    <img src="{{ URL::asset('media/video-progreso-60.png') }}" alt="progreso-60" class="paused-video-progreso" />
                </div>
            </div>
            <video id="video-player" class="video-js player-kia">
                <source src="{{ URL::asset('media/videos/testkia1280.mp4') }}" type='video/mp4'>
                <p class="vjs-no-js">
                    Para ver este video debes actualizar tu navegador o bien conseguir un navegador que
                    <a href="http://videojs.com/html5-video-support/" target="_blank">soporte video HTML5</a>
                </p>
            </video>
            <div id="controlls-video" class="controlls">
                <div id="video-progreso-total" class="progreso-total">
                    <img src="{{ URL::asset('media/video-progreso-60.png') }}" alt="progreso-60" class="img-video-progreso" />
                </div>
                <div id="video-pause-button" class="player-pause btn">
                    <p>Pausar</p>
                </div>
            </div>
        </div>
    </div><!-- / device section -->
    <!-- footer scripts -->
    <script type="text/javascript" src="libs/kia/app.js"></script>
</body>
</html>