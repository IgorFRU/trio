$(document).ready(function() {

    // $(document).on('click', '.pagination li a', function(e) {
    //     e.preventDefault();
    //     if ($(this).attr('href')) {
    //         var queryString = '';
    //         var allQueries = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
    //         if (allQueries[0].split('=').length > 1) {
    //             for (var i = 0; i < allQueries.length; i++) {
    //                 var hash = allQueries[i].split('=');
    //                 if (hash[0] !== 'page') {
    //                     queryString += '&' + hash[0] + '=' + hash[1];
    //                 }
    //             }
    //         }
    //         // console.log(hash, allQueries, $(this).attr('href'), queryString);
    //         window.location.replace($(this).attr('href') + queryString);
    //     }
    // });

    var oldScroll = 0;
    var clickToSmall = false;
    var marginMainMenu = $('.mainmenu').css('margin-top');
    var marginFirstSection = $('#firstsection').css('padding-top');

    $('.fastmenu__tosmall').click(function() {
        if ($('.fastmenu').hasClass('active')) {
            clickToSmall = false;
            $('.mainmenu').css('margin-top', marginMainMenu);
            $('#firstsection').css('padding-top', marginFirstSection);
        } else {
            clickToSmall = true;
            $('.mainmenu').css('margin-top', '45px');
            $('#firstsection').css('padding-top', '89px');
        }
        $('.fastmenu').toggleClass('active');
        $('.fastmenu__tosmall').toggleClass('active');
        $('.fastmenu__tosmall > span').toggleClass('active');
        $('.fastmenu').children().toggleClass('hide');
        //$('.logo').toggleClass('hide');	

    });

    $(window).scroll(function() {
        if ($(window).scrollTop() > 100) {
            $('.mainmenu__burger').addClass('active');
        } else {
            $('.mainmenu__burger').removeClass('active');
        }
        if (!clickToSmall) {
            if ($(window).scrollTop() > oldScroll + 50) {
                oldScroll = $(window).scrollTop();
                $('.fastmenu').addClass('active');
                $('.mainmenu').css('margin-top', '45px');
                $('.fastmenu__tosmall > span').addClass('active');
                $('.fastmenu__tosmall').addClass('active');
                //$('.logo').addClass('hide');
                $('.fastmenu').children().addClass('hide');
            };

            if (($(window).scrollTop() < oldScroll - 300) || ($(window).scrollTop() < 100)) {
                oldScroll = $(window).scrollTop();
                $('.fastmenu').removeClass('active');
                $('.fastmenu__tosmall > span').removeClass('active');
                $('.fastmenu__tosmall').removeClass('active');
                //$('.logo').removeClass('hide');
                $('.fastmenu').children().removeClass('hide');
                $('.mainmenu').css('margin-top', marginMainMenu);
            }
        }
    });

    if (($('.fastmenu__body__right__shopping_cart > span').html() == '') || ($('.fastmenu__body__right__shopping_cart > span').html() == 0)) {
        $('.fastmenu__body__right__shopping_cart > span').hide();
    }

    $('.fastmenu__body__right__search > i').click(function() {
        let search = $('.fastmenu__body__right__search > .search__form');
        search.toggleClass('active');

        //    if (search.hasClass('active')) {
        //        $('.fastmenu__body__tel').css('opacity', '0.5');
        //    }


    });

    // var prices = document.querySelectorAll('.products__card__price__new > div > span.value');

    // for (let i = 0; i < prices.length; i++) {
    //     if (prices[i].innerText % 1 == 0) {
    //         prices[i].innerText = parseInt(prices[i].innerText);
    //     }
    // }

    var salePackage = document.querySelectorAll('.products__card__price__new__package > div');

    //На карточках товаров при клике по кнопке "за 1 м.кв.", "за 1 уп" цена На продукт отображается соответствующая
    salePackage.forEach(function(btn, i) {
        btn.addEventListener('click', () => {
            const oldPrice = btn.parentNode.children;
            const showPriceValue = btn.parentNode.parentNode.querySelector('div > span.price_value');

            for (let i = 0; i < oldPrice.length; i++) {
                oldPrice[i].classList.remove('active');
            }
            showPriceValue.innerText = (Math.round(btn.dataset.price * 100) / 100).toLocaleString('ru');
            btn.classList.add('active');

        });
    });

    /**
     * Удаление всплывающего окна заказа товара, если его цена = 0
     */
    var salePackage2 = document.querySelectorAll('.products__card__price__new__package');
    salePackage2.forEach(function(btn, i) {
        const priceValue = btn.parentNode.parentNode.querySelector('.price_value').innerText;
        // if (btn.querySelectorAll('div').length < 2) {
        //     btn.parentNode.parentNode.parentNode.querySelector('.products__card__buttons').remove();
        // }
        if (priceValue <= 0) {
            btn.parentNode.parentNode.parentNode.querySelector('.products__card__buttons').remove();
            if (priceValue < 0) {
                btn.parentNode.parentNode.querySelector('.price_value').innerText = 0;
            }
        }
    });




    // var priceInInput = document.querySelectorAll('.products__card__buttons__input > input');
    // console.log(priceInInput);
    // priceInInput.forEach(function(input, i) {
    //     //input.value = 555;
    // });

    var pricePlus = document.querySelectorAll('.products__card__buttons__input > span.plus');
    pricePlus.forEach(function(plus, i) {
        const countInInput = plus.parentNode.parentNode.querySelector('.products__card__buttons__input > input');
        const forPayment = plus.parentNode.parentNode.querySelector('.for_payment > div > span');
        const unit = forPayment.getAttribute('data-unit');
        plus.addEventListener('click', () => {
            let count = countInInput.dataset.countpackage;
            count++;
            countInInput.value = Math.round(countInInput.dataset.count * count * 100) / 100 + ' ' + unit;
            countInInput.dataset.countpackage = count;
            forPayment.innerText = (Math.round(count * countInInput.dataset.price * 100) / 100).toLocaleString('ru');

        });
    });

    var priceMinus = document.querySelectorAll('.products__card__buttons__input > span.minus');
    priceMinus.forEach(function(minus, i) {
        const countInInput = minus.parentNode.querySelector('.products__card__buttons__input > input');
        const forPayment = minus.parentNode.parentNode.querySelector('.for_payment > div > span');
        const unit = forPayment.getAttribute('data-unit');
        minus.addEventListener('click', () => {
            let count = countInInput.dataset.countpackage;
            if (count > 1) {
                count--;
                countInInput.dataset.countpackage = count;
                countInInput.value = Math.round(countInInput.dataset.count * count * 100) / 100 + ' ' + unit;
                forPayment.innerText = (Math.round(count * countInInput.dataset.price * 100) / 100).toLocaleString('ru');
            }
        });
    });

    var one_click = document.querySelectorAll('.one_click');
    one_click.forEach(function(click, i) {
        click.addEventListener('click', () => {
            const quantity = click.parentNode.parentNode.querySelector('.products__card__buttons__input > input').value;
            const price = click.parentNode.parentNode.querySelector('.for_payment > div > span').innerText;
            var product = click.parentNode.parentNode.parentNode.querySelector('.products__card__info > .products__card__maininfo > .products__card__title > h3 > a');
            if (!product) {
                product = document.URL;
            }
            $('#modal_oneclick_quantity').val(quantity);
            $('#modal_oneclick_price').val(price + " руб.");

            $('#modal_oneclick_product').val(product);

            $('.modal_oneclick').addClass('active');
        });

    });

    /** Formatting price */
    (function() {
        let priceValues = document.querySelectorAll('.price_value');
        priceValues.forEach(element => {
            element.innerText = (Math.round(element.innerText * 100) / 100).toLocaleString('ru');
        });
    }());

    $('.help_btn').click(function() {
        $('.modal_send_question').addClass("active");
    });

    $('.modal_oneclick__header__close').click(function() {
        $('.modal_oneclick').removeClass("active");
    });
    $('.modal_send_question__header__close').click(function() {
        $('.modal_send_question').removeClass("active");
    });

    //-----------------
    //Управление миниатюрами и главным изображением в карточке товара на фронет

    let product_thumbnails = $('.product__thumbnails_item');
    let product_images = $('.product__images_item');

    product_thumbnails.each(function(index) {
        const image_id = $(this).data('thumb');
        $(this).on('click', function() {
            product_images.each(function(index2) {
                if ($(this).data('image') == image_id) {
                    if (!$(this).hasClass('active')) {
                        $(this).addClass('active');
                    }
                } else {
                    if ($(this).hasClass('active')) {
                        $(this).removeClass('active');
                    }
                }
            });
        });
    });

    //-----------
    // var mainProductImage = document.querySelector('.main_product_image > img');
    // var otherProductImagesContainer = document.querySelector('.images__container > .column');
    // var otherProductImages = document.querySelectorAll('.images__container__item > img');
    // var otherProductImagesSize = otherProductImages.length;

    // var otherProductImageUp = document.querySelector('.images__container span.up');
    // var otherProductImageDown = document.querySelector('.images__container span.down');

    // otherProductImages.forEach(function(img, i) {
    //     img.addEventListener('click', () => {
    //         const mainThumbnail = img.parentNode.parentNode.querySelector('.main');
    //         mainThumbnail.classList.remove('main');
    //         img.classList.add('main');
    //         mainProductImage.setAttribute('src', img.getAttribute('src'));
    //     });
    // });

    // var otherProductImagesPosition = 0;
    // var step = 0;

    // if (otherProductImageDown != null) {
    //     otherProductImageDown.addEventListener('click', () => {
    //         otherProductImagesPosition -= 75;
    //         step++;
    //         otherProductImagesContainer.style.top = otherProductImagesPosition + 'px';
    //         otherProductImageUp.style.display = 'block';
    //         if (otherProductImagesSize - step == 4) {
    //             otherProductImageDown.style.display = 'none';
    //         }
    //     });
    // }

    // if (otherProductImageUp != null) {
    //     otherProductImageUp.addEventListener('click', () => {
    //         otherProductImagesPosition += 75;
    //         step--;
    //         otherProductImagesContainer.style.top = otherProductImagesPosition + 'px';
    //         otherProductImageDown.style.display = 'block';
    //         if (step == 0) {
    //             otherProductImageUp.style.display = 'none';
    //         }
    //     });
    // }
    //Конец
    //-----------------------------------------  

    $('#question').click(function(event) {
        //event.preventDefault();
        //var $form = $(this);
        var phone = $('#question_phone').val();
        var name = $('#question_name').val();
        var question = $('#question_question').val();
        //console.log(phone);
        $.ajax({
            type: 'get',
            url: '/send-question',
            //data: $form.serialize()
            data: {
                phone: phone,
                name: name,
                question: question
            },
            // headers: {
            //     'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            // },
            success: function(data) {
                // $('#addArticle').modal('hide');
                // $('#articles-wrap').removeClass('hidden').addClass('show');
                // $('.alert').removeClass('show').addClass('hidden');
                // var str = '<tr><td>' + data['id'] +
                //     '</td><td><a href="/article/' + data['id'] + '">' + data['title'] + '</a>' +
                //     '</td><td><a href="/article/' + data['id'] + '" class="delete" data-delete="' + data['id'] + '">Удалить</a></td></tr>';

                //$('.table > tbody:last').append(str);
                $('.modal_send_question').removeClass("active");
                $('.modal_send_question').removeClass("active");

                UIkit.modal('#question-modal').hide();
            },
            error: function(msg) {
                UIkit.modal('#question-modal').hide();
            }
        });
        return false;
    });

    $('#modal_oneclick_btn').click(function(event) {
        var name = $('#modal_oneclick_name').val();
        var phone = $('#modal_oneclick_phone').val();
        var quantity = $('#modal_oneclick_quantity').val();
        var price = $('#modal_oneclick_price').val();
        var product = $('#modal_oneclick_product').val();
        $('.modal_oneclick').removeClass('active');

        let alert = $('.alert_clone').clone();
        alert.addClass('alert');
        $('.alerts').append(alert);
        alert.html('Ваше письмо отправляется...');
        alert.removeClass('alert_clone');
        alert.addClass('alert-secondary');
        setTimeout(() => {
            alert.fadeIn();
        }, 500);
        $.ajax({
            type: 'get',
            url: '/oneclick-purcache',
            data: {
                phone: phone,
                name: name,
                quantity: quantity,
                price: price,
                product: product,
            },
            success: function(data) {
                setTimeout(() => {
                    alert.fadeOut();
                }, 500);
                let success_alert = $('.alert_clone').clone();
                success_alert.addClass('alert');
                $('.alerts').append(success_alert);
                success_alert.html('Благодарим вас за заказ! Ваше письмо успешно отправлено! Скоро мы с вами свяжемся.');
                success_alert.removeClass('alert_clone');
                success_alert.addClass('alert-success');
                setTimeout(() => {
                    success_alert.fadeIn();
                }, 500);
                setTimeout(() => {
                    success_alert.fadeOut(800);
                }, 5500);
            },
            error: function(msg) {
                setTimeout(() => {
                    alert.fadeOut();
                }, 500);
                let error_alert = $('.alert_clone').clone();
                error_alert.addClass('alert');
                $('.alerts').append(error_alert);
                error_alert.html('Письмо не было отправлено. Попробуйте связаться с нами другим способом. Например, по телефону. Приносим извинения за неудобства.');
                error_alert.removeClass('alert_clone');
                error_alert.addClass('alert-danger');
                setTimeout(() => {
                    error_alert.fadeIn();
                }, 500);
                setTimeout(() => {
                    error_alert.fadeOut("slow");
                }, 5500);
                console.log(msg);
            }
        });
        return false;
    });

    $('#products_sort').change(function() {
        $.ajax({
            type: "POST",
            url: "/productsort",
            data: {
                productsort: $(this).val()
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // var response = $.parseJSON(data);
                // console.log(response);
                location.reload(true);
            },
            error: function(msg) {
                console.log(msg);
            }
        });

    });

    $('#products_per_page').change(function() {
        $.ajax({
            type: "POST",
            url: "/productsort",
            data: {
                products_per_page: $(this).val()
            },
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                // var response = $.parseJSON(data);
                // console.log(response);
                location.reload(true);
            },
            error: function(msg) {
                console.log(msg);
            }
        });

    });

    MenuHeight();

    $(window).on('resize', function() {
        MenuHeight();
    });

    function MenuHeight() {
        const win = $(this);
        const menuBlockNav = $('nav');
        const menuBlockNavTop = menuBlockNav[0].offsetTop + menuBlockNav.height() + 40; // + 20 px padding for menu window & + 20 padding bottom
        const menuBlock = $('.main-menu.uk-navbar-dropdown')[0];
        menuBlock.style.height = win.height() - menuBlockNavTop + 'px';
    }

    (function() {
        let confirm_property_button_all = document.querySelectorAll('.confirm_property_button');
        var properties_array = {};

        $('.property__item').change(function() {
            properties_array = propertiesChecked($('input[type=checkbox]:checked'));
            // let index = $(this).attr('data-property_id');
            // if (this.checked) {
            //     if (index in properties_array) {
            //         properties_array[index].push(this.value);
            //     } else {
            //         properties_array[index] = {};
            //         properties_array[index] = [this.value];
            //     }
            // } else {
            //     if (index in properties_array) {
            //         let index_to_delete = properties_array[index].indexOf(this.value);
            //         if (index_to_delete != -1) {
            //             properties_array[index].splice(index_to_delete, 1);
            //             if (properties_array[index].length == 0) {
            //                 delete properties_array[index];
            //             }
            //         }
            //     }
            // }

            let confirm_property_button = this.parentNode.parentNode.querySelector('.confirm_property_button');

            $.each(confirm_property_button_all, function(index, value) {
                if (value.classList.contains('active')) {
                    value.classList.remove('active');
                }
            });

            if (!confirm_property_button.classList.contains('active')) {
                confirm_property_button.classList.add('active');
            }


        });

        confirm_property_button_all.forEach(function(button, i) {
            button.addEventListener('click', (e) => {
                e.preventDefault();
                // console.log(properties_array);
                var new_address = '';
                for (var key in properties_array) {
                    // new_address += 'filter[' + key + ']=' + properties_array[key] + '&';
                    // console.log(properties_array[key], properties_array[key][0]);
                    new_address += `field[${key}]=${properties_array[key]}&`;
                }
                new_address = new_address.slice(0, new_address.length - 1);
                let old_url = window.location.href;
                let new_url = old_url.slice(0, AddressStringSearch(old_url, '[?]'));
                // new_address = `filter=[${new_address}]`
                // AddressStringSearch(old_url, "[?]");
                // console.log(new_address);

                window.location.replace(new_url + '?' + new_address);
            });
        });
    }());

    // function propertiesChecked(properties) {
    //     var properties_array = {};
    //     $.each(properties, function(i, element) {
    //         let index = '' + $(this).data("property_value");
    //         let values = [];
    //         if (index in properties_array) {
    //             // values.push($(this)[0].value);
    //             properties_array[index][0].push($(this)[0].value);
    //         } else {
    //             values = [$(this)[0].value];
    //             properties_array[index] = {};
    //             properties_array[index] = [values];
    //             values = [];
    //         }
    //     });
    //     // console.log(properties_array);
    //     return properties_array;
    // }

    function propertiesChecked(properties) {
        var properties_array = {};
        $.each(properties, function(i, element) {
            let index = '' + $(this).data("property_id");
            let values = [];
            if (index in properties_array) {
                // values.push($(this)[0].value);
                properties_array[index][0].push(strReplace($(this)[0].value));
            } else {
                values = [strReplace($(this)[0].value)];
                properties_array[index] = {};
                properties_array[index] = [values];
                values = [];
            }
        });
        // console.log(properties_array);
        return properties_array;
    }

    function AddressStringSearch(str, symbol) {
        if (str.search(symbol) != -1) {
            return str.search(symbol);
        } else {
            return str.length;
        }
    }

    function strReplace(string) {
        return string
            .replaceAll("%", "%25") // Процент
            .replaceAll(" ", "%20") // Пробел
            .replaceAll("\t", "%20") // Табуляция (заменяем на пробел)
            .replaceAll("\n", "%20") // Переход строки (заменяем на пробел)
            .replaceAll("\r", "%20") // Возврат каретки (заменяем на пробел)
            .replaceAll("!", "%21") // Восклицательный знак
            .replaceAll("\"", "%22") // Двойная кавычка
            .replaceAll("#", "%23") // Октоторп, решетка
            .replaceAll("\\$", "%24") // Знак доллара
            .replaceAll("&", "%26") // Амперсанд
            .replaceAll("'", "%27") // Одиночная кавычка
            .replaceAll("\\(", "%28") // Открывающаяся скобка
            .replaceAll("\\)", "%29") // Закрывающаяся скобка
            .replaceAll("\\*", "%2a") // Звездочка
            .replaceAll("\\+", "%2b") // Знак плюс
            .replaceAll(",", "%2c") // Запятая
            .replaceAll("-", "%2d") // Дефис
            .replaceAll("\\.", "%2e") // Точка
            .replaceAll("/", "%2f") // Слеш, косая черта
            .replaceAll(":", "%3a") // Двоеточие
            .replaceAll(";", "%3b") // Точка с запятой
            .replaceAll("<", "%3c") // Открывающаяся угловая скобка
            .replaceAll("=", "%3d") // Знак равно
            .replaceAll(">", "%3e") // Закрывающаяся угловая скобка
            .replaceAll("\\?", "%3f") // Вопросительный знак
            .replaceAll("@", "%40") // At sign, по цене, собачка
            .replaceAll("\\[", "%5b") // Открывающаяся квадратная скобка
            .replaceAll("\\\\", "%5c") // Одиночный обратный слеш '\'
            .replaceAll("\\]", "%5d") // Закрывающаяся квадратная скобка
            .replaceAll("\\^", "%5e") // Циркумфлекс
            .replaceAll("_", "%5f") // Нижнее подчеркивание
            .replaceAll("`", "%60") // Гравис
            .replaceAll("\\{", "%7b") // Открывающаяся фигурная скобка
            .replaceAll("\\|", "%7c") // Вертикальная черта
            .replaceAll("\\}", "%7d") // Закрывающаяся фигурная скобка
            .replaceAll("~", "%7e"); // Тильда
    }

});