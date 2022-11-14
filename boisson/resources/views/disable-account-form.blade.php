<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desactivation de comptes</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        input,
        button,
        select {
            padding: 5px;
        }

        .form-container {
            /* width: 500px; */
            margin: 10px;
            padding: 10px;
            overflow: auto;
        }

        .form-group {
            margin-top: 10px;
        }

        .message {
            color: rgb(164, 116, 209);
        }
    </style>
</head>

<body>


    <div class="form-container" style="">
        @if (session('message'))
            <h2 class="message">{{ session('message') }}</h2>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li class="message">{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <h3>Expiration De Comptes</h3>
        <form action="{{ route('desactivate-account.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="expiration_date">Date D'Expiration</label>
                <input type="datetime-local" mn="{{ date('Y-m-d') }}T{{ date('H:i') }}" id="expiration_date"
                    name="expiration_date">
            </div>
            {{-- <div class="form-group">
                <label for="user_id">Utilisateur</label>
                <select name="user_id" id="user_id">
                    <option value="">Choisir</option>
                    <option value="tout">Tout</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ Str::title($user->full_name) }}</option>
                    @endforeach
                </select>
            </div> --}}
            <div class="form-group">
                <input type="checkbox" name="deactivate" checked>désactiver
            </div>
            <div class="form-group">
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </div>

</body>

</html>
