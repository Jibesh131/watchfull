@extends('admin.layout.app')

@push('css')
@endpush

@section('content')
<div class="card-header">
    <div class="card-title">Welcome to Admin Dashboard</div>
</div>
<div class="card-body">
    
    <div class="row">
        <div class="col-md-4">
        <div class="card card-secondary bg-secondary-gradient">
            <div class="card-body bubble-shadow">
            <h1>188</h1>
            <h5 class="op-8">New Users</h5>
            <div class="pull-right">
                <h3 class="fw-bold op-8">25%</h3>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card card-secondary bg-secondary-gradient">
            <div class="card-body bubble-shadow">
            <h1>188</h1>
            <h5 class="op-8">Total Sales</h5>
            <div class="pull-right">
                <h3 class="fw-bold op-8">25%</h3>
            </div>
            </div>
        </div>
        </div>
        <div class="col-md-4">
        <div class="card card-secondary bg-secondary-gradient">
            <div class="card-body bubble-shadow">
            <h1>188</h1>
            <h5 class="op-8">Total Sales</h5>
            <div class="pull-right">
                <h3 class="fw-bold op-8">25%</h3>
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="lineChart" style="display: block; width: 462px; height: 300px;" width="462" height="300" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Bar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="barChart" style="display: block; width: 462px; height: 300px;" width="462" height="300" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Doughnut Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="doughnutChart" style="width: 462px; height: 300px; display: block;" width="462" height="300" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Multiple Line Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                        <canvas id="multipleLineChart" style="display: block; width: 462px; height: 300px;" width="462" height="300" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="card-title">Multiple Bar Chart</div>
                </div>
                <div class="card-body">
                    <div class="chart-container">
                        <div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;">
                                <div style="position:absolute;width:200%;height:200%;left:0; top:0"></div>
                            </div>
                        </div>
                        <canvas id="multipleBarChart" style="display: block; width: 462px; height: 300px;" width="462" height="300" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
  // Line Chart
  const lineCtx = document.getElementById('lineChart').getContext('2d');
  new Chart(lineCtx, {
    type: 'line',
    data: {
      labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
      datasets: [{
        label: 'Sales',
        data: [12, 19, 3, 5, 2, 3],
        borderColor: 'blue',
        backgroundColor: 'lightblue',
        fill: false,
        tension: 0.1
      }]
    }
  });

  // Bar Chart
  const barCtx = document.getElementById('barChart').getContext('2d');
  new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: 'Votes',
        data: [12, 19, 3, 5, 2, 3],
        backgroundColor: [
          'red', 'blue', 'yellow', 'green', 'purple', 'orange'
        ]
      }]
    }
  });

  // Doughnut Chart
  const doughnutCtx = document.getElementById('doughnutChart').getContext('2d');
  new Chart(doughnutCtx, {
    type: 'doughnut',
    data: {
      labels: ['Chrome', 'Firefox', 'Edge'],
      datasets: [{
        label: 'Browser Usage',
        data: [55, 25, 20],
        backgroundColor: ['#f44336', '#2196f3', '#4caf50']
      }]
    }
  });

  // Multiple Line Chart
  const multiLineCtx = document.getElementById('multipleLineChart').getContext('2d');
  new Chart(multiLineCtx, {
    type: 'line',
    data: {
      labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
      datasets: [
        {
          label: 'Email',
          data: [12, 19, 3, 17, 6, 3],
          borderColor: 'red',
          fill: false,
          tension: 0.1
        },
        {
          label: 'Ads',
          data: [2, 29, 5, 5, 2, 3],
          borderColor: 'blue',
          fill: false,
          tension: 0.1
        }
      ]
    }
  });

  // Multiple Bar Chart
  const multiBarCtx = document.getElementById('multipleBarChart').getContext('2d');
  new Chart(multiBarCtx, {
    type: 'bar',
    data: {
      labels: ['2017', '2018', '2019', '2020'],
      datasets: [
        {
          label: 'Sales',
          data: [100, 200, 150, 300],
          backgroundColor: 'rgba(255, 99, 132, 0.7)'
        },
        {
          label: 'Expenses',
          data: [90, 180, 140, 250],
          backgroundColor: 'rgba(54, 162, 235, 0.7)'
        }
      ]
    }
  });
</script>
@endpush