// import * as Math from './MathUtils.js';
const scene = new THREE.Scene();
const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
camera.position.set(0,100,100);
camera.lookAt(new THREE.Vector3(0,40,0));
// const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
const renderer = new THREE.WebGLRenderer();

// renderer.shadowMap.enabled = true;

renderer.setSize( window.innerWidth, window.innerHeight );
document.body.appendChild( renderer.domElement );

// element
const starsGeo = new THREE.Geometry();

// element position
d3.range(10000).map((d,i)=>{
    console.log(d);
    const star = new THREE.Vector3();
    star.x = THREE.Math.randFloatSpread(500);
    star.y = THREE.Math.randFloatSpread(500);
    star.z = Math.random() * 20;
    starsGeo.vertices.push(star);
});

const starsMat = new THREE.PointsMaterial({color: 0xff0000});
const starField = new THREE.Points(starsGeo,starsMat);
starField.material.color.setHex(0xffffff);
scene.add(starField);

count = 0;
var animate = ()=>{
    count += 0.015;
    requestAnimationFrame(animate);
    renderer.render(scene,camera);
    starsGeo.vertices.map(
        (d,i)=> (starsGeo.vertices[i].z = Math.cos(count) * (i * 0.05))
        );
        starsGeo.verticesNeedUpdate = true;
}
animate();

window.addEventListener('resize',()=>{
    camera.aspect = window.innerWidth/window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth/window.innerHeight);
});
