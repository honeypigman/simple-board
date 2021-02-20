/**
 * Setting Custom | @honeypigman
 * 
 */
$(document).ready(function() {
    
    var submit = function(action, category){
        $("#action").val(action);
        $("#category").val(category);

        var formData = $("#categoryFrm").serializeObject();
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
                    $("#categoryCodeBody").empty().append(rs.result_list);
                    $("#category-title").empty().append(''+category+' :: Code List');
                }
            },
            error : function(error){
                alert('Error>'+error);
            }
        });
    }

    $("#categoryBody").on('click', '.categoryList', function () {
        var action = 'LIST';
        var category = $(this).attr('id');
        submit(action, category);         
    })

});