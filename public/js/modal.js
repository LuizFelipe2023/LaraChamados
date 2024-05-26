document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.btn-delete');
    deleteButtons.forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const deleteUrl = this.dataset.deleteUrl;
            confirmDelete(deleteUrl);
        });
    });

    const cancelDeleteButton = document.getElementById('cancelDelete');
    cancelDeleteButton.addEventListener('click', function (event) {
        event.preventDefault();
        closeDeleteModal();
    });
});

function confirmDelete(deleteUrl) {
    const deleteForm = document.getElementById('deleteForm');
    deleteForm.setAttribute('action', deleteUrl);
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.style.display = 'block';
}

function closeDeleteModal() {
    const deleteModal = document.getElementById('deleteModal');
    deleteModal.style.display = 'none';
}