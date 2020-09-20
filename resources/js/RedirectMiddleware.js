

const Auth = (to,from,next)=>{
	var isLogin = localStorage.getItem('isLogin') ? localStorage.getItem('isLogin') : 0

	if(isLogin === 0){
		//next({name: 'adminlogin'})
		window.location.href = "./admin/login"
	}else{
		next()
	}

	
}


const Login = (to,from,next)=>{
    var isLogin = localStorage.getItem('isLogin') ? localStorage.getItem('isLogin') : 0

	if(isLogin == 1){
		 //next({name: 'adminindex'})
		window.location.href = "./admin"
	}else{
		next()
	}

}


module.exports = {Auth,Login}