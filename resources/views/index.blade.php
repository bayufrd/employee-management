<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Management</title>
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />

    <!-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet" /> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script> -->
    <script src="{{ asset('js/select2.min.js') }}"></script>

</head>

<body>
    <h1>Employee Management</h1>

    <!-- Export PDF -->
    <a href="/export/1">Export PDF</a>

    <!-- Form Import Excel -->
    <form action="{{ route('import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="file" required>
        <button type="submit">Import Excel</button>
    </form>

    <!-- Form Add Employee -->
    <form action="/employees/store" method="POST">
        @csrf

        <!-- Input Name -->
        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
        @error('name') 
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <!-- Input Email -->
        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
        @error('email') 
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <!-- Dropdown Select2 -->
        <select id="company-dropdown" name="company_id" required>
            <option value="">Select Company</option>
        </select>
        @error('company_id') 
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">Add Employee</button>
    </form>

    <!-- Select2 Configuration -->
    <script>
        $(document).ready(function () {
            $('#company-dropdown').select2({
                ajax: {
                    url: '{{ route("get.companies") }}', // URL API
                    dataType: 'json', // Format data
                    delay: 250, // Delay untuk pencarian
                    processResults: function (data) {
                        // Konversi data JSON untuk Select2
                        return {
                            results: data.data.map(function (company) {
                                return { id: company.id, text: company.name }; // Format data untuk Select2
                            }),
                            pagination: {
                                more: data.pagination.more // Informasi paginasi
                            }
                        };
                    },
                    cache: true // Aktifkan cache
                },
                placeholder: "Select Company", // Placeholder dropdown
                minimumInputLength: 0 // Minimum karakter untuk memulai pencarian
            });
        });
    </script>

</body>
</html>
