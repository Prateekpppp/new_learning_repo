import React from 'react'

function FoodItems({fooditems}) { //destructuring

  return (
    <>
        <h1>Food Items</h1>
        {fooditems.length == 0 ? <h3>I am hungry</h3> : <h3>I am not hungry</h3>}
        <ul className="list-group">
            {fooditems.map((i)=>(
                i == 'f2' ? null : <li key={i} className="list-group-item">{i}</li>
            ))}
            {/* {fooditems.map((i)=><li key={i} className="list-group-item">{i}</li>)} */}
        </ul>
    </>
  )
}

export default FoodItems