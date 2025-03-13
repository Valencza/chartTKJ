@extends('dashboard.layouts.app')

@section('content')

<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <div class="d-flex flex-column flex-column-fluid">

        <div class="container mt-5">
            <div class="row">
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Pembelian</h5>
                                <!-- Menampilkan total pendapatan dalam format Rupiah -->
                                @if(isset($totalPendapatan) && $totalPendapatan > 0)
                                <h3 class="fw-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h3>
                                @else
                                <h3 class="fw-bold">Rp 0</h3>
                                @endif
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-md-6 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Servis Jasa</h5>
                                <h3 class="fw-bold">Rp 8.700.000</h3>
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
                <!-- Total Layanan Barang -->
                <div class="col-xl-4 col-md-12 mb-4">
                    <div class="card shadow-sm p-5 border-0 d-flex flex-column h-100">
                        <div class="d-flex align-items-center">
                            <div class="me-4 p-5" style="background-color:rgb(220, 239, 255)">
                                <i class="bi bi-cash-stack text-primary fs-1"></i>
                            </div>
                            <div>
                                <h5 class="fw-bold text-primary">Pendapatan Servis Barang</h5>
                                <h3 class="fw-bold">Rp 21.200.000</h3>
                                <p class="text-muted mb-0">Total pendapatan bulan ini</p>
                            </div>
                        </div>
                        <div class="mt-auto"></div>
                    </div>
                </div>
            </div>
            <div class="row mt-4 mb-5">
                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-cart3 text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Pembelian</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Pembelian</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterGrafik" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDate" class="form-control w-auto ms-lg-2 ms-md-2 ms-0 d-none">
                            </div>
                        </div>
                        <div class="chart-container" style="overflow-x: auto; width: 100%;">
                            <canvas id="chartTransaksi" style="min-width: 600px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-tools text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Layanan Servis</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Servis Barang</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterGrafikServis" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDateServis" class="form-control w-auto ms-lg-2 ms-md-2 ms-0 d-none">
                            </div>
                        </div>
                        <div class="chart-container">
                            <canvas id="chartServis"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-xl-12 mb-5 pb-4">
                    <div class="card shadow-sm p-5 border-0">
                        <div class="d-xl-flex d-md-flex justify-content-between mb-3">
                            <div class="d-flex align-items-center mb-5">
                                <div class="me-5 p-3" style="background-color:rgb(220, 239, 255)">
                                    <i class="bi bi-wrench text-primary fs-1"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <h4 class="fw-bold mb-0">Pendapatan Layanan Servis</h4>
                                    <p class="text-muted mb-0">Grafik Pendapatan Servis Jasa</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start filter-container mb-5">
                                <select id="filterGrafikJasa" class="form-select w-auto">
                                    <option value="year">1 Tahun</option>
                                    <option value="month">Bulan Ini</option>
                                    <option value="last_month">Bulan Lalu</option>
                                    <option value="week">Minggu Ini</option>
                                    <option value="custom">Custom Tanggal</option>
                                </select>
                                <input type="date" id="customDateJasa" class="form-control w-auto ms-lg-2 ms-md-2 ms-0  d-none">
                            </div>
                        </div>
                        <div class="chart-container" style="overflow-x: auto; width: 100%;">
                            <canvas id="chartJasa" style="min-width: 600px; max-height: 300px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- js grafik pembelian -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const ctx = document.getElementById("chartTransaksi").getContext("2d");
                let chartTransaksi;
                const filterGrafik = document.getElementById("filterGrafik");
                const customDate = document.getElementById("customDate");

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 500) return 7;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChart(labels, data) {
                    if (chartTransaksi) {
                        chartTransaksi.destroy();
                    }

                    chartTransaksi = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#74a0ff",
                                borderRadius: 5,
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 10,
                                    right: 10,
                                    top: 20,
                                    bottom: 10
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 45,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 20000000,
                                    ticks: {
                                        stepSize: 5000000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChart(filter) {
                    fetch(`/api/get-pendapatan-grafik?filter=${filter}`)
                        .then(response => response.json())
                        .then(data => {
                            generateChart(data.labels, data.data);
                        });
                }

                filterGrafik.addEventListener("change", function() {
                    const selectedFilter = this.value;

                    if (selectedFilter === "custom") {
                        customDate.classList.remove("d-none");
                    } else {
                        customDate.classList.add("d-none");
                        updateChart(selectedFilter);
                    }
                });

                customDate.addEventListener("change", function() {
                    if (this.value) {
                        const labels = [this.value];
                        const data = [Math.floor(Math.random() * 10000000) + 5000000];
                        generateChart(labels, data);
                    }
                });

                window.addEventListener("resize", function() {
                    generateChart(
                        chartTransaksi.data.labels,
                        chartTransaksi.data.datasets[0].data
                    );
                });

                updateChart("year");
            });
        </script>

        <!-- js grafik layanan servis barang -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const canvas = document.getElementById("chartServis");
                if (!canvas) {
                    console.error("Canvas tidak ditemukan!");
                    return;
                }

                const ctx = canvas.getContext("2d");
                let chartServis;

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChart(labels, data) {
                    if (chartServis) {
                        chartServis.destroy();
                    }

                    chartServis = new Chart(ctx, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#a0d0ff",
                                borderRadius: 5,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false, // Supaya grafik tidak gepeng
                            layout: {
                                padding: {
                                    left: 5,
                                    right: 5,
                                    top: 10,
                                    bottom: 5
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 30,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 20000000,
                                    ticks: {
                                        stepSize: 5000000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChart(filter) {
                    let labels, data;

                    if (filter === "week") {
                        labels = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];
                        data = [5000000, 4200000, 4500000, 4800000, 5000000, 5200000, 5300000];
                    } else if (filter === "month" || filter === "last_month") {
                        labels = Array.from({
                            length: 31
                        }, (_, i) => `tgl ${i + 1}`);
                        data = Array.from({
                            length: 31
                        }, () => Math.floor(Math.random() * 7000000) + 5000000);
                    } else if (filter === "year") {
                        labels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
                        data = [12000000, 10500000, 13500000, 14000000, 12500000, 15000000, 15500000, 16000000, 14500000, 13500000, 14000000, 17000000];
                    }

                    generateChart(labels, data);
                }

                document.getElementById("filterGrafikServis").addEventListener("change", function() {
                    const selectedFilter = this.value;
                    const customDateInput = document.getElementById("customDateServis");

                    if (selectedFilter === "custom") {
                        customDateInput.classList.remove("d-none");
                    } else {
                        customDateInput.classList.add("d-none");
                        updateChart(selectedFilter);
                    }
                });

                document.getElementById("customDateServis").addEventListener("change", function() {
                    if (this.value) {
                        const labels = [this.value];
                        const data = [Math.floor(Math.random() * 10000000) + 5000000];
                        generateChart(labels, data);
                    }
                });

                let resizeTimer;
                window.addEventListener("resize", function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        if (chartServis) {
                            generateChart(chartServis.data.labels, chartServis.data.datasets[0].data);
                        }
                    }, 300);
                });

                updateChart("year");
            });
        </script>

        <!-- js grafik layanan servis jasa -->
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const canvasJasa = document.getElementById("chartJasa");
                if (!canvasJasa) {
                    console.error("Canvas tidak ditemukan!");
                    return;
                }

                const ctxJasa = canvasJasa.getContext("2d");
                let chartJasa;

                function responsiveFontSize() {
                    if (window.innerWidth <= 480) return 6;
                    if (window.innerWidth <= 768) return 10;
                    return 12;
                }

                function generateChartJasa(labels, data) {
                    if (chartJasa) {
                        chartJasa.destroy();
                    }

                    chartJasa = new Chart(ctxJasa, {
                        type: "bar",
                        data: {
                            labels: labels,
                            datasets: [{
                                label: "Pendapatan (Rp)",
                                data: data,
                                backgroundColor: "#7cb0ff",
                                borderRadius: 5,
                                borderSkipped: false
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: {
                                padding: {
                                    left: 5,
                                    right: 5,
                                    top: 10,
                                    bottom: 5
                                }
                            },
                            scales: {
                                x: {
                                    ticks: {
                                        autoSkip: true,
                                        maxRotation: 30,
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                y: {
                                    beginAtZero: true,
                                    max: 20000000,
                                    ticks: {
                                        stepSize: 5000000,
                                        font: {
                                            size: responsiveFontSize()
                                        },
                                        callback: function(value) {
                                            return 'Rp ' + value.toLocaleString();
                                        }
                                    }
                                }
                            },
                            plugins: {
                                legend: {
                                    labels: {
                                        font: {
                                            size: responsiveFontSize()
                                        }
                                    }
                                },
                                tooltip: {
                                    bodyFont: {
                                        size: responsiveFontSize()
                                    },
                                    titleFont: {
                                        size: responsiveFontSize() + 2
                                    }
                                }
                            }
                        }
                    });
                }

                function updateChartJasa(filter) {
                    let labels, data;

                    if (filter === "week") {
                        labels = ["Sen", "Sel", "Rab", "Kam", "Jum", "Sab", "Min"];
                        data = [6000000, 5200000, 5500000, 5800000, 6000000, 6200000, 6300000];
                    } else if (filter === "month" || filter === "last_month") {
                        labels = Array.from({
                            length: 31
                        }, (_, i) => `tgl ${i + 1}`);
                        data = Array.from({
                            length: 31
                        }, () => Math.floor(Math.random() * 8000000) + 6000000);
                    } else if (filter === "year") {
                        labels = ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"];
                        data = [14000000, 12500000, 14500000, 15000000, 13500000, 16000000, 16500000, 17000000, 15500000, 14500000, 15000000, 18000000];
                    }

                    generateChartJasa(labels, data);
                }

                document.getElementById("filterGrafikJasa").addEventListener("change", function() {
                    const selectedFilter = this.value;
                    const customDateInput = document.getElementById("customDateJasa");

                    if (selectedFilter === "custom") {
                        customDateInput.classList.remove("d-none");
                    } else {
                        customDateInput.classList.add("d-none");
                        updateChartJasa(selectedFilter);
                    }
                });

                document.getElementById("customDateJasa").addEventListener("change", function() {
                    if (this.value) {
                        const labels = [this.value];
                        const data = [Math.floor(Math.random() * 12000000) + 7000000];
                        generateChartJasa(labels, data);
                    }
                });

                let resizeTimer;
                window.addEventListener("resize", function() {
                    clearTimeout(resizeTimer);
                    resizeTimer = setTimeout(() => {
                        if (chartJasa) {
                            generateChartJasa(chartJasa.data.labels, chartJasa.data.datasets[0].data);
                        }
                    }, 300);
                });

                updateChartJasa("year");
            });
        </script>

        @endsection