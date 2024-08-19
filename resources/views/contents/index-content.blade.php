<table border="1" cellspacing="0" cellpadding="10">
    <thead>
        <tr>
            <th>رقم المحتوى</th>
            <th>المحتوى</th>
            <th>تاريخ الإنشاء</th>
            <th>الخيارات</th>
        </tr>
    </thead>
    <tbody>
        @foreach($contents as $content)
            <tr>
                <td>{{ $content->id }}</td>
                <td>{!! $content->content !!}</td>
                <td>{{ $content->created_at }}</td>
                <td>
                    <a href="{{ route('content.edit', $content->id) }}">تعديل</a>
                    <form action="{{ route('content.destroy', $content->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">حذف</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
