const router = require('express').Router();

const {checkAuth} = require('../Middlewares/AuthMiddleware');
const {check} = require('../Controllers/AuthController');

router.post('/',checkAuth,check);

module.exports = router;