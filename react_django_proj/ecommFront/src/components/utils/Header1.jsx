import React, { useState, useEffect } from 'react'
import { Link, BrowserRouter as Router } from 'react-router-dom';

function Header1(props) {

  const [count, setCount] = useState('test title');

  const [appname, setAppname] = useState(props.appName);

  console.log('234rtghn4344rgr3r---------------',props.appName);
  var page = window.location.pathname.split('/')[1];

  useEffect(()=>{
    // // document.title = 'new title is ' + count;
    document.title = (page) ? page.toUpperCase() : 'Login/Registration';

  });

  var navbar = [
    {
      id :'1',url : '/',name : 'Home',
    },
    {
      id :'2',url :'todolist' ,name :  'TodoList',
    }
  ]

  return (
    <>
      <div className="container">
        <div className="row">
          <div className="col-2">
            <h1 className="">Header1</h1>
          </div>
          {/* <Router> */}

          <div className="col-6 navbar">
            {
              navbar.map(
                function(data){
                  return (
                    <div key={data.id} className='nav-item'>
                      <Link to={data.url} className='nav-item p-2' onClick={() => setAppname(data.name)}>{data.name}</Link>
                    </div>
                  )
                }
              )
            }

            {/* <div className=''>
              <Link to='todolist' className='p-2'>TodoList</Link>  
            </div> */}

          </div>

          {/* </Router> */}
          <div className="col-4 text-center">
            <button onClick={() => setCount(count + 1)}>
              Click me
            </button>
          </div>

        </div>
      </div>

    </>
    )
}

export default Header1