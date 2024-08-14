import React from 'react'
import EnvFile from '../../envFolder/EnvFile';
import { Link, BrowserRouter as Router } from 'react-router-dom';
import img from "../../data/images.jsx";
import Imagecard from './Imagecard';

function Productcard() {

    var productImageDir = EnvFile.base_url + 'products/';
    var images = img;
    //     {
    //         id :'1',name :'plant1.jpg',
    //     },
    //     {
    //         id :'2',name :'plant1.jpg',
    //     },
    //     {
    //         id :'3',name :'plant1.jpg',
    //     },
    //     {
    //         id :'4',name :'plant1.jpg',
    //     }
    // ]
  return (
    <>
    {
        images.map(
            function(data){
                return (
                    <div key={data.id} className="col-lg-4 col-md-6 text-center">
                        <Link to={"product/"+data.id}>
                            <div className="single-product-item p-4">
                                <div className="product-image mini-img-card">
                                    <Imagecard imageSrc={data.name} />
                                {/* <div className="img w-100 img-card" style={{"backgroundImage":"url('/products/" + data.name+"')"}} /> */}
                            
                                    {/* <Link to={"product/"+data.id}><div className="img w-100" style={{"backgroundImage":"url('/products/" + data.name+"')"}} /></Link> */}
                                </div>
                                <h3>Berry</h3>
                                <p className="product-price"><span>Per Kg</span> 70$ </p>
                                <Link to={"product/"+data.id} className="cart-btn"><i className="fas fa-shopping-cart"></i> Add to Cart</Link>
                            </div>
                        </Link>
                        </div>

                )
            }
        )
    }
    </>
  )
}

export default Productcard