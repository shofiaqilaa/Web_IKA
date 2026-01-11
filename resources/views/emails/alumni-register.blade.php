<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h2>Registrasi Alumni Berhasil</h2>

    <p>Halo Alumni Polines,</p>

    <p>Akun Anda telah berhasil dibuat. Berikut data login Anda:</p>

    <table cellpadding="6">
        <tr>
            <td>No KTA</td>
            <td>: <strong>{{ $no_kta }}</strong></td>
        </tr>
        <tr>
            <td>Email</td>
            <td>: {{ $email }}</td>
        </tr>
        <tr>
            <td>Password</td>
            <td>: <strong>{{ $password }}</strong></td>
        </tr>
    </table>

    <p>
        Silakan login dan <strong>segera ganti password</strong> demi keamanan akun Anda.
    </p>

    <p>
        Salam,<br>
        <strong>IKA POLINES</strong>
    </p>
</body>
</html>
