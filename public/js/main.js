/*Cart*/

$('body').on('click', '.add-to-card-link', function(e){
    e.preventDefault();
    let id = $(this).data('id'),
        qty = $('.quantiy input').val() ? $('.quantiy input').val() : 1,
        mod = $('.available select').val();
    $.ajax({
        url: '/webshop/cart/add',
        data: {id: id, qty: qty, mod: mod},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            console.log('Error! Please try again later');
        }
    });
});

function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
     $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
}

/*Cart*/


$('#currency').change(function(){
    window.location = 'currency/change?curr=' + $(this).val();
    console.log($(this).val());
});

$('.available select').on('change', function() {
    let modId = $(this).val();
    let color = $(this).find('option').filter(':selected').data('title');
    let price = $(this).find('option').filter(':selected').data('price');
    let basePrice = $('#base-price').data('base');

    if (price) {
        $('#base-price').text(symbolLeft + price + symbolRight);
    } else {
        $('#base-price').text(symbolLeft + basePrice + symbolRight);
    }
});