
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart" width="400" height="200"></canvas>
<script>
const ctx = document.getElementById('myChart').getContext('2d');
var temp = {!! json_encode($temps->toArray()) !!};
var date = {!! json_encode($date->toArray()) !!};
const t = [];
const d = [];

for (let i = 0; i < temp.length; i++) {
    t.push(temp[i].temp);
    d.push(date[i].created_at);
}
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: d,
        datasets: [{
            label: 'Tempreture',
            data: t,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>
<a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>
<div>
  <canvas id="myChart"></canvas>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>