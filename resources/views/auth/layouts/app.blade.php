@include('auth.layouts.head')

<body class="masuk-page">

@yield('content')

@stack('js')

@include('auth.layouts.tail')  
