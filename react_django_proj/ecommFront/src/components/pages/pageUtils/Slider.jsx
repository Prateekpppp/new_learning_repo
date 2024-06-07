import React from 'react'
import {Link} from 'react-router-dom';
import Imagecard from './Imagecard';
// import img from '../../data/images';

function Productslider(props) {
    console.log('props',props);
  return (
    <>
        <div id="carouselExampleControls" className="carousel slide" data-ride="carousel">
            <div className="carousel-inner">
                {
                    (props.productImg).map((img,i)=>{
                        return(
                            <>
                                <div key={i} className={"vh65 carousel-item" + (i==0 ? " active" : "")}>
                                    <Imagecard imageSrc={img} imagebox={true} />
                                    {/* <img className="d-block w-100 card-img" src={"/products/" + img} alt={i+" slide"} /> */}
                                </div>
                            </>
                        );
                    })
                }
            </div>
            {/* <div className="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span className="carousel-control-prev-icon" aria-hidden="true"></span>
                <span className="sr-only">Previous</span>
            </div>
            <div className="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span className="carousel-control-next-icon" aria-hidden="true"></span>
                <span className="sr-only">Next</span>
            </div> */}
        </div>

        <div className="d-flex justify-content-center my-3">
            {

                (props.productImg).map((img,i)=>{
                    return(
                        <>
                            <div key={i} className="border mx-1 rounded-2">
                                <img width="60" height="60" className="rounded-2" src={"/products/"+img} />
                            </div>
                        </>
                    )
                })
            }
        </div>
    </>
  )
}

export default Productslider