@props(['align' => 'right', 'width' => '48', 'contentClasses' => 'py-1 bg-white'])

@php
switch ($align) {
case 'left':
$alignmentClasses = 'origin-top-left left-0';
break;
case 'top':
$alignmentClasses = 'origin-top';
break;
case 'right':
default:
$alignmentClasses = 'origin-top-right right-0';
break;
}

switch ($width) {
case '48':
$width = 'w-48';
break;
case '52':
$width = 'w-52';
break;
case 'flex':
$width = 'flex';
break;
case 'screen-50':
$width = 'w-screen-50';
break;
case 'screen-30':
$width = 'w-screen-30';
break;
}
@endphp

<div class="relative bg-transparent" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
    <div @click="open = ! open">
        {{ $trigger }}
    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95"
        class="absolute z-50 mt-2 w-96 md:{{ $width }} rounded-md flex-wrap overflow-y-auto max-h-screen max-w-52 sm:max-w-screen-lg {{ $alignmentClasses }}"
        style="display: none;" @click="open = false">
        <div class="rounded-lg bg-white ring-1 ring-black ring-opacity-5 w-full {{ $contentClasses }}">
            {{ $content }}
        </div>
    </div>
</div>
