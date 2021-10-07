<table>
    <thead>
    <tr role="row">
        <th style="font-weight: bold; width: 5%;">ID</th>
        <th style="font-weight: bold; width: 13%;">Company</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $ra)
        <tr class="odd">
            <td>
                {{$ra->id}}
            </td>
            <td>
                {{$ra->name}}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

