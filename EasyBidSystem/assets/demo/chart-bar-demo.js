// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#292b2c';

// Fetch chart data from PHP
fetch('fetch_proposals_data.php')
    .then(response => response.json())
    .then(data => {
        // Parse the fetched data
        const proposalsData = data.proposals;

        // Process the proposals data for the bar chart
        const proposalLabels = proposalsData.map(d => d.quarter);
        const proposalValues = proposalsData.map(d => d.proposals);

        // Create the bar chart
        var ctx = document.getElementById("myBarChart").getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: proposalLabels,
                datasets: [{
                    label: "Proposals",
                    backgroundColor: "rgba(0,146,204,1)",
                    borderColor: "rgba(0,146,204,1)",
                    data: proposalValues,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'quarter'
                        },
                        gridLines: {
                            display: false
                        },
                        ticks: {
                            maxTicksLimit: 6
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            min: 0,
                            max: 15000,
                            maxTicksLimit: 5
                        },
                        gridLines: {
                            display: true
                        }
                    }],
                },
                legend: {
                    display: false
                }
            }
        });
    });
