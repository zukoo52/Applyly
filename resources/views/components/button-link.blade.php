@props([
    'url' => '/jobs/create' ,
    'icon'=> null,
    'block'=> false,
    'BgColor' => 'bg-yellow-500',
    'HoverClass' => 'hover:bg-yellow-600',
    'TextClass' => 'text-black',
    
    
    
    ])

<a href="{{ $url }}" class="{{$BgColor}} {{$HoverClass}} {{$TextClass}} px-4 py-2 rounded hover:shadow-md transition duration-300 {{ $block ? 'block' : ''}}">
   @if($icon)
    <i class="fa fa-{{$icon}}" mr-1"></i>
    @endif
    {{ $slot }}
</a>
