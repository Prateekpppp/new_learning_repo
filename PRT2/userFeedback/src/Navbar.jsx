import React, { useContext, useState } from 'react'
import { Link } from 'react-router-dom';

const Navbar = ({setShowLogin}) => {

    const [menu,setMenu] = useState('home');

  return (
    <>
        <div>
            <ul>
                <Link to='/' onClick={()=> setMenu('home')} className={menu==='home'?'active':''}>Home</Link>
                <Link to='/feedback' onClick={()=> setMenu('feedback')} className={menu==='feedback'?'active':''}>Feedback</Link>
            </ul>

        </div>
    </>
    )
}

export default Navbar