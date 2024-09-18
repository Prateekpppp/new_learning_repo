const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const cors = require('cors');

const AuthRouter = require('./Routes/AuthRouter');
const AllRouter = require('./Routes/AllRouter');
require('dotenv').config();

const PORT = process.env.PORT || 8080;

app.get('/ping',(req,res)=>{
    res.send('pong');
});

app.use(bodyParser.json());
app.use(cors());

app.use('/auth',AuthRouter);
app.use('/products',AllRouter);

app.listen(PORT, ()=>{
    console.log('server runs');
});