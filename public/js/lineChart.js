const lineChart = document.getElementById('lineChart');
let time = [];
numbers = []
new Chart(lineChart, {
    type: 'line',
    data: {
      labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
      datasets: [{
        label: '# of Visitiors',
        data: [12, 19, 3, 5, 2, 3],
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
    }
});