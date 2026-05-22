<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>

    <h1>Profile Page</h1>

    <p>Name: {{ $user->name }}</p>
    <p>Email: {{ $user->email }}</p>

    <a href="{{ route('profile.edit') }}">
        Edit Profile
    </a>

</body>
</html>