<div class="col-lg-12"> 
  <div class="card card-info"> 
    <div class="card-body">
      <div class="row"> 
      <div class="col-lg-6 form-group">
        <label>Assembly--Part</label>
        <select name="assembly_part" class="form-control" onchange="callAjax(this,'{{ route('admin.Master.WardBandiFilterAssemblyPart') }}','voter_list')">
          <option selected disabled>Select Assembly--Part</option>
          @foreach ($assemblyParts as $assemblyPart)
          <option value="{{ $assemblyPart->id }}">{{ $assemblyPart->assembly->code or '' }}--{{ $assemblyPart->part_no }}</option> 
          @endforeach 
        </select> 
      </div>
      <div class="col-lg-6 form-group">
        <label>Ward</label>
        <select name="ward" class="form-control" onchange="callAjax(this,'{{ route('admin.Master.WardBandiFilterward') }}','sr_no_form')">
          <option selected disabled>Select Ward</option> 
          @foreach ($WardVillages as $WardVillage)
          <option value="{{ $WardVillage->id }}">{{ $WardVillage->ward_no or '' }}--{{ $WardVillage->name_e }}</option> 
          @endforeach 
        </select> 
      </div>  
      </div> 
    </div>
  </div> 
    <div class="card card-warning">
       <div class="card-header">
       <h4 class="card-title">Report</h4>
       </div> 
       <div class="card-body"> 
          <div class="row"> 
           <div class="col-lg-3"> 
            <div class="icheck-primary d-inline">
              <input type="radio" id="radioPrimary1" name="r1" checked>
              <label for="radioPrimary1">Option 1</label>  
            </div>
           </div>
           <div class="col-lg-3"> 
            <div class="icheck-primary d-inline">
              <input type="radio" id="radioPrimary2" name="r1">
              <label for="radioPrimary2">Option 1</label>  
            </div>
           </div>
           <div class="col-lg-3"> 
            <div class="icheck-primary d-inline">
              <input type="radio" id="radioPrimary3" name="r1">
              <label for="radioPrimary3">Option 1</label>  
            </div>
           </div> 
          <div class="col-lg-3">  
              <button type="submit" class="btn btn-warning form-control">Report Generate</button> 
          </div>
           </div>  
         </div>
    </div> 
      
<div class="row" id="voter_list" style="margin-top: 20px"> 
</div>
</div>
 