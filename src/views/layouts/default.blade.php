<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>{{ Config::get('laravel-cms::title') }}</title>
    
    <link href="/packages/lukaswhite/laravel-cms/css/vendor/bootstrap.min.css" rel="stylesheet">

    <link href="/packages/lukaswhite/laravel-cms/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">{{ trans('laravel-cms::cms.menu.toggle-nav') }}</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/cms">{{ Config::get('laravel-cms::title') }}</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">            
            <li><a href="/cms/page">{{ trans('laravel-cms::cms.menu.pages') }}</a></li>            
            <li><a href="/cms/block">{{ trans('laravel-cms::cms.menu.blocks') }}</a></li>            
            <li><a href="/cms/region">{{ trans('laravel-cms::cms.menu.regions') }}</a></li>            
            <li><a href="/cms/config">{{ trans('laravel-cms::cms.menu.config') }}</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      @yield('content')

    </div><!-- /.container -->

    <!--<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>-->
    <script type="text/javascript" src="/assets/js/vendor/jquery.js"></script>
    <script type="text/javascript" src="/packages/lukaswhite/laravel-cms/js/vendor/jquery-ui-1.9.1.custom.min.js"></script>
    <script src="/packages/lukaswhite/laravel-cms/js/vendor/bootstrap.min.js"></script>		
    <script src="/packages/lukaswhite/laravel-cms/js/vendor/jquery.slug.js"></script>
    <script src="/packages/lukaswhite/laravel-cms/js/vendor/ckeditor/ckeditor.js"></script>
    <script src="/packages/lukaswhite/laravel-cms/js/vendor/epic-editor/js/epiceditor.js"></script>
    <script src="/packages/lukaswhite/laravel-cms/js/Cms.js"></script>
    <script>
    $(function () {
      @yield('jquery')
    });
    </script>
  </body>
</html>
