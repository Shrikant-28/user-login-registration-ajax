/**
 * Generate Captha
 */
var code;

function createCaptcha() {
    //clear the contents of captcha div first
    document.getElementById('captcha').innerHTML = "";
    var charsArray =
        "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    var lengthOtp = 6;
    var captcha = [];
    for (var i = 0; i < lengthOtp; i++) {
        //below code will not allow Repetition of Characters
        var index = Math.floor(Math.random() * charsArray.length + 1); //get the next character from the array
        if (captcha.indexOf(charsArray[index]) == -1)
            captcha.push(charsArray[index]);
        else i--;
    }
    var canv = document.createElement("canvas");
    canv.id = "captcha";
    canv.width = 100;
    canv.height = 40;
    var ctx = canv.getContext("2d");
    ctx.font = "25px Georgia";
    ctx.strokeText(captcha.join(""), 0, 30);
    //storing captcha so that can validate you can save it somewhere else according to your specific requirements
    code = captcha.join("");
    document.getElementById("captcha").appendChild(canv); // adds the canvas to the body element
}

function validateCaptcha() {
    event.preventDefault();
    if (document.getElementById("cpatchaTextBox").value == code) {
        return 1;
    } else {
        alert("Invalid Captcha. try Again");
        createCaptcha();
        return 0;
    }
}
/********************** */
/**
 * Choosen JS: Searchable Dropdown
 */
var config = {
    '.chosen-select': {},
    '.chosen-select-deselect': { allow_single_deselect: true },
    '.chosen-select-no-single': { disable_search_threshold: 10 },
    '.chosen-select-no-results': { no_results_text: 'Oops, nothing found!' },
}

for (var selector in config) {
    try {
        $(selector).chosen(config[selector]);
    } catch (err) {
        for (var prop in err) {
            console.log("property: " + prop + " value: [" + err[prop] + "]\n");
        }
    }
}

try {
    $(".chosen-select").chosen().change(function() {
        $(this).val()
    });
} catch (err) {
    for (var prop in err) {
        console.log("property: " + prop + " value: [" + err[prop] + "]\n");
    }
}

$(document).ready(function() {
    $("#success-alert").hide();
})