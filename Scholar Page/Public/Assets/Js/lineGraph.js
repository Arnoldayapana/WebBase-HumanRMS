var ctx = document.getElementById('userActivityChart').getContext('2d');
    var gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(0, 60, 60, 0.5)');
    gradient.addColorStop(1, 'rgba(0, 60, 60, 0.1)');

    var userActivityChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Active Users',
                data: [12, 19, 3, 5, 2, 3, 18, 12, 22, 9, 15, 25],
                backgroundColor: gradient,
                borderColor: '#003c3c',
                borderWidth: 3,
                pointBackgroundColor: '#003c3c',
                pointRadius: 4,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Month',
                        color: '#003c3c',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    ticks: {
                        color: '#003c3c'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Active Users',
                        color: '#003c3c',
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    },
                    beginAtZero: true,
                    ticks: {
                        color: '#003c3c'
                    },
                    grid: {
                        color: 'rgba(0, 60, 60, 0.1)'
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#003c3c',
                        font: {
                            weight: 'bold'
                        }
                    }
                },
                tooltip: {
                    backgroundColor: '#003c3c',
                    titleColor: '#ffffff',
                    bodyColor: '#ffffff',
                    titleFont: {
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 12
                    }
                }
            }
        }
    });