
import './App.css'
import React, { useState, useEffect } from 'react'
import ReactDOM from "react-dom/client";
import {BrowserRouter, Link, Routes, Route} from 'react-router-dom';
import AppName from './components/AppName';
import TodoList from './components/todo/TodoList';
import FoodItems from './components/FoodItems';
import Auth from './components/auth/Auth';
import Home from './components/Home';
import Header from './Header';
import { ToastContainer } from "react-toastify";


function App() {

  // var fooditems = [];

  var fooditems = ['f1','f2','f3','f4','f5','f6'];
  var page = window.location.pathname.split('/')[1];
  var header = '';
  header = (page) ? page.toUpperCase() : 'Login/Registration';
  
  useEffect(()=>{
    var page = window.location.pathname.split('/')[1];
    console.log('sdfghdsdfgdfsadfgs-----------0',page);
    document.title = (page) ? page.toUpperCase() : 'Login/Registration';
    header = (page) ? page.toUpperCase() : 'Login/Registration';
    // header = page;
  });

  return (
    <>
      <BrowserRouter>
        <Header  appName={header}/>
        <AppName appName={header}/>
        <Routes>
          <Route path="" element={<Auth />} />
        </Routes>
        <Routes>
          <Route path="todolist" element={<TodoList />} />
        </Routes>
      </BrowserRouter>
      <ToastContainer hideProgressBar={true} newestOnTop={true} />
    </>
  );
}

export default App;
