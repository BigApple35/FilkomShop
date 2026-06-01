<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f1f3f4;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: white;
            width: 400px;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #202124;
        }

        .profile-avatar {
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: #4285F4;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            font-weight: 500;
            margin: 0 auto 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #5f6368;
            font-size: 14px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #dadce0;
            border-radius: 8px;
            font-size: 14px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 24px;
            background: #1a73e8;
            color: white;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
        }

        button:hover {
            background: #1669d6;
        }

        .success {
            background: #e6f4ea;
            color: #137333;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error {
            color: red;
            font-size: 13px;
            margin-top: 5px;
        }
    </style>
</head>
<body>

<div class="card">

    <h1>Edit Profile</h1>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="profile-avatar">
        {{ strtoupper(substr($user->name, 0, 1)) }}
    </div>

    <form action="{{ route('profile.update') }}" method="POST">

        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Full Name</label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                required
            >

            @error('name')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Email Address</label>

            <input
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                required
            >

            @error('email')
                <div class="error">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div style="display: flex; gap: 10px; margin-top: 10px;">

            <a
                href="{{ url('/') }}"
                style="
                    flex: 1;
                    text-align: center;
                    padding: 12px;
                    border-radius: 24px;
                    background: #e8f0fe;
                    color: #1a73e8;
                    text-decoration: none;
                    font-size: 14px;
                    font-weight: 500;
                "
            >
                Back
            </a>

            <button
                type="submit"
                style="flex: 1;"
            >
                Save Changes
            </button>

        </div>

    </form>

</div>

</body>
</html>