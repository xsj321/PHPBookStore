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
    window.location.href='http://127.0.0.1/studentsSelect/SubjectManage/SubjectManage_add/SubjectManage_add.php';
}

function OnBackClick() {
    window.location.href = "http://127.0.0.1/studentsSelect/search/search.php";
}