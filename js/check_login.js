

const form = document.getElementById('form');
const login = document.getElementById('login');
const pass = document.getElementById('pass');
const button = document.getElementById('button1');

login.addEventListener('input', checkInputs);
pass.addEventListener('input', checkInputs);


// Функция, которая будет вызываться при изменении значений в полях
function checkInputs() {
    // Проверка всех условий
    let isValid = true;

    // Получаем значения из полей
    const loginValue = login.value.trim(); //логин
    const passValue = pass.value.trim(); //пароль
    const lenlogin = loginValue.length; //длина логина

    // Добавь сюда остальные проверки как в твоей версии кода
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
        } else
            {
            //add success class
            setSuccessFor(login);
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

    // После всех проверок, проверяем, все ли условия выполнены
    if (isValid) {
        button.disabled = false; // Делаем кнопку доступной для нажатия
    } else {
        button.disabled = true; // Делаем кнопку недоступной для нажатия
    }
}

function isPassword (passValue) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$%^#@&*!?])(?=.{8,})[A-Za-z\d$%^#@&*!?]+$/.test(passValue)
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

document.getElementById('pass_box').addEventListener('change', function() {
    var pass = document.getElementById('pass');
    if (this.checked) {
        pass.type = 'text';
    } else {
        pass.type = 'password';
    }
});