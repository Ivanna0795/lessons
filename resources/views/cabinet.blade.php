@extends('app')

@section('title')
    Кабінет
@stop
@section('content')
    <h3>Вітаємо, {{Auth::user()->name}}, у вашому кабінеті</h3>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Виконані завдання</th>

            <th>У розділі</th>
        </tr>
        </thead>
        <tbody>
        {{--*/ $HtmlCopletedCount = 0 /*--}}
        {{--*/ $CssCopletedCount = 0 /*--}}
        @foreach ($completed as $c)
            <tr>
                <td>{{Str::limit($c->task_text, 200)}}
                    @if (Str::length($c->task_text)>200)
                        ...
                    @endif
                </td>

                <td>
                    @if($c->lessonType->HTML_CSS=='1')
                        <a href="{{ url('/html/') }}">HTML</a>
                        {{--*/ $HtmlCopletedCount++/*--}}
                    @elseif ($c->lessonType->HTML_CSS=='2')
                        <a href="{{ url('/css/') }}">CSS</a>
                        {{--*/ $CssCopletedCount++/*--}}
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-sm-6 charts" id="htmlChart"></div>
        <div class="col-sm-6 charts" id="CssChart"></div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            @foreach($html_lessons as $currlesson)
                <article class="lesson">
                    <a href="{{route('viewLesson',$currlesson)}}"><h4 class="title">{{$currlesson->Header }}</h4></a>
                    <p>{{ $currlesson->about_article }}</p>
                    <ul>
                        @foreach ($currlesson->tasks as $t)
                            <li><a href="{{route('viewTask',$t)}}"
                                   @if(in_array($t->id, $completed_tasks_ids)) style="color:green !important;" @endif>Завдання
                                    №{{$j}}</a></li>
                            <?php $j++;?>
                        @endforeach
                    </ul>
                </article>
                <?php $j = 1;?>
            @endforeach
        </div>
        <div class="col-sm-6">
            @foreach($css_lessons as $currlesson)
                <article class="lesson">
                    <a href="{{route('viewLesson',$currlesson)}}"><h4 class="title">{{$currlesson->Header }}</h4></a>
                    <p>{{ $currlesson->about_article }}</p>
                    <ul>
                        @foreach ($currlesson->tasks as $t)
                            <li><a href="{{route('viewTask',$t)}}"
                                   @if(in_array($t->id, $completed_tasks_ids)) style="color:green !important;" @endif>Завдання
                                    №{{$j}}</a></li>
                            <?php $j++;?>
                        @endforeach
                    </ul>
                </article>
                <?php $j = 1;?>
            @endforeach
        </div>
    </div>
@stop
@section('scripts')
    <script type="text/javascript">

        // Load the Visualization API and the corechart package.
        google.charts.load('current', {'packages': ['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create the data table.
            var data = new google.visualization.DataTable();
            var data2 = new google.visualization.DataTable();
            data.addColumn('string', 'Topping');
            data.addColumn('number', 'Slices');
            data2.addColumn('string', 'Topping');
            data2.addColumn('number', 'Slices');
            data.addRows([
                ['Виконано', {{$HtmlCopletedCount}}],
                ['Залишилося', {{Session::get('HTML_TASK_COUNT')}}-{{$HtmlCopletedCount}}],
            ]);
            data2.addRows([
                ['Виконано', {{$CssCopletedCount}}],
                ['Залишилося', {{Session::get('CSS_TASK_COUNT')}}-{{$CssCopletedCount}}],
            ]);

            // Set chart options
            var options = {
                'title': 'Прогрес HTML завдань',

                'height': 300
            };
            var options2 = {
                'title': 'Прогрес CSS завдань',

                'height': 300
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('htmlChart'));
            chart.draw(data, options);
            var chart2 = new google.visualization.PieChart(document.getElementById('CssChart'));
            chart2.draw(data2, options2);
        }
    </script>
@stop
