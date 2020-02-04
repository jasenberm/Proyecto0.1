<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Ruc</th>
        <th>Dueño</th>
        <th>Correo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($restaurants as $key=>$restaurant)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $restaurant->name_restaurant }}</td>
            <td>{{ $restaurant->category_restaurant->name }}</td>
            <td>{{ $restaurant->ruc }}</td>
            <td>{{ $restaurant->user->name }} {{ $restaurant->user->last_name }}</td>
            <td>{{ $restaurant->user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>