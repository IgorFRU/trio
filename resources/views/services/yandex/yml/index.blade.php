
<?xml version="1.0" encoding="UTF-8"?>
<yml_catalog date="{{ $today }}">
    <shop>
        
        <name>Паркетный мир</name>
        <company>ИП Дюндик Александр Константинович</company>
        <url>{{ url('/') }}</url>
        <currencies>
            <currency id="RUR" rate="1"/>
        </currencies>
        <categories>
            @forelse ($categories as $category)
                <category id="{{ $category->id }}" @if ($category->have_parent) parentId="{{ $category->parent_id }}" @endif>{{ $category->category }}</category>
            @empty
                
            @endforelse
        </categories>
        {{-- <delivery-options>
            <option cost="200" days="1-7"/>
        </delivery-options>
        <pickup-options>        <!-- условия самовывоза -->
            <option cost="0" days="1-3"/>
        </pickup-options> --}}
        <offers>
            @forelse ($products as $product)
                <offer id="{{ $product->autoscu }}">
                    <name>{{ $product->category->category ?? '' }} {{ $product->manufacture->manufacture ?? '' }} {{ $product->product ?? '' }} {{ $product->scu ?? '' }} </name>
                    <url>{{ route('product', ['category' => $product->category->slug, 'product' => $product->slug]) }}</url>                    
                    <price>{{ $product->discount_price }}</price>
                    @if ($product->actually_discount)
                        <oldprice>{{ $product->old_price }}</oldprice>                        
                    @endif
                    <currencyId>RUR</currencyId>
                    <categoryId>{{ $product->category->id ?? '' }}</categoryId>
                    <picture>@if($product->images->count()){{ asset('imgs/products')}}/{{ $product->images[0]->image}}@endif</picture>
                    <param name="Единица измерения">{{ $product->unit->unit }}</param>
                    @if ($product->description)
                        <description>
                            <![CDATA[
                                {{ mb_substr(strip_tags($product->description), 0, 3000) }}
                            ]]>
                        </description>
                    @endif
                    {{-- <delivery>true</delivery>
                    <delivery-options>
                        <option cost="300" days="1" order-before="18"/>
                    </delivery-options> --}}
                    
                    <delivery>true</delivery> 
                    <pickup>true</pickup>
                    @if ($product->in_stock)
                        <store>true</store>
                    @else
                        <store>false</store>
                    @endif
                    {{-- <param name="Цвет">белый</param> --}}
                    {{-- <weight>3.6</weight> --}}
                    @if ($product->packaging)
                        <sales_notes>Продаётся кратно упаковкам по {{ $product->unit_in_package }} {{ $product->unit->unit }}.</sales_notes>  
                    @endif
                    <sales_notes>Доставляем по Крыму транспортными компаниями и личным транспортом</sales_notes>                    
                    {{-- <dimensions>20.1/20.551/22.5</dimensions> --}}
                </offer>
            @empty
                
            @endforelse
            
        </offers>
        <gifts>
            <!-- подарки не из прайс‑листа -->
        </gifts>
        <promos>
            <!-- промоакции -->
        </promos>
    </shop>
</yml_catalog>

