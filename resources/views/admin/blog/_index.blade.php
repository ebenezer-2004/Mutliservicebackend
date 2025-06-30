@extends('admin.bases.layout')

@section('content')
<div class="page-header">
    <div class="page-header-title">
        <h2>Gestion des Blogs</h2>
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

<div class="mb-3 text-end">
    <button class="btn btn-primary" onclick="showBlogModal('create')">
        <i class="ti ti-plus"></i> Ajouter un article
    </button>
</div>

<div class="card-body">
    <div class="dt-responsive">
        <table id="datatable-blogs" class="table table-striped table-bordered nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Titre</th>
                    <th>Auteur</th>
                    <th>Type</th>
                    <th>Statut</th>
                    <th>Image</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                <tr>
                    <td>{{ $blog->id }}</td>
                    <td>{{ $blog->titre }}</td>
                    <td>{{ $blog->user ? $blog->user->nom : '-' }}</td>
                    <td>{{ $blog->type }}</td>
                    <td>
                        @if($blog->statut === 'publie')
                            <span class="badge bg-success">Publié</span>
                        @else
                            <span class="badge bg-secondary">Brouillon</span>
                        @endif
                    </td>
                    <td>
                        @if($blog->image)
       
       
        <img src="{{ Storage::url($blog->image) }}" alt="image" style="max-width:60px;max-height:40px;">
    @endif
                    </td>
                    <td>{{ $blog->created_at ? $blog->created_at->format('d/m/Y') : '' }}</td>
                    <td>
                        <button class="btn btn-sm btn-warning" title="Modifier"
                            onclick="showBlogModal('edit', {{ $blog->id }}, 
                                '{{ addslashes($blog->titre) }}',
                                '{{ addslashes($blog->type) }}',
                                '{{ addslashes($blog->statut) }}',
                                `{{ addslashes($blog->contenu) }}`)">
                            <i class="ti ti-edit"></i>
                        </button>
                        <button class="btn btn-sm btn-danger" title="Supprimer"
                            onclick="showDeleteModal({{ $blog->id }}, '{{ addslashes($blog->titre) }}')">
                            <i class="ti ti-trash"></i>
                        </button>
                        <button class="btn btn-sm btn-info" title="Voir commentaires"
    onclick="showCommentsModal({{ $blog->id }}, '{{ addslashes($blog->titre) }}')">
    <i class="ti ti-message-dots"></i> {{-- Tu peux changer l'icône selon ta bibliothèque --}}
</button>

                        
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Blog (Ajout/Modification) -->
<div class="modal fade" id="blogModal" tabindex="-1" aria-labelledby="blogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="blogForm" method="POST" enctype="multipart/form-data" onsubmit="return syncTinyMCE()">
            @csrf
            <input type="hidden" name="_method" id="blogFormMethod" value="POST">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header  text-white" style="border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title" id="blogModalLabel">Ajouter un article</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Fermer"></button>
                </div>
                <div class="modal-body" style="background: #f8f9fa;">
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" name="titre" id="titre" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" name="type" id="type" required>
                            <option value="">Sélectionner</option>
                            <option value="actualité">Actualité</option>
                            <option value="événement">Événement</option>
                            <option value="autre">Autre</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-control" name="statut" id="statut" required>
                            <option value="brouillon">Brouillon</option>
                            <option value="publie">Publié</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                    <div class="mb-3">
                        <label for="contenu" class="form-label">Contenu</label>
                        <textarea id="pc-tinymce-1" name="contenu"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary" id="btnBlogSubmit">Enregistrer</button>
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
                <div class="modal-header bg-danger text-white"  style="color:white;border-radius: 16px 16px 0 0;">
                    <h5 class="modal-title" id="deleteModalLabel" style="color: #f8f9fa">Confirmation de suppression</h5>
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


<script>
    tinymce.init({
        selector: '#pc-tinymce-1',
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
        if (tinymce.get('pc-tinymce-1')) {
            document.getElementById('pc-tinymce-1').value = tinymce.get('pc-tinymce-1').getContent();
        }
        return true;
    }

    function showBlogModal(type, id = null, titre = '', type_val = '', statut = '', contenu = '') {
        let modal = new bootstrap.Modal(document.getElementById('blogModal'));
        let form = document.getElementById('blogForm');
        let methodInput = document.getElementById('blogFormMethod');
        document.getElementById('titre').value = titre || '';
        document.getElementById('type').value = type_val || '';
        document.getElementById('statut').value = statut || '';
        setTimeout(function() {
            // Correction : utiliser le bon id du textarea pour TinyMCE
            tinymce.get('pc-tinymce-1').setContent(contenu || '');
        }, 200);

        if (type === 'create') {
            form.action = "{{ route('admin.blog.store') }}";
            methodInput.value = 'POST';
            document.getElementById('blogModalLabel').innerText = 'Ajouter un article';
            document.getElementById('btnBlogSubmit').innerText = 'Créer';
        } else {
            form.action = "{{ url('admin/blogs') }}/" + id;
            methodInput.value = 'PUT';
            document.getElementById('blogModalLabel').innerText = 'Modifier l\'article';
            document.getElementById('btnBlogSubmit').innerText = 'Mettre à jour';
        }
        modal.show();
    }

    function showDeleteModal(id, titre) {
        let modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        let form = document.getElementById('deleteForm');
        document.getElementById('deleteBlogTitle').innerText = titre;
        form.action = "{{ url('admin/blogs') }}/" + id;
        modal.show();
    }

    // Initialisation du DataTable si la table existe et la librairie est chargée
    document.addEventListener('DOMContentLoaded', function() {
        var table = document.getElementById('datatable-blogs');
        if (table && typeof DataTable !== 'undefined') {
            new DataTable(table);
        }
    });

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

</script>
@endsection
