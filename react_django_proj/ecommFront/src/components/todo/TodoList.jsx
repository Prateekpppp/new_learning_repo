/* eslint-disable react/no-unknown-property */
import TodoListItems from "./TodoListItems";
import AddList from './AddList';

function TodoList({list}) {
    var listitems = {'lstnm':'lst2345','date':'date34567'};
    return  (
        <>
            <TodoListItems listitems={listitems} />
            <AddList />
        </>
    )
}

export default TodoList