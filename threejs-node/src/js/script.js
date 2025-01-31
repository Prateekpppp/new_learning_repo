import * as THREE from 'three';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import * as dat from 'dat.gui';
import { MeshStandardMaterial } from 'three';
var init = ()=>{
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    // const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const renderer = new THREE.WebGLRenderer();
    
    renderer.shadowMap.enabled = true;

    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    const orbit = new OrbitControls(camera,renderer.domElement);

    const axesHelper = new THREE.AxesHelper(3);
    axesHelper.position.set(0,0,0);
    scene.add(axesHelper);
    
    camera.position.set(0,10,-30);
    orbit.update();
    const boxGeometry = new THREE.BoxGeometry();
    const boxMaterial = new THREE.MeshStandardMaterial({color: 0x00FF00});
    const box = new THREE.Mesh(boxGeometry,boxMaterial);
    box.position.set(0,0,0);
    scene.add(box); 

    const planeGeometry = new THREE.PlaneGeometry(30,30);
    const planeMaterial = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        side:THREE.DoubleSide
    });
    const plane = new THREE.Mesh(planeGeometry,planeMaterial);
    // plane.position.set(0,-10,0);
    scene.add(plane);
    plane.rotation.x = -0.5*Math.PI;
    plane.receiveShadow = true;
    // plane.rotation.y = 1;

    const sphereGeometry = new THREE.SphereGeometry(4,50,50);
    const sphereMaterial = new MeshStandardMaterial({
        color: 0x0000ff,
        // side:THREE.DoubleSide
    });
    const sphere = new THREE.Mesh(sphereGeometry,sphereMaterial);
    scene.add(sphere);
    sphere.position.set(-10,10,0);
    sphere.castShadow = true;

    const ambientLight = new THREE.AmbientLight(0x0087ff);
    scene.add(ambientLight);
    const directionalLight = new THREE.DirectionalLight(0xffffff,.8);
    scene.add(directionalLight);
    directionalLight.position.set(-30,30,0);
    directionalLight.castShadow = true;
    directionalLight.shadow.camera.bottom = -10;

    const directionalLightHelper = new THREE.DirectionalLightHelper(directionalLight,5);
    scene.add(directionalLightHelper);

    const directionalLightShadowHelper = new THREE.CameraHelper(directionalLight.shadow.camera);
    scene.add(directionalLightShadowHelper);
    const gui = new dat.GUI();
    
    const options= {
        sphereColor: '#ffea00',
        wireframe: false,
        speed: 0.01
    }

    gui.addColor(options,'sphereColor').onChange((e)=>{
        sphere.material.color.set(e);
    });
    gui.add(options,'wireframe').onChange((e)=>{
        sphere.material.wireframe=e;
    });
    gui.add(options,'speed',0,0.1);

    let step = 0;

    var animate = ()=>{
        box.rotation.x += 0.01;
        box.rotation.y += 0.01;
        // plane.rotation.x += 0.01;
        // plane.rotation.z += 0.01;
        step += options.speed;
        sphere.position.y = 10 * Math.abs(Math.sin(step));
        renderer.render(scene,camera);
    }
    renderer.setAnimationLoop(animate);
}

init();