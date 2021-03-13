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
                        <label for="shortName" class="mb-1">Language Short Name:</label>
                        <input name="shortName" class="form-control" id="shortName" type="text" value="{{ old('shortName')}}" placeholder="Ex: bd, jp, in" required>
                     </div>
                     <div class="form-group">
                        <label for="fullName" class="mb-1">Language Full Name:</label>
                        <input name="fullName" class="form-control" id="fullName" type="text" value="{{ old('fullName')}}" placeholder="Ex: Bangladesh, Japan, India" required>
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

{{-- Add Language --}}
   <div class="modal fade" id="addSubtitle" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Subtitle</h5>
               <button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
            <div class="modal-body">
               
               <form action="{{ url('addCode') }}" method="post" enctype="multipart/form-data" class="needs-validation" >
                  @csrf
                  <div class="d-flex align-items-start row mt-4">
                     <div class="nav flex-column col-auto nav-pills bg-light p-1" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        @php
                           $RelationNames = App\Language::all();
                        @endphp
                        @foreach($RelationNames as $RelationName)
                           <button class="av-link btn btn-outline-primary p-1 m-1 @if($loop->index==0) active @endif" data-bs-toggle="pill" data-bs-target="#v-pills-{{$RelationName->id}}">
                           {{$RelationName->fullName}}
                           </button>
                        @endforeach
                     </div>
                     <div class="tab-content col" id="v-pills-tabContent">
                      
                        @foreach($RelationNames as $RelationName)
                           <div class="tab-pane fade show @if($loop->index==0) active @endif" id="v-pills-{{$RelationName->id}}">
                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                 <button class="nav-link @if($loop->index==0) active @endif" data-bs-toggle="tab" data-bs-target="#nav-{{$RelationName->id}}_code">Code</button>
                                 <button class="nav-link" data-bs-toggle="tab" data-bs-target="#nav-{{$RelationName->id}}_output">Output</button>
                              </div>
                              <div class="tab-content" id="nav-tabContent">
                                 <div class="tab-pane fade show active resp-tab-content" id="nav-{{$RelationName->id}}_code" role="tabpanel" aria-labelledby="nav-{{$RelationName->id}}_code-tab">   
                                   {!! $RelationName->fullName !!}
                                 </div>
                                 <div class="tab-pane fade" id="nav-{{$RelationName->id}}_output" role="tabpanel" aria-labelledby="nav-{{$RelationName->id}}_output-tab">
                                  {!! $RelationName->fullName !!}
                                 </div>                   
                              </div>
                           </div>
                        @endforeach
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


