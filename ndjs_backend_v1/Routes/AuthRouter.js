const router = require('express').Router();

const {loginValidation} = require('../Middlewares/AuthMiddleware');
const {login} = require('../Controllers/AuthController');

router.post('/login',(req,res)=>{
    res.send('Login page');
});

router.post('/login',loginValidation,login);
// router.get('/',loginValidation,login);

module.exports = router;