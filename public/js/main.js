let send_message = (message,class_name)=>
{
        let m = document.getElementById('messages');
        m.innerHTML = '';
        let div = document.createElement('div');
        div.innerText = message;
        div.className = 'alert '+class_name;
        m.appendChild(div);
};

let val = (validation,message)=>{
    if(validation){
        send_message(message,'alert-danger');
        return true;
    }
    return false;
};

let validate_form = ()=>{
    let name = document.getElementById('fullname').value;
    let phone = document.getElementById('phone').value;
    let email = document.getElementById('email').value;

    let reg_email = /^\w+([\.-]?\w+)@\w+([\.-]?\w+)(\.\w{2,3})+$/;
    let reg_name = /^[a-zA-Z]+\s[a-zA-z]+$/;
    let reg_phone = /^[0-9]+$/;

    if(val(name.length < 8,"Name must be at least 8 characters long") || 
      val(!reg_name.test(name),"Invalid name") ||
      val(phone.length < 8,"Phone number is too short") ||
      val(!reg_phone.test(phone),"Phone number must be numeric") ||
      val(email.length < 3,"Email is too short") ||
      val(!reg_email.test(email),"Invalid email")
      ){
        event.preventDefault();
    }
};
