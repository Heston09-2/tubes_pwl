@props(['src' => asset('image/logos.png'), 'alt' => 'Logo', 'width' => '100', 'height' => '100'])

<div style="display: flex; justify-content: center; align-items: center;">
    <img src="{{ $src }}" alt="{{ $alt }}" width="{{ $width }}" height="{{ $height }}" style="object-fit: contain;">
</div>
