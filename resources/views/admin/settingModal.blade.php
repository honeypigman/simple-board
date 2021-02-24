<!--
    Title : Admin Layout Setting Modal | Honeypigman@gmail.com
    Date : 2021.02.20
//-->

<div id="modalCategory" class="modal fade open-boardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
              <label for="inputCategory" class="col-sm-2 col-form-label">Category</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputCategory" autofocus>
              </div>
          </div>
          <div class="row mb-1">
              <label for="inputRemark" class="col-sm-2 col-form-label">Remark</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputRemark">
              </div>
          </div>
        </form>        
        <!-- Modal-Form END -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
        <div class="modal-footer-edit">
          <button type="button" class="btn btn-primary" id='btnCategory'></button>
        </div>
      </div>      
    </div>
  </div>
</div>


<div id="modalCode" class="modal fade open-boardModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
              <label for="inputSort" class="col-sm-2 col-form-label">Sort</label>
              <div class="col-sm-10">
                  <input type="number" class="form-control" id="inputSort" autofocus>
              </div>
          </div>
          <div class="row mb-1">
              <label for="inputCode" class="col-sm-2 col-form-label">Code</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputCode" autofocus>
              </div>
          </div>
          <div class="row mb-1">
              <label for="inputName" class="col-sm-2 col-form-label">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" id="inputName" autofocus>
              </div>
          </div>
        </form>        
        <!-- Modal-Form END -->

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>        
        <div class="modal-footer-edit">
          <button type="button" class="btn btn-primary" id='btnCode'></button>
        </div>
      </div>      
    </div>
  </div>
</div>