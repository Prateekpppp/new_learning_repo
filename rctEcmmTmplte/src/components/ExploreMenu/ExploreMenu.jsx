import React from 'react'
import './ExploreMenu.css'
import {menu_list} from '../../assets/assets'

const ExploreMenu = ({category,setCategory}) => {
  // var menu_list_new = menu_list.slice(1,menu_list.length);
  return (
    <div className='explore-menu d-flex flex-column' id='explore-menu'>
      <h1>Explore our menu</h1>
      <p className='explore-menu-text'>
        Choose from a diverse menu featuring a delectable array
      </p>
      <div className="explore-menu-list d-flex justify-content-between text-center align-items-center">

        {/* <div onClick={()=>setCategory("All")} className="explore-menu-list-item">
            <img className={category===menu_list[0].menu_name?"active":""} src={menu_list[0].menu_image} alt="" />
            <p>{menu_list[0].menu_name}</p>
        </div> */}
        {menu_list.map((item,index)=>{
            return (
                <div onClick={()=>setCategory((prev)=>prev===item.menu_name?"All":item.menu_name)} key={index} className="explore-menu-list-item">
                    <img className={category===item.menu_name?"active":""} src={item.menu_image} alt="" />
                    <p>{item.menu_name}</p>
                </div>
            )
        })}
      </div>
      <hr/>
    </div>
  )
}

export default ExploreMenu
