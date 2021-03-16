<script type="text/javascript" src="{{ asset('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> 
<script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('assets/js/jquery.dataTables.min.js')}}"></script>

   
<script type="text/javascript">
   $(document).ready( function () {
      $('.table').DataTable();
   } );
</script>

 {{-- Edit subtitle --}}
   <script type="text/javascript">
      $('#editSubtitle').on('show.bs.modal', function (event) {
         console.log('Model Opened')
         var button = $(event.relatedTarget)

         var id = button.data('id') 
         // var codeTitle = button.data('codeTitle') [Camel case not allow. So don't use it]
         var language_key = button.data('language_key') 
         var subtitle = button.data('subtitle') 
         
         var modal = $(this)
         
         modal.find('.modal-body #id').val(id);
         modal.find('.modal-body #language_key').val(language_key);
         modal.find('.modal-body #subtitle').val(subtitle);
      })
   </script>

