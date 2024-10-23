<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Chào Admin!</div>
                <div class="card-body">
                    <p class="mb-0">Có một khách hàng liên hệ từ website:</p>
                    <hr>
                    <p class="mb-0">Họ tên khách hàng: {{$hoTen}}</p>
                    <p class="mb-0">Email khách hàng: {{$email}}</p>
                    <p class="mb-0">Nội dung khách liên hệ: {!! nl2br($noiDung) !!}</p>
                </div>
            </div>
        </div>
    </div>
</div>
