
<div class="item-container">

  
  <h3 class="ucfirst">
      @{{home.resName}}
      <span style="color:grey;">/</span>
      @{{home.stateParams.resId}}
  </h3>



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


@foreach($subRes as $relation)

<?php dd($subRes) ?>

  <div class="card linked-res ">

    <h4 class="ucfirst">{{$relation}}
    <button class="btn btn-primary btn-sm" style="margin-left: 10px;"
            ng-click="home.addRelatedItem('{{$relation->table2}}', '{{str_singular($relation->table1)}}_id')">
            Add
    </button>
    </h4>
    <table class='table'>
      <thead>
        <tr>
            @foreach($subResFields[$relation->table2] as $field)
            @if(substr($field->field,0,-3)!=str_singular($tableName))
            <th>

                {{ $field->label }}

            </th>
            @endif
            @endforeach
            <th>

                Actions

            </th>
          </tr>
      </thead>
      <tbody>
      <tr ng-repeat="(key, value) in home.item.<?=$relation->table2 ?>">

            @foreach($subResFields[$relation->table2] as $field)


                @if(substr($field->field,0,-3)!=str_singular($tableName))
                <td>
                    @if($field->key_type!='fk')
                    {{ <?= "value.".$field->field ?> }}
                    @else
                    {{ <?= "value.".substr($field->field,0,-3).".".$field->link_ui_label_field ?> }}
                    @endif
                </td>
                @endif

            @endforeach

            @if($relation->relation_type=="belongsToMany")

            <td><button class="btn btn-primary btn-sm" style="margin-left: 10px;"
                    ng-click="home.detachRes('{{$relation->table2}}', value.id)">
                    Del
            </button>
            </td>
            @endif

            @if($relation->relation_type=="hasMany")

            <td>
            <button class="btn btn-primary btn-sm" style="margin-left: 10px;"
                ng-click="home.updateRelatedItem('{{$relation->table2}}', '{{str_singular($relation->table1)}}_id', value)">
                Edit
            </button>

            <button class="btn btn-primary btn-sm" style="margin-left: 10px;"
                ng-click="home.delHasMany('{{$relation->table2}}', value.id)">
                Del
            </button>
            </td>
            @endif

      </tr>

      </tbody>
    </table>

    </div>
     @endforeach
 
</div> <!-- -->