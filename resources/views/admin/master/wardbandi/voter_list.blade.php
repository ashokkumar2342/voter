<div class="col-lg-6"> 
<div class="card card-info">
  <div class="card-header">
     <h3 class="card-title"></h3>
    </div> 
    <div class="card-body">
       <table class="table">
         <thead>
           <tr>
             <th>Assembly Code</th>
             <th>Part No.</th>
             <th>Action</th>
           </tr>
         </thead>
         <tbody>
          {{-- @foreach ($assemblyParts as $assemblyPart)
           <tr>
             <td>{{ $assemblyPart->assembly_id }}</td>
             <td>{{ $assemblyPart->part_no }}</td>
             <td class="text-center">
               <a href="" title="Remove" class="btn"><i class="fa fa-remove text-danger"></i></a>
             </td>
           </tr> 
          @endforeach --}}
         </tbody>
       </table>
    </div>
  </div>
</div>
<div class="col-lg-6" id="sr_no_form"> 

</div>