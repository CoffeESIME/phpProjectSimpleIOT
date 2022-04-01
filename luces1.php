<html>
  <head>
    <style>
    body {
      margin: 0;
      background: #ffffff;
    }
    </style>
  </head>
  <body>
    <script src="https://d3js.org/d3.v4.min.js"></script>
    <script>
    var svg = d3.select("body").append("svg"),
      defs = svg.append("defs"),
      on = 0,
      defs = {},
      gradient = {},
      circles = {},
      lights = [
        {
          color: "green",
          on: {
            inner: "#fff",
            outer: "#00FF00"
          },
          off: {
            inner: "#001900",
            outer: "#000"
          }
        },
        {
          color: "yellow",
          on: {
            inner: "#fff",
            outer: "#FFFF00"
          },
          off: {
            inner: "#333300",
            outer: "#000"
          }
        },

      ];

    lights.forEach(function(d, i){

      defs[d.color] = svg.append("defs");

      gradient[d.color] = defs[d.color].append("radialGradient")
          .attr("id", d.color + "-gradient");

      gradient[d.color].append("stop")
          .attr("class", "stop-inner")
          .attr("offset", "10%")
          .attr("stop-color", i == on ? d.on.inner : d.off.inner);

      gradient[d.color].append("stop")
          .attr("class", "stop-outer")
          .attr("offset", "95%")
          .attr("stop-color", i == on ? d.on.outer : d.off.outer);

      circles[d.color] = svg.append("circle")
          .attr("class", "circle-" + d.color)
          .style("fill", "url(#" + d.color + "-gradient)");

    });

    function change(on){

      lights.forEach(function(d, i){

        gradient[d.color].select(".stop-inner")
            .attr("stop-color", i == on ? d.on.inner : d.off.inner);

        gradient[d.color].select(".stop-outer")
            .attr("stop-color", i == on ? d.on.outer : d.off.outer);

        d3.select(".circle-" + d.color)
            .style("fill", "url(#" + d.color + "-gradient)");
      });

    }

    d3.interval(function(){
      on = 3;
      change(on);
    }, 1000);

    function draw(){
      var width = 300,
        height = 300,
        radius = height / 6.666666666667;

      svg
          .attr("width", width)
          .attr("height", height);

      lights.forEach(function(d){

        circles[d.color]
            .attr("cx", width / 2)
            .attr("r", radius);

      });

      circles.green
          .attr("cy", height / 1.2);

    }

    window.onload = draw, window.onresize = draw;

    </script>
  </body>
</html>