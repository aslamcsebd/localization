<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
   
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

   <script type="text/javascript">
      window.setTimeout(function() {
          $(".alert").fadeTo(500, 0).slideUp(500, function(){
              $(this).remove(); 
          });
      }, 5000);
   </script>
