const minusBtns = document.querySelectorAll(".minus");

const addBtns = document.querySelectorAll(".add");

minusBtns.forEach(minusBtn => {

    minusBtn.addEventListener("click", (event) => {

        const dataClassName = event.target.getAttribute("data-className");

        const quantityInput = document.querySelector(`.${dataClassName}`);

        const quantity = +quantityInput.value - 1;
    
        if (quantity < 0) quantityInput.value = 0;

        else quantityInput.value = quantity;

    });

});

addBtns.forEach(addBtn => {

    addBtn.addEventListener("click", (event) => {

        const dataClassName = event.target.getAttribute("data-className");

        const quantityInput = document.querySelector(`.${dataClassName}`);

        const quantity = +quantityInput.value + 1;
    
        if (quantity > 99) quantityInput.value = 99;
    
        else quantityInput.value = quantity;
    
    });

});
