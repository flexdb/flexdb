import BaseService from '../../../infra/BaseService.js'

export default class TableService extends BaseService {

  edsInit() {
    this.ngDialog = this.injector.get('ngDialog')
    this.stateParams = this.injector.get('$stateParams');
//    this.resName = this.stateParams.resName
    this.http = this.injector.get('$http')
    this.list = [];
  }


  createTable($tableName) {

  }

  all() {
      return this.http({method: "GET", 'url' : "/admin/tables" })
        .then((response) => {
           return this.list = response.data;
   
        });
  }

}
