var man_field = document.getElementById("l_manufacturer");
man_field.addEventListener("focusout", populateLaptops);

var p_man_field = document.getElementById("p_manufacturer");
p_man_field.addEventListener("focusout", populatePhones);

function populateLaptops() {
    var man_field_value = man_field.value;
    var model_field = document.getElementById("l_model");
    model_field.disabled = false;
    removeOptions(model_field);
    switch (man_field_value) {
        case "Apple":
            addOption(model_field, "MacBook");
            addOption(model_field, "MacBook Air");
            addOption(model_field, "MacBook Pro");
            break;
        case "Dell":
            addOption(model_field, "Inspiron");
            addOption(model_field, "Precision");
            addOption(model_field, "XPS");
            addOption(model_field, "Alienware");
            break;
        case "HP":
            addOption(model_field, "EliteBook");
            addOption(model_field, "Pavilion");
            addOption(model_field, "Omen");
            addOption(model_field, "Spectre");
            break;
        case "Acer":
            addOption(model_field, "Aspire");
            addOption(model_field, "Predator");
            addOption(model_field, "TravelMate");
            break;
        default:
            break;
    }
}

function populatePhones() {
    var man_field_value = p_man_field.value;
    var model_field = document.getElementById("p_model");
    model_field.disabled = false;
    removeOptions(model_field);
    switch (man_field_value) {
        case "Apple":
            addOption(model_field, "iPhone 13");
            addOption(model_field, "iPhone 12");
            addOption(model_field, "iPhone 11");
            addOption(model_field, "iPhone Xs/Xr");
            addOption(model_field, "iPhone X");
            addOption(model_field, "iPhone 8");
            addOption(model_field, "iPhone 7");
            addOption(model_field, "iPhone 6s");
            addOption(model_field, "iPhone SE (2016, 2020 or 2021)");
            break;
        case "Samsung":
            addOption(model_field, "Galaxy S22");
            addOption(model_field, "Galaxy S21");
            addOption(model_field, "Galaxy S20");
            addOption(model_field, "Galaxy S10");
            addOption(model_field, "Galaxy A73");
            addOption(model_field, "Galaxy A53");
            addOption(model_field, "Galaxy A33");
            addOption(model_field, "Galaxy Note20");
            addOption(model_field, "Galaxy Note10");
            addOption(model_field, "Galaxy Note9");
            addOption(model_field, "Galaxy Note8");
            addOption(model_field, "Galaxy Fireball");
            break;
        case "Huawei":
            addOption(model_field, "P40");
            addOption(model_field, "P30");
            addOption(model_field, "P20");
            addOption(model_field, "P10");
            addOption(model_field, "Mate 40");
            addOption(model_field, "Mate 30");
            addOption(model_field, "Mate 20");
            addOption(model_field, "Mate 10");
            break;
        default:
            break;
    }
}

function addOption(select, value) {
    var opt = document.createElement("option");
    opt.value = value;
    opt.innerHTML = value;
    select.appendChild(opt);
}

function removeOptions(select) {
    var i,
        length = select.options.length - 1;
    for (a in select.options) {
        select.options.remove(0);
    }
}
