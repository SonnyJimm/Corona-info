function drawChart(label,data){
  let chart = document.getElementById('CountryRate').getContext('2d');
  let CountryRate = new Chart(chart , {
    type:"bar",
    data:{
      labels:chart,
      datasets:[{
        data:[
          data
        ]
      }]
    },
    options:{}
  });
}
