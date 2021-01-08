<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
     <link href="https://cdn.datatables.net/1.10.17/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Disbursement App - PT FLIP
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdn.datatables.net/1.10.17/js/jquery.dataTables.min.js" defer></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" defer></script>
<script type="text/javascript">
    $(function () {

              var disburseTable = $('.disburse-table').DataTable({
                processing: true,
                serverSide: true,
                responsive: true,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                ajax: "{{ route('disburses.data') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                    {data: 'transaction_id', name:'transaction_id'},
                    {data: 'account_number', name: 'account_number'},
                    {data: 'bank_code', name: 'bank_code'},
                    {data: 'amount', name: 'amount'},
                    {data: 'remark', name: 'remark'},
                    { data: 'created_at', name: 'created_at', 'render': function(data, type){return type === 'sort' ? data : moment(data).format('DD-MM-YYYY HH:mm'); } },
                    { data: 'time_served', name: 'time_served', 'render': function(data, type){
                        if(moment(data).isValid()){
                            return type === 'sort' ? data : moment(data).format('DD-MM-YYYY HH:mm'); 
                        }else{
                            return '';
                        }
                        
                    
                    } 
                    
                    },
                    {data: 'receipt', name:'receipt'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#createDisburse').click(function () {
                
                $('#id').val('');
                $('#saveBtn').html('Submit');
                $('#transaction_id').val('');
                $('#disburseForm').trigger("reset");
                $('#modelHeading').html("Create Disbursement");
                $('#account_number').attr('readonly', false);
                $('#amount').attr('readonly', false);
                $('#bank_code').attr('readonly', false);
                $('#ajaxModel').modal('show');
            });


              $('body').on('click', '.synchItem', function () {
                  var transaction_id = $(this).data('id');
                  $.get("disburses/"+transaction_id, function (data) {
                      $('#modelHeading').html(" " + data.status);
                      $('#saveBtn').html('Update Status');
                      $('#ajaxModel').modal('show');
                      $('#id').val(data.id);
                      $('#transaction_id').val(data.transaction_id);
                      $('#bank_code').val(data.bank_code);
                      $('#bank_code').attr('readonly', true);
                      $('#account_number').val(data.account_number);
                      $('#account_number').attr('readonly', true);
                      $('#amount').val(data.amount);
                      $('#amount').attr('readonly', true);
                  })
               });

            $('#saveBtn').click(function (e) {
                e.preventDefault();
                $(this).html('Sending...');
                if($('#transaction_id').val() !== ''){
                     $.ajax({
                      data: $('#disburseForm').serialize(),
                      url: "{{ route('disburses.update') }}",
                      type: "POST",
                      dataType: 'json',
                      success: function (data) {
                         
                         if(data.error){
                            alert(data.error.message);
                            $('#saveBtn').html('Update Status');
                         }else{
                              $('#disburseForm').trigger("reset");
                              $('#ajaxModel').modal('hide');
                              disburseTable.draw();
                              $('#saveBtn').html('Update Status');
                         }
                
                     
                      },
                      error: function (request, status, error) {
                          alert(error);
                          $('#saveBtn').html('Submit');
                      }
                   });
                       

                }else{
                    $.ajax({
                      data: $('#disburseForm').serialize(),
                      url: "{{ route('disburses.store') }}",
                      type: "POST",
                      dataType: 'json',
                      success: function (data) {
                         
                         if(data.error){
                            alert(data.error.message);
                            $('#saveBtn').html('Submit');
                         }else{
                              $('#disburseForm').trigger("reset");
                              $('#ajaxModel').modal('hide');
                              disburseTable.draw();
                              $('#saveBtn').html('Submit');
                         }
                
                     
                      },
                      error: function (request, status, error) {
                          alert(error);
                          $('#saveBtn').html('Submit');
                      }
                   });

                }
              
             });
     
      

    });

</script>
</script>
</html>
