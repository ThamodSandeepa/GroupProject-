//Transition of login form to register form
const loginr=document.querySelector('.login-section');
const loginlink=document.querySelector('.login-link');
const registerlink=document.querySelector('.register-link');

//Link with login.css
registerlink.addEventListener('click',()=>{
    loginr.classList.add('active')
})

loginlink.addEventListener('click',()=>{
    loginr.classList.remove('active')
})



  
  
      

  