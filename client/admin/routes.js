export default function routes($urlRouterProvider, $locationProvider) {
  // $locationProvider.html5Mode(true);
  $urlRouterProvider.otherwise('/tables');
}

routes.$inject = ['$urlRouterProvider', '$locationProvider'];
