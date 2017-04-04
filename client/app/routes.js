export default function routes($urlRouterProvider, $locationProvider) {
  // $locationProvider.html5Mode(true);
  $urlRouterProvider.otherwise('/ui');
}

routes.$inject = ['$urlRouterProvider', '$locationProvider'];
