
export default function routes($stateProvider) {
  $stateProvider
    .state('home', { // TODO: rename to ui
        url: '/ui',
        views: {
            'content' : {
                template: '<ui-view></ui-view>',
                controller: 'MenuController',
                controllerAs: 'menu'
            },
            'leftnav' : {
                templateUrl: '/eds-template/left-nav',
                controller: 'MenuController',
                controllerAs: 'menu'
            }
        }

    }).state('home.list', {
      url: '/:resName?search',
      // template: require('./home.tmpl.html'),
      templateUrl : function (stateParams) {
        return '/eds-template/'+ stateParams.resName

      },
      controller: 'HomeController',
      controllerAs: 'home'
    }).state('home.item', {
      url: '/:resName/:resId',
      // template: require('./home.tmpl.html'),
      templateUrl : function (stateParams) {
        return '/eds-template/'+ stateParams.resName + '/' + stateParams.resId

      },
      controller: 'ItemController',
      controllerAs: 'home'
    });
}

routes.$inject = ['$stateProvider'];
