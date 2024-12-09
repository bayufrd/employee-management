<form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button type="submit">Import Excel</button>
</form>

<a href="{{ route('export.pdf', $companyId) }}">Export PDF</a>
