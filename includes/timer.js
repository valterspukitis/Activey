var countdownTimer = null;
setCookie("my_cookie",seconds,-1);

function showTimer() {
    document.getElementById("word").style.display = "none";
    document.getElementById("time").style.display = "block";
    startTimer();
}

function showWord() {
    document.getElementById("time").style.display = "none";
    document.getElementById("word").style.display = "block";
    delay(function(){
        document.getElementById("word").style.display="none";
        document.getElementById("time").style.display="block";
    }, 1000 );
}


var delay = ( function() {
    var timer = 0;
    return function(callback, ms) {
        clearTimeout (timer);
        timer = setTimeout(callback, ms);
    };
})();

function deleteCook() {
    //countdownTimer = null;
    setCookie("my_cookie",seconds,-1);
}

function setCookie(cname,cvalue,exdays)
{
    var d = new Date();
    //d.setTime(d.getTime()+(6000));
    d.setTime(d.getTime()+(exdays*24*60*60*1000));
    var expires = "expires="+d.toGMTString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
}
function getCookie(cname)
{
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i=0; i<ca.length; i++) {
        var c = ca[i].trim();
        if (c.indexOf(name)==0) return c.substring(name.length,c.length);
    }
    return "";
}


function secondPassed() {
    var minutes = Math.round((seconds - 30)/60);
    var remainingSeconds = seconds % 60;
    if (remainingSeconds < 10) {
        remainingSeconds = "0" + remainingSeconds;
    }
    //store seconds to cookie
    setCookie("my_cookie",seconds,1); //here 1 is expiry days

    document.getElementById('countdown').innerHTML = minutes + ":" +    remainingSeconds;
    if (seconds == 0) {
        clearInterval(countdownTimer);
        document.getElementById('countdown').innerHTML = "<h2>Time's up!</h2>";
    } else {
        seconds--;
    }
}

function startTimer(){
    countdownTimer = setInterval(secondPassed, 1000);
    var seconds = 10;
}

cook=getCookie("my_cookie");

if(cook==""){
    //cookie not found, so set seconds=60
    var seconds = 60;
}else{
    countdownTimer = cook;
    seconds = cook;
    startTimer();
    console.log(cook);
}

