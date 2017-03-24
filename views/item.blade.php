
<div class="item-container">
  <div class="card main-res">
  <div>
  
  <h3 class="ucfirst">
      @{{home.resName}}
      <span style="color:grey;">/</span>
      @{{home.stateParams.resId}}
  </h3>

  </div>

  <table class="table">
    <thead>
    <tr>
      
    </tr>
    </thead>
    <tfoot>
    
    </tfoot>
    <tbody>
    @foreach($fields as $field)  
    <tr>  @if(!$field->key_type == "fk")
          <td>{{home.item.<?=$field->field?>}}</td>
          @else
          <td>{{home.item.<?=$field->field?>.<?=$field->link_ui_label_field ?>}}</td>
          @endif
    </tr>
    @endforeach

    </tbody>
  </table>
  </div>

@foreach($relations as $relationName => $relationDef)




<div class="card linked-res ">
    <h4 class="ucfirst">{{$relationName}}


        <button class="btn btn-primary btn-sm {{$relationName}}-add" style="margin-left: 10px;"
                ng-click="home.addRelatedItem('{{$relationName}}', '{{$relationDef['linkField']}}')">
                Add
        </button>
    </h4>
    <table class="table">
        <tr>
            @foreach($relationDef['fields'] as $field)
                @if($field->field != $relationDef['linkField'])
                    <th>

                        {{ $field->label }}
                  </th>
                @endif
            @endforeach
            <th class="{{$relationName}}-actions">
                Actions
            </th>
    
          
        </tr>
        <tr ng-repeat="item in home.item.<?=$relationName?>">
            @foreach($relationDef['fields'] as $field)
                @if($field->field != $relationDef['linkField'])
                    @if($field->form_input == "file")
                    <td><a  target="_blank" ng-href="/files/{{item.<?=$field->field?>}}">{{item.<?=$field->field?>}}</a></td>
                  @elseif($field->key_type != "fk")
                    <td>{{item.<?=$field->field?>}}</td>
                    @else
                    <td>{{item.<?= substr($field->field, 0, -3).".".$field->link_ui_label_field ?>}}</td>
                  @endif
                @endif
            @endforeach
            <td>
                    <div class="btn-group" role="group" aria-label="Action Buttons" style="width:150px;">
                        <button class="btn btn-outline-info btn-sm {{$relationName}}-edit"  ng-click="home.updateRelatedItem('{{$relationName}}', '{{$relationDef['linkField']}}', item)">Edit</button>
                        <button class="btn btn-outline-warning btn-sm {{$relationName}}-del" ng-click="home.delHasMany('{{$relationName}}', item.id)">Del</button>
                    </div>
                </td>
    
          
        </tr>
            
    </table>
    


</div>

@endforeach

  
 
</div> <!-- -->