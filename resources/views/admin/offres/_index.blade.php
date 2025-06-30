{{-- filepath: c:\Users\EBENEZER\Desktop\IAEC\resources\views\admin\candidature\_index.blade.php --}}
@extends('admin.bases.layout')

@section('content')
<div class="page-header">
    <div class="page-block">
        <div class="row align-items-center">
            <div class="col-md-12">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Accueil</a></li>
                    <li class="breadcrumb-item" aria-current="page">offres</li>
                </ul>
            </div>
            <div class="col-md-12">
                <div class="page-header-title">
                    <h2 class="mb-0">Liste des offres</h2>
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

        <div class="card table-card"  style='padding:20px !important'>
            <div class="card-header mb-3">
                 <div class="mb-3 text-end">
       <div class="mb-3 text-end">
   <button class="btn btn-primary" onclick="showOffreModal('create')">
  <i class="ti ti-plus"></i> Ajouter une offre
</button>
</div>
    </div>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle" id="pc-dt-simple">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Fichier(pdf,doc,docs)</th>
                                <th>Titre</th>
                                <th>Durée(mois)</th>
                               
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                      <tbody>
  @foreach ($offres as $offre)
    <tr>
      <td>{{ $offre->id }}</td>
      <td>
        @if($offre->fichier)
          <a href="{{ Storage::url($offre->fichier) }}" target="_blank">Voir fichier</a>
        @endif
      </td>
      <td>{{ $offre->title }}</td>
      <td>{{ $offre->dure }} jours</td>
      <td>{{ $offre->datefin }}</td>
      <td>
        <button class="btn btn-sm btn-warning" onclick="showOffreModal('edit', {{ $offre->id }}, '{{ addslashes($offre->title) }}', `{{ addslashes($offre->description) }}`, '{{ $offre->dure }}', '{{ $offre->datefin }}')">  <i class="ti ti-edit"></i></button>
        <button class="btn btn-sm btn-danger" onclick="showDeleteModal({{ $offre->id }}, '{{ addslashes($offre->title) }}')">  <i class="ti ti-trash"></i></button>
      </td>
    </tr>
  @endforeach
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="offreModal" tabindex="-1" aria-labelledby="offreModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form id="offreForm" method="POST" enctype="multipart/form-data" onsubmit="return syncTinyMCE()">
      @csrf
      <input type="hidden" name="_method" id="offreFormMethod" value="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="offreModalLabel">Ajouter une offre</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" name="title" id="title" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea id="pc-tinymce-4" name="description"></textarea>
          </div>
          <div class="mb-3">
            <label for="dure" class="form-label">Durée (jours)</label> 
            <input type="number" class="form-control" name="dure" id="dure" required>
          </div>
          <div class="mb-3">
            <label for="fichier" class="form-label">Fichier (PDF, DOC, DOCX)</label>
            <input type="file" class="form-control" name="fichier" id="fichier" accept=".pdf,.doc,.docx">
          </div>
          <div class="mb-3">
            <label for="datefin" class="form-label">Date de fin</label>
            <input type="date" class="form-control" name="datefin" id="datefin" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn btn-primary" id="btnOffreSubmit">Enregistrer</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header text-white"  style="border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title" id="deleteModalLabel" >Confirmation de suppression</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment supprimer l'article <span id="deleteBlogTitle" class="fw-bold"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="PublieModal" tabindex="-1" aria-labelledby="PublieModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="publieForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header text-white"  style="border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title" id="deleteModalLabel" >Confirmation de publication</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    <p>Voulez-vous vraiment publier l'article <span id="publieBlogTitle" class="fw-bold"></span> ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Publier</button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="modal fade" id="commentsModal" tabindex="-1" aria-labelledby="commentsModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header  text-white">
                <h5 class="modal-title" id="commentsModalTitle">Commentaires</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
            </div>
            <div class="modal-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Nom</th>
                             <th>Email</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="commentsTableBody">
                        {{-- Les commentaires seront injectés ici --}}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

        
    </div>


<script>
    tinymce.init({
        selector: '#pc-tinymce-4',
        menubar: true,
        plugins: 'lists link image table code textcolor colorpicker advlist autolink charmap print preview anchor searchreplace visualblocks fullscreen insertdatetime media paste help wordcount',
        toolbar: 'undo redo | styles | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | fontselect fontsizeselect | removeformat | code | align | image | table | link',
        branding: false,
        height: 250,
        fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt',
        font_formats: 'Arial=arial,helvetica,sans-serif; Courier New=courier new,courier,monospace; Times New Roman=times new roman,times; Verdana=verdana,geneva,sans-serif',
        content_style: "body { font-family:Arial,sans-serif; font-size:14px }",
        toolbar_mode: 'sliding',
        image_caption: true,
        table_toolbar: "tableprops tabledelete | tableinsertrowbefore tableinsertrowafter tabledeleterow | tableinsertcolbefore tableinsertcolafter tabledeletecol",
        paste_as_text: true
    });

    function syncTinyMCE() {
        if (tinymce.get('pc-tinymce-4')) {
            document.getElementById('pc-tinymce-4').value = tinymce.get('pc-tinymce-4').getContent();
        }
        return true;
    }

    function showOffreModal(type, id = null, title = '', description = '', dure = '', datefin = '') {
  let modal = new bootstrap.Modal(document.getElementById('offreModal'));
  let form = document.getElementById('offreForm');
  let methodInput = document.getElementById('offreFormMethod');
  document.getElementById('title').value = title || '';
  document.getElementById('dure').value = dure || '';
  document.getElementById('datefin').value = datefin || '';
  setTimeout(function() {
    tinymce.get('pc-tinymce-4').setContent(description || '');
  }, 200);

  if (type === 'create') {
    form.action = "{{ route('admin.offre.store') }}";
    methodInput.value = 'POST';
    document.getElementById('offreModalLabel').innerText = 'Ajouter une offre';
    document.getElementById('btnOffreSubmit').innerText = 'Créer';
  } else {
    form.action = "{{ url('/admin/offres/update/') }}/" + id;
    methodInput.value = 'PUT';
    document.getElementById('offreModalLabel').innerText = 'Modifier l\'offre';
    document.getElementById('btnOffreSubmit').innerText = 'Mettre à jour';
  }
  modal.show();
}

    function showDeleteModal(id, titre) {
        let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        let form = document.getElementById('deleteForm');
        document.getElementById('deleteBlogTitle').innerText = titre;
        form.action = "{{ url('admin/offres/delete/') }}/" + id;
        modal.show();
    }

  function showPublieModal(id, titre) {
    let modal = new bootstrap.Modal(document.getElementById('PublieModal'));
    let form = document.getElementById('publieForm');
    document.getElementById('publieBlogTitle').innerText = titre;
    // Utilise la route Laravel générée côté Blade
    form.action = "{{ url('admin/blogs') }}/" + id + "/publier";
    modal.show();
}
   

    function showCommentsModal(blogId, blogTitle) {
    document.getElementById('commentsModalTitle').innerText = blogTitle;

    fetch(`/admin/blogs/${blogId}/comments`)
        .then(response => response.json())
        .then(data => {
            let tbody = document.getElementById('commentsTableBody');
            tbody.innerHTML = '';
            if (data.length === 0) {
                tbody.innerHTML = '<tr><td colspan="3">Aucun commentaire trouvé.</td></tr>';
            } else {
                data.forEach(comment => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${comment.name}</td>
                               <td>${comment.email}</td>
                            <td>${comment.contenu}</td>
                            <td>${new Date(comment.created_at).toLocaleDateString()}</td>
                            <td>
        <button class="btn btn-sm btn-danger" onclick="deleteComment(${comment.id})">
            <i class="ti ti-trash"></i>
        </button>
    </td>
                        </tr>
                    `;
                });
            }
            new bootstrap.Modal(document.getElementById('commentsModal')).show();
        });
}

function deleteComment(id) {
    Swal.fire({
        title: 'Supprimer ce commentaire ?',
        text: "Cette action est irréversible.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Oui, supprimer',
        cancelButtonText: 'Annuler'
    }).then((result) => {
        if (result.isConfirmed) {
            fetch(`/admin/comments/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Supprimé !', data.message, 'success');
                    showCommentsModal(currentBlogId, currentBlogTitle); 
                } else {
                    Swal.fire('Erreur', 'Impossible de supprimer ce commentaire.', 'error');
                }
            })
            .catch(() => {
                Swal.fire('Erreur', 'Une erreur est survenue.', 'error');
            });
        }
    });
}

document.getElementById('publieForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    fetch(form.action, {
        method: 'PUT',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(response => {
        if (response.ok) {
            location.reload(); 
        } else {
            return response.json().then(data => { throw data; });
        }
    }) 
    .catch(error => {
        Swal.fire('Erreur', 'Impossible de publier cet article.', 'error');
    });
});

</script>
@endsection