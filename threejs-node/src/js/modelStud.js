import * as three from 'three';
import { Vector3 } from 'three';
import * as cannon from 'cannon-es';
import * as dat from 'dat.gui';
import{GLTFLoader} from 'three/examples/jsm/loaders/GLTFLoader.js';
import { FBXLoader } from 'three/examples/jsm/loaders/FBXLoader.js';
import {OrbitControls} from 'three/examples/jsm/controls/OrbitControls.js';

var init = ()=>
{
    const width =window.innerWidth;
    const height =window.innerHeight;
    const scene = new three.Scene();
    const camera = new three.PerspectiveCamera(75,width/height,0.1,1000);
    camera.position.set(50,70,50);
    const renderer = new three.WebGLRenderer();
    renderer.setSize(width,height);
    document.body.appendChild(renderer.domElement);

    renderer.setClearColor(0xA3A3A3);

    const orbit = new OrbitControls(camera,renderer.domElement);
    orbit.update();

    const gltfLoader = new GLTFLoader();
    const fbxLoader = new FBXLoader();

    const fileUrl = new URL('../models/Donkey.gltf',import.meta.url);

    const ambientLight = new three.AmbientLight(0xededed,0.8);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,1);
    scene.add(directionalLight);
    directionalLight.position.set(10,11,7);
    
    const gui = new dat.GUI();
    
    const options= {
        'matColor': 0x7c7c7c,
    };
    
    const plane = new three.Mesh(
        new three.PlaneGeometry(20,20),
        new three.MeshBasicMaterial({
            side: three.DoubleSide,
            visible:false
        })
    );
    plane.rotation.x = -0.5*Math.PI;
    scene.add(plane);
    plane.name = 'ground';

    const grid = new three.GridHelper(20,20);
    scene.add(grid);
    
    let mixer;
    let clips;
    gltfLoader.load(fileUrl.href,(gltf)=>{
        const model = gltf.scene;
        scene.add(model);
        // console.log(model);
        mixer = new three.AnimationMixer(model);
        clips = gltf.animations;
        clips.forEach((clip)=>{
            var action = mixer.clipAction(clip);
            action.play();
        });
        gui.addColor(options,'matColor').onChange((e)=>{
            model.getObjectByName("Cube").material.color.setHex(e);
        });
    });


    window.addEventListener('keydown',(e)=>{
        if(e.keyCode == 38)
        {
            camera.position.z +=1;
        }
        if(e.keyCode == 40)
        {
            camera.position.z -=1;
        }
    })
    var clock = new three.Clock();
    const animate = (time)=>{
        if(mixer){
            mixer.update(clock.getDelta());
        }
        // mixer.setTime(time);
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