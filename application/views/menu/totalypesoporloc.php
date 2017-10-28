<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>
    </div>
    <div class="form-group">
        <select  ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>


        <label for="camps"> Camps</label>
        <select multiple="" id="camps" class="selectpicker" ng-options="camp.id for camp in camps track by camp.id" ng-model="form.c">
        </select>

        <ui-select multiple tagging tagging-label="(custom 'new' label)" ng-model="form.a" on-remove="filtrarpor(form.a)" on-select="filtrarpor(form.a)" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir campania">
          <ui-select-match placeholder="campaña">
            <span ng-bind="$item.id"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (camps | filter: $select.search) track by item.id">
            <span ng-bind="item.id"></span>
          </ui-select-choices>
        </ui-select>




    </div>

        acta:{{selected.descripcion}},//,
        {{selected["id"]}}1
        {{acta.SelectedOption.id}}2
        --{{form.a}}3 <!--elegido en el multiple picker -->
        {{options}}4
        {{actas}}5
        ----{{form.a.selected}}--{{form.b.selected}}-{{form.a}}-
        especie:{{especies.descripcion}}6
        {{especies.value}}7
        {{especies.value.descripcion}}8
        {{especies.selectedvalue}}9
        {{select}}
        <p>especie= {{form.b}}</p>
    <!-- <div ng-controller="menuController"> -->
        <div ui-grid="{ data: vector_especies }" class="myGrid"></div>
    <!-- </div> -->

</div>
