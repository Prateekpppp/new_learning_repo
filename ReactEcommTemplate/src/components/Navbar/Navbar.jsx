import React, { useContext, useState } from 'react'
import './Navbar.css'
import { assets } from '../../assets/assets'
import { Link } from 'react-router-dom';
import { StoreContext } from '../../context/StoreContext';

const Navbar = ({setShowLogin}) => {

    const [menu,setMenu] = useState('home');

    const {getTotalCartAmount} = useContext(StoreContext);

  return (
    <>
        <div className="navbar d-flex justify-content-between align-items-center">
            <Link to='/'><img src={assets.logo} alt="" className="logo" /></Link>
            <ul className="navbar-menu">
                <Link to='/' onClick={()=> setMenu('home')} className={menu==='home'?'active':''}>Home</Link>
                <a href="#test" onClick={()=> setMenu('menu')} className={menu==='menu'?'active':''}>Menu</a>
                <a href="#test" onClick={()=> setMenu('mobile-app')} className={menu==='mobile-app'?'active':''}>mobile-app</a>
                <a href="#test" onClick={()=> setMenu('contact-us')} className={menu==='contact-us'?'active':''}>contact us</a>
            </ul>

            <div className="navbar-right d-flex align-items-center">
                <img src={assets.search_icon} alt="" />
                <div className="navbar-search-icon">
                    <Link to='cart'><img src={assets.basket_icon} alt="" /></Link>
                    <div className={getTotalCartAmount()===0?"":"dot"}></div>
                </div>
                <button onClick={()=>setShowLogin(true)}>Sign In</button>
            </div>
        </div>
    </>
    )
}

export default Navbar