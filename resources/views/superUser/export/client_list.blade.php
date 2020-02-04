<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Nombres</th>
        <th>Apellidos</th>
        <th>Correo</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $key=>$user)
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->email }}</td>
        </tr>
    @endforeach
    </tbody>
</table>