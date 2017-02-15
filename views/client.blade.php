<!DOCTYPE html>
<html>
@include('fwb::_head')

<body class="theme-default colorful-enabled" ng-app="app">
    @if(env('APP_ENV') == 'prod')
    <link rel="stylesheet" href="/js/common.bundle.css" />
    <link rel="stylesheet" href="/js/app.css" />
    @else
    <link rel="stylesheet" href="http://{{env('NPM_SERVER', 'localhost')}}:8088/common.bundle.css" />
    <link rel="stylesheet" href="http://{{env('NPM_SERVER', 'localhost')}}:8088/app.css" />
    @endif
    <nav ui-view="leftnav" class="left-menu" left-menu ng-class="{'hidden-left-menu': hideLeftMenu}">
        <!-- content inserted from angular ui-view -->
    </nav>
     
    @include('fwb::_topnav')


<section class="page-content">
    
    <div ui-view="content"></div>
</section>

<div class="main-backdrop"><!-- --></div>


    <script src="/js/angular.min.js"></script>
    @if(env('APP_ENV') == 'prod')
    <script src="/js/common.bundle.js"></script>
    <script src="/js/app.js"></script>
    @else
    <script src="//{{env('NPM_SERVER', 'localhost')}}:8088/common.bundle.js"></script>
    <script src="http://{{env('NPM_SERVER', 'localhost')}}:8088/app.js"></script>
        
    @endif
        
        <!--<script src="/js/helpers.js"></script>-->
        
    


    </body>
</html>
