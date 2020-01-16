<footer>
    <div class="wrap">
        <div class="footer_content">
            {{-- <div class="footer_content__card footer_content__about">
                <div class="footer_content__title">
                    О нас
                </div>
                <div>
                    <ul>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Доставка</a></li>
                        <li><a href="#">Оплата</a></li>
                        <li><a href="#">Статьи</a></li>
                    </ul>    
                </div>                
            </div> --}}
            <div class="footer_content__card footer_content__contacts">
                <div class="footer_content__title">
                    Контакты
                </div>
                <div>
                    <span class="footer_content__card__phone"><a href="tel:+79788160166">8(978) 816 01 66</a></span>
                    <p>Республика Крым</p>
                    <p>г. Симферополь</p>
                    <p>проспект Победы, 129/2</p>
                </div>
            </div>
            <div class="footer_content__card footer_content__items">
                <div class="footer_content__title">
                    Популярные категрии
                </div>
                <div>
                    <ul>
                        @forelse ($top_categories as $item)
                            <li><a href="/catalog/{{ $item->slug }}">{{ $item->category }}</a></li>
                        @empty
                            
                        @endforelse
                    </ul>
                </div>
            </div>
            {{-- <div class="footer_content__card footer_content__socials">
                <div class="footer_content__title">
                    Мы в соцсетях
                </div>
            </div> --}}
        </div>
    </div>
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

</footer>