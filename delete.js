//document.getElementById('compBtn').addEventListener('click', compPage);
//document.getElementById('insBtn').addEventListener('click', insPage);
$(function(){
    showData();
});

$("#deleteBtn").click(function(){
    deleteData();
    $('#deleteModal').modal('hide');
});
function showData(){
    let load = true;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            load: load
        },
        dataType: "html"
    });
    req.done(function(msg){
        $("tbody").append(msg);
        $(".delToggle").click(function(){
            let id = $(this).val();
            $("#deleteBtn").val(id);
            $('#deleteModal').modal('show');
        });
        $(".editBtn").click(function(){
            let $row = $(this).closest("tr"),
            $fn = $row.find(".fnData"),
            $mn = $row.find(".mnData"),
            $ln = $row.find(".lnData"),
            $id = $row.find(".idData"),
            $idS = "",
            $fnS = "",
            $mnS = "",
            $lnS = "";

            $.each($id, function() {
                console.log($(this).html());
                $("#firstNameEdit").val($(this).html());
                $idS = $(this).html();
            });
            $.each($fn, function() {
                console.log($(this).html());
                $("#firstNameEdit").val($(this).html());
            });
            $.each($mn, function() {
                console.log($(this).html());
                $("#middleNameEdit").val($(this).html());
                $mnS = $(this).html();
            });
            $.each($ln, function() {
                console.log($(this).html());
                $("#lastNameEdit").val($(this).html());
                $lnS = $(this).html();
            });
            $("#editBtn").click(function(){
                $fnS = $("#firstNameEdit").val();
                $mnS = $("#middleNameEdit").val();
                $lnS = $("#lastNameEdit").val();
                editData($fnS,$mnS,$lnS,$idS);
            });
            $('#editModal').modal('show');
        });
    });
}

function editData($fnS,$mnS,$lnS,$idS){
    let edit = true,
    ids = $idS,
    fn = $fnS,
    mn = $mnS,
    ln = $lnS;

    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            edit: edit,
            ids: ids,
            fn:fn,
            mn:mn,
            ln:ln
        },
        dataType: "html"
    });
    req.done(function(msg){
        $(".rowData").remove();
        showData();
        $('#editModal').modal('hide');
        console.log(msg);
    });
}

function deleteData(){
    let id = $("#deleteBtn").val();
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            id: id
        },
        dataType: "html"
    });
    req.done(function(msg){
        $(".rowData").remove();
        showData();
        console.log(msg);
    });
}

function compPage(){
    window.location.href = "index.php";
}

function insPage(){
    window.location.href = "input.php";
}