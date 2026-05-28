<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f5f5;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .box {
            background: white;
            padding: 30px;
            width: 380px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            font-weight: 500;
        }

        label {
            font-size: 13px;
            color: #555;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        input:focus {
            border-color: #1a73e8;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #1558b0;
        }

        .success {
            background: #e6f4ea;
            color: #137333;
            padding: 10px;
            font-size: 13px;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .error {
            font-size: 12px;
            color: red;
            margin-top: -10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="box">

    <h2>Edit Profile</h2>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf
        @method('PUT')

        {{-- NAME --}}
        <label>Nama</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        {{-- EMAIL --}}
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email', $user->email) }}">
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <button type="submit">Update</button>
    </form>

</div>

</body>
</html>