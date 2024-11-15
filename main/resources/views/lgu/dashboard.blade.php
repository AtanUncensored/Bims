@extends('lgu.lgu-template.navigation-bar')

@section('icon')
    <i class="fas fa-house fa-lg text-black mr-1"></i>
@endsection

@section('content')
<div id="title" class="py-2 px-4">
    <h1 class="text-2xl font-bold text-green-600">AVAILABLE BARANGAYS:</h1>
</div>

<div class="my-4">
    <hr class="border-t-2 m-[15px] border-gray-300">
</div>
<div class="container mx-auto px-4">
    <div class="max-h-[40vh] lg:max-h-[28vh] overflow-y-auto">
        <div class="flex flex-wrap">
            @foreach($barangays as $barangay)
                <div class="w-full md:w-1/4 px-4 mb-4">
                    <div class="bg-white shadow-lg rounded-lg p-4">
                        <div class="flex items-center mb-4">
                            @php
                                $iconColors = [
                                    'text-blue-500', 'text-green-500', 'text-red-500', 
                                    'text-yellow-500', 'text-purple-500', 'text-pink-500', 
                                    'text-indigo-500', 'text-teal-500', 'text-orange-500', 
                                    'text-cyan-500', 'text-amber-500', 'text-lime-500'
                                ];
                                $iconColor = $iconColors[$loop->index % count($iconColors)];
                            @endphp

                            <i class="fas fa-map-marker-alt {{ $iconColor }} text-3xl mr-3"></i>
                            <h2 class="text-[15px] font-bold text-gray-600">Brgy. <span class="text-blue-600">{{ $barangay->barangay_name }}</span>, Tubigon, Bohol, Philippines</h2>
                        </div>
                        <hr class="border-t-2 border-blue-300">
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <div class="my-4">
        <canvas id="barangayChart" class="w-full h-auto max-h-[230px]"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('barangayChart').getContext('2d');
        let barangayChart;

        // Data and options for the chart
        const data = {
            labels: [
                'Total Residents', 
                'Total Males', 
                'Total Females', 
                'Total Adults', 
                'Total Seniors', 
                'Total Youth', 
                'Total Children', 
                'Total Households', 
                'Married Residents'
            ],
            datasets: [{
                label: 'Population Statistics',
                data: [
                    {{ $totalUsers }},
                    {{ $totalMales }},
                    {{ $totalFemales }},
                    {{ $totalAdults }},
                    {{ $totalSeniors }},
                    {{ $totalYouth }},
                    {{ $totalChildren }},
                    {{ $householdCount }},
                    {{ $marriedCount }}
                ],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                ],
                borderWidth: 1
            }]
        };

        // Function to determine chart type based on screen width
        function getChartType() {
            return window.innerWidth <= 768 ? 'pie' : 'bar'; // Switch to pie chart on screens <= 768px
        }

        // Function to create the chart with responsive type
        function createChart() {
            if (barangayChart) {
                barangayChart.destroy(); // Destroy previous chart instance if exists
            }
            barangayChart = new Chart(ctx, {
                type: getChartType(),
                data: data,
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            display: getChartType() === 'bar' // Hide Y-axis on pie chart
                        }
                    },
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    }
                }
            });
        }

        // Initial chart render
        createChart();

        // Re-render the chart on window resize to adjust type
        window.addEventListener('resize', function() {
            createChart();
        });
    });
</script>
@endsection
