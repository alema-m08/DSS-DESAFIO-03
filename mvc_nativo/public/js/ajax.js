document.addEventListener('DOMContentLoaded', function () {

    const checkboxes = document.querySelectorAll('.task-toggle-checkbox');

    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const taskId = this.getAttribute('data-id');
            const url = this.getAttribute('data-url');
            const isChecked = this.checked;

            const cardItem = document.getElementById(`task-card-${taskId}`);
            const title = document.getElementById(`task-title-${taskId}`);
            const desc = document.getElementById(`task-desc-${taskId}`);
            const badge = document.getElementById(`task-badge-${taskId}`);

            fetch(url, {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error al actualizar el estado de la tarea.');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    const newStatus = data.estado;

                    if (cardItem) {
                        cardItem.setAttribute('data-status', newStatus);
                    }

                    if (newStatus === 'completada') {
                        if (title) title.classList.add('text-decoration-line-through', 'text-opacity-50');
                        if (desc) desc.classList.add('text-opacity-50');
                        if (badge) {
                            badge.textContent = 'Completada';
                            badge.className = 'badge badge-status rounded-pill px-2.5 py-1.5 fs-7 bg-success bg-opacity-10 text-success border border-success border-opacity-25';
                        }
                        updateStats(1);
                    } else {
                        if (title) title.classList.remove('text-decoration-line-through', 'text-opacity-50');
                        if (desc) desc.classList.remove('text-opacity-50');
                        if (badge) {
                            badge.textContent = 'Pendiente';
                            badge.className = 'badge badge-status rounded-pill px-2.5 py-1.5 fs-7 bg-warning bg-opacity-10 text-warning border border-warning border-opacity-25';
                        }
                        updateStats(-1);
                    }

                    showToast(data.message || 'Tarea actualizada correctamente.', 'success');

                    runActiveFilter();
                } else {
                    this.checked = !isChecked;
                    showToast(data.message || 'No se pudo actualizar el estado.', 'danger');
                }
            })
            .catch(error => {
                this.checked = !isChecked;
                showToast(error.message || 'Ocurrió un error de red.', 'danger');
            });
        });
    });

    function updateStats(direction) {
        const completedCountEl = document.getElementById('stat-completed-count');
        const pendingCountEl = document.getElementById('stat-pending-count');

        if (completedCountEl && pendingCountEl) {
            let completed = parseInt(completedCountEl.textContent) || 0;
            let pending = parseInt(pendingCountEl.textContent) || 0;

            if (direction === 1) {
                completed++;
                pending--;
            } else {
                completed--;
                pending++;
            }

            completedCountEl.textContent = completed;
            pendingCountEl.textContent = pending;
        }
    }

    function showToast(message, type) {
        const toastContainer = document.getElementById('toast-container');
        if (!toastContainer) return;

        const toastId = 'toast-' + Date.now();
        const bgClass = type === 'success' ? 'toast-success' : 'toast-error';
        const iconClass = type === 'success' ? 'fa-solid fa-circle-check text-success' : 'fa-solid fa-triangle-exclamation text-danger';

        const toastHTML = `
            <div id="${toastId}" class="toast align-items-center border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex bg-glass p-2 rounded-3">
                    <div class="toast-body d-flex align-items-center text-white">
                        <i class="${iconClass} me-2.5 fs-5"></i>
                        <span>${message}</span>
                    </div>
                    <button type="button" class="btn-close btn-close-white m-auto me-2" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        `;

        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastEl = document.getElementById(toastId);

        const bsToast = new bootstrap.Toast(toastEl, { delay: 3500 });
        bsToast.show();

        toastEl.addEventListener('hidden.bs.toast', function () {
            toastEl.remove();
        });
    }

    const filterButtons = document.querySelectorAll('.btn-filter');
    const taskCards = document.querySelectorAll('.task-card-item');

    filterButtons.forEach(btn => {
        btn.addEventListener('click', function () {
            filterButtons.forEach(b => {
                b.classList.remove('active', 'bg-white', 'bg-opacity-10', 'text-white');
                b.classList.add('text-secondary-light');
            });

            this.classList.add('active', 'bg-white', 'bg-opacity-10', 'text-white');
            this.classList.remove('text-secondary-light');

            runActiveFilter();
        });
    });

    function runActiveFilter() {
        const activeBtn = document.querySelector('.btn-filter.active');
        if (!activeBtn) return;

        const filterValue = activeBtn.getAttribute('data-filter');

        taskCards.forEach(card => {
            const status = card.getAttribute('data-status');

            if (filterValue === 'todas') {
                card.style.display = 'block';
            } else if (filterValue === 'pendientes' && status === 'pendiente') {
                card.style.display = 'block';
            } else if (filterValue === 'completadas' && status === 'completada') {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }
});
