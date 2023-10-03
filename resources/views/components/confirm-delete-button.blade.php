<button onclick="confirmDelete('{{ $route }}')" class="mt-3 text-indigo-500 inline-flex items-center">Delete</button>

<script>
    function confirmDelete(deleteRoute) {
        if (confirm('Are you sure you want to delete this item?')) {
            window.location.href = deleteRoute; // Redirect to the delete route
        }
    }
</script>