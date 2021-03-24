function search() {
    var from = document.getElementById("search");
    from.submit();
}

function OnUpdateClick(element) {
    let tag = element.id;
    console.log(tag);
    let form = document.getElementById(tag+"info");
    form.submit();
}

function OnSellClick(element) {
    let tag = element.id;
    console.log(tag);
    let form = document.getElementById(tag+"sell");
    form.submit();
}

function OnDelete(element) {
    var r=confirm("确认删除");
    if (r){
        let tag = element.id;
        console.log(tag);
        let form = document.getElementById(tag+"D");
        form.submit();
    }
}

function OnAddClick() {
    window.location.href='http://127.0.0.1/BookStore/SubjectManage/SubjectManage_add/SubjectManage_add.php';
}

function OnBackClick() {
    window.location.href = "http://127.0.0.1/BookStore/search/search.php";
}