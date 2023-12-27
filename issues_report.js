"use strict";

window.onload = function () {
    document.getElementById("issueType").oninput = function () {
        showHint(this.value);
    };

    function showHint(str) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this);
                document.getElementById("txtHint").innerHTML = this.responseText; 
            }
        };

        xmlhttp.open("GET", "issue_suggest.php?q=" + str, true);
        xmlhttp.send();
    }
}