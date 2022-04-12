<!DOCTYPE html>
<html lang="en">
<head>
    <title>{{$requisition->name}}</title>
</head>
<body>
<h1>Requisition:</h1>
<p>Name: <strong>{{ $requisition->name }}</strong></p>
<p>Description: <strong>{{ $requisition->description }}</strong></p>
<p>Created at: <strong>{{ $requisition->created_at->format('M d Y') }}</strong></p>
@if($requisition->items?->count() > 0)
    <table class="">
        <tr>
            <th>Name</th>
            <th>Reference</th>
            <th>Created at</th>
        </tr>
        @foreach($requisition->items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->reference }}</td>
                <td>{{ $item->created_at->format('M d Y') }}</td>
            </tr>
        @endforeach
    </table>
@endif
</body>
</html>
