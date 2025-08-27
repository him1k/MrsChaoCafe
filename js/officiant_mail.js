//фильтрация
function filterDishes() {
    let input = document.getElementById('search').value.toLowerCase();
    let ul = document.getElementById('dishList');
    let li = ul.getElementsByTagName('li');

    for (let i = 0; i < li.length; i++) {
        let dishName = li[i].innerText.toLowerCase();
        if (dishName.includes(input)) {
            li[i].style.display = '';
        } else {
            li[i].style.display = 'none';
        }
    }
}

//ввод чисел
function validateInput(input) {
    // Получаем значение из input
    let value = parseInt(input.value);


    // Проверяем, является ли значение нечисловым или меньше 1
    if (isNaN(value) || value < 1) {
        // Если значение некорректное, очищаем input
        input.value = '';
    }
    if ((isNaN(value) || value > 5)) {
        input.value = '';
    }
}

//работающая
function updateOrderList() {
    const orderTextArea = document.getElementById('orderTextArea');
    const dishListItems = document.querySelectorAll('#dishList .list-group-item');
    let orderDetails = '';

    dishListItems.forEach(item => {
        const quantityInput = item.querySelector('input[name="quantity"]');
        const dishId = item.querySelector('span').textContent; // Получаем значение ID
        const dishName = item.childNodes[0].textContent.trim(); // Получаем имя блюда

        const price = item.firstChild.textContent.split(' - ')[1]; // Получаем цену блюда

        if (quantityInput.value > 0) {
            const quantity = quantityInput.value;

            orderDetails += `${dishName} - ${quantity} шт.\n`;
        }
    });

    // Записываем данные в текстовое поле
    orderTextArea.value = orderDetails;
    orderTextArea.style.display = orderDetails ? 'block' : 'none'; // Показываем textarea только если есть записи
}


function sendOrder() {
    const items = document.querySelectorAll('#dishList .list-group-item');
    const orderData = [];
    const comment = document.getElementById('comment').value.trim(); // Получаем комментарий и удаляем лишние пробелы
    const table_number = document.getElementById('table_number').value; // Получаем номер стола

    items.forEach(item => {
        const quantityInput = item.querySelector('input[name="quantity"]');
        const quantity = parseInt(quantityInput.value);
        const price = parseFloat(item.getAttribute('data-price'));
        const dishId = item.querySelector('span').textContent;

        if (quantity > 0) {
            const totalPrice = price * quantity;
            orderData.push({
                id_dish: dishId,
                quantity: quantity,
                total_price: totalPrice
            });
        }
    });

    // Проверка на пустой комментарий
    if (orderData.length > 0 && table_number) {
        const idOf = document.getElementById('id_of').value; //id официанта

        // Если комментарий пустой, можно установить значение по умолчанию
        const finalComment = comment.length > 0 ? comment : "Без комментария"; // Установка значения по умолчанию

        // Создаем строку параметров
        let params = `tableNumber=${encodeURIComponent(table_number)}&comment=${encodeURIComponent(finalComment)}&id_of=${encodeURIComponent(idOf)}`;

        orderData.forEach((order, index) => {
            params += `&orders[${index}][id_dish]=${encodeURIComponent(order.id_dish)}`;
            params += `&orders[${index}][quantity]=${encodeURIComponent(order.quantity)}`;
            params += `&orders[${index}][total_price]=${encodeURIComponent(order.total_price)}`;
        });

        // Создаем AJAX-запрос
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "order_officiant.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Обработка ответа
        xhr.onload = function() {
            if (xhr.status === 200) {
                console.log("Данные успешно отправлены. \t", xhr.responseText);
                // Очищаем текстовое поле после успешной отправки
                document.getElementById('orderTextArea').value = '';
                // Обнуляем количество блюд
                items.forEach(item => {
                    const quantityInput = item.querySelector('input[name="quantity"]');
                    quantityInput.value = 0;
                });
                // Обновляем список заказа
                updateOrderList();
            } else {
                console.error("Ошибка при отправке данных:", xhr.statusText);
            }
        };

        // Отправляем данные
        xhr.send(params);
    } else {
        alert("Пожалуйста, выберите хотя бы одно блюдо и укажите номер стола.");
    }
}










