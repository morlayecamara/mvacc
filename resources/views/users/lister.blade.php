@extends('layouts.blog')
@section('content') 
        
            <h1>Liste users</h1>  
            <div class="row"> 
                  <div class="col-md-12">
                   <div id="app-tab">
                    <tab></tab>
                  </div>
                  <template id="tab-template"> 
                  <div class="table-responsive">
                    <table class="table table-striped m-b-1">
                     <thead class="thead-default"> 
                      <tr>  
                        <th><small>Name</small></th>
                        <th><small>Email</small></th>
                        <th><small>Role</small></th>
                        <th><small>Province</small></th>
                        <th><small>District</small></th> 
                        <th><small>Faclity</small></th> 
                        <th><small>Zone</small></th> 
                      </tr>
                    </thead>
                    <tbody>  
                      <tr v-for="result in results">  
                         <td class="text-left"> 
                           @{{ result.name }}
                        </td> 
                         <td class="text-left"> 
                           @{{ result.email }}
                        </td> 
                         <td class="text-left"> 
                           @{{ result.roles }}
                        </td> 
                        <td class="text-left"> 
                           @{{ result.province }}
                        </td> 
                        <td class="text-center">
                           @{{ result.district }}
                        </td>
                        <td class="text-center">
                           @{{ result.facility }}
                        </td>
                        <td class="text-center">
                           @{{ result.zone }}
                        </td> 
                      </tr>
                    </tbody>
                    </table>
                  </div>
                    <!--/.table-->
                  </template>
            </div>
                   
                    
        </div> 
        <div class="content-footer">
            <nav class="footer-right">
                <ul class="nav">
                    <li></li>
                </ul>
            </nav>
            <nav class="footer-left">
                <ul class="nav">
                    <li><a href="http://www.moh.gov.zm" target="_blank"><small>Ministry of Health- Latest update: {{ date('Y') }}</small></a> </li> 
                </ul>
            </nav>
        </div><!--content-footer-->
    <script src="../resources/assets/vendor/jquery/jquery.min.js"></script>
    <script src="../resources/assets/js/app.min.js"></script>  
    <script src="../resources/assets/js/chart/chart.js"></script> 
    <script src="../resources/assets/js/views/vue-charts.js"></script> 
    <script src="../resources/assets/js/vue.js"></script> 
 
 <script>
        Vue.component('tab', {
           template: '#tab-template',

           data: function(){
             return {
                results: []
             }
           },

           created: function(){
              this.getData();
           },

           methods: {
             getData: function(){
                $.getJSON("{{ route('lister-json') }}", function(results){ 
                    this.results = results;
                }.bind(this));

                setTimeout(this.getData, 9000);
             }
           }


        });
        new Vue({
             el: '#app-tab',
        });
    </script>
 

@endsection