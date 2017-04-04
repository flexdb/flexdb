import angular from 'angular';
import uirouter from 'angular-ui-router';

import routes from './home.routes.js';
import HomeController from './home.controller.js';
import ItemController from './home.item.controller.js'
import MenuController from './home.menu.controller.js'

export default angular.module('flexwb.home', [uirouter])
  .config(routes)
  .controller('HomeController', HomeController)
  .controller('ItemController', ItemController)
  .controller('MenuController', MenuController)
  .name;