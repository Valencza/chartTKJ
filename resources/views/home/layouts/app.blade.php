
@include('home.layouts.head')
@stack('css')

<body class="index-page">

@include('home.layouts.navbar')

@if(session('error'))
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      setTimeout(function() {
        Swal.fire({
          icon: 'error',
          title: 'Akses Ditolak',
          text: '{{ session('error') }}',
          confirmButtonText: 'OK'
        });
      }, 500);
    });
  </script>
@endif

@yield('content')

@include('home.layouts.modal', ['alamat' => $alamat ?? collect()])
    
@include('home.layouts.footer')
@stack('js')
@include('home.layouts.tail')  
