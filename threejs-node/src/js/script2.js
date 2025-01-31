import * as THREE from 'three';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import * as dat from 'dat.gui';
import { MeshStandardMaterial } from 'three';
import {GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import img1 from '../img/img1.jpg';
import img2 from '../img/img2.jpg';
import img3 from '../img/img3.jpg';
import img4 from '../img/img4.jpg';

var init = ()=>{
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera( 75, window.innerWidth / window.innerHeight, 0.1, 1000 );
    // const camera = new THREE.PerspectiveCamera( 45, window.innerWidth / window.innerHeight, 0.1, 1000 );
    const renderer = new THREE.WebGLRenderer();
    const textureLoader = new THREE.TextureLoader();
    const assetLoader = new GLTFLoader();
    
    renderer.shadowMap.enabled = true;

    renderer.setSize( window.innerWidth, window.innerHeight );
    document.body.appendChild( renderer.domElement );

    const orbit = new OrbitControls(camera,renderer.domElement);

    const ambientLight = new THREE.AmbientLight(0x00ffff);
    scene.add(ambientLight);

    const spotLight = new THREE.SpotLight(0xffffff);
    scene.add(spotLight);

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
        // color: 0x0000ff,
        map:textureLoader.load(img2)
    });
    
    const sphere = new THREE.Mesh(sphereGeometry,sphereMaterial);
    scene.add(sphere);
    sphere.position.set(-10,10,0);
    sphere.castShadow = true;
    const sphereId = sphere.id;
    
    const sphere2Geometry = new THREE.SphereGeometry(4,50,50);
    const sphere2Material = new MeshStandardMaterial({
        map:textureLoader.load(img3)
    });
    const sphere2 = new THREE.Mesh(sphere2Geometry,sphere2Material);
    scene.add(sphere2);
    sphere2.position.set(10,10,0);
    sphere2.castShadow = true;

    const spotLightHelper = new THREE.SpotLightHelper(spotLight);
    scene.add(spotLightHelper);
    spotLight.position.set(-30,30,0);
    spotLight.castShadow = true;
    
    scene.background = textureLoader.load(img4);

    // selecting an object
    const mousePosition = new THREE.Vector2();

    // console.log(mousePosition);
    window.addEventListener('mousemove',(e)=>{
        mousePosition.x = (e.clientX/window.innerWidth) * 2 - 1;
        mousePosition.y = (e.clientY/window.innerHeight) * 2 - 1;
    })

    const rayCaster = new THREE.Raycaster();


    const gui = new dat.GUI();
    
    const options= {
        sphereColor: '#ffea00',
        wireframe: false,
        speed: 0.01,
        intensity: 0.5,
        penumbra:0,
        angle:0.2
    };

    gui.addColor(options,'sphereColor').onChange((e)=>{
        sphere.material.color.set(e);
    });
    gui.add(options,'wireframe').onChange((e)=>{
        sphere.material.wireframe=e;
    });
    gui.add(options,'speed',0,0.1);
    gui.add(options,'intensity',0,1);
    gui.add(options,'penumbra',0,1);
    gui.add(options,'angle',0,1);

    let step = 0;

    plane.name = 'plane';
    box.name = 'box';
    sphere.name = 'sphere';

    //importing models
    const model1url = new URL('../models/cone.glb',import.meta.url);
    assetLoader.load(model1url.href,(gltf)=>{
        const model = gltf.scene;
        scene.add(model);
        model.position.set(-12,4,10);
    },undefined,(error)=>{
        console.log(error);
    });
    
    // const model2url = new URL('../models/scene.gltf',import.meta.url);
    // assetLoader.load(model2url.href,(gltf)=>{
    //     const model = gltf.scene;
    //     scene.add(model);
    //     model.position.set(-12,4,10);
    // },undefined,(error)=>{
    //     console.log(error);
    // });



    var animate = ()=>{
        box.rotation.x += 0.01;
        box.rotation.y += 0.01;
        // plane.rotation.x += 0.01;
        // plane.rotation.z += 0.01;
        step += options.speed;
        sphere.position.y = 10 * Math.abs(Math.sin(step));

        spotLight.intensity = options.intensity;
        spotLight.penumbra = options.penumbra;
        spotLight.angle = options.angle;
        spotLightHelper.update();

        rayCaster.setFromCamera(mousePosition,camera);
        const intersects = rayCaster.intersectObjects(scene.children);
        // console.log(intersects);

        for(let i=0; i< intersects.length; i++)
        {
            // if(intersects[i].object.material.color =='0xff0000')
            // {
            //     intersects[i].object.material.color.set(0x0000ff);
            // } else
            // {
            //     intersects[i].object.material.color.set(0xff0000);
            // }
            if(intersects[i].object.id === sphere.id)
            {
                sphere2.rotation.x += 0.01;
                sphere2.rotation.y += 0.01;
            }
        }
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