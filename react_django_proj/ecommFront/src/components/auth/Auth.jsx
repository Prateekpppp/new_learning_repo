import React,{useEffect, useState} from 'react';
import { useNavigate  } from 'react-router-dom';
import { toast } from "react-toastify";
import axios from "axios";
import EnvFile from '../envFolder/EnvFile';

function Auth() {


  const navigate = useNavigate();

  useEffect(()=>{
    if(localStorage.getItem('userInf') == '123') navigate('todolist');
  })  

  const [name,setName]=useState('');
  const [password,setPassword]=useState('');

  
    const url = EnvFile.base_url+'api/test';

    const data = {
      'name': name,
      'password': password
    }

  function sign_in_up() {

    var data1 = axios
      .post(url, data, {
        headers: {
          // 'X-CSRFToken': grabToken(),
          'Content-Type': 'application/json',
          'Access-Control-Allow-Origin' : '*',
        }
      },  
      {
        withCredentials: true
      })
      .then(({data}) => {
        localStorage.setItem('userInf',JSON.stringify(data));
        navigate('todolist');
      })
      .catch(err => {
        toast.error(JSON.stringify(err));
      })
      ;

  }
  return (
    <>
      <div className="container">
        <div className="row align-items-center text-center">
          <div className="auth_form my-5 pt-5">

            <div className="w-100 form-group my-2">
              <input type="text" onChange={(e)=>setName(e.target.value)} placeholder='Enter username'/>
            </div>
            <div className="w-100 form-group my-2">
              <input type="text" onChange={(e)=>setPassword(e.target.value)} placeholder='Enter password'/>
            </div>

            <div className="w-100 mt-5">
              <button type="button" onClick={sign_in_up} className="btn btn-success">Login/Signup</button>
            </div>

          </div>
        </div>
      </div>
    </>
  )
}

export default Auth