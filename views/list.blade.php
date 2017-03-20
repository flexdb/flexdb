
<div class="page-content-inner">
    <div class="list-heading">
        <h4 style="text-transform:capitalize;">@{{home.resName}}
            <button class="btn btn-primary btn-sm {{$resName}}-add" style="margin-left: 10px;" ng-click="home.add()">Add</button>
        </h4>

    </div>
    
    <table class="table">
        <thead>
            <tr>
                
                
                @foreach($fields as $field)
                <th>
                    <!--<div uib-dropdown on-toggle="toggled(open)" class="dropdown">-->
                        <!--<div uib-dropdown-toggle>{{$field->label}}</div>-->
                        <div>{{$field->label}}</div>
<!--                   
                        <div class="dropdown-menu" uib-dropdown-menu aria-labelledby="simple-dropdown">
                          <div ng-repeat="choice in ['Sort', 'Group']">
                            <a href class="dropdown-item">@{{choice}}</a>
                          </div>
                        </div>
                      </div>-->
                    <!--</di>-->
                    
                    
                </th>
                @endforeach
                <th>Actions</th>
            </tr>
        </thead>
        <tfoot>

        </tfoot>
        <tbody>
            <tr ng-repeat="item in home.items track by $index">
                @foreach($fields as $field)

                @if($field->key_type == 'fk')

                <td>
                    {{ item.<?= substr($field->field, 0, -3).".".$field->link_ui_label_field ?>}}</td>
                @else
                <td>

  


                    {{ item.<?= $field->field ?>}}


                </td>

                @endif
                @endforeach

                <td>
                    <div class="btn-group" role="group" aria-label="Action Buttons" style="width:150px;">

                        <button class="btn btn-outline-info btn-sm"
                                ui-sref="home.item({resName: home.resName, resId: item.id})"
                                >View</button>
                        <button class="btn btn-outline-info btn-sm {{$resName}}-edit"  ng-click="home.edit(item, $index)">Edit</button>
                        <button class="btn btn-outline-warning btn-sm {{$resName}}-del" ng-click="home.del(item, $index)">Del</button>
                    </div>
                </td>
            </tr>

        </tbody>
    </table>
</div>
