
import './App.css'
import './index.css'
import React, { useState, useEffect } from 'react'
import ReactDOM from "react-dom/client";
import {BrowserRouter, Link, Routes, Route} from 'react-router-dom';
import AppName from './components/AppName';
import CommonFunction from './components/envFolder/CommonFunction';
import TodoList from './components/todo/TodoList';
import FoodItems from './components/FoodItems';
import Auth from './components/auth/Auth';
import Home from './components/pages/Home';
import Header from './components/utils/Header';
import { ToastContainer } from "react-toastify";
import Footer from './components/utils/Footer';
import Product from './components/pages/Product';


function App() {

  // var fooditems = [];
  const [page,setPage] = useState('');

  // setPage(window.location.pathname.split('/')[1]);
  
  const [header,setHeader] = useState('');

  // var fooditems = ['f1','f2','f3','f4','f5','f6'];
  // var page = window.location.pathname.split('/')[1];
  // var header = '';
  // header = (page) ? page.toUpperCase() : 'Login/Registration';

  var appName = (page) ? page.toUpperCase() : 'Login/Registration';
  

  useEffect(()=>{

    // setPage(window.location.pathname.split('/')[1]);

    // setHeader((page) ? page.toUpperCase() : 'Login/Registration');

    // page = window.location.pathname.split('/')[1];
    // console.log('sdfghdsdfgdfsadfgs-----------0',page);
    document.title = (page) ? page.toUpperCase() : 'Login/Registration';
    // header = (page) ? page.toUpperCase() : 'Login/Registration';
  });
  // console.log('23456tythre',CommonFunction.enableNav);

  return (
    <>
      {/* <CommonFunction /> */}
      <div className="app">
        {/* <BrowserRouter> */}
          {/* <Header  appName={CommonFunction.header} enableNav={CommonFunction.enableNav}/> */}
          <Header />
          <div className="content vh-100 pb-5 mb-5 overflow-scroll">

            <Routes>
              <Route path="auth" element={<Auth />} />
            </Routes>
            <Routes>
              <Route path="" element={<Home />} />
            </Routes>
            <Routes>
              <Route path="todolist" element={<TodoList />} />
            </Routes>
            <Routes>
              <Route path="/product/:name" element={<Product />} />
            </Routes>

            <ToastContainer hideProgressBar={true} newestOnTop={true} />

          </div>
          <Footer />

        {/* </BrowserRouter> */}
      </div>
    </>
  );
}

export default App;
