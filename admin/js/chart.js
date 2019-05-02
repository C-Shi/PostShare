function loadPostStatus(posts_status) {
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  var obj = {};
  posts_status.forEach(function(el) {
    obj[el.status] = el.count;
  })

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['', ...Object.keys(obj)],
      ['Posts', ...Object.values(obj)],
    ]);

    var options = {
      chart: {
        title: 'Content Management Overview',
        subtitle: '',
        sliceVisibilityThreshold:0,
      },
      bars: 'vertical' // Required for Material Bar Charts.
    };

    var chart = new google.charts.Bar(document.getElementById('post_status_chart'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
}

function loadPostCategory(posts_category) {
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  posts_category = posts_category.map(function(el) {
    return [el.title, Number(el.count)];
  })
  console.log(posts_category[0]);
  console.log(['Bootstrap', 1])
  function drawChart() {

    var data = google.visualization.arrayToDataTable([
      ['Category', 'Number of posts'],
      ...posts_category,
    ]);

    var options = {
      title: 'Post Categories Distribution',
      sliceVisibilityThreshold: 0
    };

    var chart = new google.visualization.PieChart(document.getElementById('post_category_chart'));

    chart.draw(data, options);
  }
}