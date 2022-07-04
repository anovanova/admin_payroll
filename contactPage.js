$(function(){
    showDataPos();
    showOptPos();
    showDataCont();
});
function showOptPos(){
    let posOpt = true;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            posOpt: posOpt
        },
        dataType: "html"
    });
    req.done(function(msg){
        $("#pos").append(msg);
        $("#posContE").append(msg);
    });
}
function showDataPos(){
    let loadPos = true;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            loadPos: loadPos
        },
        dataType: "html"
    });
    req.done(function(msg){
        $("#positionData").append(msg);
        $(".delPosToggle").click(function(){
            let id = $(this).val();
            $("#deleteBtnPosModal").val(id);
            $('#deleteModalPos').modal('show');
        });
        $(".editPosBtn").click(function(){
            let $row = $(this).closest("tr"),
            $id = $row.find(".posRowDataId"),
            $pos = $row.find(".posRowData"),
            $posS = "",
            $idS = "";

            $.each($pos, function() {
                console.log($(this).html());
                $("#posEdit").val($(this).html());
                $posS = $(this).html();
            });
            $.each($id, function() {
                console.log($(this).html());
                $idS = $(this).html();
            });
            $("#editBtnPos").val($idS);
            $("#editModalPos").modal('show');

        });
    });
}
function showDataCont(){
    let loadCont = true;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            loadCont: loadCont
        },
        dataType: "html"
    });
    req.done(function(msg){
        $("#contData").append(msg);
        $(".delToggleCont").click(function(){
            let id = $(this).val();
            $("#deleteBtnContModal").val(id);
            $('#deleteModalCont').modal('show');
        });
        $(".viewBtnCont").click(function(){
            let $row = $(this).closest("tr"),
            $contIdV = $row.find(".idDataCont"),
            $contFnV = $row.find(".fnDataCont"),
            $contMnV = $row.find(".mnDataCont"),
            $contLnV = $row.find(".lnDataCont"),
            $contPosV = $row.find(".posDataCont"),
            $contCivV = $row.find(".civDataCont"),
            $contGendV = $row.find(".gendDataCont"),
            $contContNoV = $row.find(".contNoDataCont"),
            $contBdateV = $row.find(".bdateDataCont"),
            $contDateHV = $row.find(".dateHDataCont"),
            $contSssV = $row.find(".sssDataCont"),
            $contPhlhV = $row.find(".phlhDataCont"),
            $contPagIV = $row.find(".pagIDataCont"),
            $contTinV = $row.find(".tinDataCont"),
            idP;

            $.each($contIdV, function() {
                idP= $(this).html();
            });
            $.each($contFnV, function() {
                $("#firstNameContV").html($(this).html());
            });
            $.each($contMnV, function() {
                $("#middleNameContV").html($(this).html());
                
            });
            $.each($contLnV, function() {
                $("#lastNameContV").html($(this).html());
                
            });
            $.each($contPosV, function(){
                $("#posContV").html($(this).html());
            });
            $.each($contCivV, function(){
                $("#civContV").html($(this).html());
            });
            $.each($contGendV, function(){
                $("#gendContV").html($(this).html());
            });
            $.each($contContNoV, function(){
                $("#contNoV").html($(this).html());
            });
            $.each($contBdateV, function(){
                $("#bDateV").html($(this).html());
            });
            $.each($contDateHV, function(){
                $("#dateHiredV").html($(this).html());
            });
            $.each($contSssV, function(){
                $("#sssV").html($(this).html());
            });
            $.each($contPhlhV, function(){
                $("#phlhV").html($(this).html());
            });
            $.each($contPagIV, function(){
                $("#pagIV").html($(this).html());
            });
            $.each($contTinV, function(){
                $("#tinV").html($(this).html());
            });
            showPic(idP);
            $("#viewModalCont").modal('show');
        });
        $(".editBtnCont").click(function(){
            let $row = $(this).closest("tr"),
            $id = $row.find(".idDataCont"),
            $contFn = $row.find(".fnDataCont"),
            $contMn = $row.find(".mnDataCont"),
            $contLn = $row.find(".lnDataCont"),
            $contPos = $row.find(".posDataCont"),
            $contCiv = $row.find(".civDataCont"),
            $contGend = $row.find(".gendDataCont"),
            $contContNo = $row.find(".contNoDataCont"),
            $contBdate = $row.find(".bdateDataCont"),
            $contDateH = $row.find(".dateHDataCont"),
            $contSss = $row.find(".sssDataCont"),
            $contPhlh = $row.find(".phlhDataCont"),
            $contPagI = $row.find(".pagIDataCont"),
            $contTin = $row.find(".tinDataCont"),
            $idES = "",
            $contFnES = "",
            $contMnES = "",
            $contLnES = "",
            $contPosES = "",
            $contCivES = "",
            $contGendES = "",
            $contContNoES = "",
            $contBdateES = "",
            $contDateHES = "",
            $contSssES = "",
            $contPhlhES = "",
            $contPagIES = "",
            $contTinES = "";
            $('#posContEDiv option[value="'+$contPos.html()+'"]').prop('selected', true);
            if($contCiv.html() == "SINGLE"){
                $("#singleR").prop("checked", true);
            }
            else{
                $("#marriedR").prop("checked", true);
            }

            if($contGend.html() == "MALE"){
                $("#maleR").prop("checked", true);
            }
            else{
                $("#femaleR").prop("checked", true);
            }
            $.each($id, function() {
                $idES = $(this).html();
            });
            $.each($contFn, function() {
                $("#firstNameContE").val($(this).html());
                $contFnES = $(this).html();
            });
            $.each($contMn, function() {
                $("#middleNameContE").val($(this).html());
                $contMnES = $(this).html();
            });
            $.each($contLn, function(){
                $("#lastNameContE").val($(this).html());
                $contLnES = $(this).html();
            });
            $.each($contPos, function(){
                
                $contPosES = $(this).html();
            });
            /*$.each($contCiv, function(){
                
                $contCivES = $(this).val();
            });
            $.each($contGend, function(){
                
                $contGendES = $(this).val();
            });*/
            $.each($contContNo, function(){
                $("#contNoE").val($(this).html());
                $contContNoES = $(this).html();
            });
            $.each($contBdate, function(){
                $("#bDateE").val($(this).html());
                $contBdateES = $(this).html();
            });
            $.each($contDateH, function(){
                $("#dateHiredE").val($(this).html());
                $contDateHES = $(this).html();
            });
            $.each($contSss, function(){
                $("#sssE").val($(this).html());
                $contSssES = $(this).html();
            });
            $.each($contPhlh, function(){
                $("#phlhE").val($(this).html());
                $contPhlhES = $(this).html();
            });
            $.each($contPagI, function(){
                $("#pagIE").val($(this).html());
                $contPagIES = $(this).html();
            });
            $.each($contTin, function(){
                $("#tinE").val($(this).html());
                $contTinES = $(this).html();
            });
            console.log($idES);
            $("#idEdit").val($idES);
            $("#editModalCont").modal('show');
        });
    });
}
$("#editBtnPos").click(function(){
    let editPos = true,
    posE = $("#posEdit").val(),
    ids = $("#editBtnPos").val();
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            editPos: editPos,
            idPos: ids,
            posE:posE
        },
        dataType: "html"
    });
    req.done(function(msg){
        $(".rowDataPos").remove();
        showDataPos();
        $("#editModalPos").modal('hide');
        console.log("hello pos");
    });
});
$("#viewExcelContacts").click(function(){
    let viewExcelCont = true;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {viewExcelCont: viewExcelCont},
        dataType: "html"
    });
    req.done(function(msg){
        console.log(msg);
    });
});
function editPos($idS,$posS){
    let editPos = true,
    ids = $idS,
    posE = $posS;
    
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data: {
            editPos: editPos,
            idPos: ids,
            posE:posE
        },
        dataType: "html"
    });
    req.done(function(msg){
        $(".rowDataPos").remove();
        showDataPos();
        $("#editModalCont").modal('hide');
        console.log(msg);
    });
}

function showPic(id){
    let showPic = true,
    idP = id;
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data:{
            showPic: showPic,
            idP: idP
        },
        dataType: "html"
    });
    req.done(function(msg){
        //$("#imageDiv").html("<img src='"+msg+"' alt='' />");
        $(".profilePic").remove();
        $("#imageDiv").append(msg);
        //$("#imageDiv img").attr("src", msg);
        console.log(msg);
    });
}

$("#formExcelCont").on('submit',(function(e){
    e.preventDefault();
    let fd = new FormData(this);
    let req = $.ajax({
        url: "process.php",
        method: "post",
        data: fd,
        contentType: false,
        processData: false
    });
    req.done(function(msg){
        /*$(".rowDataCont").remove();
        showDataCont();
        $("#editModalCont").modal('hide');*/
        console.log(msg);
    });
}));
//$("#editBtnCont").click(function(){
    //$posS = $("#posEdit").val();
    $("#formEditCont").on('submit',(function(e){
        e.preventDefault(); 
        let fd = new FormData(this);
        let editCont = true,
        ids = $("#editBtnCont").val(),
        fn = $("#firstNameContE").val(),
        mn = $("#middleNameContE").val(),
        ln = $("#lastNameContE").val(),
        posCont = $("#posContE").val(),
        civ = $(".occuE:checked").val(),
        gend = $(".gendE:checked").val(),
        contNo = $("#contNoE").val(),
        bdate = $("#bDateE").val(),
        dateH = $("#dateHiredE").val(),
        sss = $("#sssE").val(),
        phlh = $("#phlhE").val(),
        pagI = $("#pagIE").val(),
        tin = $("#tinE").val(),
        files = $('#imageContE')[0].files,
        imageP = $("#imageContE[type=file]").val();
        let req = $.ajax({
            url: "process.php",
            method: "post",
            data: 
                //editCont: editCont,
                fd,
                /*fn: fn,
                mn: mn,
                ln: ln,
                posCont: posCont,
                civCont: civ,
                gend: gend,
                contNo: contNo,
                bdate: bdate,
                dateH: dateH,
                sss: sss,
                phlh: phlh,
                pagI: pagI,
                tin: tin,
                imageP: imageP*/
            
            contentType: false,
            processData: false
        });
        req.done(function(msg){
            $(".rowDataCont").remove();
            showDataCont();
            $("#editModalCont").modal('hide');
            console.log(msg);
        });
    }));
    
    
//});

$("#contactsBtn").click(function(){
    $("#pageTitle").html("Contacts");
    $("#dashboard").hide();
    $("#contacts").addClass('content d-inline').removeClass('content d');
    $("#position").addClass('content d').removeClass('content d-inline');
    //$("#contacts").show();
});

$("#AddContactsBtn").click(function(){
    $("#contactModal").modal('show');
});

$("#positionBtn").click(function(){
    $("#pageTitle").html("Position");
    $("#dashboard").hide();
    $("#contacts").addClass('content d').removeClass('content d-inline');
    $("#position").addClass('content d-inline').removeClass('content d');
});

$("#addPositionBtn").click(function(){
    $('#addPositionModal').modal('show');
});

$("#posSubBtn").click(function(){
    let pos = true;
    let posInp = $("#positionInp").val();
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data:{
            pos: pos,
            posInp: posInp
        }
    });
    req.done(function(msg){
        $('.rowDataPos').remove();
        $('#addPositionModal').modal('hide');
        showDataPos();
        console.log(msg);
    });
});

$("#deleteBtnPosModal").click(function(){
    let delPos = true;
    let idPos = $("#deleteBtnPosModal").val();
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data:{
            delPos: delPos,
            idPos: idPos
        }
    });
    req.done(function(){
        $('#deleteModalPos').modal('hide');
        $(".rowDataPos").remove();
        showDataPos();
    });
});

$("#deleteBtnContModal").click(function(){
    let delCont = true;
    let idCont = $("#deleteBtnContModal").val();
    let req = $.ajax({
        url: "process.php",
        method: "get",
        data:{
            delCont: delCont,
            idCont: idCont
        }
    });
    req.done(function(){
        $('#deleteModalCont').modal('hide');
        $(".rowDataCont").remove();
        showDataCont();
    });
});

$("#contSub").click(function(){
    let contIns = true;
    let fn = $("#firstNameCont").val(),
    mn = $("#middleNameCont").val(),
    ln = $("#lastNameCont").val(),
    posCont = $("#pos").val(),
    occu = $(".occu:checked").val(),
    gend = $(".gend:checked").val(),
    contNo = $("#contNo").val(),
    bDate = $("#bDate").val(),
    dateHired = $("#dateHired").val(),
    sss = $("#sss").val(),
    phlh = $("#phlh").val(),
    pagI = $("#pagI").val(),
    tin = $("#tin").val();

    let req = $.ajax({
        url: "process.php",
        method: "POST",
        data: {
            contIns: contIns,
            fn: fn,
            mn: mn,
            ln: ln,
            posCont: posCont,
            occu: occu,
            gend: gend,
            contNo: contNo,
            bDate: bDate,
            dateHired: dateHired,
            sss: sss,
            phlh: phlh,
            pagI: pagI,
            tin: tin
        },
        dataType: "html"
    });
    req.done(function(msg){
        $(".rowDataCont").remove();
        console.log(msg);
        showDataCont();
    });
    $('#contactModal').modal('hide');
});

$("#genExcel").click(function(){
    let genExc = true;
    req = $.ajax({
        url: "process.php",
        method: "post",
        data: {
          genExc: genExc  
        },
        dataType: "html"
    });
    req.done(function(msg){
        console.log(msg);
    });
});
