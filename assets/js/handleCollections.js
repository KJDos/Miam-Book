$('#add-step').click(function () {
    const index = +$('#widgets-counter').val();

    const template = $('#recipe_steps').data('prototype').replace(/__name__/g, index);
    $('#recipe_steps').append(template); +
    $('#widgets-counter').val(index + 1);
    deleteCollection();
});

function deleteCollection() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#recipe_steps div.form-group').length;
    $('#widgets-counter').val(count);
}
updateCounter();
deleteCollection();

/*********************************************************************************************************/

$('#add-ingredient').click(function () {
    const index = +$('#widgets-counter-ingredients').val();

    const template = $('#recipe_ingredients').data('prototype').replace(/__name__/g, index);
    $('#recipe_ingredients').append(template); +
    $('#widgets-counter-ingredients').val(index + 1);
    deleteCollection();
});

function deleteCollection() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounterIngredients() {
    const count = +$('#recipe_ingredients div.form-group').length;
    $('#widgets-counter-ingredients').val(count);
}
updateCounterIngredients();
deleteCollection();