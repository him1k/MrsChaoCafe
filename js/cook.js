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



//моя, оригинал
function addToOrderTextArea(idOrder, quantity, nameDish, button) {
    let status = "Готово";

    // Получаем элемент ul
    const orderList = document.getElementById('dishList_new');

    // Форматируем данные для добавления
/*    const orderInfo = `Блюдо: ${nameDish} \nКол-во: ${quantity} шт. \nСтатус: ${status}. \n`;*/
    const orderInfo = `Блюдо: ${nameDish}; \nКол-во: ${quantity} шт; \n Номер заказа: ${idOrder}`;

    // Создаем новый элемент li
    const newListItem = document.createElement('li');
    newListItem.classList.add('list-group-item');
    newListItem.setAttribute("name", 'dish[]');
    newListItem.textContent = orderInfo;

    // Добавляем новый элемент li в ul
    orderList.appendChild(newListItem);

    // Удаляем элемент списка
    const listItem = document.getElementById('order-' + idOrder); // Получаем li по id
    if (listItem) {
        listItem.remove(); // Удаляем элемент списка
    }

    // Удаляем кнопку из элемента списка
    button.remove();

    //заказов нет
    const orderList1 = document.getElementById('dishList');
    if (orderList1.children.length === 0) {
        // Если нет элементов, создаем элемент li с текстом "Заказов нет"
        const emptyListItem = document.createElement('li');
        emptyListItem.classList.add('list-group-item');
        emptyListItem.textContent = "Заказов нет";
        orderList1.appendChild(emptyListItem);
    }


    //новое
    // AJAX отправка данных
/*
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/bakeryhtml/Bakery%20Main/order_cook.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Получаем значения id_cook и id_order
    const idCook = document.querySelector('input[name="id_cook"]').value;
    const idOrder = document.querySelector('input[name="id_order"]').value;

    // Формируем строку для отправки
    const params = `id_cook=${idCook}&id_order=${idOrder}`;

    xhr.send(params);
*/
/*        const idCook = <?php echo $id_cook; ?>; // Получаем id_cook из PHP*/

/*    const idCook = document.querySelector('input[name="id_cook"]').value;
    const idOrder = document.querySelector('input[name="id_order"]').value;

        // Создаем AJAX-запрос
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "http://localhost/bakeryhtml/Bakery%20Main/order_cook.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

        // Формируем строку для отправки
        const params = `id_cook=${idCook}&id_order=${idOrder}`;

        // Отправляем данные
        xhr.send(params);

        // Обработка ответа
        xhr.onload = function() {
        if (xhr.status === 200) {
        console.log("Данные успешно отправлены:", xhr.responseText);
    } else {
        console.error("Ошибка при отправке данных:", xhr.statusText);
    }
    };*/

}

/*
function sendOrder(idOrder, quantity, nameDish, idCook, button) {
    const idCook = button.previousElementSibling.value; // Получаем id_cook из скрытого поля
    // Создаем AJAX-запрос
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "http://localhost/bakeryhtml/Bakery%20Main/order_cook.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Формируем строку для отправки
    const params = `id_cook=${encodeURIComponent(idCook)}&id_order=${encodeURIComponent(idOrder)}`;

    // Обработка ответа
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Данные успешно отправлены:", xhr.responseText);
            // Если сервер возвращает данные, вы можете обработать их здесь
            addToOrderTextArea(idOrder, quantity, nameDish, button);
        } else {
            console.error("Ошибка при отправке данных:", xhr.statusText);
        }
    };

    // Отправляем данные
    xhr.send(params);
}*/

//новое
function sendOrder(idOrder, quantity, nameDish, idCook, button) {

    // Создаем AJAX-запрос
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "order_cook.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    // Формируем строку для отправки
    const params = `id_cook=${encodeURIComponent(idCook)}&id_order=${encodeURIComponent(idOrder)}`;

    // Обработка ответа
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log("Данные успешно отправлены:", xhr.responseText);
            // Если сервер возвращает данные, вы можете обработать их здесь
            addToOrderTextArea(idOrder, quantity, nameDish, button);
        } else {
            console.error("Ошибка при отправке данных:", xhr.statusText);
        }
    };

    // Отправляем данные
    xhr.send(params);
}


