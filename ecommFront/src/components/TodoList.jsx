/* eslint-disable react/no-unknown-property */

function TodoList() {
    let lstItem = {'lstnm':'lst2345','date':'date34567'};
    // let lstItem = ['lst2345','date3fg7'];
    return  <div class="row my-2">
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
}

export default TodoList