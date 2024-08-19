<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المحتوى</title>
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1>تعديل المحتوى</h1>

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="color: red;">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('content.update', $content->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="content">المحتوى</label>
                <textarea name="content" id="editor1" class="form-control">{{ $content->content }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">تحديث</button>
        </form>
    </div>
    <form action="{{ route('content.destroy', $content->id) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">حذف</button>
</form>

    <script>
        CKEDITOR.replace('editor1');
    </script>
</body>
</html>
