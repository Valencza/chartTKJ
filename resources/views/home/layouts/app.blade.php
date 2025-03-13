
@include('home.layouts.head')
@stack('css')

<body class="index-page">

@include('home.layouts.navbar')

@yield('content')

@include('home.layouts.modal', ['alamat' => $alamat ?? collect()])
    
@include('home.layouts.footer')
@stack('js')
@include('home.layouts.tail')  
