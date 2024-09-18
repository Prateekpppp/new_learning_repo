const jwt = require('jsonwebtoken');

const loginValidation = (req,res,next)=>{
    console.log('loginValidation----');
    next();
}

const checkAuth = (req,res,next)=>{
    console.log('req.headers----',req.header('Authorization'));
    const auth = req.header('Authorization');
    if(!auth){
        return res.status(403)
            .json({message:'Unauthorized'});
    }
    
    console.log('checkAuth----');

    next();
}

module.exports = {
    loginValidation,
    checkAuth
}