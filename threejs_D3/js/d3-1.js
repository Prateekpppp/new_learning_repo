const width = window.innerWidth;
const height = window.innerHeight;

const svg = d3.select('body').append('svg').attr('width',width).attr('height',height);

const projection = d3.geoMercator().scale(180)
.translate([width/2,height/1.4]);
var path = d3.geoPath(projection);
// path = path(projection);
// var title = 
const g = svg.append('g');

d3.json('https://cdn.jsdelivr.net/npm/world-atlas@2.0.2/countries-110m.json')
.then(data => {
    // console.log(data);
    const countries = topojson.feature(data, data.objects.countries);
    // console.log(countries.features[0].geometry.coordinates[0][0][0][1]);
    // console.log(countries);

    g.selectAll('path')
    .data(countries.features)
    .enter()
    .append('path')
    .attr('class','country')
    .attr('d',path)
    .attr('fill','#ddd')
    .attr('stroke',(d)=>{
        // console.log(path.centroid(d)[0])
        if(d.properties.name == 'India'){
            return 'orange';
        } else{
            return '#000';
        }
    })
    .attr('title',(d,i)=> countries.features[i].properties.name);
    
    g.selectAll('circle')
    .data(countries.features)
    .enter()
    .append('circle')
    .attr('r',2)
    .attr('cx',(d)=>path.centroid(d)[0])
    .attr('cy',(d)=>path.centroid(d)[1]);

    g.selectAll('text')
    .data(countries.features)
    .enter()
    .append('text')
    .attr('fill','#000')
    .style("text-anchor", "middle")
    .attr('x',(d)=>path.centroid(d)[0])
    .attr('y',(d)=>path.centroid(d)[1])
    .text((d)=> d.properties.name);
    
});
