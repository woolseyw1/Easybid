// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Fetch chart data from PHP
fetch('fetch_revenue_data.php')
    .then(response => response.json())
    .then(data => {
        // Parse the fetched data
        const revenueData = data.revenue;

        // Process the revenue data for the area chart
        const revenueLabels = revenueData.map(d => d.date);
        const revenueValues = revenueData.map(d => d.revenue);

        // Create the area chart
        var ctx = document.getElementById("myAreaChart").getContext('2d');
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: revenueLabels,
                datasets: [{
                    label: "Revenue",
                    lineTension: 0.3,
                    backgroundColor: "rgba(0,123,204,0.2)",
                    borderColor: "rgba(0,146,204,1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(0,146,204,1)",
                    pointBorderColor: "rgba(255,255,255,0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(0,146,204,1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: revenueValues,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 40000,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            color: "rgba(0, 0, 0, .125)",
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    });
