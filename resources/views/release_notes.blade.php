
    <div class="container">
        <h1>Release Notes</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Version</th>
                    <th>Details</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($releaseNotes as $note)
                    <tr>
                        <td>{{ $note->version }}</td>
                        <td>{{ $note->details }}</td>
                        <td>{{ $note->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
