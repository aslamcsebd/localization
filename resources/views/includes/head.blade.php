   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1">

   <!-- CSRF Token -->
   <meta name="csrf-token" content="{{ csrf_token() }}">

   <title>{{ config('app.name', 'Laravel') }}</title>

   <!-- Scripts -->
   <script src="{{ asset('js/app.js') }}" defer></script>

   <!-- Fonts -->
   <link rel="dns-prefetch" href="//fonts.gstatic.com">
   <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <!-- Styles -->
   <link href="{{ asset('css/app.css') }}" rel="stylesheet">

   <style type="text/css">
      

/*card design*/
.card{ margin-top: 15px; }
.card-header{ padding: 0.2rem 1.25rem; color: #fff; text-align: center;}
.info{ background-color: #17a2b8; }
.success{ background-color: #28a745; }

/*Datatable*/
table.dataTable tbody tr { background-color: transparent; ext-align: center;}

.dataTables_wrapper
.dataTables_length,
.dataTables_filter,
.dataTables_info,
.dataTables_paginate { background-color: cyan; border-radius: 2px; }

.dataTables_wrapper .dataTables_filter,
.dataTables_wrapper .dataTables_paginate{ float: none; }

/*Top*/
.dataTables_wrapper .dataTables_length label,
.dataTables_wrapper .dataTables_filter label{ padding: 0.175rem 0.5rem; margin-bottom: 0rem; }
.dataTables_wrapper .dataTables_filter { margin-bottom: 0.20rem; }

/*Buttom*/
.dataTables_wrapper .dataTables_info { padding: 0.5rem; }
.dataTables_wrapper .dataTables_paginate { padding: 0.25em; }
.dataTables_wrapper .dataTables_paginate, .dataTables_wrapper .dataTables_info { margin-top: 0.20rem; }
.dataTables_wrapper .dataTables_paginate .paginate_button { min-width: 1.5em; padding: 0.2em 0.6em; margin-left: 2px; }

.table td { vertical-align: middle; }

.table td, .table th { border: 0.5px solid #dee2e6 !important; }
.table.dataTable { border-collapse: collapse;}

table.dataTable thead th,
table.dataTable thead td { 
   padding: 0px 18px; 
   background-color: #17c0eb;
}
.table tbody{ background-color: #00cec9; }

.table tbody > tr >td:nth-child(1),
.table tbody > tr >td:nth-child(2){ text-align: center; }

.nav { background: #bdc3c7; }
.d-flex .card { margin-top: 5px !important; }
.nav-link.active { background-color: #81ecec !important; color: #000 !important; }
   </style>
