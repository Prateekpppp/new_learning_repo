import React from 'react'

function TodoListItems({listitems}) {
    let lstItem = listitems;
    return (
        <div class="row my-2">
            <div class="col-4">
                {lstItem.lstnm}
                {/* {lstItem[0]} */}
            </div>
            <div class="col-4">
                {lstItem.date}
                {/* {lstItem[1]} */}
            </div>
            <div class="col-2">
            <button type="button" class="btn btn-danger">Delete</button>
            </div>
        </div>
    )
}

export default TodoListItems