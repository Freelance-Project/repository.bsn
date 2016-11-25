@extends('frontend.layouts.layout')

@section('content')
<!-- middle -->
<div id="middle-content">
	<div class="container">
    	<div class="main-search-result">
        	<div class="row row-header">
            	<div class="col-md-4 left no-left-padding">
                	<ul class="nav nav-pills custom-pills">

                    	<li role="presentation" class="active"><a href="{{url('search/'.$data['class'].'/person')}}">Nama Peneliti</a></li>
                        
                    </ul>
                </div>
            	<div class="col-md-3 right">
                	<div id="imaginary_container"> 
                        <div class="input-group stylish-input-group">
                            <input type="text" class="form-control"  placeholder="Search" >
                            <span class="input-group-addon">
                                <button type="submit">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>  
                            </span>
                        </div><!--end.search--input-->
                	</div><!--end.imaginary_container-->
            	</div><!--end.col-3-->
            </div><!--end.row-->
            
            <!--<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>-->
            
            <div class="row search-list">
                 <hgroup class="mb20">
                    <h1>&nbsp;</h1>
                    <h2 class="lead"><strong class="text-danger">{{$data['result']->total()}}</strong> Data ditemukan <!--for the search for <strong class="text-danger">Lorem</strong>--></h2>								
                </hgroup>
                <section class="col-xs-12 col-sm-6 col-md-12">
                    
                    @if ($data['result']->total() > 0)
                    @foreach($data['result'] as $val)
                    <article class="search-result row">
                        <div class="col-xs-12 col-sm-12 col-md-2">
                            <ul class="meta-search">
                                <li><i class="glyphicon glyphicon-tags"></i> <span>{!! $val->address !!}</span></li>
                                <li><i class="glyphicon glyphicon-tags"></i> <span><strong>{!! $val->phone !!}</strong></span></li>
                                <li><i class="glyphicon glyphicon-tags"></i> <span>{!! $val->education !!}</span></li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-7 excerpet">
                            <h3><a href="{{url('personel/detail/'.$val->id)}}" title="">{{$val->name}}</a></h3>
                            <p>{!! substr($val->experience, 0, 300) !!}</p>
                        </div>
                        <span class="clearfix borda"></span>
                    </article>
                    @endforeach
                    @endif
                    			
            
                </section>
            </div><!--end.row-->
            
            <div class="row text-center">
            	<div class="col-md-12">
                    <nav aria-label="Page navigation">
                      {!! with(new \App\Helper\Src\Pagination($data['result']))->render() !!}
                    </nav>
                </div>
            </div><!--end.row-->
        </div>
    </div><!--end.container-->
</div>
<!-- end of middle -->

<script src="{{ asset(null) }}frontend/libs/highchart/highcharts.js"></script>
<script src="{{ asset(null) }}frontend/libs/highchart/modules/exporting.js"></script>

<script type="text/javascript">
    
    var data_chart = {!! $data['chart'] !!};
    
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'column'
            },
            title: {
                text: 'Statistik Pertahun'
            },
            xAxis: {
                categories: data_chart.category
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Total Data'
                },
                stackLabels: {
                    enabled: true,
                    style: {
                        fontWeight: 'bold',
                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
                    }
                }
            },
            legend: {
                align: 'right',
                x: -70,
                verticalAlign: 'top',
                y: 20,
                floating: true,
                backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColorSolid) || 'white',
                borderColor: '#CCC',
                borderWidth: 1,
                shadow: false
            },
            tooltip: {
                formatter: function() {
                    return '<b>'+ this.x +'</b><br/>'+
                        this.series.name +': '+ this.y +'<br/>'+
                        'Total: '+ this.point.stackTotal;
                }
            },
            plotOptions: {
                column: {
                    stacking: 'normal',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [{
                name: 'Penelitian',
                data: data_chart.penelitian
            }, {
                name: 'Publikasi',
                data: data_chart.publikasi
            }, {
                name: 'Data Pendukung',
                data: data_chart.pendukung
            }]
        });
    });

</script>

@endsection 