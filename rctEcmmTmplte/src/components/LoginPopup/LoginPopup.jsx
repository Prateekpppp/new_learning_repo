import React, { useState, useContext } from 'react'
import './LoginPopup.css'
import { assets } from '../../assets/assets';
import { handleError } from '../../utils';
import axios from 'axios';
import { StoreContext } from '../../context/StoreContext';
import { ToastContainer, toast } from "react-toastify";

const LoginPopup = ({setShowLogin}) => {

    const [currState,setCurrState] = useState('Sign Up');

    const [formInf,setFormInf] = useState({
      name:'',
      email:'',
      password:'',
    });

    const {apiBaseUrl} = useContext(StoreContext);


    // var url = 18
    // need to check this (...) operator

        // const inputChange = (e) => {
        //   const {name,value} = e.target;
        //   const copyFormValue = formInf;
        //   copyFormValue[name] = value;

        //   setFormInf(copyFormValue);
        //   console.log('formInf  ==== ',formInf);
        // }


    const inputChange = (e) => {
      const {name,value} = e.target;
      const copyFormValue = {...formInf};
      copyFormValue[name] = value;

      setFormInf(copyFormValue);
    }
    
    const handleFormSubmit = (e) => {
      e.preventDefault();

      const {name,email,password} = formInf;
      
      if(!email||!password){
        return handleError('All fields are required');
      }

      axios.post(apiBaseUrl+'/auth/login', formInf, {
          headers: {
            'Authorization':'Bearer ' + localStorage.getItem('login_token'),
          }
        })
        .then((res) => {
          // localStorage.setItem('userInf',JSON.stringify(formInf));
          console.log('res',res);
        })
        .catch((err) => {
          console.log('err---',err);
      });

    }

  return (
    <div className='login-popup'>
      <form onSubmit={handleFormSubmit} className="login-popup-container">
        <div className="login-popup-title">
            <h2>{currState}</h2>
            <img src={assets.cross_icon} onClick={()=>setShowLogin(false)} alt="" />
        </div>
        <div className="login-popup-inputs">
            {currState==="Login"?<></>:<input name='name' onChange={inputChange} type="text" placeholder='Your name' />}
            <input name='email' onChange={inputChange} type="email" placeholder='Your email' />
            <input name='password' onChange={inputChange} type="password" placeholder='Password' />
        </div>
        <button>{currState==="Sign Up"?"Create account":"Login"}</button>
        <div className="login-popup-condition">
            <input type="checkbox" name="" />
            <p>Agree with the policies</p>
        </div>
        {currState==="Login"
        ?<p>Create a new account? <span onClick={()=>setCurrState("Sign Up")}>Click here</span></p>
        :<p>Already have an account? <span onClick={()=>setCurrState("Login")}>Login here</span></p>
        }
      </form>
      {/* <ToastContainer /> */}
    </div>
  )
}

export default LoginPopup
