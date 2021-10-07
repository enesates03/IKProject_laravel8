<table>
    <thead>
    <tr role="row">
        <th style="font-weight: bold; width: 5%; ">ID</th>
        <th style="font-weight: bold; width: 20%;">Name</th>
        <th style="font-weight: bold; width: 25%;">Address</th>
        <th style="font-weight: bold; width: 17%;">Phone</th>
        <th style="font-weight: bold; width: 17%;">E-mail</th>
        <th style="font-weight: bold; width: 18%;">Website</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datalist as $rs)
        <tr class="odd">
            <td>{{$rs->id}}</td>
            <td>{{$rs->name}}</td>
            <td>{{$rs->address}}</td>
            <td>{{$rs->phone}}</td>
            <td>{{$rs->email}}</td>
            <td>{{$rs->website}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
