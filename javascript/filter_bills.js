const filterButtons = document.querySelectorAll(".filter-btn");

let activeFilters = {
    status: null
};

function resetActiveButtons() {
    filterButtons.forEach(btn => btn.classList.remove('active'));
}

function filterBills() {
    const rows = document.querySelectorAll('#bill-rows tr');
    
    rows.forEach(row => {
        let showRow = true;
        
        if (activeFilters.status) {
            const statusBadge = row.querySelector('td:nth-child(5) .status-badge');
            if (statusBadge) {
                const statusText = statusBadge.innerText.trim();
                if (statusText !== activeFilters.status) {
                    showRow = false;
                }
            }
        }
        if (showRow) {
            row.classList.remove('titanic');
        } else {
            row.classList.add('titanic');
        }
    });
}

filterButtons.forEach(button => {
    button.addEventListener('click', function(event) {
        event.preventDefault();
        
        const category = this.getAttribute('data-category');
        const value = this.getAttribute('data-value');
        
        if (category === 'all') {
            activeFilters.status = null;
            resetActiveButtons();
            this.classList.add('active');
            filterBills();
            return;
        }
        const allButton = document.querySelector('[data-category="all"]');
        if (allButton) allButton.classList.remove('active');
        
        if (category === 'status') {
            if (activeFilters.status === value && this.classList.contains('active')) {
                activeFilters.status = null;
                this.classList.remove('active');
            } else {
                document.querySelectorAll('[data-category="status"]').forEach(btn => {
                    btn.classList.remove('active');
                });
                activeFilters.status = value;
                this.classList.add('active');
            }
        }
        
        filterBills();
    });
});