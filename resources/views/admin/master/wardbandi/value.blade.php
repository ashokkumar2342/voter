<div class="col-lg-12"> 
  <div class="card card-info"> 
    <div class="card-body">
      <div class="row"> 
      <div class="col-lg-6 form-group">
        <label>Assembly--Part</label>
        <select name="" class="form-control" onchange="callAjax(this,'{{ route('admin.Master.WardBandiFilterAssemblyPart') }}','voter_list')">
          <option selected disabled>Select Assembly--Part</option>
          @foreach ($assemblyParts as $assemblyPart)
          <option value="">{{ $assemblyPart->assembly->code or '' }}--{{ $assemblyPart->part_no }}</option> 
          @endforeach 
        </select> 
      </div>
      <div class="col-lg-6 form-group">
        <label>Ward</label>
        <select name="" class="form-control" onchange="callAjax(this,'{{ route('admin.Master.WardBandiFilterward') }}','sr_no_form')">
          @foreach ($WardVillages as $WardVillage)
          <option value="">{{ $WardVillage->ward_no or '' }}--{{ $WardVillage->name_e }}</option> 
          @endforeach 
        </select> 
      </div>  
      </div> 
    </div>
  </div>
<div class="row" id="voter_list"> 
</div>
</div>
 