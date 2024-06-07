import React from "react";
import {useParams} from 'react-router-dom';
import Productslider from "./pageUtils/Slider";
import img from "../data/images";
import Productdetail from "./pageUtils/Productdetail";

function Product(props) {
    const params = useParams()

    var {name} = useParams();

    // var name = params.name;

    console.log(img)
    var product = img.filter((data)=>{
        // console.log(data.id);
        return name == data.id;
    });
    console.log('image',product);

    product = product[0];

  return (
    // <div>Product {name}</div>
    <>
        <div className="container border border-primary rounded-2 my-5">
            <div className="row py-3">
                <div className="col-lg-6">
                    {/* image slider */}
                    <Productslider productImg={product.images}/>
                    
                </div>
                <div className="col-lg-6">
                    <Productdetail productid={product.id} />
                </div>
            </div>
        </div>
    </>
  )
}

export default Product