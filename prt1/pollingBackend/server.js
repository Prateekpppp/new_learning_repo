
// setup server
require('dotenv').config();
const express = require('express');
const app = express();
const port = process.env.PORT;
const cors = require('cors');
const {pollSchema} = require('./schema');


app.use(cors());
app.use(express.json());



// endpoints

app.get('api/updatePoll',(request,response)=>{
    let data = request.body;
    console.log('request----',request);
    console.log('data----',data);
    mongoose.connect(dbUrl+'pollingData');
    const pollModel = mongoose.model('pollingData',pollSchema);
    pollModel.insertMany(data);
    
    response.end('testing data',response);
    
})


app.listen(port, ()=>console.log(`Server is running on port ${port}`));