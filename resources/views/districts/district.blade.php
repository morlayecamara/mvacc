@extends('layouts.blog')
@section('content')
  <style type="text/css">
    #go{ 
        margin-top:38px;
    }
  </style>

          <div class="row">
               @if (Auth::user()->roles == 'viewer-district')
                  <h2 id="name_district"></h2><br>
               @endif
               @if (Auth::user()->roles == 'viewer-province')
                  <h2 id="name_province"></h2><br>
               @endif
           </div>
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
                        <div class="form-group col-sm-3">
                          <label for="district">Select District</label>
                              <select class="form-control" id="district">
                                  <option></option>
                              </select>
                        </div>
                         <div class="form-group col-sm-2">
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>
                      @endif 

                       @if (Auth::user()->roles == 'viewer-province')
                        <input id="province" type="hidden" value="{{ Auth::user()->province }}" name="">
                        <div class="form-group col-sm-3">
                          <label for="district">Select District</label>
                              <select class="form-control" id="district">
                                  <option></option>
                              </select>
                        </div>
                         <div class="form-group col-sm-2">
                          <button id="go" type="button" class="btn btn-primary">Go</button>
                        </div>
                      @endif 
                      @if (Auth::user()->roles == 'viewer-district')
                        <input id="province" type="hidden" value="{{ Auth::user()->province }}" name="">
                        <input id="district" type="hidden" value="{{ Auth::user()->district }}" name="">
                      @endif
              </div><!--/.row-->
              <div class="row">
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
                          <div id="bar_facility"></div>
                    </div>
                    <div class="col-md-4">
                      <h6>% Fully Immunized</h6>
                        <p><small>Children 18–23 months</small></p>
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
      var district = $('#district').val();
      $(document).ready(function() {  
             var province = $('#province').val(); 
             $('#district').empty(); 
             $.get('ajax-district?province=' + province, function(data){
                 
                 $.each(data, function(index, districtObj){
                   $('#district').append('<option value="'+districtObj.district+'">'+districtObj.district+'</option>');
                 });
          });
      });

      $("#name_district").html('Coverage | <span style="color:grey"> ' +district+' District</span>');
      $("#name_province").html('Coverage | <span style="color:grey"> ' +district+' District</span>');


    

          $("#province").on('change', function(e){
             var province = e.target.value; 
             $('#district').empty(); 
             $.get('ajax-district?province=' + province, function(data){
                 
                 $.each(data, function(index, districtObj){
                   $('#district').append('<option value="'+districtObj.district+'">'+districtObj.district+'</option>');
                 });
          });
      }); 


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
                     var district = $('#district').val();
                     var url = '{{ route("province_blog_one", "province=:province,district=:district") }}';
                     url = url.replace(':province', province);
                     url = url.replace(':district', district);
                     url = url.replace(',', '&');
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
                   var district = $('#district').val(); 
                   var url = '{{ route("province_blog_two", "province=:province,district=:district") }}';
                   url = url.replace(':province', province);
                   url = url.replace(':district', district);
                   url = url.replace(',', '&');
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
                   var district = $('#district').val();
                   var url = '{{ route("province_blog_three", "province=:province,district=:district") }}';
                   url = url.replace(':province', province);
                   url = url.replace(':district', district);
                   url = url.replace(',', '&');
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
                     var district = $('#district').val();
                     var url = '{{ route("province_blog_four", "province=:province,district=:district") }}';
                     url = url.replace(':province', province);
                     url = url.replace(':district', district);
                     url = url.replace(',', '&');
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

      function barfacility(){

        var province = $('#province').val();
        var district = $('#district').val();
 
        var url = '{{ route("carte_district_json", "province=:province,district=:district") }}';
        url = url.replace(':province', province);
        url = url.replace(':district', district);
        url = url.replace(',', '&');
        $.getJSON(url, function(data) {
        Highcharts.chart('bar_facility', {
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



        function pie(){
           $('#app-chart').empty();
           $('#app-chart').append('<chartjs-pie :option="myoption" :labels="mylabels" :datasets="mydatasets"  :width="300" :height="300"></chartjs-pie>');
            var province = $('#province').val();
            var district = $('#district').val();
 
            var url = '{{ route("pie_province_json", "province=:province,district=:district") }}';
            url = url.replace(':province', province);
            url = url.replace(':district', district);
            url = url.replace(',', '&');
            $.getJSON(url, function(results){
             
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

         }


    function dropout() {

    var province = $('#province').val();
    var district = $('#district').val();
    var url = '{{ route("dropout_province_json", "province=:province,district=:district") }}';
    url = url.replace(':province', province);
    url = url.replace(':district', district);
    url = url.replace(',', '&');
    d3.json(url, function(error,dropout){
    values = Object.values(dropout);
     
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
          var url = '{{ route("bar_province_json", "province=:province,district=:district") }}';
          url = url.replace(':province', province);
          url = url.replace(':district', district);
          url = url.replace(',', '&');
          $.getJSON(url, function(data) {
            
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
          pie();
          dropout();
          bar();
          barfacility(); 
      });
</script>

<script type="text/javascript">
   $("#go").click(function() { 
      var district = $('#district').val(); 
      $("#name_province").html('Coverage | <span style="color:grey"> ' +district+' District</span>');  
          pie();
          dropout();
          bar();
          barfacility();
     }); 
</script>

@endsection
