@extends('layouts.blog')
@section('content') 
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
        <div class="row"> 
            <h1>Metrics</h1>
            <div class="row"> <br></div> 
            <div class="col-md-12"><h4>Key Figures</h4></div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                        <div class="subtitle-keyfigures">Total of Enrolled Children on mVaccination </div>
                        <div class="pop-keyfigures">All Children</div>
                        <div id="app-one">
                          <blog-one></blog-one>
                        </div>

                        <template id="blog-one"> 
                         <tbody>
                            <tr v-for="blog_one in blogsOne"> 
                                 <td class="number-keyfigures">@{{ blog_one.valueall }} children</td>
                            </tr> 
                            <tr v-for="blog_one in blogsOne"> 
                                 <td class="data-keyfigures">@{{ blog_one.femaleall }} % of girls and @{{ blog_one.maleall }} % of boys</td>
                            </tr>
                          </tbody>
                        </template>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                        <div class="subtitle-keyfigures">Total of Enrolled Children under 2 years</div>
                        <div class="pop-keyfigures">Children 0 - 23 months</div>
                         <div id="app-two">
                          <blog-two></blog-two>
                        </div>
                        <template id="blog-two"> 
                          <tbody>
                            <tr v-for="blog_two in blogsTwo"> 
                                 <td class="number-keyfigures">@{{ blog_two.value }} children</td>
                            </tr>
                            <tr v-for="blog_two in blogsTwo"> 
                                <td class="data-keyfigures">@{{ blog_two.female }} % of girls and @{{ blog_two.male }} % of boys</td>
                            </tr>
                          </tbody>
                        </template>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                           <div class="subtitle-keyfigures">Total of Active Volunteers on mVaccination</div>
                           <div class="pop-keyfigures">Active / Enrolled Volunteers</div>
                           <div id="app-three">
                              <blog-three></blog-three>
                            </div>
                           <template id="blog-three"> 
                              <tbody>
                                  <tr v-for="blog_three in blogsThree"> 
                                      <td class="number-keyfigures">@{{ blog_three.chw }} / @{{ blog_three.tot_chw }}</td>
                                  </tr>  
                              </tbody>
                          </template>   
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="keyfigures-horizontal">
                           <div class="subtitle-keyfigures">Total of Active Facilities on mVaccination</div>
                           <div class="pop-keyfigures"></div> 
                           <div id="app-four">
                              <blog-four></blog-four>
                            </div>
                           <template id="blog-four"> 
                              <tbody>
                                  <tr v-for="blog_four in blogsFour"> 
                                      <td class="number-keyfigures">@{{ blog_four.facility }} / @{{ blog_four.facilitytot }}</td>
                                  </tr>  
                              </tbody>
                          </template>  
                      </div>
                </div>
            </div> 
            <div class="row"> <br></div> 
            <div class="row"> 
                <div class="col-md-12 bg-beige"><h4>Children</h4></div> 
                    <div class="col-md-8">    
                    <h6>Evolution of Enrolled Children by Month</h6>   
                    <!--  
                      <div id="app-chart-bar">
                          <canvas id="mycanvas" count="1"></canvas> 
                          <chartjs-bar option="myoption" :labels="mylabels" target="mycanvas" :datasets="mydatasets" :backgroundcolor="'#383838'"></chartjs-bar> 
                      </div>
                    -->

                    <section id="chart">
                        <d3__chart
                                   :layout="layout"
                                   :chart-data="chartData"
                                   :axes="axes"></d3__chart>
                      </section>

                      <section class="content">
                         
                      </section>

                      <template id="d3__chart">
                        <svg :view-box.camel="viewBox" preserveAspectRatio="xMidYMid meet">
                          <g class="d3__stage" :style="stageStyle">
                            <d3__axis
                                      v-for="axis in axes"
                                      :axis="axis"
                                      :layout="layout"
                                      :scale="scale"
                                      ></d3__axis>
                            <d3__series
                                        v-for="seriesData in chartData"
                                        :series-data="seriesData" 
                                        :layout="layout"
                                        :scale="scale"></d3__series>
                          </g>
                        </svg>
                      </template>

                      <template id="d3__axis">
                        <g :class="[classList]" ref="axis" :style="style"></g>
                      </template>

                      <template id="d3__series">
                        <g class="d3__series">
                          <d3__area
                                    :layout="layout"
                                    :series-data="this.seriesData"
                                    :scale="this.scale">
                          </d3__area>
                          <d3__line
                                    :layout="layout"
                                    :series-data="this.seriesData"
                                    :scale="this.scale">
                          </d3__line>
                          <d3__scatter
                                       :layout="layout"
                                       :series-data="this.seriesData"
                                       :scale="this.scale">
                          </d3__scatter>
                        </g>
                      </template>

                      <template id="d3__line">
                        <path class="line" ref="line" :style="style"></path>
                      </template>

                      <template id="d3__area">
                        <path class="area" ref="area" :style="style"></path>
                      </template>

                      <template id="d3__scatter">
                        <g class="points">
                          <d3__point
                                     v-for="pointData in seriesData.values"
                                     v-if="typeof pointData.value !== typeof null"
                                     :series-id="seriesData.id"
                                     :point-data="pointData"
                                     :layout="layout"
                                     :scale="scale"></d3__point>
                        </g>
                      </template>

                      <template id="d3__point">
                        <circle class="point" ref="point" :style="style"></circle>
                      </template>



                    </div>
                    <div class="col-md-4"> 
                      <h6>Distribution of Enrolled Children by Age Group</h6>
                        <p><small></small></p>
                        <div id="app-chart"> 
                          <chartjs-pie :option="myoption" :labels="mylabels" :datasets="mydatasets"  :width="300" :height="300"></chartjs-pie>
                        </div>
                    </div>
                    
                 
                  </div>
            <div class="row"> 
                  <div class="col-md-12 bg-beige"><h4>Volunteers</h4></div>
                  <div class="col-md-8">
                  <h6>Evolution of Enrolled Volunteers by Month</h6> 

                  <section id="chart_chw">
                        <d3__chart_chw
                                   :layout="layout"
                                   :chart-data="chartData"
                                   :axes="axes"></d3__chart_chw>
                      </section>

                      <section class="content">
                         
                      </section>

                      <template id="d3__chart_chw">
                        <svg :view-box.camel="viewBox" preserveAspectRatio="xMidYMid meet">
                          <g class="d3__stage" :style="stageStyle">
                            <d3__axis_chw
                                      v-for="axis in axes"
                                      :axis="axis"
                                      :layout="layout"
                                      :scale="scale"
                                      ></d3__axis_chw>
                            <d3__series_chw
                                        v-for="seriesData in chartData"
                                        :series-data="seriesData" 
                                        :layout="layout"
                                        :scale="scale"></d3__series_chw>
                          </g>
                        </svg>
                      </template>

                      <template id="d3__axis_chw">
                        <g :class="[classList]" ref="axis" :style="style"></g>
                      </template>

                      <template id="d3__series_chw">
                        <g class="d3__series">
                          <d3__area
                                    :layout="layout"
                                    :series-data="this.seriesData"
                                    :scale="this.scale">
                          </d3__area>
                          <d3__line
                                    :layout="layout"
                                    :series-data="this.seriesData"
                                    :scale="this.scale">
                          </d3__line>
                          <d3__scatter
                                       :layout="layout"
                                       :series-data="this.seriesData"
                                       :scale="this.scale">
                          </d3__scatter>
                        </g>
                      </template>

                      <template id="d3__line">
                        <path class="line" ref="line" :style="style"></path>
                      </template>

                      <template id="d3__area">
                        <path class="area" ref="area" :style="style"></path>
                      </template>

                      <template id="d3__scatter">
                        <g class="points">
                          <d3__point
                                     v-for="pointData in seriesData.values"
                                     v-if="typeof pointData.value !== typeof null"
                                     :series-id="seriesData.id"
                                     :point-data="pointData"
                                     :layout="layout"
                                     :scale="scale"></d3__point>
                        </g>
                      </template>

                      <template id="d3__point">
                        <circle class="point" ref="point" :style="style"></circle>
                      </template>
                   </div>
                  
                    
            </div> 
            <div class="row"> 
                
                      <div class="col-md-12 bg-beige"><h4>Actives Volunteers</h4></div>
                      <div class="col-md-12">
                         <div class="table table-responsive">
                          <table id="example" class="table table-striped m-b-1">
                          <thead class="thead-default">
                            <tr> 
                              <th class="text-center">Name</th>
                              <th class="text-center">Phone</th>
                              <th class="text-center">Province</th>
                              <th class="text-center">District</th>
                              <th class="text-center">Facility</th>
                              <th class="text-center">Zone</th>
                              <th class="text-center">Number of children registered</th>  
                            </tr> 
                          </thead> 
                        </table> 
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
    <script src="../resources/assets/js/app.min.js"></script>
    <script src="../resources/assets/js/chart/chart.js"></script> 
    <script src="../resources/assets/js/views/vue-charts.js"></script> 
    <script src="../resources/assets/js/vue.js"></script>
    <script src="../resources/assets/js/d3/d3.min.js"></script>
    <script src="../resources/assets/dynatable/jquery.dataTables.min.js"></script> 
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/d3/4.12.0/d3.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.5.9/vue.js"></script>
    <script>
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
                $.getJSON("{{ route('blog_one') }}", function(blogsOne){ 
                    this.blogsOne = blogsOne;
                }.bind(this));

                setTimeout(this.getBlogsOne, 9000);
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
                blogsTwo: []
             }
           },

           created: function(){
              this.getBlogsTwo();
           },

           methods: {
             getBlogsTwo: function(){
                $.getJSON("{{ route('blog_one') }}", function(blogsTwo){ 
                    this.blogsTwo = blogsTwo;  
                }.bind(this));

                setTimeout(this.getBlogsTwo, 10000);
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
                blogsThree: []
             }
           },

           created: function(){
              this.getBlogsThree();
           },

           methods: {
             getBlogsThree: function(){
                $.getJSON("{{ route('blog_metrics_four') }}", function(blogsThree){ 
                    this.blogsThree = blogsThree;  
                }.bind(this));

                setTimeout(this.getBlogsThree, 10000);
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
                blogsFour: []
             }
           },

           created: function(){
              this.getBlogsFour();
           },

           methods: {
             getBlogsFour: function(){
                $.getJSON("{{ route('blog_metrics_four') }}", function(blogsFour){ 
                    this.blogsFour = blogsFour;  
                }.bind(this));

                setTimeout(this.getBlogsFour, 10000);
             }
           }


        });
        new Vue({
             el: '#app-four',
        });
    </script>

 
   
   <script>
    $.getJSON("{{ route('pie_metrics_json') }}", function(results){  
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
            mylabels: ["0-6 months", "6-12 months", "12 - 18 months", "18 - 24 months"],
            mydatasets:[{
                data: results,
                backgroundColor: [
                    "#d24760",
                    "#4f6785",
                    "#f4814e",
                    "#ffd332"
                ],
                hoverBackgroundColor: [
                    "#d24760",
                    "#4f6785",
                    "#f4814e",
                    "#ffd332"
                ]
            }]
        },
    });
  });
  
</script>
 
<script type="text/javascript">
  $.getJSON("{{ route('line_metrics_json') }}", function(data) {
    console.log(data);
     var response = {
  "data": {
    "flipbooks": {
      "rawData": data
    }
  }
};
var chartData = response.data.flipbooks.rawData;

// Parse the data and split it into series
var columns = ['Timestamp', 'Previous', 'Current'],
    offset = 1;
var c = columns.slice(offset).map(function(id, index) {
  return {
    id: id,
    values: chartData.map(function(d) {
      return {
        timestamp: d3.utcParse("%Y-%m-%dT%H:%M:%S")(d[0]).setHours(0,0,0,0),
        value: d[index + offset]
      }
    })
  }
});

// Component: SVG parent and stage
Vue.component('d3__chart', {
  template: '#d3__chart',
  props: [
    'axes',       // Chart axes
    'layout',     // Dimensions for the chart and margins
    'chart-data'  // Data for plotting
  ],
  computed: {

    // SVG viewbox
    viewBox: function() {
      var outerWidth = this.layout.width + this.layout.marginLeft + this.layout.marginRight,
          outerHeight = this.layout.height + this.layout.marginTop + this.layout.marginBottom;
      return '0 0 ' + outerWidth + ' ' + outerHeight;
    },

    // Stage
    stageStyle: function() {
      return {
        'transform': 'translate(' + this.layout.marginLeft + 'px,' + this.layout.marginTop + 'px)'
      }
    }
  },
  data: function() {
    return {
      scale: {
        x: this.getScaleX(),
        y: this.getScaleY(),
        color: d3.scaleOrdinal()
          .range(['#159078', '#999999'])
          .domain(['Current', 'Previous'])
      }
    }
  },
  methods: {

    // Get x-axis scale
    getScaleX: function() {
      return d3.scaleTime()
        .range([0, this.layout.width])
        .domain(d3.extent(chartData, function(d) {
          return d3.utcParse("%Y-%m-%dT%H:%M:%S")(d[0]).setHours(0,0,0,0)
        }));
    },

    // Get y-axis scale
    getScaleY: function() {
      return d3.scaleLinear()
        .range([this.layout.height, 0])
        .domain([
          0,
          d3.max(this.chartData, function(d) {
            return d3.max(d.values, function(e) {
              return e.value;
            })
          })
        ]);
    }
  },
  watch: {
    // Watch for layout changes
    layout: {
      deep: true,
      handler: function(val, oldVal) {
        this.scale.x = this.getScaleX();
        this.scale.y = this.getScaleY();
      }
    }
  }
});

// Component: Chart axes
Vue.component('d3__axis', {
  template: '#d3__axis',
  props: ['axis', 'layout', 'scale'],
  data: function() {
    return {
      classList: ['axis'].concat(this.getAxisClasses())
    }
  },
  mounted: function() {
    this.drawAxis();
  },
  computed: {
    style: function() {
      return {
        transform: this.getAxisTransform()
      }
    }
  },
  methods: {
    
    // Return a class list containg the appropriate labels for axes
    getAxisClasses: function() {
      var axis = {
        top: 'x',
        bottom: 'x',
        left: 'y',
        right: 'y'
      };
      return [this.axis, axis[this.axis]];
    },
    
    // Draw axis
    drawAxis: function() {
      
      var $axis = d3.select(this.$refs.axis);
      var scale = this.scale;
      var axisGenerator = {
        top: d3.axisTop(scale.x).tickFormat(d3.timeFormat("%b %d")),
        right: d3.axisRight(scale.y),
        bottom: d3.axisBottom(scale.x).tickFormat(d3.timeFormat("%b %d")),
        left: d3.axisLeft(scale.y)
      }
      
      $axis.call(axisGenerator[this.axis]);
    },
    
    // Return necessary axis transformation for proper positioning
    getAxisTransform: function() {
      
      var axisOffset = {
        top: { x: 0, y: 0 },
        right: { x: this.layout.width, y: 0 },
        bottom: { x: 0, y: this.layout.height },
        left: { x: 0, y: 0 }
      };

      return 'translate('+axisOffset[this.axis].x+'px, '+axisOffset[this.axis].y+'px)';
    }
  },
   watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawAxis();
      }
    }
  }
});

// Component: Data series
Vue.component('d3__series', {
  template: '#d3__series',
  props: ['layout', 'series-data', 'scale']
});


// Component: D3 line
Vue.component('d3__line', {
  template: '#d3__line',
  props: ['layout', 'series-data', 'scale'],
  mounted: function() {
    this.drawLine();
  },
  methods: {
    drawLine: function() {

      // Get scale
      var scale = this.scale;

      // Line object
      var line = d3.line()
        .x(function(d) {
          return scale.x(d.timestamp);
        })
        .y(function(d) {
          return scale.y(d.value);
        });

      // DOM node for line
      var $line = d3.select(this.$refs.line);
      $line
        .data([this.seriesData.values.filter(function(d) {
          return typeof d.value !== typeof null;
        })])
        .attr('d', line);
    }
  },
  computed: {
    style: function() {
      return {
        fill: 'none',
        stroke: '#19638c',
        strokeWidth: 2
      }
    }
  },
  watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawLine();
      }
    }
  }
});




// Component: D3 point/scatter
Vue.component('d3__scatter', {
  template: '#d3__scatter',
  props: ['layout', 'series-data', 'scale'],
  watch: {
    scale: {
      deep: true,
      handler: function() {}  // Has to be included for nested components watch to fire properly
    }
  }
});

// D3 component: points


// Component: D3 area
Vue.component('d3__area', {
  template: '#d3__area',
  props: ['layout', 'series-data', 'scale'],
  mounted: function() {
    this.drawArea();
  },
  methods: {
    drawArea: function() {
      // Get scale
      var scale = this.scale;

      // Area object
      var area = d3.area()
        .x(function(d) {
          return scale.x(d.timestamp);
        })
        .y0(scale.y(0))
        .y1(function(d) {
          return scale.y(d.value);
        });

      // DOM node for area
      var $area = d3.select(this.$refs.area);

      $area
        .datum(this.seriesData.values.filter(function(d) {
          return typeof d.value !== typeof null;
        }))
        .attr('d', area);
    }
  },
  computed: {
    style: function() {
      return {
        fill: '#52aee0',
        fillOpacity: 1
      }
    }
  },
  watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawArea();
      }
    }
  }
});

// Initialize chart
var d3Vis = new Vue({
  el: '#chart',
  data: {
    layout: {
      width: 800,
      height: 400,
      marginTop: 5,
      marginRight: 0,
      marginBottom: 50,
      marginLeft: 40,
    },
    chartData: c,
    axes: ['left', 'bottom']
  }
});
  });
</script>




<!-- chw chart line -->

<script type="text/javascript">
  $.getJSON("{{ route('line_metrics_chw_json') }}", function(data) {
    console.log(data);
     var response = {
  "data": {
    "flipbooks": {
      "rawData": data
    }
  }
};
var chartData = response.data.flipbooks.rawData;

// Parse the data and split it into series
var columns = ['Timestamp', 'Previous', 'Current'],
    offset = 1;
var c = columns.slice(offset).map(function(id, index) {
  return {
    id: id,
    values: chartData.map(function(d) {
      return {
        timestamp: d3.utcParse("%Y-%m-%dT%H:%M:%S")(d[0]).setHours(0,0,0,0),
        value: d[index + offset]
      }
    })
  }
});

// Component: SVG parent and stage
Vue.component('d3__chart_chw', {
  template: '#d3__chart_chw',
  props: [
    'axes',       // Chart axes
    'layout',     // Dimensions for the chart and margins
    'chart-data'  // Data for plotting
  ],
  computed: {

    // SVG viewbox
    viewBox: function() {
      var outerWidth = this.layout.width + this.layout.marginLeft + this.layout.marginRight,
          outerHeight = this.layout.height + this.layout.marginTop + this.layout.marginBottom;
      return '0 0 ' + outerWidth + ' ' + outerHeight;
    },

    // Stage
    stageStyle: function() {
      return {
        'transform': 'translate(' + this.layout.marginLeft + 'px,' + this.layout.marginTop + 'px)'
      }
    }
  },
  data: function() {
    return {
      scale: {
        x: this.getScaleX(),
        y: this.getScaleY(),
        color: d3.scaleOrdinal()
          .range(['#159078', '#999999'])
          .domain(['Current', 'Previous'])
      }
    }
  },
  methods: {

    // Get x-axis scale
    getScaleX: function() {
      return d3.scaleTime()
        .range([0, this.layout.width])
        .domain(d3.extent(chartData, function(d) {
          return d3.utcParse("%Y-%m-%dT%H:%M:%S")(d[0]).setHours(0,0,0,0)
        }));
    },

    // Get y-axis scale
    getScaleY: function() {
      return d3.scaleLinear()
        .range([this.layout.height, 0])
        .domain([
          0,
          d3.max(this.chartData, function(d) {
            return d3.max(d.values, function(e) {
              return e.value;
            })
          })
        ]);
    }
  },
  watch: {
    // Watch for layout changes
    layout: {
      deep: true,
      handler: function(val, oldVal) {
        this.scale.x = this.getScaleX();
        this.scale.y = this.getScaleY();
      }
    }
  }
});

// Component: Chart axes
Vue.component('d3__axis_chw', {
  template: '#d3__axis_chw',
  props: ['axis', 'layout', 'scale'],
  data: function() {
    return {
      classList: ['axis'].concat(this.getAxisClasses())
    }
  },
  mounted: function() {
    this.drawAxis();
  },
  computed: {
    style: function() {
      return {
        transform: this.getAxisTransform()
      }
    }
  },
  methods: {
    
    // Return a class list containg the appropriate labels for axes
    getAxisClasses: function() {
      var axis = {
        top: 'x',
        bottom: 'x',
        left: 'y',
        right: 'y'
      };
      return [this.axis, axis[this.axis]];
    },
    
    // Draw axis
    drawAxis: function() {
      
      var $axis = d3.select(this.$refs.axis);
      var scale = this.scale;
      var axisGenerator = {
        top: d3.axisTop(scale.x).tickFormat(d3.timeFormat("%b %d")),
        right: d3.axisRight(scale.y),
        bottom: d3.axisBottom(scale.x).tickFormat(d3.timeFormat("%b %d")),
        left: d3.axisLeft(scale.y)
      }
      
      $axis.call(axisGenerator[this.axis]);
    },
    
    // Return necessary axis transformation for proper positioning
    getAxisTransform: function() {
      
      var axisOffset = {
        top: { x: 0, y: 0 },
        right: { x: this.layout.width, y: 0 },
        bottom: { x: 0, y: this.layout.height },
        left: { x: 0, y: 0 }
      };

      return 'translate('+axisOffset[this.axis].x+'px, '+axisOffset[this.axis].y+'px)';
    }
  },
   watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawAxis();
      }
    }
  }
});

// Component: Data series
Vue.component('d3__series_chw', {
  template: '#d3__series_chw',
  props: ['layout', 'series-data', 'scale']
});


// Component: D3 line
Vue.component('d3__line', {
  template: '#d3__line',
  props: ['layout', 'series-data', 'scale'],
  mounted: function() {
    this.drawLine();
  },
  methods: {
    drawLine: function() {

      // Get scale
      var scale = this.scale;

      // Line object
      var line = d3.line()
        .x(function(d) {
          return scale.x(d.timestamp);
        })
        .y(function(d) {
          return scale.y(d.value);
        });

      // DOM node for line
      var $line = d3.select(this.$refs.line);
      $line
        .data([this.seriesData.values.filter(function(d) {
          return typeof d.value !== typeof null;
        })])
        .attr('d', line);
    }
  },
  computed: {
    style: function() {
      return {
        fill: 'none',
        stroke: '#19638c',
        strokeWidth: 2
      }
    }
  },
  watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawLine();
      }
    }
  }
});




// Component: D3 point/scatter
Vue.component('d3__scatter', {
  template: '#d3__scatter',
  props: ['layout', 'series-data', 'scale'],
  watch: {
    scale: {
      deep: true,
      handler: function() {}  // Has to be included for nested components watch to fire properly
    }
  }
});

// D3 component: points


// Component: D3 area
Vue.component('d3__area', {
  template: '#d3__area',
  props: ['layout', 'series-data', 'scale'],
  mounted: function() {
    this.drawArea();
  },
  methods: {
    drawArea: function() {
      // Get scale
      var scale = this.scale;

      // Area object
      var area = d3.area()
        .x(function(d) {
          return scale.x(d.timestamp);
        })
        .y0(scale.y(0))
        .y1(function(d) {
          return scale.y(d.value);
        });

      // DOM node for area
      var $area = d3.select(this.$refs.area);

      $area
        .datum(this.seriesData.values.filter(function(d) {
          return typeof d.value !== typeof null;
        }))
        .attr('d', area);
    }
  },
  computed: {
    style: function() {
      return {
        fill: '#52aee0',
        fillOpacity: 1
      }
    }
  },
  watch: {
    // Changes to scale means we have to redraw the line!
    scale: {
      deep: true,
      handler: function(val, oldVal) {
        this.drawArea();
      }
    }
  }
});

// Initialize chart
var d3Vis = new Vue({
  el: '#chart_chw',
  data: {
    layout: {
      width: 800,
      height: 400,
      marginTop: 5,
      marginRight: 0,
      marginBottom: 50,
      marginLeft: 40,
    },
    chartData: c,
    axes: ['left', 'bottom']
  }
});
  });
</script>

    <script type="text/javascript">
      /* Formatting function for row details - modify as you need */
      function format(d) {
          
      }

      function tab(){
         
            var url = "{{ route('chw_metrics_json') }}";
         
          
          var table = $('#example').DataTable({  
               'ajax': {
               'url': url
            },
              "columns": [ 
                  { "data": "chw_name" },
                  { "data": "chw_phone" }, 
                  { "data": "province" },
                  { "data": "district" },
                  { "data": "health_facility" },
                  { "data": "zone" },
                  { "data": "total" },
              ],
              "order": [[1, 'asc']],
              "destroy" : true
          });
           
          // Add event listener for opening and closing details
          
      }
      $(document).ready(function() {  
          tab();  
      });

     
   
   </script> 
@endsection