/**
 * Modal Custom | @cjuco
 * 
 */
function init_modal(target, modalWidth, modalHeight){
    $("#"+target).on('show.bs.modal', function () {
        $(".board-modal-dialog").css("width", modalWidth + "px");
        $(".modal-body").css("height", modalHeight + "px");
        $(".modal-content").css('height', 'auto');
        fn_ModalOptions(target, modalWidth, modalHeight);
    })
}

function fn_ModalOptions(target, _width, _height) {
    var zoomInOut = 0;   // 0: 최소화, 1: 최대화
    var modalView = $("#"+target);
    var getModalWidth = _width;
    var getModalHeight = _height;
    
    modalView.find('.modal-content').resizable({
        start: function(event, ui) {
            //modalView.find('.modalPage-resize-drag').show();
        },
        stop: function(event, ui) {
            //modalView.find('.modalPage-resize-drag').hide();
        },
        minWidth: 400,
        minHeight: 110,
        handles: 'n, e, s, w, ne, sw, se, nw',
        alsoResize: ".modal-body"
        //alsoResize: ".modal-header, .modal-body, .modal-footer"
    }).draggable({
        handle: ".modal-header",
        scroll: false
    });

    $("#modalHeader").dblclick(function() {
        modalZoom();
    })

    function modalZoom() {
        if(zoomInOut == 0) {
            zoomInOut = 1;                          
            $(".modal-dialog").css('top', '0px');
            $(".modal-dialog").css('right', '0px');
            $(".modal-dialog").css('bottom', '0px');
            $(".modal-dialog").css('left', '0px');
            $(".modal-dialog").css('width', '100%');
            $(".modal-dialog").css('height', '100%');                
            $(".modal-content").css('top', '0px');
            $(".modal-content").css('left', '0px');
            $(".modal-content").css('width', '100%');
            $(".modal-content").css('height', '100%');                
            $(".modal-body").css('width', '100%');
            $(".modal-body").css('height', 'calc(100% - 134px)'); // 100% -  (header + footer)
           
        } else {
            zoomInOut = 0;                
            $(".modal-dialog").css('top', '0px');
            $(".modal-dialog").css('right', '0px');
            $(".modal-dialog").css('bottom', '0px');
            $(".modal-dialog").css('left', '0px');
            $(".modal-dialog").css('width', getModalWidth + 'px');
            $(".modal-dialog").css('height', '100%');
            
            $(".modal-content").css('top', '0px');
            $(".modal-content").css('left', '0px');
            $(".modal-content").css('width', 'auto');
            $(".modal-content").css('height', 'auto');
            
            $(".modal-body").css('width', getModalWidth + "px");
            $(".modal-body").css('height', getModalHeight + "px"); // 100% -  (header + footer)
        }
    }
}