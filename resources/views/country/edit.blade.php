<x-app-layout>
    <div>
        <div>
            <div>
                <h2>
                    {{ __('Edit Pays') }}
                </h2>
            </div>

            <div>
                <form method="POST" action="{{ route('country.update', $country->id) }}">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}

                    <div>
                        <div>
                            <label for="name">
                                {{ __('Name') }}
                            </label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ $country->name }}"
                                   required />
                        </div>
                    </div>

                    <div>
                        <button type="submit">
                            {{ __('Save Changes') }}
                        </button>
                    </div>
                </form>

                <form method="POST" action="{{ route('country.destroy', $country->id) }}" class="delete-form">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="delete-btn" data-id="{{ $country->id }}">{{ __('Delete') }}</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    if (confirm('Are you sure you want to delete this item?')) {
                        const id = this.dataset.id;
                        const resourceType = window.location.pathname.split('/')[1];

                        fetch(`/${resourceType}/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => {
                                if (response.ok) {
                                    window.location.href = `/${resourceType}`; // Redirect to index
                                } else {
                                    alert('Error deleting item');
                                }
                            });
                    }
                });
            });
        });
    </script>
</x-app-layout>
