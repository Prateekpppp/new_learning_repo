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
    camera.position.set(10,15,-22);
    const renderer = new three.WebGLRenderer();
    renderer.setSize(width,height);
    renderer.shadowMap.enabled = true;
    document.body.appendChild(renderer.domElement);

    const orbit = new OrbitControls(camera,renderer.domElement);
    orbit.update();

    const ambientLight = new three.AmbientLight(0x333333);
    scene.add(ambientLight);
    const directionalLight = new three.DirectionalLight(0xffffff,0.8);
    scene.add(directionalLight);
    directionalLight.position.set(0,50,0);
    
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

    const Hplane = new three.Mesh(
        new three.PlaneGeometry(1,1),
        new three.MeshBasicMaterial({
            side: three.DoubleSide,
            transparent:true
            // visible:false
        })
    );
    Hplane.rotation.x = -0.5*Math.PI;
    Hplane.position.set(0.5,0,0.5);
    scene.add(Hplane);

    const mouse = new three.Vector2();
    const rayCaster = new three.Raycaster();
    let intersect='';
        let spheres = [];
    var action=(e)=>{
        mouse.x = (e.clientX/width)*2-1;
        mouse.y = -(e.clientY/height)*2+1;
        var pointOfContact = '';
        rayCaster.setFromCamera(mouse,camera);
        intersect = rayCaster.intersectObjects(scene.children);
        intersect.forEach((intersect)=>{
            if(intersect.object.name == 'ground')
            {
                var heighlight = new three.Vector3().copy(intersect.point).floor().addScalar(0.5);
                Hplane.position.set(heighlight.x,0,heighlight.z);
                pointOfContact = heighlight;
            }
        });
        return pointOfContact;
    }

    window.addEventListener('mousemove',(e)=>action(e));
    window.addEventListener('click',(e)=>{
        var pointOfContact = action(e);
        if(pointOfContact)
        {
            console.log(pointOfContact);
            // console.log(intersect.object.name);
            const sphereGeometry = new three.SphereGeometry(0.25,25,25);
            const sphereMaterial = new three.MeshStandardMaterial({
                color: 0xFF0000,
                // wireframe:true
            });
            const sphere = new three.Mesh(sphereGeometry,sphereMaterial);
            scene.add(sphere);
            sphere.position.set(pointOfContact.x,pointOfContact.y,pointOfContact.z);
            spheres.push(sphere);
        }

    });
    const animate = (time)=>{
        Hplane.material.opacity = 1 + Math.sin(time/120);
        spheres.forEach((sphere)=>{
            sphere.rotation.x = time/2000;
            sphere.position.y = 0.5+0.5*Math.abs(Math.sin(time/1000));
            sphere.rotation.z = time/2000;
        })
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