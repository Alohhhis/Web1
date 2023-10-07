//валидация текстового поля
let formChecker = document.querySelector(".js-form"),
    formInputText = document.querySelector(".js-text-input");

formChecker.onsubmit = function () {
    let y = formInputText.value;
    let parsed = parseFloat(y.replace(',','.'));
    console.log(parsed);
    if (!isNaN(parsed)){
        if (parsed < -3 || parsed >5){
            formInputText.style.background ="#dc5b3d";
            return false;
        }
        else {
            formInputText.style.background="#9ee75b";
            return true;
        }
    }
    else {
        formInputText.style.background="#dc5b3d";
        return false;
    }

}
//выборка чекбоксов
const checkboxes = document.querySelectorAll('input[type="checkbox"]');
let r = null;
checkboxes.forEach(checkbox => {
    checkbox.addEventListener('click', () => {
        if (checkbox.checked) {
            r = checkbox.value;
            checkboxes.forEach(otherCheckbox => {
                if (otherCheckbox !== checkbox) {
                    otherCheckbox.checked = false;
                }
            });
        } else {
            r = null;
        }
    });
});