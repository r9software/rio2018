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
var tlInteraction = new TimelineMax();
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
            .from("#device-separator", 0.8, {autoAlpha:0},"device+=0.8")
            .from("#mobile-button", 0.8, {right:200, autoAlpha:0},"device+=0.8")
            .from("#desktop-button", 0.8, {left:200, autoAlpha:0},"device+=0.8");
}
function goToMobileSteps(){
    tlSelectDevice.to('#device', 0.4, {top:'-100vh'});
    tlMobileSteps = new TimelineMax();
    tlMobileSteps.set("#mobile-steps", {display:"table",top:'100vh'})
            .to("#mobile-steps",0.4,{top:0})
            .from("#mobile-instruction-text", 0.5, {bottom:100, autoAlpha:0},"mobile-init")
            .from("#mobile-step-1", 0.8, {left:200, autoAlpha:0},"mobile-init+=0.6")
            .from("#mobile-step-2", 0.8, {right:200, autoAlpha:0},"mobile-init+=0.6")
            .from('#regresar-mobile-btn',0.8,{top:100, autoAlpha:0}, "mobile-init+=0.6");
}
function restartSelectDevice(){
    tlSelectDevice.to('#device', 0.4, {display:"table",left:'100%',top:0,autoAlpha:100});
    goToSelectDevice();
}
function returnSelectDevice(){
    tlSelectDevice.set('#device',{top:'-100vh'}).to('#device',0.4,{top:0});
    tlMobileSteps.to("#mobile-steps",0.4,{top:'100vh'});
}
function goToInteraction(){
    tlMobileSteps.to("#mobile-steps", 0.6, {autoAlpha:0, display:'none'});
    tlSelectDevice.to('#device', 0.6, {autoAlpha:0, display:'none'});
    tlIntroVideo.set("#video", {display:"none"});
    tlHome.set('#home', {left:'-100%'});
    tlInteraction = new TimelineMax();
    tlInteraction.set("#interaction-1", {autoAlpha:1,display:"table"})
        .from('#interaction-text',0.6,{bottom:100, autoAlpha:0},"interaction-1-init")
        .from('#interaction-button-left',0.8,{top:200, right:200, autoAlpha:0},"interaction-1-init+=0.6")
        .from('#interaction-button-right',0.8,{bottom:200, left:200, autoAlpha:0},"interaction-1-init+=0.6")
        .from('#int1-device-separator',0.6,{autoAlpha:0},"interaction-1-init+=0.6")
        .from('#contador-int-1',0.4,{top:100, autoAlpha:0},"interaction-1-init+=0.6");
}
function goToVideo(){
    tlInteraction.to("#interaction-1", 0.6, {autoAlpha:0, display:'none'})
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
    tlInteraction.set("#interaction-1", {display:'none'});
}

/***********************************
 * 
 *  3. Listeners
 * 
 **********************************/

$('#sin-registro-btn').on('click',goToSelectDevice);
$('#regresar-mobile-btn').on('click',returnSelectDevice);
$('#mobile-button').on('click',goToMobileSteps);
$('#desktop-button').on('click',goToInteraction); //goToVideo
$('#interaction-button-left').on('click',goToVideo);
$('#interaction-button-right').on('click',goToVideo);

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
    //restartHome();
    goToInteraction();
});
$('#video-pause-button').on('click',function(){
    if(!introPlayer.paused()){
        introPlayer.pause();
        $('#video-pause-button').hide();
        $('#paused-cover').css('display','table');
    }
});

$('#paused-cover').on('click',function(){
    if(introPlayer.paused()){
        introPlayer.play();
        $('#video-pause-button').show();
        $('#paused-cover').css('display','none');
    }
});

/***********************************
 * 
 *  5. Init Events
 * 
 **********************************/

homeStart();
//goToSelectDevice();