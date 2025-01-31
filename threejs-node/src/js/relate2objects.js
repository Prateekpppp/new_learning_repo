import * as THREE from 'three';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import { MeshStandardMaterial } from 'three';
import stars from '../img/stars.jpg';
import sunTexture from '../img/sun.jpg';
import mercuryTexture from '../img/mercury.jpg';
import earthTexture from '../img/earth.jpg';
import neptuneTexture from '../img/neptune.jpg';
import saturnTexture from '../img/saturn.jpg';
import saturnringTexture from '../img/saturn ring.png';


var init = ()=>{
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    // const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const renderer = new THREE.WebGLRenderer();
    const orbit = new OrbitControls(camera,renderer.domElement);
    const textureLoader = new THREE.TextureLoader();
    const assetLoader = new GLTFLoader();
    
    // renderer.shadowMap.enabled = true;
    
    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );
    
    camera.position.set(0,140,140);
    orbit.update();

    const ambientLight = new THREE.AmbientLight(0x333333);
    scene.add(ambientLight);

    const cubeTextureLoader = new THREE.CubeTextureLoader();
    scene.background = cubeTextureLoader.load([
        stars,
        stars,
        stars,
        stars,
        stars,
        stars,
    ]);

    const sunGeo = new THREE.SphereGeometry(16,30,30);
    const sunMat = new THREE.MeshBasicMaterial({
        map:textureLoader.load(sunTexture)
    });
    const sun = new THREE.Mesh(sunGeo, sunMat);
    scene.add(sun);

    const createPlanet = (size,texture,position,ring)=>
    {
        const geo = new THREE.SphereGeometry(size,30,30);
        const mat = new THREE.MeshStandardMaterial({
            map:textureLoader.load(texture)
        });
        const mesh = new THREE.Mesh(geo, mat);
        const obj = new THREE.Object3D();
        obj.add(mesh);
        if(ring){
            const ringGeo = new THREE.RingGeometry(
                ring.innerRadius,
                ring.outerRadius,
                32
            );
            const ringMat = new THREE.MeshStandardMaterial({
                map:textureLoader.load(ring.texture),
                side:THREE.DoubleSide
            });
            const ringMesh = new THREE.Mesh(ringGeo, ringMat);
            obj.add(ringMesh);
            ringMesh.position.x = position;
            ringMesh.rotation.x = -0.5 * Math.PI;
        }
        scene.add(obj);
        mesh.position.x = position;
        return {mesh,obj}
    }

    const mercury = createPlanet(3.2,mercuryTexture,30);
    const saturn = createPlanet(10,saturnTexture,130,{
        innerRadius:10,
        outerRadius:20,
        texture: saturnringTexture
    });
    const earth = createPlanet(6,earthTexture,90);

    const pointLight = new THREE.PointLight(0xffffff,2,400);
    // pointLight.position.set(50,50,50);
    scene.add(pointLight);
    var animate = ()=>{
        // sun.rotateY(0.04);
        // self rotation
        sun.rotation.y += 0.004;
        mercury.mesh.rotation.y += 0.009;
        saturn.mesh.rotation.y += 0.009;
        earth.mesh.rotation.y += 0.009;

        // around an object rotation
        mercury.obj.rotation.y += 0.06;
        saturn.obj.rotation.y += 0.006;
        earth.obj.rotation.y += 0.009;
        renderer.render(scene,camera);
    }
    renderer.setAnimationLoop(animate);
    
    window.addEventListener('resize',()=>{
        camera.aspect = window.innerWidth/window.innerHeight;
        camera.updateProjectionMatrix();
        renderer.setSize(window.innerWidth/window.innerHeight);
    });
}

init();