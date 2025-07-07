@extends('layouts.admin_master')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title text-center">Student User Create </h4>

                    @if(session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('student.register.submit') }}" method="POST">
                        @csrf

                        <!-- User ID Field -->
                        <div class="mb-3">
                            <label class="form-label">Student User ID</label>
                            <input type="text" class="form-control" id="dhakila_number" name="dhakila_number" value="{{ old('dhakila_number') }}" required>
                            @error('dhakila_number') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Auto-Fetched Student Name -->
                        <div class="mb-3">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control" id="student_name" disabled>
                        </div>

                        <!-- Password Field -->
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" name="password" required>
                            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mb-3">
                            <label class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" name="password_confirmation" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
    <!-- <script>
    document.getElementById('dhakila_number').addEventListener('input', function() {
        let dhakilaNumber = this.value;

        if (dhakilaNumber.length > 3) {
            fetch('{{ route('student.fetch-name') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({ dhakila_number: dhakilaNumber })
            })
            .then(response => response.json())
            .then(data => {
                console.log(data); // এখানে কনসোল লগ করে দেখুন ডাটা আসছে কিনা
                if (data.success) {
                    document.getElementById('student_name').value = data.name;
                } else {
                    document.getElementById('student_name').value = '';
                }
            })
            .catch(error => console.error('Error fetching data:', error));
        } else {
            document.getElementById('student_name').value = '';
        }
    });
</script> -->

    <script>
        document.getElementById('dhakila_number').addEventListener('input', function() {
    let dhakilaNumber = this.value;

    if (dhakilaNumber.length > 3) {
        fetch('{{ route('student.fetch-name') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ dhakila_number: dhakilaNumber })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data); // Debugging জন্য
            
            if (data.success) {
                document.getElementById('student_name').value = data.name;
            } else {
                document.getElementById('student_name').value = '';
            }
        })
        .catch(error => console.error('Error fetching data:', error));
    } else {
        document.getElementById('student_name').value = '';
    }
});

    </script>
@endsection
