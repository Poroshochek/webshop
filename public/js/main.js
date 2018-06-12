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

$('#cart .modal-body').on('click', '.del-item', function () {
    let id = $(this).data('id');
    $.ajax({
        url: '/webshop/cart/delete',
        data: {id: id},
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function() {
            alert('Oooooups, something wrong!');
        }
    })
});


function showCart(cart) {
    if ($.trim(cart) == '<h3>Корзина пуста</h3>') {
     $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'none');
    } else {
        $('#cart .modal-footer a, #cart .modal-footer .btn-danger').css('display', 'inline-block');
    }
    $('#cart .modal-body').html(cart);
    $('#cart').modal();
    if ($('.cart-sum').text()) {
        $('.simpleCart_total').html($('#cart .cart-sum').text());
    } else {
        $('.simpleCart_total').text('Карзина пустая');
    }
}

function getCart() {
    $.ajax({
        url: '/webshop/cart/show',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            console.log('Error! Please try again later');
        }
    });
}

function clearCart() {
    $.ajax({
        url: '/webshop/cart/clear',
        type: 'GET',
        success: function (res) {
            showCart(res);
        },
        error: function () {
            console.log('Error! Please try again later');
        }
    });
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