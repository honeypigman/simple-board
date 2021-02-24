<!--
    Title : Admin Layout Settings Information 
    Date : 2020.12.30
//-->
@extends('layout/header')
@section('content')
<!-- CSRF-TOKEN //-->
<meta name="csrf-token" content="{{ csrf_token() }}">

<form id="categoryFrm" method="POST">
  @csrf
  <input type="hidden" name="div" value="CATEGORY">
  <input type="hidden" name="action" id="action">
  <input type="hidden" name="category" id="category">
  <input type="hidden" name="remark" id="remark">
</form>

<form id="categoryCodeFrm" method="POST">
  @csrf
  <input type="hidden" name="div" value="CODE">
  <input type="hidden" name="action" id="action">
  <input type="hidden" name="category" id="category">
  <input type="hidden" name="sort" id="sort">
  <input type="hidden" name="code" id="code">
  <input type="hidden" name="name" id="name">
</form>

<div class="setting">
    <div class="raw">
        <div class="col-4 float-start pe-3">
            <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    Category
                    <span id="btnCategoryModal" class="float-end mt-1" data-bs-toggle="modal" data-bs-target="#modalCategory" data-feather="plus-square" style="cursor:pointer;"></span>
                 </p>
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <th class="col-md-4">CODE</th>
                        <th class="col-md-6">DES</th>
                        <th class="col-md-2">Fun.</th>
                    </thead>
                    <tbody id="categoryBody">
                        <tr>
                            <td colspan="3" align=center class="text-secondary">The data does not exist.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-8 float-end">
        <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    <span id="category-title">Code List </span>
                    <span id="btnCodeModal" class="float-end mt-1 d-none" data-bs-toggle="modal" data-bs-target="#modalCode" data-feather="plus-square" style="cursor:pointer;"></span>
                </p>
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <th class="col-md-1">Sort</th>
                        <th class="col-md-4">CODE</th>
                        <th class="col-md-5">DES</th>
                        <th class="col-md-2">Fun.</th>
                    </thead>
                    <tbody id='categoryCodeBody'>
                        <tr>
                            <td colspan="4" align=center class="text-secondary">The data does not exist.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
    @include('admin/settingModal')
</div>
<!-- Script Push -->
@push('scripts')
    <script src="{{ mix('/js/setting.js') }} "></script>
@endpush
@endsection