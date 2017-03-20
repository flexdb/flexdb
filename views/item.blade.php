
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


        <button class="btn btn-primary btn-sm" style="margin-left: 10px;"
                ng-click="home.addRelatedItem('{{$relationName}}', '{{$relationName}}')">
                Add
        </button>
    </h4>
    <table class="table">
        <tr>
            @foreach($relationDef['fields'] as $field)
              <th>
                
                  {{ $field->label }}
            </th>
            @endforeach
    
          
        </tr>
        <tr ng-repeat="item in home.item.<?=$relationName?>">
            @foreach($relationDef['fields'] as $field)
              <td>
                  {{item.<?=$field->field?>}}
                  
            </td>
            @endforeach
    
          
        </tr>
            
    </table>
    


</div>

@endforeach

  
 
</div> <!-- -->