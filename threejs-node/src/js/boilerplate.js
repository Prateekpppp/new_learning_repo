import * as three from 'three';
import { Vector3 } from 'three';
import * as cannon from 'cannon-es';
import{GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';

var init = ()=>
{
    const width =window.innerWidth;
    const height =window.innerHeight;
    const scene = new three.Scene();
    const camera = new three.PerspectiveCamera(75,width/height,0.1,1000);
    camera.position.set(10,15,-22);
    const renderer = new three.WebGLRenderer();
    renderer.setSize(width,height);
    document.body.appendChild(renderer.domElement);

    const orbit = new OrbitControls(camera,renderer.domElement);
    orbit.update();

    const ambientLight = new three.AmbientLight(0xededed,0.8);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,1);
    scene.add(directionalLight);
    directionalLight.position.set(0,50,0);
    
    const animate = (time)=>{
        renderer.render(scene,camera);
    }
    renderer.setAnimationLoop(animate);

    window.addEventListener('resize',()=>{
        camera.aspect = width/height;
        camera.updateProjectionMatrix();
        renderer.setSize(width,height);
    });
}
init();