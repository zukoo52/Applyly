<x-layout>
    <x-slot name="title">Create New Job</x-slot>
    <br>
    <form action="/jobstore" method="post">
    @csrf    
    <input type="text" name="title" placeholder="title">
        <br><br>
        <input type="text" name="description" placeholder="description">
        <br><br>
        
        <button type="submit"> Submit</button>
    </form>
</x-layout>
    
