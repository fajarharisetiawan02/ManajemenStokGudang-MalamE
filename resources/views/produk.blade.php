<h1>Data Produk</h1>

<table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nama</th>
        <th>Harga</th>
    </tr>

    @foreach ($data as $item)
    <tr>
        <td>{{ $item['id'] }}</td>
        <td>{{ $item['nama'] }}</td>
        <td>{{ $item['harga'] }}</td>
    </tr>
    @endforeach

</table>