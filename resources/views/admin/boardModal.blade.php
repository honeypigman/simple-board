<!--
    Title : Admin Layout Board Modal-Write | Honeypigman@gmail.com
    Date : 2020.12.30
    His.
          2021.02.15  Modal Wide Funtion Add by @cjuco
//-->

<div id="boardModal" class="modal fade open-boardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered board-modal-dialog">
    <div class="modal-content">
      <div id="modalHeader" class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <!-- Modal-Form START -->
        <form>
        <div class="row mb-1">
            <label for="inputPassword3" class="col-sm-2 col-form-label">Title</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputTitle" autofocus>
            </div>
        </div>
        <div class="row mb-1">
            <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="email" class="form-control border-0" id="inputEmail" value="{{ Session::get('login_id') }}" readOnly>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-sm-12" id="inputContentArea"></div>
        </div>
        </form>        
        <!-- Modal-Form END -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
        <div class="modal-footer-edit">
          <button type="button" class="btn btn-primary" id='btnEdit'></button>
          <button type="button" class="btn btn-danger d-none" id='btnDel'>Delete</button>
        </div>
      </div>      
    </div>
  </div>