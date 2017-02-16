/***********************************
 ** author: @maph65
 ** project: Kia Vibrant 2018
 **********************************/

/***********************************
 * 
 *  1. Variables
 * 
 **********************************/

var tlHome = new TimelineMax();
var tlSelectDevice = new TimelineMax();
var tlMobileSteps = new TimelineMax();
var tlIntroVideo = new TimelineMax();
var introPlayer = videojs('video-player');


/***********************************
 * 
 *  2. Sequences
 * 
 **********************************/

function homeStart(){
    tlHome = new TimelineMax({delay:1});
    tlHome.set("#home", {display:"table"})
        .from("#logo-nuevo-rio", 1.2, {left:100, autoAlpha:0},"inicio")
        .from("#home-text", 1.2, {right:100, autoAlpha:0},"inicio")
        .from("#iniciar-con", 1.2, {bottom:100, autoAlpha:0},"inicio+=1.2")
        .from("#fb-button", 1.2, {right:200, autoAlpha:0},"inicio+=1.2")
        .from("#tw-button", 1.2, {left:200, autoAlpha:0},"inicio+=1.2")
        .from("#home-next-btn-container", 1.2, {top:100, autoAlpha:0},"inicio+=1.2");
}
function restartHome(){
    tlHome.to('#home', 0.4, {left:0});
    homeStart();
}
function goToSelectDevice(){
    tlHome.to('#home', 0.4, {left:'-100%'});
    tlSelectDevice = new TimelineMax();
    tlSelectDevice.set("#device", {display:"table",left:'100%',top:0})
            .to("#device",0.4,{left:0})
            .from("#device-text", 0.5, {bottom:100, autoAlpha:0},"device")
            .from("#mobile-button", 0.8, {right:200, autoAlpha:0},"device+=0.8")
            .from("#desktop-button", 0.8, {left:200, autoAlpha:0},"device+=0.8");
}
function goToMobileSteps(){
    tlSelectDevice.to('#device', 0.4, {top:'-100vh'});
    tlMobileSteps = new TimelineMax();
    tlMobileSteps.set("#mobile-steps", {display:"table",top:'100vh'})
            .to("#mobile-steps",0.4,{top:0});
}
function restartSelectDevice(){
    tlSelectDevice.to('#device', 0.4, {display:"table",left:'100%',top:0,autoAlpha:100});
    goToSelectDevice();
}
function returnSelectDevice(){
    tlSelectDevice.set('#device',{top:'-100vh'}).to('#device',0.4,{top:0});
    tlMobileSteps.to("#mobile-steps",0.4,{top:'100vh'});
}
function goToVideo(){
    tlMobileSteps.to("#mobile-steps", 0.6, {autoAlpha:0, display:'none'});
    tlSelectDevice.to('#device', 0.6, {autoAlpha:0, display:'none'});
    tlIntroVideo = new TimelineMax();
    tlIntroVideo.set("#video", {display:"table"});
    introPlayer.play();
}

function restartAll(){
    tlHome.set('#home', {left:0});
    tlSelectDevice.set('#device', {display:"table",left:'100%',autoAlpha:100});
    tlIntroVideo.set("#video", {display:"none"});
    tlMobileSteps.set("#mobile-steps", {display:"table",top:'100vh'});
}

/***********************************
 * 
 *  3. Listeners
 * 
 **********************************/

$('#sin-registro-btn').on('click',goToSelectDevice);
$('#regresar-mobile-btn').on('click',returnSelectDevice);
$('#mobile-button').on('click',goToMobileSteps);
$('#desktop-button').on('click',goToVideo);

//desactiva menu contextual - solo para produccion
//document.addEventListener('contextmenu', event => event.preventDefault());

/***********************************
 * 
 *  4. Video player
 * 
 **********************************/

introPlayer.on('ended', function() {
    tlIntroVideo.set("#video", {display:"none"});
    restartAll();
    restartHome();
});
$('#video-pause-button').on('click',function(){
    if(!introPlayer.paused()){
        introPlayer.pause();
        $('#video-pause-button').html('<p>Continuar</p>');
        $('#paused-cover').css('display','table');
    }else{
        introPlayer.play();
        $('#video-pause-button').html('<p>Pausar</p>');
        $('#paused-cover').css('display','none');
    }
});

/***********************************
 * 
 *  5. Init Events
 * 
 **********************************/

homeStart();
//goToFirstVideo();