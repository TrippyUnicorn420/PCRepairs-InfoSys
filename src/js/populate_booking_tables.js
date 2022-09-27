var man_field = document.getElementById("l_manufacturer");
man_field.addEventListener("focusout", populateLaptops);

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
    document.getElementById("issue_l").innerHTML =
        "What's wrong with your " +
        man_field_value +
        " " +
        model_field.value +
        "?";
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
