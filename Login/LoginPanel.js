

function OnRegClick() {
    let form = document.getElementById("the_form");
    let the_reg = document.getElementById("is_login");
    the_reg.value = "false";
    form.submit();

}

function OnLoginClick() {
    let form = document.getElementById("the_form");
    form.submit();
}

