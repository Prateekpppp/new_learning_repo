import React, { useState, useEffect } from 'react'

function CommonFunction() {

  var fooditems = ['f1','f2','f3','f4','f5','f6'];
//   var page = window.location.pathname.split('/')[1];
  const [page,setPage] = useState('');

  // setPage(window.location.pathname.split('/')[1]);
  
  const [header,setHeader] = useState('');

  // setHeader((page) ? page.toUpperCase() : 'Login/Registration');

  var enableNav = (page) ? true : false;

  useEffect(()=>{
    // page = window.location.pathname.split('/')[1];
    // page = (page) ? page.toUpperCase() : 'Login/Registration';
    // document.title = (page) ? page.toUpperCase() : 'Login/Registration';

    setPage(window.location.pathname.split('/')[1]);

    setHeader((page) ? page.toUpperCase() : 'Login/Registration');
    enableNav = (page) ? true : false;
    // console.log('enableNav in new rgtgf',enableNav);
    // console.log('setPage in new rgtgf',page);
    // console.log('setHeader in new rgtgf',header);
    // header = page;
  });

  return (
    {'page':page,'header':header,'enableNav':enableNav}
  )
}

export default CommonFunction