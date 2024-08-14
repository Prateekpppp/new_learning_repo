import React from 'react'

function TodoListItems({listitems}) {
    let lstItem = listitems;
    return (
        <div className="row my-2">
            <div className="col-4">
                {lstItem.lstnm}
                {/* {lstItem[0]} */}
            </div>
            <div className="col-4">
                {lstItem.date}
                {/* {lstItem[1]} */}
            </div>
            <div className="col-2">
            <button type="button" className="btn btn-danger">Delete</button>
            </div>
        </div>
    )
}

export default TodoListItems