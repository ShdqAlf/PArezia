@extends('components.home', ['title' => 'Halaman Pelemar'])

@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header bg-primary">
                <h3 class="text-white">Tes Kemampuan</h3>
                <p>Berakhir Pada Tanggal : {{ \Carbon\Carbon::parse($tes->loker->tanggal_berakhir)->locale('id_ID')->isoFormat('D MMMM Y') }}</p>
            </div>
            <div class="card-body">
                <div class="text-center mt-3">
                    <a href="" id="mulai_tes" class="btn btn-primary">Mulai Tes ?</a>
                </div>
                <div id="tes" style="display: none;">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ab, culpa! Facilis enim culpa, modi,
                        incidunt reiciendis officia suscipit porro libero veniam quaerat dolorum quisquam magni placeat
                        nihil provident! Accusantium, rerum!</p>
                </div>
            </div>
        </div>
    </section>


    <script>
        document.getElementById('mulai_tes').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('tes').style.display = 'block';
            document.getElementById('mulai_tes').style.display = 'none';
        });
    </script>
@endsection
