import HomeController from './home.controller.js'

export default class ItemController extends HomeController {

  edsInit() {

    this.linkedTables = [];
    this.ngDialog = this.injector.get('ngDialog')
    this.stateParams = this.injector.get('$stateParams');
    this.resName = this.stateParams.resName
    this.http = this.injector.get('$http')
    console.log("init in child " + this.resName);
    this.get();
    this.getLinkedTables();
    return true;
  }

  getLinkedTables() {

      return this.http({method: "GET", 'url' : "/api/relations/" + this.resName  })
        .then((response) => {
          
          angular.forEach(response.data, function (relation) {

            this.loadLinkedTable(relation).then(
              (data) => {
                this.linkedTables.push(data);
              }
            );
          }, this);

          
        });


  }

  loadLinkedTable(relation) {

      return this.http({method: "GET", 'url' : "/api/" + relation.link_table  })
        .then((response) => {
          return {name : relation.link_table, data: response.data } ;

        });



  }

  addRelatedItem(table) {

    const _scope = this.scope;
    let resName = this.stateParams.resName;
    let resKey = this.stateParams.resName + "_id";
    let resId = this.stateParams.resId;
    _scope.dialogType='add'
    
    _scope.form = {}
    _scope.form[resKey] = resId
    this.addDialog = this.ngDialog.open({
                template: '/forms/' + resName,
                scope: _scope,
                width: '80%'
            });
  }

  



  get() {

    return this.http({method: "GET", 'url' : "/api/" + this.resName + "/" + this.stateParams.resId })
        .then((response) => {
          console.log(response);
          return this.item = response.data[0]
        });

  }




}
