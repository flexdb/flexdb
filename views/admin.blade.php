<html>
    <head>
        
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">-->
        <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">-->
        
        <link rel="stylesheet" href="https://unpkg.com/angular-toastr/dist/angular-toastr.css" />
        
        @if(env('APP_ENV') == 'prod')
        <link rel="stylesheet" href="/js/common.bundle.css" />
        <link rel="stylesheet" href="/js/admin.css" />
        @else
        <link rel="stylesheet" href="http://{{env('NPM_SERVER', 'localhost')}}:8081/common.bundle.css" />
        <link rel="stylesheet" href="http://{{env('NPM_SERVER', 'localhost')}}:8081/admin.css" />
        <link rel="stylesheet" href="http://{{env('NPM_SERVER', 'localhost')}}:8082/style.css" />
        @endif
        
        <script type="text/javascript" src='/js/tinymce/tinymce.min.js'></script>
        
        <base href="/">

        
    </head>
    <body class="main-view-container" ng-app="admin">
        
        <nav class="navbar navbar-toggleable-md navbar-inverse fixed-top bg-inverse">
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="#">Admin Panel</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
              </ul>
            </div>
            </nav>
        <div class="main-container">
            <ui-view></ui-view>
        </div>
        <script src="/js/angular.min.js"></script>
         @if(env('APP_ENV') == 'prod')
        <script src="/js/common.bundle.js"></script>
        <script src="/js/admin.js"></script>
        @else
        <script src="//{{env('NPM_SERVER', 'localhost')}}:8081/common.bundle.js"></script>
        <script src="http://{{env('NPM_SERVER', 'localhost')}}:8081/admin.js"></script>
        @endif
    </body>
</html>
