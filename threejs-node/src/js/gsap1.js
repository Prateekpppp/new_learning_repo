import * as three from 'three';
import gsap from 'gsap';
import{GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import{RGBELoader} from 'three/examples/jsm/loaders/RGBELoader.js';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';
import {FirstPersonControls} from 'three/examples/jsm/controls/FirstPersonControls.js';

var init = ()=>
{
    const width =window.innerWidth;
    const height =window.innerHeight;
    const scene = new three.Scene();
    const camera = new three.PerspectiveCamera(75,width/height,0.1,1000);
    camera.position.set(-1.7,0,8.7);
    camera.lookAt(-1.7,0,8.7);
    const renderer = new three.WebGLRenderer();
    renderer.setSize(width,height);
    renderer.setClearColor(0xA3A3A3);
    renderer.outputEncoding = three.sRGBEncoding;
    renderer.toneMapping = three.ACESFilmicToneMapping;

    document.body.appendChild(renderer.domElement);

    // const orbit = new OrbitControls(camera,renderer.domElement);
    // orbit.update();

    // const controls = new FirstPersonControls(camera,renderer.domElement);
    // controls.movementSpeed = 8;
    // controls.lookSpeed = 0.08;

    const gltfLoader = new GLTFLoader();

    const fileUrl = new URL('../models/hall.glb',import.meta.url);
    // const gltfLoader = new GLTFLoader(loadingManager);
    const ambientLight = new three.AmbientLight(0xededed,0.8);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,1);
    scene.add(directionalLight);
    directionalLight.position.set(0,50,0);

    // const loadingManager = new three.LoadingManager();
    // const progressBar = document.getElementsByClassName('progressBar');
    // loadingManager.onProgress = (url,loaded,total)=>{
    //     progressBar.value = (loaded/total)*100;
    // };
    // loadingManager.onLoad = ()=>{
    //     document.getElementsByClassName('progress').style.display = 'none';
    // };
    let model1 ;
    gltfLoader.load(fileUrl.href,(gltf)=>{
        model1 = gltf.scene;
        // console.log(model1);
        var move = (zD) =>{
            // camera.getWorldDirection();
            gsap.to(camera.position,{
                // z:camera.position.z+zD,
                duration:1,
                onUpdate:()=>{
                    camera.translateZ(camera.position.z,zD);
                    console.log(camera.position.z);
                }
            });
        }
        var rotate = (yD) =>{
            gsap.to(camera.rotation,{
                y: camera.rotation.y+yD,
                duration:1,
            });
        }
        window.addEventListener('keydown',(e)=>{
            if(e.keyCode == 38)
            {
                move(-0.0001);
            }
            if(e.keyCode == 39)
            {
                rotate(-0.3);
            }
            if(e.keyCode == 40)
            {
                move(0.0001);
            }
            if(e.keyCode == 37)
            {
                rotate(0.3);
            }
        });
        scene.add(model1);
    });
    
    // const hdrImage = new URL('../img/sceneBack1.hdr',import.meta.url);
    // const rgbeLoader = new RGBELoader();

    // rgbeLoader.load(hdrImage,(hdr)=>{
    //     hdr.mapping = three.EquirectangularReflectionMapping
    //     scene.background = hdr;
    // });

    const clock = new three.Clock();
    const animate = (time)=>{
        renderer.render(scene,camera);
        // controls.update(clock.getDelta());
    }
    renderer.setAnimationLoop(animate);

    window.addEventListener('resize',()=>{
        camera.aspect = width/height;
        camera.updateProjectionMatrix();
        renderer.setSize(width,height);
    });
}
init();