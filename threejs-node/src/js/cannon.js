import * as THREE from 'three';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import * as dat from 'dat.gui';
import { MeshStandardMaterial } from 'three';
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import img1 from '../img/img1.jpg';
import img2 from '../img/img2.jpg';
import img3 from '../img/img3.jpg';
import img4 from '../img/img4.jpg';

import * as CANNON from 'cannon-es';

var init = ()=>{
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    // const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const renderer = new THREE.WebGLRenderer();
    const textureLoader = new THREE.TextureLoader();
    const assetLoader = new GLTFLoader();

    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );
    
    const physics = new CANNON.World({
        gravity: new CANNON.Vec3(0,-9.81,0)
    });
    
    const groundPhyMat = new CANNON.Material();
    const ground = new CANNON.Body({
        // shape: new CANNON.Plane(),
        shape: new CANNON.Box(new CANNON.Vec3(15,15,0.1)),
        // mass:10
        type:CANNON.Body.STATIC,
        material:groundPhyMat
    });
    physics.addBody(ground);
    ground.quaternion.setFromEuler(-Math.PI/2,0,0);

    const ballPhyMat = new CANNON.Material();
    const ball = new CANNON.Body({
        shape: new CANNON.Sphere(2),
        mass:10,
        position:new CANNON.Vec3(0,15,0),
        material:ballPhyMat
        // type:CANNON.Body.STATIC
    });
    physics.addBody(ball);
    ball.linearDamping = 0.31;  
    const groundBallContactMat = new CANNON.ContactMaterial(
        groundPhyMat,
        ballPhyMat,
        {restitution:0.8}
    );
    physics.addContactMaterial(groundBallContactMat);

    const squarePhyMat = new CANNON.Material();
    const square = new CANNON.Body({
        shape: new CANNON.Box(new CANNON.Vec3(1,1,1)),
        mass:1,
        position:new CANNON.Vec3(10,20,0),
        material:squarePhyMat
        // type:CANNON.Body.STATIC
    });
    physics.addBody(square);
    square.angularDamping = 0.5;

    const groundSquareContactMat = new CANNON.ContactMaterial(
        groundPhyMat,
        squarePhyMat,
        {friction:0.04}
    );

    physics.addContactMaterial(groundSquareContactMat);
    
    const timeStep = 1/60;

    const orbit = new OrbitControls(camera,renderer.domElement);

    const ambientLight = new THREE.AmbientLight(0x00ffff);
    scene.add(ambientLight);

    camera.position.set(0,10,-30);
    orbit.update();
    const boxGeometry = new THREE.BoxGeometry(2,2,2);
    const boxMaterial = new THREE.MeshStandardMaterial({
        color: 0x00FF00,
        wireframe:true
    });
    const box = new THREE.Mesh(boxGeometry,boxMaterial);
    // box.position.set(0,0,0);
    scene.add(box); 

    const planeGeometry = new THREE.PlaneGeometry(30,30);
    const planeMaterial = new THREE.MeshStandardMaterial({
        color: 0xffffff,
        side:THREE.DoubleSide,
        // wireframe:true
    });
    const plane = new THREE.Mesh(planeGeometry,planeMaterial);
    // plane.position.set(0,-10,0);
    scene.add(plane);
    plane.rotation.x = -0.5*Math.PI;
    plane.receiveShadow = true;
    // plane.rotation.y = 1;

    const sphereGeometry = new THREE.SphereGeometry(4,50,50);
    const sphereMaterial = new MeshStandardMaterial({
        // color: 0x0000ff,
        map:textureLoader.load(img2),
        wireframe:true
    });
    
    const sphere = new THREE.Mesh(sphereGeometry,sphereMaterial);
    scene.add(sphere);
    sphere.position.set(-10,10,0);
    sphere.castShadow = true;
    const sphereId = sphere.id;
    
    const sphere2Geometry = new THREE.SphereGeometry(2,50,50);
    const sphere2Material = new MeshStandardMaterial({
        map:textureLoader.load(img3),
        wireframe:true
    });
    const sphere2 = new THREE.Mesh(sphere2Geometry,sphere2Material);
    scene.add(sphere2);
    // sphere2.position.set(10,10,0);
    sphere2.castShadow = true;

    var animate = ()=>{
        box.rotation.x += 0.01;
        box.rotation.y += 0.01;
        
        physics.step(timeStep);
        plane.position.copy(ground.position);
        plane.quaternion.copy(ground.quaternion);
        sphere2.position.copy(ball.position);
        sphere2.quaternion.copy(ball.quaternion);
        box.position.copy(square.position);
        box.quaternion.copy(square.quaternion);
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