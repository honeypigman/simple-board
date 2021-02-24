/**
 * Setting Custom | @honeypigman
 *  Date : 2020.12.30
 * 
 */
$(document).ready(function() {
    
    var spinnerBtn= "<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div> ";

    // Modal - Category Init
    init_modal('modalCategory', 450, 110);
    $("#btnCategoryModal").click(function(){
        console.log('modalCategory');
        $(".modal-title").text('Category');
        $("#inputCategory").val('');
        $("#inputRemark").val('');
        $("#btnCategory").text("Save");
        $("#btnCategory").attr("disabled", false);
    });

    // Modal Category - Save
    $("#btnCategory").click(function(){
        var action = $(this).text();
        $(this).prepend(spinnerBtn);
        $(this).attr("disabled", true);
        submit('categoryFrm', action, '');
    });

    // Modal - Code Init
    init_modal('modalCode', 450, 150);
    $("#btnCodeModal").on('click',function () {
        $(".modal-title").empty().append('Code :: <span class="badge rounded-pill bg-light text-dark">'+$("#category").val()+'</span>');
        $("#inputCategory").val('');
        $("#inputSort").val('');
        $("#inputCode").val('');
        $("#inputName").val('');
        $("#btnCode").text("Save");
        $("#btnCode").attr("disabled", false);
    });

    // Modal Code - Save
    $("#btnCode").click(function(){
        var category = $("#category").val();
        var action = $(this).text();
        $(this).prepend(spinnerBtn);
        $(this).attr("disabled", true);
        submit('categoryCodeFrm', action, category);
    });

    var submit = function(form, action, key){

        $("input[name=category]", document.form).val(key);
        $("input[name=action]", document.form).val(action);         

        // Modal Data Setting
        if( action == 'Save' ){
            switch(form){
                case 'categoryFrm':
                    $("input[name=remark]", document.form).val($("#inputRemark").val());  
                    $("input[name=category]", document.form).val($("#inputCategory").val());  
                    break;
                case 'categoryCodeFrm':
                    $("input[name=sort]", document.form).val($("#inputSort").val());  
                    $("input[name=code]", document.form).val($("#inputCode").val());  
                    $("input[name=name]", document.form).val($("#inputName").val());  
                    break;
            }
        }
    
        var formData = $("#"+form).serializeObject();
        $.ajax({
            method:"POST",
            url:"/admin/setting/"+action,
            dataType : 'JSON',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:(formData),
            success : function(rs){
                if(rs.result){
                    if( action == 'List' ){
                        switch(form){
                            case 'categoryFrm':
                                $("#categoryBody").empty().append(rs.result_list);
                                break;
                            case 'categoryCodeFrm':
                                $("#categoryCodeBody").empty().append(rs.result_list);
                                $("#btnCodeModal").removeClass("d-none");
                                $("#category-title").empty().append('Code List :: <span class="badge rounded-pill bg-light text-dark">'+key+'</span>');
                                break;
                        }
                        feather.replace();
                    }

                    else if ( action == 'Update' || action == 'Delete' || action == 'Save' ){
                        if( action == 'Save' ){
                            $("div[id^='modal']").modal("hide");
                        }
                        submit(form, 'List', key);
                    }
                }
            },
            error : function(error){
                alert('Error>'+error);
            }
        });
    }

    // Category Setting
    //  - 이 부분은 효율적인 생산방식으로 개선하고 싶은데 흠 ..
    //  - 고전적인 처리 방식이라고해야하나? 흠 .. 

    // Init
    submit('categoryFrm', 'List', 'All'); 

    // Category Code List
    $("#categoryBody").on('click', '.categoryList', function () {
        var category = $(this).attr('id');
        submit('categoryCodeFrm', 'List', category);
    })

    // Category - Set Unlock
    $("#categoryBody").on('click', '.categoryLock', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var key = arrSplit[1];
        var remark = $("#remark_"+key).text();

        $("#remark_"+key).empty().append('<input class="form-control form-control-sm" text="name" value="'+remark+'" style="border:0px; font-size:0.75rem;"></td>');
        $("#remark_"+key+" > input").select();

        $(this).removeClass('d-inline');
        $(this).addClass('d-none');
        $("#unlock_"+key).removeClass('d-none');
        $("#unlock_"+key).addClass('d-inline');      
        $("#delete_"+key).removeClass('d-none');
        $("#delete_"+key).addClass('d-inline');     
    })

    // Category - Update Data
    $("#categoryBody").on('click', '.categoryUnLock', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var key = arrSplit[1];
        var remark = $("#remark_"+key+" > input").val();

        $(this).removeClass('d-inline');
        $(this).addClass('d-none');
        $("#lock_"+key).removeClass('d-none');
        $("#lock_"+key).addClass('d-inline');      

        $("#remark").val(remark);
 
        submit('categoryFrm', 'Update', key);
    })

    // Category - Delete Data
    $("#categoryBody").on('click', '.categoryDelete', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var key = arrSplit[1];

        submit('categoryFrm', 'Delete', key);
    })


    // Code - Set Unlock
    $("#categoryCodeBody").on('click', '.categoryCodeLock', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var key = arrSplit[1]+"_"+arrSplit[2];
        var sort = $("#sort_"+key).text();
        var name = $("#name_"+key).text();

        $("#sort_"+key).empty().append('<input class="form-control form-control-sm" text="name" value="'+sort+'" style="border:0px; font-size:0.75rem;"></td>');
        $("#name_"+key).empty().append('<input class="form-control form-control-sm" text="name" value="'+name+'" style="border:0px; font-size:0.75rem;"></td>');
        $("#sort_"+key+" > input").select();

        $(this).removeClass('d-inline');
        $(this).addClass('d-none');
        $("#unlock_"+key).removeClass('d-none');
        $("#unlock_"+key).addClass('d-inline'); 
        $("#delete_"+key).removeClass('d-none');
        $("#delete_"+key).addClass('d-inline');     
    })

    // Code - Update Data
    $("#categoryCodeBody").on('click', '.categoryCodeUnLock', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var category = arrSplit[1];
        var key = arrSplit[1]+"_"+arrSplit[2];
        var sort = $("#sort_"+key+" > input").val();
        var name = $("#name_"+key+" > input").val();
        var code = $("#code_"+key).text();

        $(this).removeClass('d-inline');
        $(this).addClass('d-none');
        $("#lock_"+key).removeClass('d-none');
        $("#lock_"+key).addClass('d-inline');      
        $("#sort").val(sort);
        $("#code").val(code);
        $("#name").val(name);

        submit('categoryCodeFrm', 'Update', category);
    })

    // Code - Delete Data
    $("#categoryCodeBody").on('click', '.categoryCodeDelete', function () {
        var arrSplit = ($(this).attr('id')).split('_');
        var category = arrSplit[1];
        var key = arrSplit[1]+"_"+arrSplit[2];
        var code = $("#code_"+key).text();

        $("#code").val(code);

        submit('categoryCodeFrm', 'Delete', category);
    })
});