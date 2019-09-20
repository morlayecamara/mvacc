@extends('layouts.blog')
@section('content')
  <style type="text/css">
    #go{ 
        margin-top:38px;
    }
  </style>

        <div class="row"> 
            <h2 id="name_province"></h2><br>
            <div class="row">
                     @if (Auth::user()->roles == 'admin')
                        <div class="form-group col-sm-2">
                          <label for="province">Province</label>
                          <select class="form-control" id="province">
                            @foreach($provinces as $province)
                               <option>{{$province->province}}</option>
                            @endforeach
                          </select>
                        </div>
                         <div class="form-group col-sm-2">
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>
                      @endif
                      @if (Auth::user()->roles == 'viewer-province')
                        <input id="province" type="hidden" value="{{ Auth::user()->province }}" name="">
                      @endif
              </div><!--/.row-->
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
                        <div class="subtitle-keyfigures">Number of children 12 - 23 immunized</div>
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
                  <div class="col-md-12 bg-beige"><h4>Coverage Indicators</h4></div>
                  <div class="col-md-8">
                     <div id="bar_container"></div>
                
            </div>
                    <div class="col-md-4">
                  <h6>Drop-Out by Vaccines (%)</h6>
                 <p><small>Children 12–23 months</small></p>
                 <div class="">
                      <div id="chart-dropout">

                      </div>
                 </div>
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
    <script src="../resources/assets/js/highcharts/highcharts.js"></script>
    <script src="../resources/assets/js/highcharts/map.js"></script>
    <script src="https://code.highcharts.com/maps/modules/data.js"></script>
    <script src="../resources/assets/js/highcharts/exporting.js"></script>

    <script src="../resources/assets/js/chart/chart.js"></script>
    <script src="../resources/assets/js/app.min.js"></script>
    <script src="../resources/assets/js/views/vue-charts.js"></script>
    <script src="../resources/assets/js/vue.js"></script>
    <script src="../resources/assets/js/d3/d3.min.js"></script>

    <script type="text/javascript">
      var province = $('#province').val(); 
      $("#name_province").html('Coverage | <span style="color:grey">'+province+' Province</span>');

          $("#province").on('change', function(e){
             var province = e.target.value;
         });


        // Prepare demo data
        // Data is joined to map using value of 'hc-key' property by default.
        // See API docs for 'joinBy' for more info on linking data and map.
        function carte() {

              var province = $('#province').val();
              var url = '{{ route("carte_province_json", "province=:province") }}';
              url = url.replace(':province', province);
              $.getJSON(url, function(data) {
                console.log(data);
                // Create the chart
      // Prepare random data
    var data = data;

    var emailFolder = $('#emailFolder').val(); 
    var url = window.location.href;
    var arr = url.split("/");
    var domainename = arr[0] + "//" + arr[2];
    if(domainename === 'http://localhost')
    {
        var domaineUrl = domainename+'/blog/public';
    }
    else{
        var domaineUrl = domainename;
    } 


    if(province == 'Central')
    {
        url = domaineUrl+'/json/geojson/CE_districts.geojson';
    }
    if(province == 'Copperbelt')
    {
        url = domaineUrl+'/json/geojson/CO_districts.geojson';
    }
    if(province == 'Eastern')
    {
        url = domaineUrl+'/json/geojson/EA_districts.geojson';
    }
    if(province == 'Luapula')
    {
        url = domaineUrl+'/json/geojson/LP_districts.geojson';
    }
    if(province == 'Lusaka')
    {
        url = domaineUrl+'/json/geojson/LS_districts.geojson';
    }
    if(province == 'Muchinga')
    {
        url = domaineUrl+'/json/geojson/MU_districts.geojson';
    }
    if(province == 'North-Western')
    {
        url = domaineUrl+'/json/geojson/NO_districts.geojson';
    }
    if(province == 'Northern')
    {
        url = domaineUrl+'/json/geojson/NW_districts.geojson';
    }
    if(province == 'Southern')
    {
        url = domaineUrl+'/json/geojson/SO_districts.geojson';
    }
    if(province == 'Western')
    {
        url = domaineUrl+'/json/geojson/WE_districts.geojson';
    }
    $.getJSON(url, function (geojson) {

    // Initiate the chart
    Highcharts.mapChart('idcontainer', {

            title: {
                text: 'Children 12 - 23 Immunized by Province',
                align: 'left',
                style: {
                    fontSize: '12px',
                },
            },

            credits: {
                enabled: false
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
                mapData: geojson,
                joinBy: ['Name_Distr', 0],
                keys: ['Name_Distr', 'value'],
                name: 'Children 12 - 23 Immunized',
                states: {
                    hover: {
                         color: '#BADA55'
                    }
                },
                dataLabels: {
                    enabled: true,
                    format: '{point.properties.Name_Distr}'
                },
                tooltip: {
                    valueSuffix: '%'
                }
            }]
        });
    });
                });
            }




              Vue.component('blog-one', {
                 template: '#blog-one',

                 data: function(){
                   return {
                      blogsOne: []
                   }
                 },

                 created: function(){
                    this.getBlogsOne();
                 },

                 methods: {
                   getBlogsOne: function(){
                     var province = $('#province').val();
                     var url = '{{ route("province_blog_one", "province=:province") }}';
                     url = url.replace(':province', province);
                      $.getJSON(url, function(blogsOne){
                          this.blogsOne = blogsOne;
                      }.bind(this));

                      setTimeout(this.getBlogsOne, 9000);
                   }
                 }


              });
              new Vue({
                   el: '#app-one',
              });


            Vue.component('blog-two', {
               template: '#blog-two',

               data: function(){
                 return {
                    blogsTwo: []
                 }
               },

               created: function(){
                  this.getBlogsTwo();
               },

               methods: {
                 getBlogsTwo: function(){
                   var province = $('#province').val();
                   var url = '{{ route("province_blog_two", "province=:province") }}';
                   url = url.replace(':province', province);
                    $.getJSON(url, function(blogsTwo){
                        this.blogsTwo = blogsTwo;
                    }.bind(this));

                    setTimeout(this.getBlogsTwo, 5000);
                 }
               }


            });
            new Vue({
                 el: '#app-two',
            });



            Vue.component('blog-three', {
               template: '#blog-three',

               data: function(){
                 return {
                    blogsThree: []
                 }
               },

               created: function(){
                  this.getBlogsThree();
               },

               methods: {
                 getBlogsThree: function(){
                   var province = $('#province').val();
                   var url = '{{ route("province_blog_three", "province=:province") }}';
                   url = url.replace(':province', province);
                    $.getJSON(url, function(blogsThree){
                        this.blogsThree = blogsThree;
                    }.bind(this));

                    setTimeout(this.getBlogsThree, 5000);
                 }
               }


            });
            new Vue({
                 el: '#app-three',
            });


              Vue.component('blog-four', {
                 template: '#blog-four',

                 data: function(){
                   return {
                      blogsFour: []
                   }
                 },

                 created: function(){
                    this.getBlogsFour();
                 },

                 methods: {
                   getBlogsFour: function(){
                     var province = $('#province').val();
                     var url = '{{ route("province_blog_four", "province=:province") }}';
                     url = url.replace(':province', province);
                      $.getJSON(url, function(blogsFour){
                          this.blogsFour = blogsFour;
                      }.bind(this));

                      setTimeout(this.getBlogsFour, 5000);
                   }
                 }


              });
              new Vue({
                   el: '#app-four',
              });


        function pie(){
           $('#app-chart').empty();
           $('#app-chart').append('<chartjs-pie :option="myoption" :labels="mylabels" :datasets="mydatasets"  :width="300" :height="300"></chartjs-pie>');
            var province = $('#province').val();
            var url = '{{ route("pie_province_json", "province=:province") }}';
            url = url.replace(':province', province);
            $.getJSON(url, function(results){
              console.log(results);
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
                    mylabels: ["No 12 - 23", "12 - 23"],
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

         }


    function dropout() {

    var province = $('#province').val();
    var url = '{{ route("dropout_province_json", "province=:province") }}';
    url = url.replace(':province', province);
    d3.json(url, function(error,dropout){
    values = Object.values(dropout);
     console.log(values);
     var data = values;

        data = data.sort(function (a, b) {
            return d3.ascending(a.value, b.value);
        })


        var margin = {
            top: 10,
            right: 20,
            bottom: 15,
            left: 50
        };

        var width = 285 - margin.left - margin.right,
            height = 350 - margin.top - margin.bottom;
        $('#chart-dropout').empty();
        var svg = d3.select("#chart-dropout").append("svg")
            .attr("width", width + margin.left + margin.right)
            .attr("height", height + margin.top + margin.bottom)
            .append("g")
            .attr("transform", "translate(" + margin.left + "," + margin.top + ")");

        var x = d3.scale.linear()
            .range([0, width])
            .domain([0, d3.max(data, function (d) {
                return d.value;
            })]);

        var y = d3.scale.ordinal()
            .rangeRoundBands([height, 0], .3)
            .domain(data.map(function (d) {
                return d.label;
            }));

        //make y axis to show bar names
        var yAxis = d3.svg.axis()
            .scale(y)
            //no tick marks
            .tickSize(0)
            .orient("left");

        var gy = svg.append("g")
            .attr("class", "y axis")
            .call(yAxis)

        var bars = svg.selectAll(".bar")
            .data(data)
            .enter()
            .append("g")

        //append rects
        bars.append("rect")
            .attr("class", "bar")
            .attr("y", function (d) {
                return y(d.label);
            })
            .attr("height", y.rangeBand())
            .attr("x", 0)
            .attr("width", function (d) {
                return x(d.value);
            });

        //add a value label to the right of each bar
        bars.append("text")
            .attr("class", "label")
            //y position of the label is halfway down the bar
            .attr("y", function (d) {
                return y(d.label) + y.rangeBand() / 2 + 4;
            })
            //x position is 3 pixels to the right of the bar
            .attr("x", function (d) {
                return x(d.value) + 3;
            })
            .text(function (d) {
                return d.value;
            });

        });
        }

          function bar(){

          var province = $('#province').val();
          var url = '{{ route("bar_province_json", "province=:province") }}';
          url = url.replace(':province', province);
          $.getJSON(url, function(data) {
             console.log(data);
          Highcharts.chart('bar_container', {
              chart: {
                  type: 'column'
              },

              title: {
                  text: ''
              },
               credits: {
                          enabled: false
                      },
              legend: {
                      enabled: true
              },

              subtitle: {
                  text: ''
              },
              xAxis: {
                  type: 'category',
                  labels: {
                      rotation: -45,
                      style: {
                          fontSize: '13px',
                          fontFamily: 'Verdana, sans-serif'
                      }
                  }
              },
              yAxis: {
                  min:0,
                  title: {
                      text: 'Coverage'
                  }
              },
              tooltip: {
                  pointFormat: 'Coverage: <b>{point.y:.1f} %</b>'
              },
              series: [{
                  name: 'Coverage',
                  data: data,
                  dataLabels: {
                      enabled: true,
                      rotation: -90,
                      color: '#FFFFFF',
                      align: 'right',
                      format: '{point.y:.1f}', // one decimal
                      y: 10, // 10 pixels down from the top
                      style: {
                          fontSize: '13px',
                          fontFamily: 'Verdana, sans-serif'
                      }
                  },
              }]
          });
          });
        }

        


</script>

<script type="text/javascript">
  $(document).ready(function() {  
         carte();
         pie();
         dropout();
         bar();
      });
</script>

<script type="text/javascript">
   $("#go").click(function() { 
          carte();
          pie();
          dropout();
          bar();
     }); 
</script>

@endsection
