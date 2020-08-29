@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Tables</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
         <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.database.conection.tableRecordStore') }}" method="post" class="add_form">
                {{ csrf_field() }} 
                <div class="row"> 
                    <div class="col-sm-6 form-group">
                        <label>From Tables</label>
                        <select name="tables" class="form-control select2">
                        <option selected disabled>Select Table</option>
                        @foreach ($datas as $key => $data)
                         @foreach ($data as $key => $val)
                         <option value="{{ $val }}">{{ $val }}</option>  
                         @endforeach 
                        @endforeach 
                        </select>
                    </div>
                    <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-primary form-group form-control">Transfer</button> 
                    </div>
                </div>
            </form>
            </div>
        </div>  
    </div>
    </section>
    @endsection 

