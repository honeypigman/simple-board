<!--
    Title : Admin Layout Access Log
    Date : 2020.12.30
//-->
@extends('layout/header')
@section('content')

<div class="access_board">
    <div class="alert alert-primary" role="alert" style="margin-top:20px;">
        <form class="row" style="margin:-10px;">
            <div class="col-6 text-start">
                <select class="form-select-custom">
                    <option selected>Date</option>
                    <option value="save">Request</option>
                </select>
                <input type="text" class="form-input-md-custom" placeholder="Start Date" aria-label="State">
                <input type="text" class="form-input-md-custom" placeholder="End Date" aria-label="Zip">
            </div>
            <div class="col-5 text-end">
                <select class="form-select-custom">
                    <option selected>Search</option>
                    <option value="no">No</option>
                    <option value="ip">IP</option>
                    <option value="id">ID</option>
                </select>
                <input type="text" class="form-input-lg-custom" placeholder="Search" aria-label="State">
            </div>
            <div class="col-1">
                <button type="submit" class="btn btn-light align-right"><span data-feather="search"></span></button>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-12 text-end">
            <button type="submit" class="btn btn-sm btn-success align-right"><span data-feather="download"></span>Excel</button>
        </div>
    </div>
    <hr>

    <table class="table table-sm table-hover">
        <thead>
            <tr>
                <th scope="col">IP</th>
                <th scope="col">ID</th>
                <th scope="col">Req URL</th>
                <th scope="col">Req Time</th>            
            </tr>
        </thead>
        <tbody>
            @if(!empty($result))
                @foreach($result as $list)
                <tr style="valign:middle; cursor:pointer;" class="boardView">
                    <td>{{ $list->login_id }}</td>
                    <td>{{ $list->ip }}</td>
                    <td>{{ $list->request_uri }}</td>
                    <td>{{ $list->request_time }}</td>
                </tr>
                @endforeach
            @endif
        </tr>
    </tbody>
    </table>

    <div class="row">
        <div class="col-sm"></div>
        <div class="col-sm">
        <nav aria-label="Page navigation">
        <ul class="pagination">
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
                <span aria-hidden="true">&laquo;</span>
            </a>
            </li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">4</a></li>
            <li class="page-item"><a class="page-link" href="#">5</a></li>
            <li class="page-item"><a class="page-link" href="#">6</a></li>
            <li class="page-item"><a class="page-link" href="#">7</a></li>
            <li class="page-item"><a class="page-link" href="#">8</a></li>
            <li class="page-item"><a class="page-link" href="#">9</a></li>
            <li class="page-item"><a class="page-link" href="#">10</a></li>
            <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
                <span aria-hidden="true">&raquo;</span>
            </a>
            </li>
        </ul>
        </nav>
        </div>
        <div class="col-sm"></div>
    </div>
</div>
    
@endsection