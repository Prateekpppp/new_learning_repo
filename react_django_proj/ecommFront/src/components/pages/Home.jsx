import React from 'react'
import Banner from './pageUtils/Banner'
import Productcard from './pageUtils/Productcard'

function Home() {
  return (
    <>
        <Banner />
        <div className="container my-5">
          <div className="row">
            <Productcard />
          </div>
        </div>
    </>
    )
}

export default Home