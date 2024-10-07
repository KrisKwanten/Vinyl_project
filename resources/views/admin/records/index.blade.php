<x-vinylshop-layout>
    <x-slot name="title">The Vinyl Shop: records</x-slot>
    <x-slot name="subtitle">Records</x-slot>


<ul>
    <?php
    foreach ($records as $record){
        echo "<li> $record </li>";
        //echo '<li>' . $record . '</li>';
    }
    ?>
</ul>
</x-vinylshop-layout>
