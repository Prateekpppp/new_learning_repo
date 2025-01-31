import * as three from 'three';
import { Vector3 } from 'three';
import * as cannon from 'cannon-es';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';

var init = ()=>
{
    const width =window.innerWidth;
    const height =window.innerHeight;
    const scene = new three.Scene();
    const camera = new three.PerspectiveCamera(75,width/height,0.1,1000);
    const renderer = new three.WebGLRenderer({
        antialias:true
    });
    renderer.setSize(width,height);
    renderer.shadowMap.enabled = true;
    document.body.appendChild(renderer.domElement);

    const planeGeometry = new three.PlaneGeometry(10,10);
    const planeMaterial = new three.MeshStandardMaterial({
        color: 0xffffff,
        side:three.DoubleSide
    });
    const plane = new three.Mesh(planeGeometry,planeMaterial);
    scene.add(plane);
    plane.rotation.x = -0.5*Math.PI;
    plane.receiveShadow = true;
    
    camera.position.set(0,4,10);
    
    const world = new cannon.World({
        gravity: new cannon.Vec3(0,-9.81,0)
    });

    const groundPhyMat = new cannon.Material();
    const ground = new cannon.Body({
        shape: new cannon.Box(new cannon.Vec3(5,5,0.001)),
        type:cannon.Body.STATIC,
        material:groundPhyMat
    });
    world.addBody(ground);
    ground.quaternion.setFromEuler(-Math.PI/2,0,0);
    
    // const spherePhy = new cannon.Body({
    //     shape:
    // })
    const orbit = new OrbitControls(camera,renderer.domElement);
    orbit.update();
    
    const ambientLight = new three.AmbientLight(0x333333);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,0.8);
    scene.add(directionalLight);
    directionalLight.position.set(0,50,0);
    directionalLight.castShadow = true;
    directionalLight.shadow.mapSize.width = 1024;
    directionalLight.shadow.mapSize.height = 1024;
    const directionalLightHelper = new three.DirectionalLightHelper(directionalLight,5);
    scene.add(directionalLightHelper);

    // const axesHelper = new three.AxesHelper(20);
    // scene.add(axesHelper);

    // const planeGeo = new three.PlaneGeometry()
    const mouse = new three.Vector2();
    const intersectionPoint = new three.Vector3();
    const planeNormal = new three.Vector3();
    const plane1 = new three.Plane();
    const rayCaster = new three.Raycaster();

    window.addEventListener('mousemove',(e)=>{
        mouse.x = (e.clientX/width)*2-1;
        mouse.y = -(e.clientY/height)*2+1;
        planeNormal.copy(camera.position).normalize();
        plane1.setFromNormalAndCoplanarPoint(planeNormal,scene.position);
        rayCaster.setFromCamera(mouse,camera);
        rayCaster.ray.intersectPlane(plane1,intersectionPoint);
    });

    const balls = [];
    const ballsPhy = [];
    window.addEventListener('click',(e)=>{
        const sphereGeometry = new three.SphereGeometry(0.125,30,30);
        const sphereMaterial = new three.MeshStandardMaterial({
            color: Math.random()*0xffffff,
            metalness:0,
            roughness:0
        });
        const sphere = new three.Mesh(sphereGeometry,sphereMaterial);
        scene.add(sphere);
        sphere.castShadow = true;
        // spherePhy.position = new cannon.Vec3(intersectionPoint.x,intersectionPoint.y,intersectionPoint.Z);

        const spherePhyMat = new cannon.Material();        
        const spherePhy = new cannon.Body({
            mass:0.3,
            shape: new cannon.Sphere((0.125)),
            position: new cannon.Vec3(intersectionPoint.x,intersectionPoint.y,intersectionPoint.z),
            material:spherePhyMat
        });
        world.addBody(spherePhy);
        spherePhy.linearDamping = 0.31;  
        const groundBallContactMat = new cannon.ContactMaterial(
            groundPhyMat,
            spherePhyMat,
            {restitution:0.3}
        );
        world.addContactMaterial(groundBallContactMat);

        balls.push(sphere);
        ballsPhy.push(spherePhy);
        // sphere.position.copy(intersectionPoint);
    });

    // const spherePhy = new cannon.Body({
    //     mass:0.3,
    //     shape: new cannon.Sphere((0.125)),
    //     position: '',
    // });
    // world.addBody(spherePhy);

    const animate = ()=>{
        world.step(1/60);
        plane.position.copy(ground.position);
        plane.quaternion.copy(ground.quaternion);
        for(let i=0;i<balls.length;i++)
        {
            balls[i].position.copy(ballsPhy[i].position);
            balls[i].quaternion.copy(ballsPhy[i].quaternion);   
        }
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