document.addEventListener('DOMContentLoaded', function () {
    var container = document.querySelector('[data-api-sessions]');
    var refreshButton = document.querySelector('[data-refresh-sessions]');
    var searchInput = document.querySelector('[data-api-search]');

    if (!container) {
        return;
    }

    var allSessions = [];

    function render(sessions) {
        if (!sessions.length) {
            container.innerHTML = '<div class="empty">No sessions matched your search.</div>';
            return;
        }

        container.innerHTML = sessions.map(function (session) {
            var color = session.track_color || '#1d4ed8';
            return [
                '<article class="card api-card" style="border-left-color:' + color + '">',
                '<span class="badge">' + escapeHtml(session.track || 'General') + '</span>',
                '<h3>' + escapeHtml(session.title) + '</h3>',
                '<p>' + escapeHtml(session.description.substring(0, 160)) + '...</p>',
                '<p><strong>Time:</strong> ' + escapeHtml(session.date + ' ' + session.time) + '</p>',
                '<p><strong>Room:</strong> ' + escapeHtml(session.room || '-') + '</p>',
                '<p><strong>Speaker:</strong> ' + escapeHtml(session.speaker || '-') + '</p>',
                '<p><strong>Seats left:</strong> ' + session.available_seats + '</p>',
                '</article>'
            ].join('');
        }).join('');
    }

    function loadSessions() {
        container.innerHTML = '<div class="empty">Loading sessions from API...</div>';
        fetch('/api/sessions')
            .then(function (response) { return response.json(); })
            .then(function (payload) {
                allSessions = payload.data || [];
                render(allSessions);
            })
            .catch(function () {
                container.innerHTML = '<div class="alert alert-error">Could not load API data.</div>';
            });
    }

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    if (refreshButton) {
        refreshButton.addEventListener('click', loadSessions);
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var term = searchInput.value.toLowerCase();
            render(allSessions.filter(function (session) {
                return [session.title, session.description, session.room, session.speaker, session.track]
                    .join(' ')
                    .toLowerCase()
                    .indexOf(term) !== -1;
            }));
        });
    }

    loadSessions();
});
