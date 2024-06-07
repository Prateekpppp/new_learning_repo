import React from 'react'

function Imagecard(props) {
    if(props.imagebox){
        return (
            <img className="w-100 card-img" src={"/products/" + props.imageSrc} />
        )
    }
    return (
        <div className="img w-100 img-card" style={{"backgroundImage":"url('/products/" + props.imageSrc+"')"}} />
    )
}

export default Imagecard