
$(document).ready(function () {

    $('#form_plan').submit(function (e) {
        if ($('#plan_code').val() == '') {
            e.preventDefault();
            alert('Escolha um plano');
        }
    });

    $('.plan').click(function () {
        $('#plan_code').val($(this).find('input[name="code"]').val());

        $('.plan').removeClass('active');
        $(this).addClass('active');

        updateValue()
    });


    $('#add_person').click(function () {
        $('form .content').append($("#clone").clone().html());
    });

});

function updateValue() {
    let one = $('.plan.active').find('input[name="range_one"]');
    let price_one = 0;
    for (let i = 0; i < one.length; i++) {
        if (one[i].dataset.lifes <= $('#form_plan').find('.name').length) {
            price_one = one[i].value;
        }
    }

    let two = $('.plan.active').find('input[name="range_two"]');
    let price_two = 0;
    for (let i = 0; i < two.length; i++) {
        if (two[i].dataset.lifes <= $('#form_plan').find('.name').length) {
            price_two = two[i].value;
        }
    }

    let three = $('.plan.active').find('input[name="range_three"]');
    let price_three = 0;
    for (let i = 0; i < three.length; i++) {
        if (three[i].dataset.lifes <= $('#form_plan').find('.name').length) {
            price_three = three[i].value;
        }
    }
    let ages = $('#form_plan').find('.age');
    let total_value = 0;
    for (let i = 0; i < ages.length; i++) {
        if (ages[i].value) {
            if (ages[i].value < 18) {
                total_value += parseFloat(price_one);
            } else if (ages[i].value > 17 && ages[i].value < 40) {
                total_value += parseFloat(price_two);
            } else if (ages[i].value > 39) {
                total_value += parseFloat(price_three);
            }
        }

    }
    $('#valor_total').find('span').html('R$ ' + total_value)
}