import { useEffect } from "react";

function AppName(props){

    let appname1 = props.appname;
    var page = window.location.pathname.split('/')[1];

    appname1 = (page) ? page.toUpperCase() : 'Login/Registration';
    appname1 = appname1.toUpperCase();

    return <h1 className="fw-bold my-5 text-center">{appname1}</h1>
}

export default AppName;