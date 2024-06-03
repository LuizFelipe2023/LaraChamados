<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - LaraChamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Enviar Feedback</h2>
            <form method="POST" action="{{ route('chamados.feedback.insert', ['chamado_id' => $chamado->id]) }}">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="feedback">Feedback</label>
                    <textarea id="feedback" class="form-control @error('feedback') is-invalid @enderror" name="feedback" required autofocus>{{ old('feedback') }}</textarea>

                    @error('feedback')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="rating">Avaliação (de 1 a 5)</label>
                    <input id="rating" type="number" class="form-control @error('rating') is-invalid @enderror" name="rating" min="1" max="5" required>

                    @error('rating')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-0">
                    <button type="submit" class="btn btn-primary">Enviar Feedback</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>
