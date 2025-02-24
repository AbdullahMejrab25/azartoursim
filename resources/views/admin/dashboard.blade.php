@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Main Content -->
            <main class="col-md-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>

                <div class="row">
                    <!-- Example Cards -->
                    <div class="col-md-4">
                        <div class="card bg-primary text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">{{ $totalUsers }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-success text-white mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Roles</h5>
                                <p class="card-text">{{ $totalRoles }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card bg-warning text-dark mb-3">
                            <div class="card-body">
                                <h5 class="card-title">Total Permissions</h5>
                                <p class="card-text">{{ $totalPermissions }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Graph Section -->
                <div class="row mt-4">
                    <!-- Login Count Chart -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">User Logins</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="loginChart"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Insurance Created Chart -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title">Insurance Created</h5>
                            </div>
                            <div class="card-body">
                                <canvas id="insuranceChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </main>
        </div>
    </div>

    <!-- Chart.js Script -->
    <script>
        
        // Login Count Chart
        // console.log("login count :",{{ $loginCount }});
        var loginCtx = document.getElementById('loginChart').getContext('2d');
        var loginChart = new Chart(loginCtx, {
            type: 'bar',
            data: {
                labels: ['Login Count'],
                datasets: [{
                    label: 'User Logins',
                    data: [{{ $loginCount }}],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Insurance Created Chart
        var insuranceCtx = document.getElementById('insuranceChart').getContext('2d');
        var insuranceChart = new Chart(insuranceCtx, {
            type: 'bar',
            data: {
                labels: ['Insurance Created'],
                datasets: [{
                    label: 'Insurances Created',
                    data: [{{ $insuranceCount }}],
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
@endsection
