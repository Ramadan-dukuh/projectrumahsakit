@extends('template')

@section('content')
<div class="container">
    <h2>Edit Profil</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="photo" class="form-label">Foto Profil</label><br>
            @if(auth()->user()->photo)
                <img src="{{ asset('storage/' . auth()->user()->photo) }}" alt="Foto Profil" class="mb-2" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                <br>
                <input type="checkbox" name="remove_photo" value="1"> Hapus foto saat ini
            @endif
            <input type="file" name="photo" id="photo" class="form-control mt-2">
        </div>

        <button type="submit" class="btn btn-primary">Update Profil</button>
    </form>
</div>
@endsection
