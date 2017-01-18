window.fbAsyncInit = function() {
    FB.init({
    appId      : '455046901373297',
    xfbml      : true,
    version    : 'v2.6'
    });
};

(function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/de_DE/sdk.js";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

function logmeintoFB () {
    FB.getLoginStatus(function(Conresponse) {
        if (Conresponse.status === 'connected') {
            //var uid = Conresponse.authResponse.userID;
            //var accessToken = Conresponse.authResponse.accessToken;
            FB.api('/me?fields= id,first_name,last_name', function(response) {
                $.ajax({
                    url: 'login.php',
                    method: 'POST',
                    dataType: 'JSON',
                    data: {all: JSON.stringify(response)}
                })
                    .done(function(msg) {
                        if (msg == "logged")
                        {
                            window.location.reload();
                        }
                        else if(msg == "error")
                        {
                            var fail = document.getElementById("fail");
                            fail.innerHTML = "Login failed!";
                        }
                    });
            });
        }

        else if (Conresponse.status === 'not_authorized') {
            var fail = document.getElementById("fail");
            fail.innerHTML = "Not authorised!";        }
        else {
            FB.login(function() {
                logmeintoFB();
            });
        }
    });
}

