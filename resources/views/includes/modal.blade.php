{{-- Add Language --}}
   <div class="modal fade" id="addLanguage" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Language</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addCode') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="form">                     
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Short Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: bd, jp, in" required>
                     </div>
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Full Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: Bangladesh, Japan, India" required>
                     </div>

                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Country Image/Logo:</label>
                        <input type="file" class="form-control" name="">
                     </div>

                    {{--  <div class="form-group">
                        <label for="code" class="mb-1">Full Code :</label>
                        <textarea name="code" class="form-control" id="code" type="text" rows="5" value="{{ old('code')}}"></textarea>
                     </div> --}}
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

   {{-- Add Language --}}
   <div class="modal fade" id="addKey" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Key</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addCode') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="form">                     
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Short Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: bd, jp, in" required>
                     </div>
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Full Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: Bangladesh, Japan, India" required>
                     </div>

                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Country Image/Logo:</label>
                        <input type="file" class="form-control" name="">
                     </div>

                    {{--  <div class="form-group">
                        <label for="code" class="mb-1">Full Code :</label>
                        <textarea name="code" class="form-control" id="code" type="text" rows="5" value="{{ old('code')}}"></textarea>
                     </div> --}}
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


{{-- Add Language --}}
   <div class="modal fade" id="addSubtitle" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Subtitle</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addCode') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="form">                     
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Short Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: bd, jp, in" required>
                     </div>
                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Language Full Name:</label>
                        <input name="codeTitle" class="form-control" id="codeTitle" type="text" value="{{ old('codeTitle')}}" placeholder="Ex: Bangladesh, Japan, India" required>
                     </div>

                     <div class="form-group">
                        <label for="codeTitle" class="mb-1">Country Image/Logo:</label>
                        <input type="file" class="form-control" name="">
                     </div>

                    {{--  <div class="form-group">
                        <label for="code" class="mb-1">Full Code :</label>
                        <textarea name="code" class="form-control" id="code" type="text" rows="5" value="{{ old('code')}}"></textarea>
                     </div> --}}
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

