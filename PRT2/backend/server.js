// Server setup
const express = require('express');
const app = express();
const cors = require('cors');
const port = 8080;
const bodyParser = require('body-parser');

app.use(cors());
app.use(express.json());

// db connection

const mongoose = require('mongoose');
mongoose.connect('mongodb+srv://prateekpppp4:prateek4@cluster0.lokolyb.mongodb.net/feedback')
.then(()=>{
    console.log('mongo connected');
})
.catch((err)=>{
    console.log('Error',err);
    
})

// Schema
const userSchema = new mongoose.Schema({
    name: {
        type: String,
        required: true
    },
    email: {
        type: String,
        required: true
    },
    feedback: {
        type: String,
        required: true
    }
});

const feedback = mongoose.model('feedback',userSchema);

// endpoints

app.post('/feedback',async function(req,res){
    console.log('req---',req.body);
    // req = req.body;
    
    await feedback.insertOne({
        name: req.body.name,
        email: req.body.email,
        feedback: req.body.feedback,
    });
    res.send('FeedFeedback sent successfully');
});

app.get('/feedbacks',async function(req,res){
    let data = await feedback.find({});
    console.log('feedback--',data);
    
    res.send(data);
});



app.listen(port,function(){
    console.log(`server running on ${port}`);
});