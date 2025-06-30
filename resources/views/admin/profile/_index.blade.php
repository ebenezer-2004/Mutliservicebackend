@extends('admin.bases.layout')

@section('content')

 <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
            <div class="col-md-12">
              <ul class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Acceuil</a></li>
                <li class="breadcrumb-item"><a href="javascript: void(0)">Utilisateur</a></li>
                <li class="breadcrumb-item" aria-current="page">Compte</li>
              </ul>
            </div>
            <div class="col-md-12">
              <div class="page-header-title">
                <h2 class="mb-0">Mon compte</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="row">
        <div class="col-sm-12">
          <div class="card">
            <div class="card-body py-0">
              <ul class="nav nav-tabs profile-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="profile-tab-1" data-bs-toggle="tab" href="#profile-1" role="tab"
                    aria-selected="true">
                    <i class="ti ti-user me-2"></i>Profile
                  </a>
                </li>            
                <li class="nav-item">
                  <a class="nav-link" id="profile-tab-4" data-bs-toggle="tab" href="#profile-4" role="tab"
                    aria-selected="true">
                    <i class="ti ti-lock me-2"></i>Modifier le mot de passe
                  </a>
                </li> 
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane show active" id="profile-1" role="tabpanel" aria-labelledby="profile-tab-1">
              <div class="row">
              
                <div class="col-lg-12 col-xxl-12">
                  
                  <div class="card">
                    <div class="card-header">
                      <h5>Personal Details</h5>
                    </div>
                    <div class="card-body">
                      <ul class="list-group list-group-flush">
                        <li class="list-group-item px-0 pt-0">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Nom</p>
                              <p class="mb-0">{{Auth::user()->nom}}</p>
                            </div>
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Prénom</p>
                              <p class="mb-0">{{Auth::user()->prenom}}</p>
                            </div>
                          </div>
                        </li>
                        <li class="list-group-item px-0">
                          <div class="row">
                            <div class="col-md-6">
                              <p class="mb-1 text-muted">Email</p>
                              <p class="mb-0">{{Auth::user()->email}}</p>
                            </div>
                             <div class="col-md-6">
                              <p class="mb-1 text-muted">Role</p>
                              <p class="mb-0">{{Auth::user()->role}}</p>
                            </div>
                           
                          </div>
                        </li>
                       
                        
                      </ul>
                    </div>
                  </div>
                
                </div>
              </div>
            </div>
          
            <div class="tab-pane" id="profile-4" role="tabpanel" aria-labelledby="profile-tab-4">
              <form  method="post" action="{{ route('admin.password.update') }}">
                @csrf
              <div class="card">
                <div class="card-header">
                  <h5>Modifier mot de passe</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="form-group">
                        <label class="form-label">Ancien Mot de Passe</label>
                        <input type="password" class="form-control" name="current_password">
                      @error('current_password')
                        <span class="text-danger">{{ $message }}</span> 
                      @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Nouveau Mot de Passe</label>
                        <input type="password" class="form-control" name="new_password" >
                     @error('new_password')
                    <span class="text-danger">{{ $message }}</span> 

                     @enderror
                      </div>
                      <div class="form-group">
                        <label class="form-label">Confirmation du Mot de Passe</label>
                        <input type="password" class="form-control" name="new_password_confirmation">
                       @error('new_password_confirmation')
<span class="text-danger">{{ $message }}</span> 
   
                       @enderror
                     
                      </div>
                    </div>
                  
                  </div>
                </div>
                <div class="card-footer text-end btn-page">
                  <div class=""><button type="submit" class="btn btn-primary">Modifier le Profile</button></div>
                </div>
              </div>
              </form>
            </div>
          
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
      <!-- [ Main Content ] end -->
    </div>
  </div>

@endsection