<!DOCTYPE html>
<html lang="es-MX">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar videojuego</title>
</head>

<body>
    <h1>Formulario de edición de videojuegos</h1>
    <p><a href="{{ route('games') }}">Listar todos los videojuegos</a></p>
    <form action="{{ route('updateVideogame') }}" method="POST">
        @csrf
        <input type="hidden" name="game_id" value="{{ $game->id }}">
        <input type="text" placeholder="Nombre del videojuego" name="name_game" value="{{ $game->name }}">
        @error('name_game')
            {{ $message }}
        @enderror
        <select name="categoria_id" id="">
            @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id }}" @if ($categoria->id == $game->category_id) selected @endif>
                    {{ $categoria->name }}</option>
            @endforeach
        </select>
        <input type="submit" value="Enviar">
    </form>
</body>

</html>
