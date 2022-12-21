<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>get Coordinates</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    @if(count($errors) > 0)
<div class="p-1">
    @foreach($errors->all() as $error)
    <div class="alert alert-warning alert-danger fade show" role="alert">{{$error}} 
       </div>
    @endforeach
</div>
@endif
    <form action="{{ route('fetch.coordinates') }}" method="post">
        @csrf
        <div class="form-group">
            <input type="text" name="country_code" class="form-control" id="countryCode"
                placeholder="Enter Country Code">
        </div>
        <div class="form-group">
            <input type="text" name="city" class="form-control" id="City" placeholder="Enter City">
        </div>
        <div class="form-group">
            <input type="text" name="street" class="form-control" id="Street" placeholder="Enter Street">
        </div>
        <div class="form-group">
            <input type="text" name="postal_code" class="form-control" id="postal_code"
                placeholder="Enter Postal Code">
        </div>
        <div class="form-check">
            <input type="checkbox" name="search[]" value="google_maps" class="form-check-input" id="googlMaps">
            <label class="form-check-label" for="googlMaps">Google Maps</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="search[]" value="here_maps" class="form-check-input" id="googlMaps">
            <label class="form-check-label" for="googlMaps">Here Maps</label>
        </div>
        <div class="form-check">
            <input type="checkbox" name="search[]" value="database" class="form-check-input" id="googlMaps">
            <label class="form-check-label" for="googlMaps">DataBase</label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</body>

</html>
