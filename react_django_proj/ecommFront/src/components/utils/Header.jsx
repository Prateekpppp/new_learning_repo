import React, { useState, useEffect } from 'react'
import Header1 from './Header1'
import NavbarComm from './NavbarComm'

function Header(props) {
  
  // if(props.enableNav == true){
  //   return(
  //     <>
  //     {/* <Header1 /> */}
  //       <NavbarComm />
  //     </>
  //   )
  // }
  return (
    <>
      {/* <Header1 /> */}
      <NavbarComm />
        {/* heading */}
    </>
  )
}

export default Header