
export default function routes($stateProvider) {
  $stateProvider
    .state('table', {
      url: '/tables',
      template: require('./table.menu.tmpl.html'),
      controller: 'MenuController',
      controllerAs: 'table'

    }).state('table.create', {
      url: '/create',
      templateUrl : function (stateParams) {
        return '/admin/tables/create'
      },
      controller: 'TableController',
      controllerAs: 'table'
    })
    .state('table.list', {
      url: '/:resName',
      template : require('./table.index.tmpl.html'),
      controller: 'TableController',
      controllerAs: 'table'
    })
    .state('table.item', {
      url: '/:resName/:resId',
      // template: require('./home.tmpl.html'),
      templateUrl : function (stateParams) {
        return '/eds-template/'+ stateParams.resName + '/' + stateParams.resId

      },
      controller: 'ItemController',
      controllerAs: 'field'
    }
    );
}

routes.$inject = ['$stateProvider'];
