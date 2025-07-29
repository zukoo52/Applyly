<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$title ?? 'Workopia | find and list jobs'}}</title>
</head>

<body>
    <!-- @include('components.header')  meka wenuwata < x-header/> dnnath plwan -->
    <h1>Layout components</h1>
    <x-header />
    <main class="container mx-auto p-4 mt-4">
        {{$slot}}
    </main>
</body>

</html>