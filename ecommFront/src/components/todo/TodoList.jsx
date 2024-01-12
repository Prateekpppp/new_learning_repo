/* eslint-disable react/no-unknown-property */
import TodoListItems from "./TodoListItems";
function TodoList({list}) {
    var listitems = {'lstnm':'lst2345','date':'date34567'};
    return  (
        <TodoListItems listitems={listitems} />
    )
}

export default TodoList