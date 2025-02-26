<li class="nav-item">
    <a wire:navigate {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
</li>

<a href="index.html" class="">
    <i class="fas fa-desktop"></i>
    <span>{{ $slot }}</span>
</a>
