<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="card p-5">
            <div class="card-header">Xin chào khách hàng {{$hoTen}}!</div>
            <div class="card-body">
                <p class="mb-0">
                    {!! nl2br($noiDung) !!}
                </p>
            </div>
        </div>
    </div>
</div>
