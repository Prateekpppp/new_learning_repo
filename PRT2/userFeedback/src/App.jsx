import { useState } from 'react'
import { Route, Routes } from 'react-router-dom'
import Form from './Form'
import Feedback from './Feedback'
import './App.css'
import Navbar from './Navbar'

function App() {

  return (
    <>
      <Navbar/>
      <Routes>
        <Route path='' element={<Form />} />
        <Route path='/feedback' element={<Feedback/>} />
      </Routes>
    </>
  )
}

export default App
