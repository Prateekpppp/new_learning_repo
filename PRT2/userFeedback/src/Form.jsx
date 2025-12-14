import React from 'react'
import { Navigate } from 'react-router-dom'
import { useState } from 'react'
import axios from 'axios';

function Form() {
  
  const [name,setName] = useState('');
  const [email,setEmail] = useState('');
  const [feedback,setFeedback] = useState('');
  const [response,setResponse] = useState(false);

  const submitFeedback = ()=>{
    let data = {
      name:name,
      email:email,
      feedback:feedback
    };
    console.log(data);

    axios.post('http://localhost:8080/feedback',data)
    .then((res)=>{
      console.log('res---',res.data);
      setResponse(res.data);
      clearInputs();
    })
    .catch((err)=>{
      console.log('err---',err);
    });
    
  }

  const clearInputs = ()=>{
    setName('');
    setEmail('');
    setFeedback('');
  }
  
  return (
        <>
            <form>
            <div className="inputGroup">
                <label htmlFor="name">Name</label>
                <input onChange={(e)=>setName(e.target.value)} type="text" name="name" id="" />
            </div>
            <div className="inputGroup">
                <label htmlFor="email">Email</label>
                <input onChange={(e)=>setEmail(e.target.value)} type="text" name="email" id="" />
            </div>
            <div className="inputGroup">
                <label htmlFor="feedback">Feedback</label>
                <input onChange={(e)=>setFeedback(e.target.value)} type="text" name="feedback" id="" />
            </div>
            <div className="inputGroup">
                <a className='submit' onClick={()=>submitFeedback()}>Submit</a>
            </div>
            </form>
            <div className="inputGroup">
            <div className='response' style={{display:(response)?'block':'none'}}>{response}</div>
            </div>
        </>
  )
}

export default Form