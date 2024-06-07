<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback - LaraChamados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/edit.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h2>Enviar Feedback</h2>
            <form method="POST" action="{{ route('chamados.feedback.insert', $chamado->id) }}">
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
                    <div class="stars">
                        <input type="radio" id="star5" name="rating" class="star star-5" value="5" />
                        <label class="star star-5" for="star5"></label>
                        <input type="radio" id="star4" name="rating" class="star star-4" value="4" />
                        <label class="star star-4" for="star4"></label>
                        <input type="radio" id="star3" name="rating" class="star star-3" value="3" />
                        <label class="star star-3" for="star3"></label>
                        <input type="radio" id="star2" name="rating" class="star star-2" value="2" />
                        <label class="star star-2" for="star2"></label>
                        <input type="radio" id="star1" name="rating" class="star star-1" value="1" />
                        <label class="star star-1" for="star1"></label>
                    </div>
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
