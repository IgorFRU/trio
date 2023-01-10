<footer>
    <section class="uk-section uk-section-secondary uk-section-small uk-light">
        <div class="uk-container">
            <div class="uk-grid-medium uk-child-width-1-1 uk-child-width-1-3@m uk-grid uk-grid-stack" uk-grid="">
                <div class="uk-first-column">
                    <a class="uk-logo uk-text-primary uk-text-left" href="{{ route('index') }}">
                        <div>
                            <span class="uk-text-bold uk-text-uppercase">Паркетный мир</span>
                        </div>
                    </a>
                    {{-- <a class="uk-logo" href="index.html"><img src="images/logo-inverse.svg" alt="Logo" width="90" height="32"></a> --}}
                    <p class="uk-text-small">Продажа напольных покрытий в Крыму. Профессиональная укладка с использованием только профессиональных материалов. Доставка паркета по Симферополю и Крыму.</p>
                    <iframe src="https://yandex.ru/sprav/widget/rating-badge/1042612800" width="150" height="50" frameborder="0"></iframe>
                </div>

                <nav class="uk-grid-small uk-child-width-1-2 uk-grid" uk-grid="">
                    <div class="uk-first-column">
                        <ul class="uk-nav uk-nav-default">
                            @forelse ($categories as $category)
                                @if ($loop->iteration > 10)
                                    @break
                                @endif
                                <li><a href="{{ route('category', $category->slug) }}">{{ $category->category }}</a></li>
                            @empty
                                
                            @endforelse
                            <li><a href="{{ route('categories') }}" class="uk-text-bold uk-text-uppercase">Все категории товаров</a></li>
                        </ul>
                    </div>
                    <div>
                        <ul class="uk-nav uk-nav-default">
                            @forelse ($manufactures as $manufacture)
                                @if ($loop->iteration > 10)
                                    @break
                                @endif
                                <li><a href="{{ route('manufacture', $manufacture->slug) }}">{{ $manufacture->manufacture }}</a></li>
                            @empty
                                
                            @endforelse
                            <li><a href="{{ route('manufactures') }}" class="uk-text-bold uk-text-uppercase">Все производители</a></li>
                        </ul>
                    </div>
                </nav>

                <div class="">
                    <ul class="uk-list uk-text-small">
                        <li>
                            <a href="tel:+79788160166" class="uk-link-muted">
                                <span class="uk-margin-small-right uk-icon" uk-icon="receiver"></span>
                                <span>8(978) 816 01 66</span>
                            </a>
                        </li>
                        <li>
                            <a class="uk-link-muted" href="#">
                                <span class="uk-margin-small-right uk-icon" uk-icon="mail"></span>
                                <span class="tm-pseudo">info@parketpro.com</span>
                            </a>
                        </li>
                        <li>
                            <div class="uk-text-muted">
                                <span class="uk-margin-small-right uk-icon" uk-icon="location"></span>
                                <span>пр.&nbsp;Победы,&nbsp;129, Симферополь,&nbsp;Крым</span>
                            </div>
                        </li>
                        <li>
                            <div class="uk-text-muted">
                                <span class="uk-margin-small-right uk-icon" uk-icon="clock"></span>
                                <span class="uk-display-inline-block">ПН-ПТ 09:00–18:00</span>
                                <span class="uk-display-block">СБ 09:00–16:00</span>
                                <span class="uk-display-block">ВС выходной</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <div class="modal_oneclick">
        <div class="modal_oneclick__header">
            Быстрый заказ
            <div class="modal_oneclick__header__close">
    
            </div>
        </div>
        <form id="modal_oneclick">
            @csrf
            <input type="text" id="modal_oneclick_name" name="name" placeholder="Имя" required>
            <input type="text" id="modal_oneclick_phone" name="phone" placeholder="Номер телефона" required>
            <input type="text" id="modal_oneclick_quantity" name="quantity" placeholder="Количество" readonly>
            <input type="text" id="modal_oneclick_price" name="price" placeholder="Сумма заказа" readonly>
            
            <input type="hidden" id="modal_oneclick_product" name="product">
            <input type="hidden" id="modal_oneclick_url" name="url">
            <div id="modal_oneclick_btn">Отправить</div>
        </form>
    </div>
<div class="alerts">
    <div class="alert_clone shadow hide" role="">
        
    </div>
</div>
<a href="" uk-totop uk-scroll class="to_up"></a>
<script type='text/javascript'>
(function () {
    window['yandexChatWidgetCallback'] = function() {
        try {
            window.yandexChatWidget = new Ya.ChatWidget({
                guid: '30aabd02-3fdf-9f47-5a65-ecac4d8186c3',
                buttonText: '',
                title: 'Чат с "Паркетным миром"',
                theme: 'light',
                collapsedDesktop: 'never',
                collapsedTouch: 'never'
            });
        } catch(e) { }
    };
    var n = document.getElementsByTagName('script')[0],
        s = document.createElement('script');
    s.async = true;
    s.charset = 'UTF-8';
    s.src = 'https://yastatic.net/s3/chat/widget.js';
    n.parentNode.insertBefore(s, n);
})();
</script>
</footer>