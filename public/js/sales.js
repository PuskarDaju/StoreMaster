$(document).ready(function() {
    $.ajax({
        url: '/revenueByCategory', // The URL to the route
        type: 'GET', // The HTTP method
        success: function (response) {
            const categories = Object.keys(response);
            const revenues = Object.values(response);

            const ctx = document.getElementById('revenuePieChart').getContext('2d');
            const revenueChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: categories,
                    datasets: [{
                        label: 'Revenue by Category',
                        data: revenues,
                        backgroundColor: [
                            '#007bff',
                            '#28a745',
                            '#ffc107',
                            '#dc3545',
                            '#6f42c1',
                            '#17a2b8'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        },
                        title: {
                            display: true,
                            text: 'Total Revenue by Category'
                        }
                    }
                }
            });
        },
        error: function (error) {
            console.error('Error loading chart data:', error);
        }
    });

    //

      $.ajax({
        url: '/topSoldItemsByRevenue', // The URL to the route
        type: 'GET', // The HTTP method
      
        success: function(response) {
            const labels = response.map(item => item.product_name);
            const data = response.map(item => item.units_sold);
    
            const ctx = document.getElementById('topSoldItemsBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Units Sold',
                        data: data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        borderRadius: 10
                    }]
                },
                options: {
                    // indexAxis: 'y', // this makes it horizontal
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Units Sold'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        },
        error: function(err) {
            console.error('Error fetching data:', err);
        }
        });

     
 

    //sending ajax for topSoldItems based on units
    $.ajax({
        url: '/topSoldItemsByUnit', // The URL to the route
        type: 'GET', // The HTTP method
      
        success: function(response) {
            const labels = response.map(item => item.product_name);
            const data = response.map(item => item.units_sold);
    
            const ctx = document.getElementById('topSoldItemsBarChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Units Sold',
                        data: data,
                        backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                        borderRadius: 10
                    }]
                },
                options: {
                    // indexAxis: 'y', // this makes it horizontal
                    responsive: true,
                    scales: {
                        x: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Units Sold'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            enabled: true
                        }
                    }
                }
            });
        },
        error: function(err) {
            console.error('Error fetching data:', err);
        }
        });

        $.ajax({
            url: '/total-sales-per-month', // The URL to the route
            type: 'GET', // The HTTP method
            success: function(response) {
                // Parse the response to get month and total sales data
                const months = response.map(item => getMonthName(item.month)); // Getting month names from numbers
                const totalSales = response.map(item => item.total_sales);
    
                // Display data in a histogram (bar chart)
                const ctx = document.getElementById('monthlySalesHistogram').getContext('2d');
                new Chart(ctx, {
                    type: 'bar', // Bar chart
                    data: {
                        labels: months, // Months as labels
                        datasets: [{
                            label: 'Total Sales Per Month',
                            data: totalSales, // Total sales per month
                            backgroundColor: '#36b9cc', // Color of the bars
                            borderRadius: 5,
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true, // Start Y-axis from zero
                                title: {
                                    display: true,
                                    text: 'Total Sales ($)'
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                display: false // Hide legend since we have only one dataset
                            },
                            tooltip: {
                                enabled: true
                            }
                        }
                    }
                });
            },
            error: function(error) {
                console.log('Error fetching data:', error);
            }
        });
    
        // Function to convert month number to month name
        function getMonthName(monthNumber) {
            const monthNames = [
                'January', 'February', 'March', 'April', 'May', 'June',
                'July', 'August', 'September', 'October', 'November', 'December'
            ];
            return monthNames[monthNumber - 1]; // Convert month number to month name
        }
}); 

