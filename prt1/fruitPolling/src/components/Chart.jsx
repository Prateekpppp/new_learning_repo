import React from 'react'


function Chart({data}) {
    
  return (
    <>
        <ul className="chart">
            <li>
                <span style={{height:data.apple+'%'}} title="Apple"></span>
            </li>
            <li>
                <span style={{height:data.banana+'%'}} title="Banana"></span>
            </li>
            <li>
                <span style={{height:data.mango+'%'}} title="Mango"></span>
            </li>
        </ul>
    </>
  )
}

export default Chart