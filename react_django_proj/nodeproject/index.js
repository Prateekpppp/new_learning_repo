const express = require("express")
const path = require('path')
const mysql = require("mysql")
const app = express()
const bcrypt = require("bcryptjs")
const session = require('express-session');

// const dotenv = require('dotenv');
// dotenv.config();


const jwt = require('jsonwebtoken');

app.use(express.urlencoded({extended: 'false'}))
app.use(express.json())

// import User from "/models/User.js";
const User = require('./models/User');


app.use(session({
    secret: 'your-secret-key', // Use a secret key for session encryption
    resave: false,
    saveUninitialized: false
}));


const PORT = process.env.PORT || 3003;

const SECRET_ACCESS_TOKEN = '5add23248a8e7da82dc784100ef8b75da17b55e8';

const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',
    password: 'user@123',
    database: 'testing'
})

db.connect((error) => {
    if(error) {
        console.log(error)
    } else {
        console.log("MySQL connected!")
    }
})

// View Engine Setup
app.set("views", path.join(__dirname))
// app.set("view engine", "ejs")
app.set("view engine", "hbs")


app.get("/", function(req, res){
    const userId = req.session.userId;

    const Usertoken = req.session.token;
    // res.render("index")
    res.render('index', { userId: userId,Usertoken:Usertoken});
})

app.get("/register", (req, res) => {
    if (!req.session.userId) {
        res.render("login")
    }else{
        res.render("register")
    }
})


app.get("/login", (req, res) => {
    if (!req.session.userId) {
        res.render("login")
    }else{
        res.redirect('profile')
    }
})


app.post("/auth/login", (req, res) => {    
    const { email, password } = req.body
    if( email === "") {
        return res.render('login', {
            message: 'This email is empty!'
        })
    } else if(password === "") {
        return res.render('login', {
            message: 'This password is empty!'
        })
    }

    try {
        // check if the user exists
        // const user = User.findOne({ username: req.body.email });
        // if (user) {

        // db.query('SELECT * FROM users WHERE email = ?', [email], async (error, user) => {
        db.query('SELECT * FROM users WHERE email = ? AND password = ?', [email, password], function(error, user, fields) {
            // console.log(user);
            if (error) throw error;
            if( user.length > 0 ) {
                //check if password matches
                // const result = req.body.password === user.password;
                // console.log(req.body.password," === ",user[0].password);
                if (req.body.password === user[0].password) {
                    req.session.userId = user[0].id;
                    req.session.username = user[0].name;
                    console.log('Logged in successfully');
                    let jwtSecretKey = '5add23248a8e7da82dc784100ef8b75da17b55e8';
                    let data = {
                        // time: Date(),
                        userId: user[0].id,
                    }
                
                    const token = jwt.sign(data, jwtSecretKey);
                
                    // res.send(token);
                    req.session.token = token;
                    console.log(req.session);
                    // res.send({"Success":"Success!"});
                    // return res.render('profile', { user:user[0].name,message: "User login, Please wait!" ,class: 'success',});
                    res.redirect('/profile?token='+req.session.token);
                } else {
                    return res.render('login', { message: "password doesn't match" ,class: 'danger',});
                }
            } else {
                return res.render('login', { message: "User doesn't exist" ,class: 'danger',});
            }
        })
    } catch (error) {
        return res.render('login', { message:error ,class: 'danger',});
    }

})

app.post("/auth/register", (req, res) => {    
    const { name, email, password, password_confirm } = req.body
    if(email === "") {
        return res.render('register', {
            message: 'This email is empty!',class: 'danger',
        })
    }

    if(password === "") {
        return res.render('register', {
            message: 'This password is empty!',class: 'danger',
        })
    }
    
    let hashedPassword =  bcrypt.hash(password, 8)
    db.query('SELECT email FROM users WHERE email = ?', [email], async (error, result) => {
        if( result.length > 0 ) {
            return res.render('register', {
                message: 'This email is already in use',class: 'danger',
            })
        }
    })

    db.query('INSERT INTO users SET?', {name: name, email: email, password: password}, (err, result) => {
        if(err) {
            console.log(err)
        } else {
            console.log('User registered!');
            return res.render('register', {
                message: 'User registered!',class: 'success',
            })
        }
    })
    // db.query() code goes here
})

app.get('/profile', (req, res) => {
    // Check if userId is set in the session
    // userId is set, so you can access its value
    const userId = req.session.userId;
    // console.log(req);
    // console.log(res);
    if (!userId) {
        return res.redirect('/login');
    }

    const token = req.session.token;
    let jwtSecretKey = '5add23248a8e7da82dc784100ef8b75da17b55e8';

    jwt.verify(token, jwtSecretKey, async (err, decoded) => {
        if (err) {
            // if token has been altered or has expired, return an unauthorized error
            return res
                .status(401)
                .json({ message: "This session has expired. Please login" });
        }else{
            return res
                .status(200)
                .json({ message: "User Token Verify!" });
        }
    });

    if (req.session.userId) {
        // Now you can use the userId in your application logic, such as fetching user data from the database
        // For example, you might fetch the user data associated with this userId
        // console.log(userId);
        db.query('SELECT * FROM users WHERE id = ?', [userId], function(err, user, fields) {
            if (err) {
                // Handle error
                return res.status(500).send('Error fetching user data');
            }
            // console.log('user-----------',user);
            // User found, do something with the user data
            res.render('profile', { user:user[0].name }); // Assuming you're rendering a 'profile' view
        });
    } else {
        // userId is not set in the session, meaning the user is not authenticated
        // Redirect the user to the login page or show an error message
        res.redirect('/login'); // Example redirect to the login page
    }
});

app.listen(PORT, function(error){
	if(error) throw error
	console.log("Server created Successfully on PORT", PORT)
})

//Handling user logout 
app.get('/logout', function (req, res, next) {
	console.log("logout")
	if (req.session) {
    // delete session object
    req.session.destroy(function (err) {
    	if (err) {
    		return next(err);
    	} else {
    		return res.redirect('/');
    	}
    });
}
});

app.get('/forgetpass', function (req, res, next) {
	res.render("forget.ejs");
});

app.post('/forgetpass', function (req, res, next) {
	//console.log('req.body');
	//console.log(req.body);
	User.findOne({email:req.body.email},function(err,data){
		console.log(data);
		if(!data){
			res.send({"Success":"This Email Is not regestered!"});
		}else{
			// res.send({"Success":"Success!"});
			if (req.body.password==req.body.passwordConf) {
			data.password=req.body.password;
			data.passwordConf=req.body.passwordConf;

			data.save(function(err, Person){
				if(err)
					console.log(err);
				else
					console.log('Success');
					res.send({"Success":"Password changed!"});
			});
		}else{
			res.send({"Success":"Password does not matched! Both Password should be same."});
		}
		}
	});
	
});
 
function isLoggedIn(req, res, next) {
    if (req.isAuthenticated()) return next();
    res.redirect("/login");
}

// Main Code Here  //
// Generating JWT
app.post("/user/generateToken", (req, res) => {
    // Validate User Here
    // Then generate JWT Token
 
    let jwtSecretKey = '5add23248a8e7da82dc784100ef8b75da17b55e8'
    let data = {
        time: Date(),
        userId: 12,
    }
 
    const token = jwt.sign(data, jwtSecretKey);
 
    res.send(token);
});
 
// Verification of JWT
app.get("/user/validateToken", (req, res) => {
    // Tokens are generally passed in header of request
    // Due to security reasons.
 
    let tokenHeaderKey = process.env.TOKEN_HEADER_KEY;
    let jwtSecretKey = '5add23248a8e7da82dc784100ef8b75da17b55e8';
 
    try {
        const token = req.header(tokenHeaderKey);
 
        const verified = jwt.verify(token, jwtSecretKey);
        if (verified) {
            return res.send("Successfully Verified");
        } else {
            // Access Denied
            return res.status(401).send(error);
        }
    } catch (error) {
        // Access Denied
        return res.status(401).send(error);
    }
});