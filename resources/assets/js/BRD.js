/**
 * Board Custom | @honeypigman
 * 
 */
$(document).ready(function() {    

    // Set Modal
    init_modal('boardModal', 750, 450);
    
    const tbl = $("#tbl").val();

    $( "#sdate" ).datepicker();
    $( "#edate" ).datepicker();

    $("#boardModal").on('show.bs.modal', function () {
        var modalWidth = 650;
        var modalHeight = 500;

        $(".board-modal-dialog").css("width", modalWidth + "px");
        $(".modal-body").css("height", modalHeight + "px");
        $(".modal-content").css('height', 'auto');
        fn_ModalOptions(modalWidth, modalHeight);
    })

    var spinnerBtn= "<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div> ";

    // Board Tab
    $(".board .nav-link").click(function(){
        var arrSplit = ($(this).attr('id')).split('_');
        var tab = arrSplit[1];
        $("#current_page").val(1);
        if(tab == "Active" ){
            submit('List', 'Y');
        }else if(tab == "Delete"){
            submit('List', 'N');
        }
    });

    // Board View
    $("#boardBody").on('click', '.boardView', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var bno = arrSplit[1];

        if( bno>0 ){
            var action = "View";
            $("#boardModal").modal("show");
            $(".modal-title").text('['+bno+'] '+action);
            $("#btnEdit").text('Edit');            
            $("#btnEdit").attr("disabled", false);
            $("#btnDel").text('Delete');
            $("#btnDel").attr("disabled", false);
            $("#bno").val(bno);

            submit(action);         
        }
    })
    
    // Board Write
    $("#boardWrite").click(function(){
        callEditor('INIT');
        $(".modal-title").text('Writing');
        $("#inputTitle").val('');
        $("#inputContent").val('');
        $("#btnEdit").text("Save");
        $("#btnEdit").attr("disabled", false);
        $("#btnDel").addClass('d-none');
    })

    // Board Edit
    $("#btnEdit").click(function(){
        var action = $(this).text();
        $(this).prepend(spinnerBtn);
        $(this).attr("disabled", true);
        submit(action);
    });

    // Board Delete
    $("#btnDel").click(function(){
        var action = "Delete";
        $(this).prepend(spinnerBtn);
        $(this).attr("disabled", true);
        submit(action);
    });

    //Page Link
    $("#pagination").on('click', '.setPage', function () {

        $("#action").val('List');
        $("#current_page").val($(this).text());
        
        var formData = $("#boardFrm").serializeObject();
        $.ajax({
            method:"POST",
            url:"/admin/board/action/"+tbl,
            dataType : 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:(formData),
            success : function(rs){

                if(rs.result){
                    $("#boardBody").empty().append(rs.result_list);
                    setPagenation(rs.result_page);
                }
            },
            error : function(error){
                alert('Error>'+error);
            }
        })
    })

    // Set Pagenation Next / Pre
    $("#pagination").on('click', '.movePage', function () {
        var setPage = 1;
        var setPageAct = $(this).text();
        var setTotalPage = $("#total_page").val();
        if( setPageAct == '>' ){ 
            setPage = parseInt($(".page-link").last().attr('aria-label'));
            if(setPage>setTotalPage){
                return false;
            }
        }else{
            setPage = parseInt($(".page-link").first().attr('aria-label'));
            if(setPage<1){
                return false;
            }
        }

        $("#current_page").val(setPage);
        submit('List', 'Y');  
    }) 

    // Set Pagenation
    var setPagenation = function(page){        
        var perPage = page['limit'];
        var setCurrentPage = (!page['current_page']?1:$("#current_page").val());
        var setPageGrp = Math.ceil(setCurrentPage/perPage);
        var setEPageNum = setPageGrp*perPage;
        var setSpageNum = (setEPageNum-perPage)+1;
        var setPageNation = "<li class='page-item movePage'><a class='page-link' href='#' aria-label='"+(setSpageNum-1)+"'><span aria-hidden='true'><</span></a></li>";
        for(setSpageNum; setSpageNum<=(page['totalPage']>setEPageNum?setEPageNum:page['totalPage']); setSpageNum++){
            var addClass="";    
            if(setSpageNum == setCurrentPage){
                addClass= "bg-secondary text-white";
            }
            setPageNation+="<li class='page-item setPage'><a class='page-link "+addClass+"' href='#' >"+setSpageNum+"</a></li>";
        }
        setPageNation+="<li class='page-item movePage'><a class='page-link' href='#' aria-label='"+setSpageNum+"'><span aria-hidden='true'>></span></a></li>";

        if(page['totalPage'] == setCurrentPage){
            setSpageNum=0;
        }
                
        // Pagination
        $("#pagination").empty().append(setPageNation);
        $("#current_page").val(setCurrentPage);
        $("#total_page").val(page['totalPage']);
    }

    var submit = function(action, status=null){
        $("#action").val(action);  
        if( action =="List" ){
            $("#list_status").val(status);
        }else if( action == "Edit" || action == "Save" ){
            var title = $("#inputTitle").val();
            var email = $("#inputEmail").val();
            var content = callEditor('GET');
            $("#title").val(title);
            $("#email").val(email);
            $("#content").val(content);
        }
        var formData = $("#boardFrm").serializeObject();
        $.ajax({
            method:"POST",
            url:"/admin/board/action/"+tbl,
            dataType : 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:(formData),
            success : function(rs){
                if(rs.result){
                    if( action == "View" ){
                        $.each(rs.result_data, function() {
                            callEditor('INIT');
                            $("#inputTitle").val(this.title);
                            $("#inputContent").text(this.content);
                            if(this.status == 'N'){
                                $(".modal-footer-edit").addClass('d-none');
                                $("#inputContent").attr("disabled", true);
                                $("#inputTitle").attr("disabled", true);
                            }else{
                                $(".modal-footer-edit").removeClass('d-none');
                                $("#inputContent").attr("disabled", false);
                                $("#inputTitle").attr("disabled", false);
                            }
                        });                    
                        $("#btnDel").removeClass('d-none');
                    }else if ( action == "List"){
                        $("#boardBody").empty().append(rs.result_list);
                        setPagenation(rs.result_page);
                    }else{
                        $("#boardModal").modal("hide");
                        submit('List', 'Y');
                    }
                }
            },
            error : function(error){
                alert('Error>'+error);
            }
        });
    }

    // Editor Event
    var callEditor = function(action){
        if(action == "INIT"){
            // ContentsArea
            $("#inputContentArea").html('').append("<textarea name='inputContent' id='inputContent' rows='10' cols='80'></textarea>");
            CKEDITOR.replace( 'inputContent' );
            CKEDITOR.config.height = '15rem';
        }else if(action == "GET"){
            return CKEDITOR.instances.inputContent.getData();
        }
    }
        
    // Default Setting
    submit('List', 'Y');    
});