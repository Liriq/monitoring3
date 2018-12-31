<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'Моніторинг водосховища')</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico">    
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/layout.css') }}" rel="stylesheet">    
    @stack('styles')
    <script src="{{ asset('js/admin/jquery.min.js') }}" ></script>
</head>

<body>
    <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="/"><img src="/images/logo.png" alt="Logo"></a>
                <a class="navbar-brand navbar-brand-alt hidden" href="/"><img src="/images/logo2.png" alt="Logo"></a>
            </div>
            
            @include(\Laratrust::hasRole('admin') ? 'includes._admin_menu' : 'includes._dashboard_menu')
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        @include('includes._header')
        <!-- Header-->
        
        @yield('breadcrumbs')
        
        @include('includes._flash_messages')

        @yield('content')

    </div><!-- /#right-panel -->

    <!-- Right Panel -->    
    
    <script src="/js/admin/app.js" ></script>
    <script type="text/javascript" src="/js/admin/layout.js" ></script>
    @stack('scripts')
</body>

</html>
