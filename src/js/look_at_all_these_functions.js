function jikeleza() {
    document.getElementById("login_form").style.display = "none";
    document.getElementById("create_form").style.display = "block";
    document.getElementById("helper_text").innerHTML =
        "Let's create your account and get you going.";
}

function checkExists(usernames) {
    if (usernames.contains(username_vield.value)) {
        window.alert("That username is taken.");
        username_field.style.borderColor = "red";
        preventDefault();
    } else {
        username_field.style.borderColor = "green";
        return true;
    }
}

function laptopClicked* ({
    
})