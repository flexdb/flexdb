import BaseService from '../../../infra/BaseService.js'

export default class EdsFieldService extends BaseService {
        
        

  edsInit() {

     
    this.ngDialog = this.injector.get('ngDialog')
    this.stateParams = this.injector.get('$stateParams');
    this.http = this.injector.get('$http')
    this.list = [];
    this.setTypeAndInputTypeMappings();
    this.newField = {};
  }
  
  setTypeAndInputTypeMappings() {
      this.fieldTypes = {
          string : {
              type: 'string',
              input_type: 'text',
          },
          text : {
              type: 'text',
              input_type: 'textarea',
          },
          decimal : {
              type: 'decimal',
              input_type: 'text',
          },
          integer : {
              type: 'integer',
              input_type: 'number',
          },
          date : {
              type: 'date',
              input_type: 'datepicker',
          },
          file: {
              type: 'string',
              input_type: 'file'
          },
          fk : {
              type: 'integer',
              input_type: 'select',
          },
          
      }
  
  }


    get(simpleFieldDef) {
        
        let newField = {};
        this.newField = {};
        
        this.simpleFieldDef = simpleFieldDef;

        switch (simpleFieldDef.type) {
            case 'fk':
              newField = this.getFkType();
              break;
            default:
              newField = this.getBasicType();
              break;
          }
          
        return newField;

    }
    
    applyCommonFields() {
        
        this.newField.table = this.simpleFieldDef.table;
        this.newField.field = this.simpleFieldDef.name;
        this.newField.label = this.simpleFieldDef.label;
        this.newField.type = this.fieldTypes[this.simpleFieldDef.type].type;
        this.newField.form_input = this.fieldTypes[this.simpleFieldDef.type].input_type;
        this.newField.properties = '';
        this.newField.list = 1;
        this.newField.sort_order = 1;
        this.newField.created_at = (new Date()).toISOString().substring(0, 10);
        
    }
    
    getFkType() {
        if(this.simpleFieldDef.type != 'fk') {
            console.error('something went wrong!!!');
        }
        
        this.applyCommonFields();
        this.newField.field = this.simpleFieldDef.name;
        this.newField.key_type = 'fk';
        this.newField.link_table = this.simpleFieldDef.link_table;
        this.newField.link_field = 'id';
        this.newField.link_ui_label_field = this.simpleFieldDef.link_ui_label_field;
        
        return this.newField;
    }
    
    getBasicType() {
        this.applyCommonFields();
        
        return this.newField;  
    }



  all() {
      return this.http({method: "GET", 'url' : "/admin/tables" })
        .then((response) => {
           return this.list = response.data;

        });
  }

}

