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

// обновление заказа
    function updateOrderList() {
    const orderList = document.getElementById('orderList');
    orderList.innerHTML = ''; // Очищаем текущий список заказов
    const dishListItems = document.querySelectorAll('#dishList li'); // Получаем все элементы списка блюд

    dishListItems.forEach(item => {
    const quantityInput = item.querySelector('input[type="number"]'); // Получаем поле ввода количества
    const quantity = quantityInput.value; // Получаем значение

    if (quantity > 0) {
    const dishName = item.firstChild.textContent.split(' - ')[0]; // Получаем название блюда
    const price = item.firstChild.textContent.split(' - ')[1]; // Получаем цену блюда

    // Создаём элемент списка для заказа и добавляем его в список заказов
    const orderItem = document.createElement('li');
    orderItem.className = 'list-group-item d-flex justify-content-between align-items-center';
    orderItem.textContent = `${dishName} - ${price} (${quantity} шт.)`;
    orderList.appendChild(orderItem);
}
});
}




/*function updateOrderList() {
    const orderList = document.getElementById('orderList');
    orderList.innerHTML = ''; // Очищаем текущий список заказов
    const dishListItems = document.querySelectorAll('#dishList li'); // Получаем все элементы списка блюд

    dishListItems.forEach(item => {
        const quantityInput = item.querySelector('input[type="number"]'); // Получаем поле ввода количества
        const quantity = quantityInput.value; // Получаем значение

        if (quantity > 0) {
            const dishName = item.firstChild.textContent.split(' - ')[0]; // Получаем название блюда
            const price = item.firstChild.textContent.split(' - ')[1]; // Получаем цену блюда

            // Создаём элемент списка для заказа и добавляем его в список заказов
            const orderItem = document.createElement('li');
            orderItem.className = 'list-group-item d-flex justify-content-between align-items-center';
            orderItem.textContent = `${dishName} - ${price} (Количество: ${quantity})`;
            orderList.appendChild(orderItem);
        }
    });
}*/


