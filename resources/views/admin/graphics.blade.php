@extends('layouts.painel')

@section('content')
    <div style="width: 80%; margin: auto;">
        <canvas id="barChart"></canvas>
    </div>

    <script>
        var aceitos = {{ $aceitos }};
        var pendentes = {{ $pendentes }};
        var solucionados = {{ $solucionados }};

        // Configurando os dados do gráfico
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Aceitos', 'Pendentes', 'Solucionados'],
                datasets: [{
                    label: 'Quantidade',
                    data: [aceitos, pendentes, solucionados],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
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
@endsection
