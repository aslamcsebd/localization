{{-- Add Language --}}
   <div class="modal fade" id="addLanguage" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Language</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addLanguage') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="form"> 
                     <div class="form-group">
                        <label for="name" class="mb-1">Language Full Name:</label>
                        <input name="name" class="form-control" id="name" type="text" value="{{ old('name')}}" placeholder="Ex: Bangladesh, Japan, India" required>
                     </div>

                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Country Image/Logo:</label>
                        <input type="file" class="form-control" name="countryImage">
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-primary" type="submit">Add Now</button>
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

{{-- Add Key --}}
   <div class="modal fade" id="addKey" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Key</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addKey') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="form">                     
                     <div class="form-group">
                        <label for="key" class="mb-1">Key Name:</label>
                        <input name="key" class="form-control" id="key" type="text" value="{{ old('key')}}" placeholder="Ex: Home_Page, Profile_page" required>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button class="btn btn-primary" type="submit">Add Now</button>
                     <button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>

