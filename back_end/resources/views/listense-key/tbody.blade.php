@foreach ($response as $item)
    <tr>
        <td data-label="Code">{{ $item->code }}</td>
        <td data-label="Url">{{ $item->url }}</td>
        <td data-label="User">{{ $item->user }}</td>
        <td data-label="Email">{{ $item->email }}</td>
        <td data-label="Product">
            <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png" alt=""
                width="50" />
        </td>
        <td data-label="Action">
            <div class="btn-group">
                <button type="button" class="btn btn-info">Show</button>
                <button type="button" class="btn btn-warning btn-edit" data-id="{{ $item->id }}">
                    Edit
                </button>
                <button type="button" class="btn btn-danger btn-delete" data-id="{{ $item->id }}">
                    Delete
                </button>
            </div>
        </td>
    </tr>
@endforeach
