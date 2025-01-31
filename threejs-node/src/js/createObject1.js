import * as three from 'three';
import { Vector3 } from 'three';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';

var init = ()=>
{
    const width =window.innerWidth;
    const height =window.innerHeight;
    const scene = new three.Scene();
    const camera = new three.PerspectiveCamera(75,width/height,0.1,1000);
    const renderer = new three.WebGLRenderer();
    renderer.setSize(width,height);
    document.body.appendChild(renderer.domElement);

    // const planeGeometry = new three.PlaneGeometry(40,40);
    // const planeMaterial = new three.MeshStandardMaterial({
    //     color: 0xffffff,
    //     side:THREE.DoubleSide
    // });
    // const plane = new three.Mesh(planeGeometry,planeMaterial);
    // scene.add(plane);
    // plane.rotation.x = -0.5*Math.PI;
    
    camera.position.set(0,6,6);
    
    const orbit = new OrbitControls(camera,renderer.domElement);
    orbit.update();
    
    const ambientLight = new three.AmbientLight(0x333333);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,0.8);
    scene.add(directionalLight);
    directionalLight.position.set(0,50,0);

    const axesHelper = new three.AxesHelper(20);
    scene.add(axesHelper);

    const mouse = new three.Vector2();
    const intersectionPoint = new three.Vector3();
    const planeNormal = new three.Vector3();
    const plane = new three.Plane();
    const rayCaster = new three.Raycaster();

    window.addEventListener('mousemove',(e)=>{
        mouse.x = (e.clientX/width)*2-1;
        mouse.y = -(e.clientY/height)*2+1;
        planeNormal.copy(camera.position).normalize();
        plane.setFromNormalAndCoplanarPoint(planeNormal,scene.position);
        rayCaster.setFromCamera(mouse,camera);
        rayCaster.ray.intersectPlane(plane,intersectionPoint);
    });

    window.addEventListener('click',(e)=>{
        const sphereGeometry = new three.SphereGeometry(0.125,30,30);
        const sphereMaterial = new three.MeshStandardMaterial({
            color: 0xFFEA00,
            metalness:0,
            roughness:0
        });
        const sphere = new three.Mesh(sphereGeometry,sphereMaterial);
        scene.add(sphere);
        sphere.position.copy(intersectionPoint);
    });

    const animate = ()=>{
        renderer.render(scene,camera);
    }
    renderer.setAnimationLoop(animate);

    window.addEventListener('resize',()=>{
        camera.aspect = width/height;
        camera.updateProjectionMatrix();
        renderer.setSize(width,height);
    })

}
init();