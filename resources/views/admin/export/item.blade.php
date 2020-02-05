<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Categoria</th>
        <th>Nombre</th>
        <th>Precio</th>
    </tr>
    </thead>
    <tbody>
    @foreach($items as $key=>$item)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $item->category->name }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->price }}</td>
        </tr>
    @endforeach
    </tbody>
</table>