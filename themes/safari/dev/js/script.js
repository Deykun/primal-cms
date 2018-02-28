console.log('Cześć!');
var config = {
	jquery: false
};

$(document).ready(function () {
	config.jquery = true; 
    
    var cookieWarning = getCookie("cookie_warning");
    
    if (!(cookieWarning != null && cookieWarning != "")) {
        document.getElementById("cookieInfo").style.display = 'block';
        document.getElementById("eat-cookie").addEventListener("click", function() {
            document.getElementById("cookieInfo").style.display = "none";
            setCookie("cookie_warning", cookieWarning, 365);
        });
    } else {
        console.log('Witam ponownie');
    }

});

function setCookie(t, e, i) {
    var n = new Date;
    n.setDate(n.getDate() + i);
    var s = escape(e) + (null == i ? "" : "; expires=" + n.toUTCString());
    document.cookie = t + "=" + s
}

function getCookie(t) {
    var e, i, n, s = document.cookie.split(";");
    for (e = 0; e < s.length; e++)
        if (i = s[e].substr(0, s[e].indexOf("=")), n = s[e].substr(s[e].indexOf("=") + 1), (i = i.replace(/^\s+|\s+$/g, "")) == t) return unescape(n)
}

function checkCookie() {
    var t = getCookie("username");
    null != t && "" != t ? alert("Welcome again " + t) : null != (t = prompt("Please enter your name:", "")) && "" != t && setCookie("username", t, 365)
}
