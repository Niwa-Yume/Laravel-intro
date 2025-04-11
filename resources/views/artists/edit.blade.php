<x-app-layout>
<div>
    <div>
        <div>
            <h2>
                {{ __('Edit Artist') }}
            </h2>
        </div>

        <div>
            <form method="POST" action="{{ route('artist.update', $artist->id) }}">
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
                               value="{{ $artist->name }}"
                               required />
                    </div>

                    <div>
                        <label for="firstname">
                            {{ __('Firstname') }}
                        </label>
                        <input type="text"
                               name="firstname"
                               id="firstname"
                               value="{{ $artist->firstname }}"
                               required />
                    </div>

                    <div>
                        <label for="country_id">
                            {{ __('Country') }}
                        </label>
                        <select name="country_id"
                                id="country_id"
                                required>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->id == $artist->country_id ? 'selected="selected"' : '' }}>
                                    {{ $country->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit">
                        {{ __('Save Changes') }}
                    </button>
                </div>
            </form>

            <form method="POST"
                  action="{{ route('artist.destroy', $artist->id) }}"
                  class="delete-form">
                @csrf
                @method('DELETE')
                <button type="submit">
                    {{ __('Delete') }}
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    let token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.delete-btn').forEach(button => {
            button.addEventListener('click', function() {
                if (confirm('Are you sure you want to delete this item?')) {
                    const id = this.dataset.id;
                    const resourceType = window.location.pathname.split('/')[1]; // Gets 'artist', 'film', etc.

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
                                window.location = '/artist';
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
