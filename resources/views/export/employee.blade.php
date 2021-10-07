<table>
    <thead>
    <tr role="row">
        <th style="font-weight: bold; width: 5%; ">ID</th>
        <th style="font-weight: bold; width: 18%;">First Name</th>
        <th style="font-weight: bold; width: 18%;">Last Name</th>
        <th style="font-weight: bold; width: 20%;">E-mail</th>
        <th style="font-weight: bold; width: 20%;">Phone</th>
        <th style="font-weight: bold; width: 18%;">Company</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($datalist as $rs)
        <tr class="odd">
            <td>{{ $rs -> id}} </td>
            <td>{{ $rs -> firstname}} </td>
            <td>{{ $rs -> lastname}}</td>
            <td>{{ $rs -> email}}</td>
            <td>{{ $rs -> phone}}</td>
            <td>
                @foreach ($data as $ra)
                    @if($rs -> company == $ra-> id)
                        {{$ra-> name}}
                    @endif
                @endforeach
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
