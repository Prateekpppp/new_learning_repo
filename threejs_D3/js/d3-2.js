const width = window.innerWidth;
const height = window.innerHeight;

const svg = d3.select('body').append('svg').attr('width',width).attr('height',height);

// const projection = d3.geoAlbersUsa().scale(830)
// .translate([width/2,height/2]);
// var path = d3.geoPath(projection);
// path = path(projection);
// var title = 
const g = svg.append('g');

d3.json('https://cdn.jsdelivr.net/npm/us-atlas@3/states-albers-10m.json',(error,data) => {
    var states = topojson.feature(data, data.objects.states);
    var projection = d3.geoIdentity()
        .fitSize([width, height], states);

    var path = d3.geoPath(projection);
    // console.log(data);
    // const states = topojson.feature(data, data.objects.states);
    // const states = topojson.feature(data, data.objects.states, (a, b) => a !== b);

    g.selectAll('.state')
    .data(states.features)
    .enter()
    .append('path')
    .attr('class','state')
    .attr('d',path)
    .attr('fill','#e3e3e3')
    .attr('stroke',(d)=>{
        // console.log(path.centroid(d)[0])
        // if(d.properties.name == 'India'){
        //     return 'orange';
        // } else{
            return '#000';
        // }
    })
    .attr('title',(d,i)=> states.features[i].properties.name);
    
    g.selectAll('circle')
    .data(states.features)
    .enter()
    .append('circle')
    .attr('r',2)
    .attr('cx',(d)=>path.centroid(d)[0])
    .attr('cy',(d)=>path.centroid(d)[1]);

    g.selectAll('text')
    .data(states.features)
    .enter()
    .append('text')
    .attr('fill','#000')
    .style("text-anchor", "middle")
    .attr('x',(d)=>path.centroid(d)[0])
    .attr('y',(d)=>path.centroid(d)[1])
    .text((d)=> d.properties.name);
    
});
