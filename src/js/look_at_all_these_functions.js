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

function laptopClicked() {
    document.getElementById("phone_choice").style.display = "none";
    document.getElementById("laptop_details").style.display = "block";
}

function keep_laptop_movin() {
    if (!document.getElementById("l_model").value) {
        window.alert("Choose the model before you can continue.");
    } else {
        document.getElementById("laptop_details").style.display = "none";
        document.getElementById("laptop_problem").style.display = "block";
    }
}

function finish_laptop_up() {
    if (document.getElementById("issue_l").value == "") {
        window.alert("Tell us what's wrong before you can continue.");
    } else {
        document.getElementById("laptop_problem").style.display = "none";
        document.getElementById("final_laptop").style.display = "block";

        document.getElementById("final_laptop_assessment").innerHTML =
            document.getElementById("l_manufacturer").value +
            " " +
            document.getElementById("l_model").value +
            " Assessment";
        document.getElementById("reported_laptop_issue").innerHTML =
            document.getElementById("l_issue").value;

        document.getElementById("l_price").innerHTML = "Price: \t\tR 295.00";
    }
}
