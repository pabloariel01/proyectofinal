<div class="block">
    <div class="navbar navbar-inner block-header">
        <div class="muted pull-left"><b>{{titulo}}</b></div>
    </div>
    <div class="form-group">
      <label for="actas"> Actas</label>
        <select id="actas" ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>


        <p > Localidades</p>


        <ui-select  ng-model="form.a" on-select="actualizarTabla()" theme="bootstrap" sortable="true" ng-disabled="disabled" style="width: 300px;" title="elegir localidad">
          <ui-select-match placeholder="localidades">
            <span ng-bind="form.a.nombre"></span>
          </ui-select-match>
          <ui-select-choices repeat="item in (localidades | filter: $select.search) track by item.idlocalidad">
            <span ng-bind="item.nombre"></span>
          </ui-select-choices>
        </ui-select>




    </div>

    <!-- <div ng-controller="menuController"> -->
        <div ui-grid="{ data: vector_especies }" class="myGrid"></div>
    <!-- </div> -->
    <!-- <button type="button" class="btn btn-success" ng-click="export()">Exportar</button> -->


<b>Captura por unidad de esfuerzo</b>


    <div
       bar-chart
       bar-data='vector_especies'
       bar-x='idcampaña'
       stacked= 'true'
       bar-y='["suma", "cpue"]'
       bar-labels='["suma", "cpue"]'
       bar-colors='["#31C0BE", "#c7254e"]'>

     </div>
<b>Captura por unidad de esfuerzo por g.</b>
     <div
        bar-chart
        bar-data='vector_especies'
        bar-x='idcampaña'
        stacked= 'true'
        bar-y='["suma","cpue g"]'
        bar-labels='["suma","cpue g"]'
        bar-colors='["#c225ff","#ff254e"]'>

     </div>
</div>
