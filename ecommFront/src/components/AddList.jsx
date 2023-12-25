/* eslint-disable react/no-unknown-property */
function AddList() {
    return <div class="row my-2">
                <div class="col-4">
                <input type="text" placeholder='Enter value'/>
                </div>
                <div class="col-4">
                <input type="date" name="todoDate" id="todoDate" />
                </div>
                <div class="col-2">
                <button type="button" class="btn btn-success">Add</button>
                </div>
            </div>
}

export default AddList