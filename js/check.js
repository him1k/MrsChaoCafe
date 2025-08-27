
    document.getElementById('number').addEventListener("keypress", function (evt) {
    if (evt.which < 48 || evt.which > 57)
{
    evt.preventDefault();
}
});

    const form = document.getElementById('form');
    const login = document.getElementById('login');
    const numb = document.getElementById('number')
    const pass = document.getElementById('pass');
    const confirm_pass = document.getElementById('confirm_pass');

    form.addEventListener('submit',(e)=> {
        e.preventDefault();
        checkInputs();
    })

    function checkInputs(){
        //проверка всех условий
        let isValid = true; //
        //get tje values from the inputs
        const loginValue = login.value.trim();
        const passValue = pass.value.trim();
        const confirm_passValue = confirm_pass.value.trim();
        const numberValue = numb.value.trim();

        const lenlogin = loginValue.length;

        if(loginValue === '') {
            //show error
            //add error class
            setErrorFor(login,'Вы не ввели логин');
            isValid = false;
        } else if (lenlogin > 15) {
            setErrorFor(login,'Нужно не более 15 символов')
            isValid = false;
        } else if (lenlogin < 4)
        {
            setErrorFor(login,'Нужно минимум 4 символа')
            isValid = false;
        } else {
            //add success class
            setSuccessFor(login);
        }

        if (numberValue == '')
        {
            setErrorFor(numb,'Нужно ввести номер')
            isValid = false;
        } else if (numberValue.length > 4) {
            setErrorFor(numb,'Слишком много цифр')
            isValid = false;
        } else {
         setSuccessFor(numb)
        }

        if (passValue === '') {
            setErrorFor(pass, 'Вы не ввели пароль')
            isValid = false;
        } else if (isPassword(passValue) == false){
            setErrorFor(pass,'Ошибка построения пароля')
            isValid = false;
        } else {
            setSuccessFor(pass)
        }


        if (confirm_passValue === '') {
            setErrorFor(confirm_pass, 'Вы не ввели повтор пароля')
            isValid = false;
        } else if (passValue !== confirm_passValue) {
            setErrorFor(confirm_pass, 'Пароли не совпадают')
            isValid = false;
        } else if (passValue === confirm_passValue && isPassword(passValue) === false) {
            setErrorFor(pass,'Ошибка построения пароля')
            setErrorFor(confirm_pass,'Ошибка построения пароля')
            isValid = false;
        } else {
            setSuccessFor(pass)
            setSuccessFor(confirm_pass)
        }

        if (isValid == true) {
            document.getElementById('button1').addEventListener('click', function() {
                requset1('POST',requestURL,body)
                    .then(data=>console.log(data))
                    .catch(err => console.log(err))
            });
        }
    }

    function setErrorFor(input, message) {
        const formControl = input.parentElement;
        const small = formControl.querySelector('small')
        //add error message inside small
        small.innerText = message;
        //add error class
        formControl.className ='form-control error';
    }

    function setSuccessFor(input) {
        const formControl = input.parentElement;
        formControl.className = 'form-control success'
    }

    function isPassword (passValue) {
        return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$%^#@&*!?])(?=.{8,})[A-Za-z\d$%^#@&*!?]+$/.test(passValue)
    }

    document.getElementById('pass_box').addEventListener('change', function() {
        var pass = document.getElementById('pass');
        if (this.checked) {
            pass.type = 'text';
        } else {
            pass.type = 'password';
        }
    });

    const requestURL = 'validation_form/check.php';
    function requset1 (method,url,body=null){
        return new Promise((resolve,reject) => {
            const xhr = new XMLHttpRequest()
            xhr.open(method,url)
            xhr.responseType = 'json'
            xhr.setRequestHeader('Content-Type', 'application/json')
            xhr.onload = () => {
                if (xhr.status >= 400) {
                    reject(xhr.status >= 400)
                } else {
                    resolve(xhr.response)
                }
            }
            xhr.onerror=()=> {
                reject(xhr.response)
            }
            xhr.send(JSON.stringify(body))
        })
    }
    const body = {
        login, numb, pass
    }