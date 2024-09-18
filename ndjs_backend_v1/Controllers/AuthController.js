const jwt = require('jsonwebtoken');

const login = async (req,res)=>{

    // res.send('true');
    var email='mail@gmail.com';

    const jwtToken = jwt.sign(
        {email:email,_id:2},
        process.env.JWT_SECRET,
        {expiresIn:'24h'}
    );

    res.status(200)
    .json({
        message:"login success",
        success:true,
        jwtToken,
        email
    });

    res.send('pong--',jwtToken);
}

const check = async (req,res)=>{
    res.status(200).json([
        {
            name:'mobile',
            price:1000
        }
    ])
}


module.exports = {
    login,
    check
}