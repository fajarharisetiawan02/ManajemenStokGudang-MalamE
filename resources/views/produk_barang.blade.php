<html>
<head>
    <title>List Barang</title>
</head>
<body>

<h2>List Barang</h2>

<table border="1" cellpadding="10">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Harga</th>
        </tr>
    </thead>

    <tbody>
        @foreach($data as $dataku)
        <tr>
            <td>{{ $dataku['id'] }}</td>
            <td>{{ $dataku['nama'] }}</td>
            <td>{{ $dataku['harga'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>