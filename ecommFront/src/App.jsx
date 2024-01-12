/* eslint-disable react/no-unknown-property */
// import { useState } from 'react'
// import reactLogo from './assets/react.svg'
// import viteLogo from '/vite.svg'
import './App.css'
// import Col from 'react-bootstrap/Col';
import AppName from './components/AppName';
import AddList from './components/todo/AddList';
import TodoList from './components/todo/TodoList';
import FoodItems from './components/FoodItems';


function App() {

  // var fooditems = [];
  var fooditems = ['f1','f2','f3','f4','f5','f6'];
  return (
    <>
      <center>
        <AppName appname='Todo App new' />
      </center>
      <div class="container text-center">
        <AddList />
        <TodoList />
        {/* <FoodItems fooditems={fooditems}/> */}
      </div>
    </>
  );
}

export default App;
