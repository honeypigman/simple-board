<!--
    Title : Admin Layout Settings Information 
    Date : 2020.12.30
//-->
@extends('layout/header')
@section('content')
<div class="setting">
    <div class="raw">
        <div class="col-4 float-start pe-3">
            <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    Category
                    <span class="float-end mt-1" data-feather="plus-square"></span>
                </p>                
                <table class="table">
                    <thead class="table-light">
                        <th>CODE</th>
                        <th>DES</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-8 float-end">
        <div class="bd-example" style="padding:10px;">
                <p class="fw-bold text-start">
                    List
                    <span class="float-end mt-1" data-feather="plus-square"></span>
                </p>
                <table class="table">
                    <thead class="table-light">
                        <th>CODE</th>
                        <th>DES</th>
                        <th>Sort</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>2</td>
                            <td>3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@endsection