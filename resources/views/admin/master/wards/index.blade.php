@extends('admin.layout.base')
@section('body')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3>Add Wards</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right"> 
                </ol>
            </div>
        </div> 
        <div class="card card-info"> 
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card card-primary"> 
                            <form action="{{ route('admin.Master.village.store') }}" method="post" class="add_form" content-refresh="district_table">
                                {{ csrf_field() }}
                                <div class="card-body">
                                    <div class="row"> 
                                    <div class="col-lg-6 form-group">
                                        <label for="exampleInputEmail1">States</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="states" class="form-control">
                                            <option selected disabled>Select States</option>
                                            @foreach ($States as $State)
                                            <option value="{{ $State->id }}">{{ $State->code }}--{{ $State->name_e }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-6 form-group">
                                        <label for="exampleInputEmail1">District</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="district" class="form-control">
                                            <option selected disabled>Select District</option>
                                            @foreach ($Districts as $District)
                                            <option value="{{ $District->id }}">{{ $District->code }}--{{ $District->name_e }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Block MCS</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="block_mcs" class="form-control">
                                            <option selected disabled>Select Block MCS</option>
                                            @foreach ($BlocksMcs as $BlocksMc)
                                            <option value="{{ $BlocksMc->id }}">{{ $BlocksMc->code }}--{{ $BlocksMc->name_e }}</option>  
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">Village</label>
                                        <span class="fa fa-asterisk"></span>
                                        <select name="block_mcs" class="form-control">
                                            <option selected disabled>Select Village</option>
                                            @foreach ($Villages as $Village)
                                            <option value="{{ $Village->id }}">{{ $Village->code }}--{{ $Village->name_e }}</option>  
                                            @endforeach
                                        </select>
                                    </div> 
                                    <div class="col-lg-4 form-group">
                                        <label for="exampleInputEmail1">How Many Ward To Create</label>
                                        <span class="fa fa-asterisk"></span>
                                        <input type="text" name="ward" class="form-control" placeholder="" maxlength="5">
                                    </div> 
                                </div> 
                                <div class="card-footer text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div> 
                    </div>
                    <div class="col-lg-12">
                        <div class="card card-primary table-responsive"> 
                             <table id="district_table" class="table table-striped table-hover control-label">
                                 <thead>
                                     <tr>
                                         <th>States</th>
                                         <th>District</th>
                                         <th>Block MCS</th>
                                         <th>Code</th>
                                         <th>Name (English)</th>
                                         <th>Name (Local Language)</th>
                                         <th>Action</th>
                                          
                                     </tr>
                                 </thead>
                                 <tbody>
                                    @foreach ($Villages as $Village)
                                     <tr>
                                         <td>{{ $Village->states->name_e or '' }}</td>
                                         <td>{{ $Village->district->name_e or '' }}</td>
                                         <td>{{ $Village->blockMCS->name_e or '' }}</td>
                                         <td>{{ $Village->code }}</td>
                                         <td>{{ $Village->name_e }}</td>
                                         <td>{{ $Village->name_l }}</td>
                                         <td class="text-nowrap">
                                             <a onclick="callPopupLarge(this,'{{ route('admin.Master.BlockMCSEdit',$Village->id) }}')" title="" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                                             <a href="" title="" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                         </td>
                                     </tr> 
                                    @endforeach
                                 </tbody>
                             </table>
                        </div> 
                    </div> 
                </div>
            </div> 
        </div> 
    </section>
    @endsection
    <script type="text/javascript">
        $('#ddd').DataTable();
    </script> 

