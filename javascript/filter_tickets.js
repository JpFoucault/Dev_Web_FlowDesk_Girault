const filterButtons = document.querySelectorAll(".filter-btn");

function resetActiveButtons() {
    filterButtons.forEach(btn => {
        btn.classList.remove('active');
    });
}

let activeFilters = {
    status: null,
    billable: null
};

function filterTickets() {
    const rows = document.querySelectorAll('#ticket-rows tr');
    
    rows.forEach(row => {
        let showRow = true;
        
        if (activeFilters.status) {
            const statusBadge = row.querySelector('.status-badge');
            if (statusBadge) {
                const statusText = statusBadge.innerText.trim();
                if (statusText != activeFilters.status) {
                    showRow = false;
                }
            }
        }
        
        if (activeFilters.billable) {
            const billableCell = row.querySelector('td:nth-child(2)');
            if (billableCell) {
                const billableText = billableCell.innerText.trim();
                if (billableText != activeFilters.billable) {
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
        
        if (category == 'all') {
            activeFilters.status = null;
            activeFilters.billable = null;
            
            resetActiveButtons();
            
            this.classList.add('active');
            
            const rows = document.querySelectorAll('#ticket-rows tr');
            rows.forEach(row => {
                row.classList.remove('titanic');
            });
            
            return;
        }
        
        const allButton = document.querySelector('[data-category="all"]');
        if (allButton) {
            allButton.classList.remove('active');
        }
        
        if (category == 'status') {
            if (activeFilters.status == value && this.classList.contains('active')) {
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
        
        if (category == 'billable') {
            if (activeFilters.billable == value && this.classList.contains('active')) {
                activeFilters.billable = null;
                this.classList.remove('active');
            } else {
                document.querySelectorAll('[data-category="billable"]').forEach(btn => {
                    btn.classList.remove('active');
                });

                activeFilters.billable = value;
                this.classList.add('active');
            }
        }
        
        filterTickets();
    });
});