<style type="text/css">
    .myGrid {
        width: 500px;
        height: 250px;
    }

</style>



            <div class="col-md-10" id="page-wrapper">         <!--/span-->
                <div class="page-wrapper"> 
                </div>
                <div id="content">
                    <div class="col-md-7">
                        <div class="row-fluid">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"><b>{{titulo}}</b></div>
                                </div>   
                                <div class="form-group">
                                    <select  ng-options="acta as acta.descripcion for acta in actas track by acta.id" ng-model="selected"></select>

                                    <select multiple="" class="selectpicker" ng-options="especies.descripcion for especies in vector_especies track by especies.descripcion" ng-model="form.a">                       
                                    </select>

                                        <ui-select multiple ng-model="especies.selectedvalue">
                                            <ui-select-match placeholder="Select item">
                                                <span ng-bind="$item.descripcion"></span>
                                            </ui-select-match>
                                            <ui-select-choices repeat="item in (vector_especies | filter: $select.search) track by item.descripcion">
                                                <span ng-bind="item.descripcion"></span>
                                            </ui-select-choices>
                                        </ui-select>


                                            
                                </div>

                                    acta:{{selected.descripcion}},//,{{selected["id"]}}{{acta.SelectedOption.id}}{{select}}{{form.a}}{{options}}{{actas}}
                                    especie:{{especies.descripcion}}{{especies.value}}{{especies.value.descripcion}}{{especies.selectedvalue}}

                                <!-- <div ng-controller="menuController"> -->
                                    <div ui-grid="{ data: vector_especies }" class="myGrid"></div>
                                <!-- </div> -->

                            </div>
                        </div>
                        <div class="row-fluid">
                            <h5>total = </h5>{{total}}
                            <p>{{localidades}}</p>
                            <p>{{actas}}</p>
                        </div>
                        <div >
                        <button  ng-click="porcentajes()" type="button" class="btn btn-primary">Porcentajes</button>
                        <button  ng-click="tabla_especies()" type="button" class="btn btn-primary">totales</button>
                                        <!-- <button ng-click="toggle()" ng-class="{on:b.state}" ng-repeat="b in btns">{{b.label}}</button> -->
                                        <!-- <button class="md-raised md-primary md-button md-ink-ripple" type="button" aria-label="boton1"></button> -->
                        </div>


                         <div
                              class="line-chart"
                              line-chart
                              line-post-units="'%'"  
                              line-data='vector_especies'
                              line-xkey='descripcion'
                              line-ykeys='["ITU", "ITA","ABR","PGO"]'
                              line-labels='["itu", "ita","abr","pgo"]'
                              line-colors='["#31C0BE", "#c7254e","#c225ff","#ff254e"]'
                              resize='true'
                              ymax='40%'
                              ymin='20%'>
                        </div>

                        
                        <!-- <canvas id="line" class="chart chart-line" chart-data="data"
                            chart-labels="labels" chart-series="series" chart-options="options"
                            chart-dataset-override="datasetOverride" chart-click="onClick" resize="true">
                        </canvas>  -->

                    </div>
                   <!--  <div class="col-md-5">
                        <h5>Especies</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Especies</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="v in vector_especies">
                                    <td>{{$index}}</td>
                                    <td>{{v}}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div
                              class="line-chart"
                              line-chart
                              line-post-units="'%'"  
                              line-data='vector_especies'
                              line-xkey='descripcion'
                              line-ykeys='["ITU", "ITA","ABR","PGO"]'
                              line-labels='["itu", "ita","abr","pgo"]'
                              line-colors='["#31C0BE", "#c7254e","#c225ff","#ff254e"]'>
                        </div>
                    </div> -->
                </div>
            </div>
    </div>
