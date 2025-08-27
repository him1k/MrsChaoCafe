document.getElementById('number').addEventListener("keypress", function (evt) {
    if (evt.which < 48 || evt.which > 57) {
        evt.preventDefault();
    }
});

const form = document.getElementById('form');
const login = document.getElementById('login');
const numb = document.getElementById('number');
const pass = document.getElementById('pass');
const confirm_pass = document.getElementById('confirm_pass');
const button = document.getElementById('button1');

// Чекбокс
const checkbox = document.getElementById('checkboxId');
checkbox.addEventListener('change', checkInputs);


login.addEventListener('input', checkInputs);
numb.addEventListener('input', checkInputs);
pass.addEventListener('input', checkInputs);
confirm_pass.addEventListener('input', checkInputs);



// Функция, которая будет вызываться при изменении значений в полях
function checkInputs() {
    // Проверка всех условий
    let isValid = true;

    // Получаем значения из полей
    const loginValue = login.value.trim();
    const passValue = pass.value.trim();
    const confirm_passValue = confirm_pass.value.trim();
    const numberValue = numb.value.trim();
    const lenlogin = loginValue.length;

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

        if (numberValue == '')
        {
            setErrorFor(numb,'Нужно ввести номер')
            isValid = false;
        } else if (numberValue.length < 11) {
            setErrorFor(numb,'Введено меньше 11 цирф')
            isValid = false;
        } else if (isNumber(numberValue) == false) {
            setErrorFor(numb,'Номер введён некорректно')
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

    //проверка чекбокса

    if (!checkbox.checked) {
        isValid = false;
    }

    // После всех проверок, проверяем, все ли условия выполнены
/*    if (isValid === true ) {
        button.disabled = false; // Делаем кнопку доступной для нажатия
    } else {
        button.disabled = true; // Делаем кнопку недоступной для нажатия
    }*/

    button.disabled = !isValid;
}

function isPassword (passValue) {
    return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$%^#@&*!?])(?=.{8,})[A-Za-z\d$%^#@&*!?]+$/.test(passValue)
}

function isNumber (passValue) {
    return /^((\+7|7|8)+([0-9]){10})$/.test(passValue)
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