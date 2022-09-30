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
    document.getElementById("big_phone").onclick = no();
    document.getElementById("big_laptop").onclick = no();
}

function keep_laptop_movin() {
    if (!document.getElementById("l_model").value) {
        window.alert("Choose the model before you can continue.");
    } else {
        document.getElementById("laptop_details").style.display = "none";
        document.getElementById("laptop_problem").style.display = "block";
        document.getElementById("issue_l").innerHTML =
            "What's wrong with your " +
            document.getElementById("l_manufacturer").value +
            " " +
            document.getElementById("l_model").value +
            "?";
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

function no_enter_for_you() {
    if (
        document.getElementById("final_laptop").style.display == "hidden" ||
        document.getElementById("final_phone").style.display == "hidden"
    ) {
        preventDefault();
    } else true;
}

function no() {
    return false;
}

function yes() {
    return true;
}

function phoneClicked() {
    document.getElementById("laptop_choice").style.display = "none";
    document.getElementById("phone_details").style.display = "block";
    document.getElementById("big_phone").onclick = no();
    document.getElementById("big_laptop").onclick = no();
}

function unclickPhone() {
    document.getElementById("laptop_choice").style.display = "block";
    document.getElementById("phone_details").style.display = "none";
    document.getElementById("big_phone").onclick = yes();
    document.getElementById("big_laptop").onclick = yes();
}

function keep_phone_movin() {
    if (!document.getElementById("p_model").value) {
        window.alert("Choose the model before you can continue.");
    } else {
        document.getElementById("phone_details").style.display = "none";
        document.getElementById("phone_problem").style.display = "block";
        document.getElementById("issue_p").innerHTML =
            "What's wrong with your " +
            document.getElementById("p_manufacturer").value +
            " " +
            document.getElementById("p_model").value +
            "?";
    }
}

function phone_go_back() {
    document.getElementById("phone_details").style.display = "block";
    document.getElementById("phone_problem").style.display = "none";
}

function finish_phone_up() {
    if (!document.getElementById("p_issue").value) {
        window.alert("Tell us what's wrong before you can continue.");
    } else {
        document.getElementById("phone_problem").style.display = "none";
        document.getElementById("final_phone").style.display = "block";

        document.getElementById("final_phone_assessment").innerHTML =
            document.getElementById("p_manufacturer").value +
            " " +
            document.getElementById("p_model").value +
            " Assessment";
        document.getElementById("reported_p_issue").innerHTML =
            document.getElementById("p_issue").value;

        document.getElementById("p_price").innerHTML =
            "Assessment Price: \t\tR 295.00";
    }
}

function phone_not_yet() {
    document.getElementById("phone_problem").style.display = "block";
    document.getElementById("final_phone").style.display = "none";
}

function clearBlues() {
    devices = document.getElementsByClassName("device");
    console.log(devices);
    for (let i = 0; i < devices.length; i++) {
        devices.item(i).style.backgroundColor = "#f8fafc";
        devices.item(i).style.color = "#000000";
    }
}
