@extends('layout')

@section('title', 'Pantalla Inicial')

@section('content')
<div style="display: flex; justify-content: center; padding: 20px;">
    <div style="width: 100%; max-width: 1400px;">
        {{-- Imagen principal logo2.png --}}
        <div style="text-align: center; margin-bottom: 30px;">
            <img src="{{ asset('images/logo2.png') }}" alt="Promoción de Ropa" style="max-width: 100%; height: auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        </div>

        {{-- Dos imágenes, una a cada lado --}}
        <div class="two-images-promo" style="display: flex; justify-content: space-around; align-items: center; margin-bottom: 40px; gap: 20px;">
            <img src="https://boliviauniverso.com/images/front-end/home/bolivia-0.jpg.webp?v=3.2" alt="Prenda de promoción izquierda" style="max-width: 48%; height: auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
            <img src="https://boliviauniverso.com/images/front-end/home/divina-0.jpg.webp?v=3.2" alt="Prenda de promoción derecha" style="max-width: 48%; height: auto; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.2);">
        </div>

        {{-- Título de la sección --}}
        <h2 style="text-align: center; margin-bottom: 30px; color: #273e52;">SEPTIEMBRE DE LOCURA</h2>
        
        {{-- Cuadrícula de 3x3 de imágenes --}}
        <div class="prendas-grid-full">
            @php
                $prendas = [
                    ['imagen' => 'https://shoprepurpose.org/cdn/shop/files/2_174b840e-a67c-44d4-9c4a-281efa9588ca_300x.png?v=1755105927'],
                    ['imagen' => 'https://img01.ztat.net/article/spp-media-p1/a956474f133f4c818458e1b86d935a98/a87e137adcad431d8fc68bec374bd792.jpg?imwidth=300&filter=packshot'],
                    ['imagen' => 'https://shoprepurpose.org/cdn/shop/files/5_0124a636-fa69-43e6-8012-578cf291f371_300x.png?v=1755115385'],
                    ['imagen' => 'https://shoprepurpose.org/cdn/shop/files/13_4387aee5-b367-4620-a524-98484c8e3a2c_300x.png?v=1755115916'],
                    ['imagen' => 'https://is4.revolveassets.com/images/p4/n/tv/PAIG-MJ79_V5.jpg'],
                    ['imagen' => 'https://is4.revolveassets.com/images/p4/n/tv/PAIG-MS26_V4.jpg'],
                    ['imagen' => 'https://is4.revolveassets.com/images/p4/n/tv/PAIG-MS14_V3.jpg'],
                    ['imagen' => 'https://img01.ztat.net/article/spp-media-p1/8bc0497c83c0469696b1a3ee30f54785/43ed67e7d6564f518c2ccdac511f22fc.jpg?imwidth=300&filter=packshot'],
                    ['imagen' => 'https://img01.ztat.net/article/spp-media-p1/8ebb6351078b41b490a5230f986ae231/1584d8c46c1247e585f9bef9a5b3aaa5.jpg?imwidth=300&filter=packshot'],
                ];
            @endphp
            
            @foreach($prendas as $prenda)
            <img src="{{ $prenda['imagen'] }}" alt="Prenda de ropa" class="prenda-imagen-full">
            @endforeach
        </div>
    </div>
    
</div>

<style>
    /* Estilos para la nueva cuadrícula que ocupa todo el espacio */
    .prendas-grid-full {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
    }

    /* Estilo para las imágenes dentro de la cuadrícula */
    .prenda-imagen-full {
        width: 100%;
        height: 300px;
        object-fit: cover;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .prenda-imagen-full:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 20px rgba(0,0,0,0.4);
        z-index: 10;
    }
    .p{
        
    }
    /* Oculta los estilos de la cuadrícula anterior para evitar conflictos */
    .prendas-grid, .prenda-card, .prenda-info { display: none; }
</style>
@endsection