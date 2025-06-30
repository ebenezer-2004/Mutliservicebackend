{{-- filepath: c:\Users\EBENEZER\Desktop\IAEC\resources\views\admin\candidature\_index.blade.php --}}
@extends('admin.bases.layout')

@section('content')
@extends('admin.bases.layout')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                    <li class="breadcrumb-item" aria-current="page">Contact</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Message de contact</h2>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Affichage des messages --}}
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

<div class="row">
    <div class="col-sm-12">
        <div class="card table-card" style='padding:20px !important'>
            <div class="card-header mb-3">
                <h4 class="mb-0">Liste des messages</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="pc-dt-simple">
    <thead>
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($messages as $message)
        <tr>
            <td>{{ $message->id }}</td>
            <td>{{ $message->name }}</td>
            <td>{{ $message->email }}</td>
            <td>{{ $message->created_at ? $message->created_at->format('d/m/Y H:i') : '' }}</td>
            <td>
                <button class="btn btn-sm btn-info" title="Voir"
                    onclick="showMessageModal({{ $message->id }}, '{{ addslashes($message->name) }}', '{{ addslashes($message->email) }}', '{{ addslashes($message->telephone) }}', `{{ addslashes($message->message) }}`)">
                    <i class="ti ti-eye"></i>
                </button>
                <button class="btn btn-sm btn-danger" title="Supprimer"
                    onclick="confirmDelete({{ $message->id }})">
                    <i class="ti ti-trash"></i>
                </button>
                <form id="deleteForm-{{ $message->id }}" action="{{ route('messages.destroy', $message->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
                </div>
                <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="messageModalLabel">Détails du message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <div class="mb-2">
          <label class="form-label">Nom</label>
          <input type="text" class="form-control" id="modalName" disabled>
        </div>
        <div class="mb-2">
          <label class="form-label">Email</label>
          <input type="text" class="form-control" id="modalEmail" disabled>
        </div>
        <div class="mb-2">
          <label class="form-label">Téléphone</label>
          <input type="text" class="form-control" id="modalTelephone" disabled>
        </div>
       
        <div class="mb-2">
          <label class="form-label">Message</label>
          <textarea class="form-control" id="modalMessage" rows="4" disabled></textarea>
        </div>
      </div>
    </div>
  </div>
</div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
function showMessageModal(id, name, email, telephone, message) {
    document.getElementById('modalName').value = name;
    document.getElementById('modalEmail').value = email;
    document.getElementById('modalTelephone').value = telephone;
    document.getElementById('modalMessage').value = message;
    new bootstrap.Modal(document.getElementById('messageModal')).show();
}

function confirmDelete(id) {
    Swal.fire({
        title: 'Supprimer ce message ?',
        text: "Cette action est irréversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('deleteForm-' + id).submit();
        }
    });
}
</script>