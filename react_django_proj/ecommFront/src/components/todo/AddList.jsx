/* eslint-disable react/no-unknown-property */
function AddList() {
    return <div className="row my-2">
                <div className="col-4">
                <input type="text" placeholder='Enter value'/>
                </div>
                <div className="col-4">
                <input type="date" name="todoDate" id="todoDate" />
                </div>
                <div className="col-2">
                <button type="button" className="btn btn-success">Add</button>
                </div>
            </div>
}

export default AddList