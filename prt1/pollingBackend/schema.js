// client library for mongoDB
const mongoose = require('mongoose');

const pollSchema = new mongoose.Schema({
    // properties in noSQl and column in SQL
    apple:{
        type: Number,
        required: true
    },
    banana:{
        type:Number,
        required: true,
        unique: true
    },
    mango:{
        type:Number,
        required: true,
        unique: true
    },
});

exports.pollSchema = pollSchema;