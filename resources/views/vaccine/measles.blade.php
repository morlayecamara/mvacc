@extends('layouts.blog')
@section('content')
        
     
        <div class="row"> 
            <h1>Measles Vaccination</h1>
            <div class="col-md-12"><h4>Key Figures</h4></div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                        <div class="subtitle-keyfigures">Number of registered children in mVaccination </div>
                        <div class="pop-keyfigures">Children 0 - 23 months</div>
                        <div id="app-one">
                          <blog-one></blog-one>
                        </div>

                        <template id="blog-one"> 
                         <tbody>
                            <tr v-for="blog_one in blogsOne"> 
                                <td class="number-keyfigures">@{{ blog_one.value }} children</td>
                            </tr> 
                            <tr v-for="blog_one in blogsOne"> 
                                <td class="data-keyfigures">@{{ blog_one.female }} % of girls and @{{ blog_one.male }} % of boys</td>
                            </tr>
                          </tbody>
                        </template>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                        <div class="subtitle-keyfigures">Number of children fully immunized</div>
                        <div class="pop-keyfigures">Children 12 - 23 months</div>
                         <div id="app-two">
                          <blog-two></blog-two>
                        </div>
                        <template id="blog-two"> 
                          <tbody>
                            <tr v-for="blog_two in blogsTwo"> 
                                <td class="number-keyfigures">@{{ blog_two.value }} children</td>
                            </tr>
                            <tr v-for="blog_two in blogsTwo"> 
                                <td class="data-keyfigures">@{{ blog_two.percent }} % of registered children</td>
                            </tr>
                          </tbody>
                        </template>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                           <div class="subtitle-keyfigures">Number of Children missing second dose of Measles</div>
                           <div class="pop-keyfigures">Children 12 - 23 months</div>
                           <div id="app-three">
                            <blog-three></blog-three>
                          </div>
                        <template id="blog-three"> 
                          <tbody>
                              <tr v-for="blog_three in blogsThree"> 
                                  <td class="number-keyfigures">@{{ blog_three.value }} children</td>
                              </tr>
                              <tr v-for="blog_three in blogsThree"> 
                                  <td class="data-keyfigures">@{{ blog_three.percent }} % of registered children</td>
                              </tr>
                          </tbody>
                        </template>   
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                           <div class="subtitle-keyfigures">Number of Children Dropout between DPT1 and DPT3</div>
                           <div class="pop-keyfigures">Children 12 - 23 months</div> 
                           <div id="app-four">
                              <blog-four></blog-four>
                            </div>
                           <template id="blog-four"> 
                              <tbody>
                                  <tr v-for="blog_four in blogsFour"> 
                                      <td class="number-keyfigures">@{{ blog_four.value }} children</td>
                                  </tr>
                                  <tr v-for="blog_four in blogsFour"> 
                                      <td class="data-keyfigures">@{{ blog_four.percent }} % of registered children</td>
                                  </tr>
                              </tbody>
                          </template>    
                        </div>
                </div>
            </div> 
            <div class="row"> <br></div> 
            <div class="row"> 
                <div class="col-md-12 bg-beige"><h4>Vaccination Coverage</h4></div>
                    <div class="col-md-8">         
                         <div id="idcontainer" style="height: 500px; min-width: 310px; max-width: 800px; margin: 0 auto"></div> 
                    </div>
                    <div class="col-md-4"> 
                      <h6>% Fully Immunized</h6>
                        <p><small>Children 12–23 months</small></p>
                        <div id="app-chart"> 
                          <chartjs-pie :option="myoption" :labels="mylabels" :datasets="mydatasets"  :width="300" :height="300"></chartjs-pie>
                        </div>
                    </div>
                     <div class="col-sm-4">
                        <div class="keyfigures-vertical">
                             
                        </div>
                     </div>
                 
                  </div>
            <div class="row"> 
                  <div class="col-md-12"><h4>Coverage Indicators</h4></div>
                  <div class="col-md-12">
                   <div id="app-tab">
                    <tab></tab>
                  </div>
                  <template id="tab-template"> 
                  <div class="table-responsive">
                    <table class="table table-striped m-b-1">
                    <thead class="thead-default">
                      <tr>
                        <th class="text-left">Province</th>
                        <th class="text-center">Tot</th>
                        <th class="text-center">0-12</th>
                        <th class="text-center">12-23</th>
                        <th class="text-center">% Coverage measles</th> 
                        <th class="text-center"># Vaccinated</th> 
                        <th class="text-center"># Unvaccinated</th>
                        <th class="text-center">Targeted Population</th>  
                      </tr>
                    </thead>
                    <tbody>  
                      <tr v-for="result in results"> 
                        <td class="text-left">
                           @{{ result.province }}
                        </td> 
                        <td class="text-center">
                           @{{ result.children_023 }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_011 }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_1223 }}
                        </td>
                        <td class="text-center">
                           @{{ result.measles }}
                        </td>
                        <td class="text-center">
                           @{{ result.nbrmeasles }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_1223-result.nbrmeasles }}
                        </td>
                        <td class="text-center">
                           @{{ result.children_1223 }}
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
    <script src="../resources/assets/js/highcharts/highcharts.js"></script>
    <script src="../resources/assets/js/highcharts/map.js"></script>
    <script src="../resources/assets/js/highcharts/exporting.js"></script>
    <script src="../resources/assets/js/highcharts/zm-all.js"></script> 

     <script>
        // Prepare demo data
        // Data is joined to map using value of 'hc-key' property by default.
        // See API docs for 'joinBy' for more info on linking data and map.
    
      $.getJSON("{{ route('carte_measles_json') }}", function(data) {  
        // Create the chart
        Highcharts.mapChart('idcontainer', {
            chart: {
                map: 'countries/zm/zm-all',
            backgroundColor: '#FFF',
            },
            
            credits: {
                enabled: false
            },

            title: {
                text: 'Children Fully Immunized by Province',
         align: 'left',
         style: {
                fontSize: '12px',
            },
            },
            
            legend: {
          enabled: true
      },

            mapNavigation: {
                enabled: false,
                buttonOptions: {
                    verticalAlign: 'bottom'
                }
            },

           colorAxis: {
              dataClasses: [{ 
                 from: 0,
                 to: 0.1,
                 color: "#f6f6f6",
                 name: 'No data'
                 },{ 
                 from:0.1, 
                 to: 50,
                 color: "#d24760",
                 name: '< 50 %'
                 },{
                 from: 50,
                 to: 70,
                 color: "#f4814e",
                 name: '50-70 %'
                 },{
                 from: 70,
                 to: 80,
                 color: "#ffd332",
                 name: '70-80 %'
                 },{
                 from: 80,
                 to: 90,
                 color: "#95c5e9",
                 name: '80-90 %'
                 },{
                 from: 90,
                 color: "#4f6785",
                 name: '> 90 %'
                 }           
             ]
            },
            
            plotOptions:{
          series:{
              point:{
                  events:{
                      click: function(){
                             var province = this.name; 
                        }
                    }
                }
            }
        },

            series: [{
                data: data,
                name: 'Children Fully Immunized', 
                states: {
                    hover: {
                        color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.name}'
                },

     tooltip: {
                valueSuffix: '%'
              }
            }]
        });
 });
      
</script>
    <script src="../resources/assets/js/chart/chart.js"></script> 
    <script src="../resources/assets/js/views/vue-charts.js"></script> 
    <script src="../resources/assets/js/vue.js"></script>
    <script src="../resources/assets/js/d3/d3.min.js"></script>
   <script>
        Vue.component('blog-one', {
           template: '#blog-one',

           data: function(){
             return {
                blogs: [],
                blogsOne: []
             }
           },

           created: function(){
              this.getBlogs();
              this.getBlogsOne();
           },

           methods: {
             getBlogs: function(){
                $.getJSON("{{ route('blog_one') }}", function(blogs){ 
                    this.blogs = blogs;
                }.bind(this));

                setInterval(this.getBlogs, 30000);
             },
             getBlogsOne: function(){ 
                var url = window.location.href;
                var arr = url.split("/");
                var domainename = arr[0] + "//" + arr[2];

                if(domainename === 'http://localhost')
                {
                   var addressUrl = domainename+'/blog/public/json/blog/blogOne.blade.php';
                }
                else{
                   var addressUrl = domainename+'/json/blog/blogOne.blade.php';
                }
                
                $.getJSON(addressUrl, function(blogsOne){ 
                    this.blogsOne = blogsOne;
                }.bind(this));

                setInterval(this.getBlogsOne, 10000);
             }
           }


        });
        new Vue({
             el: '#app-one',
        });
    </script>
     <script>
        Vue.component('blog-two', {
           template: '#blog-two',

           data: function(){
             return {
                blogs: [],
                blogsTwo: []
             }
           },

           created: function(){
              this.getBlogs();
              this.getBlogsTwo();
           },

           methods: {
             getBlogs: function(){
                $.getJSON("{{ route('blog_two') }}", function(blogs){ 
                    this.blogs = blogs;  
                }.bind(this));

                setInterval(this.getBlogs, 30000);
             },
             getBlogsTwo: function(){
                var url = window.location.href;
                var arr = url.split("/");
                var domainename = arr[0] + "//" + arr[2];

                if(domainename === 'http://localhost')
                {
                   var addressUrl = domainename+'/blog/public/json/blog/blogTwo.blade.php';
                }
                else{
                   var addressUrl = domainename+'/json/blog/blogTwo.blade.php';
                }
                $.getJSON(addressUrl, function(blogsTwo){ 
                    this.blogsTwo = blogsTwo;  
                }.bind(this));

                setInterval(this.getBlogsTwo, 10000);
             }
           }


        });
        new Vue({
             el: '#app-two',
        });
    </script>
    <script>
        Vue.component('blog-three', {
           template: '#blog-three',

           data: function(){
             return {
                blogs: [],
                blogsThree: []
             }
           },

           created: function(){
              this.getBlogs();
              this.getBlogsThree();
           },

           methods: {
             getBlogs: function(){
                $.getJSON("{{ route('blog_three') }}", function(blogs){ 
                    this.blogs = blogs;  
                }.bind(this));

                setInterval(this.getBlogsThree, 30000);
             },
             getBlogsThree: function(){
                var url = window.location.href;
                var arr = url.split("/");
                var domainename = arr[0] + "//" + arr[2];

                if(domainename === 'http://localhost')
                {
                   var addressUrl = domainename+'/blog/public/json/blog/blogThree.blade.php';
                }
                else{
                   var addressUrl = domainename+'/json/blog/blogThree.blade.php';
                }
                $.getJSON(addressUrl, function(blogsThree){ 
                    this.blogsThree = blogsThree;  
                }.bind(this));

                setInterval(this.getBlogsThree, 10000);
             }
           }


        });
        new Vue({
             el: '#app-three',
        });
    </script>
    <script>
        Vue.component('blog-four', {
           template: '#blog-four',

           data: function(){
             return {
                blogs: [],
                blogsFour: []
             }
           },

           created: function(){
              this.getBlogs();
              this.getBlogsFour();
           },

           methods: {
             getBlogs: function(){
                $.getJSON("{{ route('blog_four') }}", function(blogs){ 
                    this.blogs = blogs;  
                }.bind(this));

                setInterval(this.getBlogsFour, 30000);
             },
             getBlogsFour: function(){
                var url = window.location.href;
                var arr = url.split("/");
                var domainename = arr[0] + "//" + arr[2];

                if(domainename === 'http://localhost')
                {
                   var addressUrl = domainename+'/blog/public/json/blog/blogFour.blade.php';
                }
                else{
                   var addressUrl = domainename+'/json/blog/blogFour.blade.php';
                }
                $.getJSON(addressUrl, function(blogsFour){ 
                    this.blogsFour = blogsFour;  
                }.bind(this));

                setInterval(this.getBlogsFour, 10000);
             }
           }


        });
        new Vue({
             el: '#app-four',
        });
    </script>
   <script>
    $.getJSON("{{ route('pie_measles_json') }}", function(results){  
    Vue.use(VueCharts);
    const app = new Vue({
        el: '#app-chart',
        data:{
            myoption:{
                responsive:true,
                maintainAspectRatio:true,
                title: {
                    display: true,
                    position: 'bottom'
                }
            },
            mylabels: ["No fully", "Fully"],
            mydatasets:[{
                data: results,
                backgroundColor: [
                    "#d24760",
                    "#4f6785" 
                ],
                hoverBackgroundColor: [
                    "#d24760",
                    "#4f6785"
                ]
            }]
        },
    });
  });
  
</script>
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
                $.getJSON("{{ route('tab_overview_json') }}", function(results){ 
                    this.results = results;
                }.bind(this));

                setTimeout(this.getData, 30000);
             }
           }


        });
        new Vue({
             el: '#app-tab',
        });
    </script>
   
@endsection