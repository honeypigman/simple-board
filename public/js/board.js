function init_modal(t,a,e){$("#"+t).on("show.bs.modal",function(){$(".board-modal-dialog").css("width",a+"px"),$(".modal-body").css("height",e+"px"),$(".modal-content").css("height","auto"),fn_ModalOptions(t,a,e)})}function fn_ModalOptions(t,a,e){var i=0,n=$("#"+t),o=a,l=e;n.find(".modal-content").resizable({start:function(t,a){},stop:function(t,a){},minWidth:400,minHeight:110,handles:"n, e, s, w, ne, sw, se, nw",alsoResize:".modal-body"}).draggable({handle:".modal-header",scroll:!1}),$("#modalHeader").dblclick(function(){0==i?(i=1,$(".modal-dialog").css("top","0px"),$(".modal-dialog").css("right","0px"),$(".modal-dialog").css("bottom","0px"),$(".modal-dialog").css("left","0px"),$(".modal-dialog").css("width","100%"),$(".modal-dialog").css("height","100%"),$(".modal-content").css("top","0px"),$(".modal-content").css("left","0px"),$(".modal-content").css("width","100%"),$(".modal-content").css("height","100%"),$(".modal-body").css("width","100%"),$(".modal-body").css("height","calc(100% - 134px)")):(i=0,$(".modal-dialog").css("top","0px"),$(".modal-dialog").css("right","0px"),$(".modal-dialog").css("bottom","0px"),$(".modal-dialog").css("left","0px"),$(".modal-dialog").css("width",o+"px"),$(".modal-dialog").css("height","100%"),$(".modal-content").css("top","0px"),$(".modal-content").css("left","0px"),$(".modal-content").css("width","auto"),$(".modal-content").css("height","auto"),$(".modal-body").css("width",o+"px"),$(".modal-body").css("height",l+"px"))})}$(document).ready(function(){init_modal("boardModal",750,450);const t=$("#tbl").val();$("#sdate").datepicker(),$("#edate").datepicker(),$("#boardModal").on("show.bs.modal",function(){$(".board-modal-dialog").css("width","650px"),$(".modal-body").css("height","500px"),$(".modal-content").css("height","auto"),fn_ModalOptions(650,500)});var a="<div class='spinner-border spinner-border-sm' role='status'><span class='visually-hidden'>Loading...</span></div> ";$(".board .nav-link").click(function(){var t=$(this).attr("id").split("_")[1];$("#current_page").val(1),"Active"==t?i("List","Y"):"Delete"==t&&i("List","N")}),$("#boardBody").on("click",".boardView",function(){var t=$(this).attr("id").split("_")[1];if(t>0){$("#boardModal").modal("show"),$(".modal-title").text("["+t+"] View"),$("#btnEdit").text("Edit"),$("#btnEdit").attr("disabled",!1),$("#btnDel").text("Delete"),$("#btnDel").attr("disabled",!1),$("#bno").val(t),i("View")}}),$("#boardWrite").click(function(){n("INIT"),$(".modal-title").text("Writing"),$("#inputTitle").val(""),$("#inputContent").val(""),$("#btnEdit").text("Save"),$("#btnEdit").attr("disabled",!1),$("#btnDel").addClass("d-none")}),$("#btnEdit").click(function(){var t=$(this).text();$(this).prepend(a),$(this).attr("disabled",!0),i(t)}),$("#btnDel").click(function(){$(this).prepend(a),$(this).attr("disabled",!0),i("Delete")}),$("#pagination").on("click",".setPage",function(){$("#action").val("List"),$("#current_page").val($(this).text());var a=$("#boardFrm").serializeObject();$.ajax({method:"POST",url:"/admin/board/action/"+t,dataType:"JSON",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},data:a,success:function(t){t.result&&($("#boardBody").empty().append(t.result_list),e(t.result_page))},error:function(t){alert("Error>"+t)}})}),$("#pagination").on("click",".movePage",function(){var t=1,a=$(this).text(),e=$("#total_page").val();if(">"==a){if((t=parseInt($(".page-link").last().attr("aria-label")))>e)return!1}else if((t=parseInt($(".page-link").first().attr("aria-label")))<1)return!1;$("#current_page").val(t),i("List","Y")});var e=function(t){for(var a=t.limit,e=t.current_page?$("#current_page").val():1,i=Math.ceil(e/a)*a,n=i-a+1,o="<li class='page-item movePage'><a class='page-link' href='#' aria-label='"+(n-1)+"'><span aria-hidden='true'><</span></a></li>";n<=(t.totalPage>i?i:t.totalPage);n++){var l="";n==e&&(l="bg-secondary text-white"),o+="<li class='page-item setPage'><a class='page-link "+l+"' href='#' >"+n+"</a></li>"}o+="<li class='page-item movePage'><a class='page-link' href='#' aria-label='"+n+"'><span aria-hidden='true'>></span></a></li>",t.totalPage==e&&(n=0),$("#pagination").empty().append(o),$("#current_page").val(e),$("#total_page").val(t.totalPage)},i=function(a,o=null){if($("#action").val(a),"List"==a)$("#list_status").val(o);else if("Edit"==a||"Save"==a){var l=$("#inputTitle").val(),s=$("#inputEmail").val(),d=n("GET");$("#title").val(l),$("#email").val(s),$("#content").val(d)}var r=$("#boardFrm").serializeObject();$.ajax({method:"POST",url:"/admin/board/action/"+t,dataType:"JSON",headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")},data:r,success:function(t){t.result&&("View"==a?($.each(t.result_data,function(){n("INIT"),$("#inputTitle").val(this.title),$("#inputContent").text(this.content),"N"==this.status?($(".modal-footer-edit").addClass("d-none"),$("#inputContent").attr("disabled",!0),$("#inputTitle").attr("disabled",!0)):($(".modal-footer-edit").removeClass("d-none"),$("#inputContent").attr("disabled",!1),$("#inputTitle").attr("disabled",!1))}),$("#btnDel").removeClass("d-none")):"List"==a?($("#boardBody").empty().append(t.result_list),e(t.result_page)):($("#boardModal").modal("hide"),i("List","Y")))},error:function(t){alert("Error>"+t)}})},n=function(t){if("INIT"==t)$("#inputContentArea").html("").append("<textarea name='inputContent' id='inputContent' rows='10' cols='80'></textarea>"),CKEDITOR.replace("inputContent"),CKEDITOR.config.height="15rem";else if("GET"==t)return CKEDITOR.instances.inputContent.getData()};i("List","Y")});
