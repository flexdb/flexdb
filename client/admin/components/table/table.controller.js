import BaseCtrl from '../../../infra/BaseCtrl.js'
import {fieldTypes} from '../../../config/field_types.config.js'

export default class TableController extends BaseCtrl {

  edsInit() {
    this.ngDialog = this.injector.get('ngDialog');
    this.toastr = this.injector.get('toastr');
    this.stateParams = this.injector.get('$stateParams');
    this.tables = this.injector.get('TableService');
    this.edsFields = this.injector.get('EdsFieldService');
    this.resName = this.stateParams.resName
    this.http = this.injector.get('$http')
    this.tableDetails = [];
    this.loadDbFields();
    this.getSampleData();
    
    console.log("init in child " + this.resName);
    if(this.stateParams.resName != null ) {
        this.loadTableDetails();
    }
    
    this.form = {};
    this.fieldTypes = fieldTypes; // see imports above. imported field types from config
    this.tinymceOptions = {
        theme : 'modern',
        skin: 'lightgray',
        plugins: "table directionality",
        menubar: false,
        toolbar: 'undo redo | insert | styleselect | bold italic | ltr rtl | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | table',
        content_css: [
            '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
            '/js/tinymce/content.min.css',
            '/fonts/faruma.css'
          ],
        style_formats: [
            { title: 'Dhivehi text', inline: 'span', 
                styles: { direction: 'rtl', fontFamily: "FarumaWeb" , 'fontSize':'12pt' } },
            
        ]
      };
    
    
    return true;
    

    
  }

  showNotifications(notifications_json) {
      let notifications = JSON.parse(notifications_json) || [];
      notifications.map((notification)=> {
          if(notification.type == 'success') {
              this.toastr[notification.type](notification.msg, notification.type);
          } else {
              let toastConfig = {
                    closeButton: true,
                    timeOut: 15000,
                  };
              this.toastr[notification.type](notification.msg, notification.type, toastConfig);
          }
      });

  }


  createTable(tableName) {

    this.http({method: "POST", url : "/admin/tables", 'data': {'table': tableName} })
            .then((response) => {

                this.tables.all();
                this.tables.list.dbLastCreated.tables = [tableName];
                
              
            });

      

  }

  loadTableDetails() {
      this.http({method: "GET", url : "/admin/tables/" + this.stateParams.resName })
            .then((response) => {

                this.tableDetails = response.data;


            });
  }
  
  loadDbFields() {
      this.http({method: "GET", url : "/admin/tables/db/fields" })
            .then((response) => {

                this.dbFields = response.data;


            });
  }


    del($tableName) {

      this.http({method: "DELETE", url : "/admin/tables/" + $tableName })
          .then((response) => {
            if(response.status == 200) {
                    this.tables.all();

                }

          });
    }
  
    addField() {

        const ngDialog = this.ngDialog
        const stateParams = this.stateParams;
        const _scope = this.scope;
        let resName = stateParams.resName;
        this.targetTable = resName;

        _scope.dialogType='add'
        _scope.form = {}

        this.addDialog = ngDialog.open({
                    template: require('./table.add-field.tmpl.html'),
                    plain: true,
                    scope: _scope,
                    width: '80%'
                });
    }

  storeField(simpleFieldDef) {

      
      
      let table = this.stateParams.resName;
      simpleFieldDef.table = table;
      let newField = this.edsFields.get(simpleFieldDef);
      
      this.http({method: "POST", url : "/admin/tables/" + table + "/fields", data: newField })
        .then((response) => {
          let newItem = response.data;
          this.showNotifications(response.headers('x-notifications'));
          this.loadTableDetails();
          this.form = {};
          
          this.addDialog.close();

        });
      
  }
  
  delField(field) {
      let delUrl = "/admin/tables/" + field.table + "/fields/" + field.field;
      console.log(delUrl);
    this.http({method: "DELETE", url : delUrl })
        .then((response) => {
            this.loadTableDetails();
          
        });
  }

  addRelation(linkTable) {

      let data = {};
      data.table1 = this.stateParams.resName;
      data.table2 = linkTable.link_table;
      data.relation_type = linkTable.relation_type
      this.http({method: "POST", url : "/admin/tables/" + data.table1 + "/links", data: data })
        .then((response) => {
          let newItem = response.data;
          this.showNotifications(response.headers('x-notifications'));
          this.loadTableDetails();

        });

  }
  
  suggestFields(currentField) {
      
      if(currentField == 'link_table') {
          let table = this.form.link_table[0].toUpperCase() + this.form.link_table.slice(1);
          if(this.form.link_table.slice(-1) == 's') {
              table = table.slice(0,-1);
          } 
          this.form.label = table + " " + this.form.link_ui_label_field;    
      }
  }

  list() {

    return this.http({method: "GET", 'url' : "/api/" + this.resName })
        .then((response) => {
          this.items = response.data
  
        });
  }
  
   getSampleData() {

    return this.http({method: "GET", 'url' : "/api/" + this.resName })
        .then((response) => {
          this.sampleData = response.data
  
        });
  }

  addAcl() {

      let newAclDef = {table: this.resName};
      this.http({method: "POST", url : "/acl/tables", data: newAclDef })
        .then((response) => {
          let newItem = response.data;
          this.showNotifications(response.headers('x-notifications'));
          this.log(newItem);

        });
  }
  
}
