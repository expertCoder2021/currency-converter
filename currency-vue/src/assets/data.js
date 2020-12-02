export let basicData = {
    chart: {
      type: "spline"
    },
    title: {
      text: "Monthly currency rates"
    },
    subtitle: {
      text: ""
    },
    xAxis: {
      categories: [
      ]
    },
    yAxis: {
      title: {
        text: "Values"
      },
      labels: {
        formatter: function() {
          return this.value;
        }
      }
    },
    tooltip: {
      crosshairs: true,
      shared: true
    },
    credits: {
      enabled: false
    },
    plotOptions: {
      spline: {
        marker: {
          radius: 4,
          lineColor: "#666666",
          lineWidth: 1
        }
      }
    },
    series: []
  };
  
  export let asyncData = {
    name: "Rate",
    marker: {
      symbol: "square"
    },
    data: [
    ]
  };