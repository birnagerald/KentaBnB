$('#add-image').click(function () {
    // getting the index of the next field
    const index = +$('#widgets-counter').val();

    //getting the proto of entrys
    const tmpl = $('#ad_images').data('prototype').replace(/__name__/g, index);

    //put this code into the div
    $('#ad_images').append(tmpl);

    $('#widgets-counter').val(index + 1);

    //Handle delete button
    handleDeleteButtons();
});

function handleDeleteButtons() {
    $('button[data-action="delete"]').click(function () {
        const target = this.dataset.target;
        $(target).remove();
    });
}

function updateCounter() {
    const count = +$('#ad_images div.form-group').length;

    $('#widgets-counter').val(count);
}
updateCounter();
handleDeleteButtons();