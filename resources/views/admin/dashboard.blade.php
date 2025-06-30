@extends('admin.bases.layout')

@section('content')
@if (session('success'))
    <script>     
        Swal.fire({
            icon: 'success',
            title: 'Succès',
            text: '{{ session('success') }}'
        });
    </script>
@endif
@if (session('error'))
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            text: '{{ session('error') }}'
        });
    </script>
@endif
@if ($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Erreur',
            html: `{!! implode('<br>', $errors->all()) !!}`
        });
    </script>
@endif
  
<div class="container mt-4">
    <h2 class="mb-5 text-center" style="font-size:2.2rem;font-weight:900;letter-spacing:1px;">Tableau de bord Administrateur</h2>
    <div class="row justify-content-center">
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100" style="border-radius: 1.5rem;">
                <div class="card-body text-center py-5">
                    <i class="ti ti-users" style="font-size:3.5rem;color:#002855"></i>
                    <h5 class="card-title mt-4 mb-2" style="font-size:1.4rem;font-weight:700;">Utilisateurs</h5>
                    <p class="card-text display-4" style="font-weight:900;color:#002855;">{{ \App\Models\User::count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100" style="border-radius: 1.5rem;">
                <div class="card-body text-center py-5">
                    <i class="ti ti-file-text" style="font-size:3.5rem;color:#ffb400"></i>
                    <h5 class="card-title mt-4 mb-2" style="font-size:1.4rem;font-weight:700;">Articles publiés</h5>
                    <p class="card-text display-4" style="font-weight:900;color:#ffb400;">{{ \App\Models\Blog::where('statut',"1")->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100" style="border-radius: 1.5rem;">
                <div class="card-body text-center py-5">
                    <i class="ti ti-cash" style="font-size:3.5rem;color:#28a745"></i>
                    <h5 class="card-title mt-4 mb-2" style="font-size:1.4rem;font-weight:700;">Articles non publiés</h5>
                    <p class="card-text display-4" style="font-weight:900;color:#28a745;">{{ \App\Models\Blog::where('statut',"0")->count() }}</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card shadow-lg border-0 h-100" style="border-radius: 1.5rem;">
                <div class="card-body text-center py-5">
                    <i class="ti ti-book" style="font-size:3.5rem;color:#007bff"></i>
                    <h5 class="card-title mt-4 mb-2" style="font-size:1.4rem;font-weight:700;">Offres</h5>
                    <p class="card-text display-4" style="font-weight:900;color:#007bff;">{{ \App\Models\Opportunites::count() }}</p>
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
