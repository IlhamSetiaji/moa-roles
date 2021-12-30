<!DOCTYPE html>
<html lang="en">

@include('stisla.head')

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            @include('stisla.navbar')
            @include('stisla.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-header">
                        <h1>Halaman Mahasiswa</h1>
                    </div>

                    <div class="section-body">
                        <p>Ini adalah halaman detail dari kelas {{ $masterClasses->name }}</p>
                    </div>
                </section>
            </div>
            @include('stisla.footer')
        </div>
    </div>
@include('stisla.script')
</body>

</html>
