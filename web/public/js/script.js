/* jshint browser: true */

function httpPost (url, parameters, callback) {
    var query = [];
    if (!parameters) parameters = {};

    for (var p in parameters) {
        query.push(encodeURIComponent(p) + "=" + encodeURIComponent(parameters[p]));
    }
    query = query.join("&");

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && callback) {
            callback(this.status, this.responseText);
        }
    };

    xhttp.open("POST", url, true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send(query);
}

function parseResponse(statusCode, responseText) {
    if (statusCode != 200) {
        return null;
    }

    var json = null;
    try {
        json = JSON.parse(responseText);
    }
    catch (ignored) {}

    return json;
}