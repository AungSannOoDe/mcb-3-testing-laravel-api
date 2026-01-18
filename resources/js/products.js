import $ from 'jquery';

$(document).ready(function(){
    $('#category').on('change', function(){
    const categoryId = this.value;
    $('#product').html('<option value="">ကုန်အမည်ရွေးပါ</option>'); // reset

    if(categoryId && categoryId != 0){
        $.ajax({
            url: '/products/' + categoryId,
            type: 'GET',
            dataType: 'json', // important!
            success: function(res){
                $.each(res, function(key, value){
                    $('#product').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                });
            },
            error: function(xhr){
                console.log('AJAX error:', xhr);
            }
        });
    }
});


    $('#price').on('input', function() {
        // get values as numbers
        const price = parseFloat($(this).val()) || 0;
        const netWeight = parseFloat($('#netweight').val()) || 0;

        // calculate total
        const totalPrice = netWeight * price;

        // set the total input value
        $('#total').val(totalPrice.toFixed(2)); // optional: 2 decimal places
    });
    $('#netweight').on('input', function() {
        // get values as numbers
        const netWeight = parseFloat($(this).val()) || 0;
        const price = parseFloat($('#price').val()) || 0;

        // calculate total
        const totalPrice = netWeight * price;

        // set the total input value
        $('#total').val(totalPrice.toFixed(2)); // optional: 2 decimal places
    });

})