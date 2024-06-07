import React, { useState, useEffect } from 'react'
// import React from 'react'
import Container from 'react-bootstrap/Container';
import Nav from 'react-bootstrap/Nav';
import Navbar from 'react-bootstrap/Navbar';
import NavDropdown from 'react-bootstrap/NavDropdown';
import { Link, BrowserRouter as Router } from 'react-router-dom';
import navValues from "../data/navbar";

function NavbarComm(props) {

    const [appname, setAppname] = useState(props.appName);

    const [menu, setMenu] = useState('Home');

    var navbar = navValues;
    //     {
    //     id :'1',url : '/',name :'Home',
    //     },
    //     {
    //     id :'2',url :'todolist' ,name :'TodoList',
    //     },
    //     {
    //     id :'3',url :'auth' ,name :'Auth',
    //     }
    // ]
  return (
    <>
        <nav className="navbar navbar-expand-lg navbar-light bg-light">
            <div className="container-fluid">
                <Link className="navbar-brand">Navbar</Link>
                <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span className="navbar-toggler-icon"></span>
                </button>
                <div className="collapse navbar-collapse" id="navbarSupportedContent">
                <ul className="navbar-nav me-auto mb-2 mb-lg-0">

                    {
                        navbar.map(
                            function(data){
                                return (
                                    // <div key={data.id} className='nav-item'>
                                    // </div>
                                    <li key={data.id} className="nav-item">
                                        <Link key={data.id} to={data.url} className={menu===data.name?"nav-item p-2 active":"nav-item p-2"} onClick={() => setMenu(data.name)}>{data.name}</Link>
                                    
                                    </li>
                                    // <Nav.Link key={data.id} href={data.url} onClick={() => setAppname(data.name)}>{data.name}</Nav.Link>
                                )
                            }
                        )
                    }
                </ul>
                <form className="d-flex">
                    <input className="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                    <button className="btn btn-outline-success" type="submit">Search</button>
                </form>
                <div className="d-flex border-primary border rounded-pill p-2 mx-3 bg-transparent">Sign In</div>
                </div>
            </div>
        </nav>
        
        {/* <Navbar expand="lg" className="bg-body-tertiary">
            <Container>
                <Navbar.Brand href="#home">React-Bootstrap</Navbar.Brand>
                <Navbar.Toggle aria-controls="basic-navbar-nav" />
                <Navbar.Collapse id="basic-navbar-nav">
                <Nav className="me-auto">
                    {
                        navbar.map(
                            function(data){
                                return (
                                    // <div key={data.id} className='nav-item'>
                                    // <Link to={data.url} className='nav-item p-2' onClick={() => setAppname(data.name)}>{data.name}</Link>
                                    // </div>
                                    <Nav.Link>
                                        <Link to={data.url} className='nav-item p-2' onClick={() => setAppname(data.name)}>{data.name}</Link>
                                    </Nav.Link>
                                )
                            }
                        )
                    }
                </Nav>
                </Navbar.Collapse>
            </Container>
        </Navbar> */}
    </>
  )
}

export default NavbarComm