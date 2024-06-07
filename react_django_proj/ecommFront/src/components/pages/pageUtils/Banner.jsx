import React from 'react'

function Banner() {
  return (
    <>
        <div className="bg-primary text-white py-5">
            <div className="container py-5">
            <h1>
                Best products &amp; <br />
                brands in our store
            </h1>
            <p>
                Trendy Products, Factory Prices, Excellent Service
            </p>
            <button type="button" className="btn btn-outline-light">
                Learn more
            </button>
            <button type="button" className="btn btn-light shadow-0 text-primary pt-2 border border-white">
                <span className="pt-1">Purchase now</span>
            </button>
            </div>
        </div>
    </>
  )
}

export default Banner