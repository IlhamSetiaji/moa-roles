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
                        <h1>Halaman Dosen</h1>
                    </div>

                    <div class="section-body">
                        
                    </div>
                </section>
            </div>
            @include('stisla.footer')
        </div>
    </div>

@include('stisla.script')
</body>

</html>
