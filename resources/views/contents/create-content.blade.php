<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء محتوى جديد</title>
    <!-- تحميل CKEditor من CDN -->
    <script src="https://cdn.ckeditor.com/4.16.1/standard/ckeditor.js"></script>
</head>
<body>
    <div class="container">
        <h1>إنشاء محتوى جديد</h1>

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

        <form action="{{ route('content.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="content">المحتوى</label>
                <textarea name="content" id="editor1" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">حفظ</button>
        </form>
    </div>

    <script>
        CKEDITOR.replace('editor1');
    </script>
</body>
</html>
