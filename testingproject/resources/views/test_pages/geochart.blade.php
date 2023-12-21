<html>
  <head>
  <style>
  #kt_charts_states{
   width: 95vw;
   height:92vh;
}

#stat {
  position: fixed;
  top: .5rem;
  right: 1rem;
}
#stat div{
  width: 100px
}
  </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

  </head>
  <body>
  <div id="kt_charts_states"></div>
<div id="stat"></div>
  </body>
    <script type="text/javascript">
      let info = [
  ['State', 'Sales', 'Order Count'],
  ['Alabama', 1939.95, 6],
  ['Arizona', 5256.83, 9],
  ['Arkansas', 7917.89, 14],
  ['California', 20587.1, 32],
  ['Colorado', 7494.87, 8],
];

let gradient = ['#e6f4ff', '#008ffb', '#ff4560'];
let range = {
  start: 80,
  end: 25460.26
};

google.charts.load('current', {
  'packages': ['geochart'],
});
google.charts.setOnLoadCallback(drawRegionsMap);

function drawRegionsMap() {
  var data = google.visualization.arrayToDataTable(info);
  var formatter = new google.visualization.NumberFormat({
    pattern: '$###,###.##'
  });
  formatter.format(data, 1);
  var options = {
    region: 'US',
    displayMode: 'regions',
    resolution: 'provinces',
    colorAxis: {
      colors: gradient
    },
    geochartVersion: 11,
    legend: {
      numberFormat: '$###,###.##'
    },
  };

  var chart = new google.visualization.GeoChart(document.getElementById('kt_charts_states'));
  chart.draw(data, options);
};

// display colors for each state
let stat = document.getElementById('stat');
let content = ''
info.forEach((state, i) => {
  if (i === 0) return;
  content += `<div style='background-color: ${getStateColor(gradient, range, state[1])}'>${state[0]}</div>`;
});
stat.innerHTML = content;

// interpolate colors
function getStateColor(gradient, range, value) {
  let colors = gradient.map(c => hexToRgb(c));
  let sectionLength = (range.end - range.start) / (gradient.length - 1);
  let section = (value / sectionLength) | 0;
  if (section + 1 == gradient.length) section -= 1;

  value = value - sectionLength * section - range.start;
  let result = ['r', 'g', 'b'].map(c => {
    // interpolate color from start color to end color
    let out = (1 - (value / sectionLength)) * colors[section][c];
    out += (value / sectionLength) * colors[section + 1][c];
    return Math.ceil(out);
  });
  return rgbToHex(...result);
}

// utility functions
function hexToRgb(hex) {
  var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
  hex = hex.replace(shorthandRegex, function(m, r, g, b) {
    return r + r + g + g + b + b;
  });

  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    r: parseInt(result[1], 16),
    g: parseInt(result[2], 16),
    b: parseInt(result[3], 16)
  } : null;
}

function rgbToHex(r, g, b) {
  return "#" + ((1 << 24) + ((r | 0) << 16) + ((g | 0) << 8) + (b | 0)).toString(16).slice(1);
}
    </script>
</html>
