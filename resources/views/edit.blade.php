<!DOCTYPE html>
<html>
<head>
    <title>Edit Profile</title>
</head>
<body>

    <h1>Edit Profile</h1>

    <form action="{{ route('profile.update') }}" method="POST">

        @csrf
        @method('PUT')

        <input type="text"
               name="name"
               value="{{ $user->name }}">

        <br><br>

        <input type="email"
               name="email"
               value="{{ $user->email }}">

        <br><br>

        <button type="submit">
            Update Profile
        </button>

    </form>

</body>
</html>