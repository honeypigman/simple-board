<!--    
    Title : Admin Layout Board | Honeypigman@gmail.com
    Date : 2020.12.30
//-->
@extends('layout/header')
@section('content')
<!-- CSRF-TOKEN //-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<form id="boardFrm" method="POST">
  @csrf
  <input type="hidden" name="action" id="action">
  <input type="hidden" name="list_status" id="list_status">
  <input type="hidden" name="bno" id="bno">
  <input type="hidden" name="email" id="email">
  <input type="hidden" name="title" id="title">
  <input type="hidden" name="total_page" id="total_page">
  <input type="hidden" name="current_page" id="current_page">
  <textarea class="d-none" name="content" id="content"></textarea>
</form>

<div class="admin_board">
    <div class="alert alert-primary" role="alert" style="margin-top:20px;">
        <form class="row" style="margin:-10px;">
            <div class="col-6 text-start">
                <select class="form-select-custom">
                    <option selected>Date</option>
                    <option value="save">Save</option>
                </select>
                <input type="text" class="form-input-md-custom" id="sdate" placeholder="Start Date" aria-label="State">
                <input type="text" class="form-input-md-custom" id="edate" placeholder="End Date" aria-label="Zip">
                <select class="form-select-custom">
                    <option selected>Status</option>
                    <option value="Y">Active</option>
                    <option value="N">Delte</option>
                </select>
            </div>
            <div class="col-5 text-end">
                <select class="form-select-custom">
                    <option selected>Search</option>
                    <option value="no">No</option>
                    <option value="title">Title</option>
                    <option value="content">Content</option>
                    <option value="writer">Writer</option>
                </select>
                <input type="text" class="form-input-lg-custom" placeholder="Search" aria-label="State">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-light align-right"><span data-feather="search"></span></button>
            </div>
        </form>
    </div>

    <!-- Search Button //-->
    <div class="row">
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-sm btn-success align-right"><span data-feather="download"></span>Excel</button>
            <button type="submit" class="btn btn-sm btn-light align-right" id="boardWrite" data-bs-toggle="modal" data-bs-target="#boardModal"><span data-feather="edit"></span>writing</button>
        </div>
    </div>
    <hr>

    <!-- Board Tab //-->    
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-link active" id="tab_active" data-bs-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Active</a>
            <a class="nav-link" id="tab_delete" data-bs-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Delete</a>
        </div>
    </nav>

    <!-- Board List //-->    
    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th scope="col" style="width: 3%"><input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"></th>
                <th scope="col" style="width: 5%">No</th>
                <th scope="col" style="width: 5%">Sort</th>
                <th scope="col" style="width: 20%">Title</th>
                <th scope="col" style="width: 10%">Info</th>
                <th scope="col" style="width: 5%">Status</th>
            </tr>
        </thead>
        <div  data-role="page">
        <tbody id='boardBody'>
            <tr><td colspan="6" align=center>
                <button class="btn fs-6 w-100" type="button" disabled>
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    로딩중 ...
                </button>
            </td></tr>
        </tbody>
        </div>
    </table>

    <!-- Pagination //-->
    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
            <nav  aria-label="Page navigation">
            <ul class="pagination" id="pagination"></ul>
            </nav>
        </div>
        <div class="col-sm"></div>
    </div>
</div>
@include('admin/boardModal')
</div>

<!-- Script Push -->
@push('scripts')
    <script src="{{ mix('/js/board.js') }} "></script>
    <script src="/ckeditor/ckeditor.js"></script>
@endpush

@endsection