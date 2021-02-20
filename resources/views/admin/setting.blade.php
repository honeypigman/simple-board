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
  <input type="hidden" name="action" id="action">
  <input type="hidden" name="category" id="category">  
</form>
<div class="setting">
    <div class="raw">
        <div class="col-4 float-start pe-3">
            <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    Category
                    <span class="float-end mt-1" data-feather="plus-square"></span>
                 </p>
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <th class="col-md-5">CODE</th>
                        <th class="col-md-5">DES</th>
                        <th class="col-md-2">Y/N</th>
                    </thead>
                    <tbody id="categoryBody">
                        @foreach($PARENT as $k=>$v)
                        <tr id="{{ $v->category }}" class="categoryList" style="cursor:pointer;">
                            <td>{{ $v->category }}</td>
                            <td>{{ $v->remark }}</td>
                            <td>{{ $v->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-8 float-end">
        <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    <span id="category-title">Code List </span>
                    <span class="float-end mt-1" data-feather="plus-square"></span>
                </p>
                <table class="table table-sm table-hover">
                    <thead class="table-light">
                        <th class="col-md-2">Sort</th>
                        <th class="col-md-5">CODE</th>
                        <th class="col-md-5">DES</th>
                    </thead>
                    <tbody id='categoryCodeBody'>
                        <tr>
                            <td colspan="3" align=center class="text-secondary">The data does not exist.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
<!-- Script Push -->
@push('scripts')
    <script src="/js/SET.js"></script>
@endpush
@endsection